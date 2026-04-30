<?php

namespace App\Controllers;

use App\Models\AlunosModel;
use App\Models\ProfessorModel;
use App\Models\TrabalhadorModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class RelatorioController extends BaseController
{
    /**
     * Exportação para Excel (Alunos, Professores e Trabalhadores)
     */
    public function exportarExcel($tipo, $id_turma = null)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        switch ($tipo) {
            case 'alunos':
                if ($id_turma) {
                    $db = \Config\Database::connect();
                    $data = $db->query("SELECT a.* FROM alunos a JOIN matriculas m ON m.id_aluno = a.id_aluno WHERE m.id_turma = ?", [$id_turma])->getResultArray();
                    $filename = "Lista_Alunos_Turma_" . $id_turma;
                } else {
                    $data = (new AlunosModel())->findAll();
                    $filename = "Lista_Geral_Alunos";
                }
                $headers = ['ID', 'Nome Completo', 'Gênero', 'Data Nascimento', 'Telefone'];
                $keys = ['id_aluno', 'nome', 'genero', 'data_nascimento', 'telefone'];
                break;

            case 'professores':
                $data = (new ProfessorModel())->findAll();
                $filename = "Lista_Professores";
                $headers = ['ID', 'Nome', 'Especialidade', 'Email', 'Telefone'];
                $keys = ['id_professor', 'nome', 'especialidade', 'email', 'telefone'];
                break;

            default: // trabalhadores
                $data = (new TrabalhadorModel())->findAll();
                $filename = "Lista_Trabalhadores";
                $headers = ['ID', 'Nome', 'Cargo', 'NIF', 'Telefone'];
                $keys = ['id_trabalhador', 'nome', 'cargo', 'nif', 'telefone'];
        }

        // Cabeçalho
        foreach ($headers as $col => $text) {
            $sheet->setCellValueByColumnAndRow($col + 1, 1, $text);
        }

        // Dados
        $rowIdx = 2;
        foreach ($data as $item) {
            foreach ($keys as $colIdx => $key) {
                $sheet->setCellValueByColumnAndRow($colIdx + 1, $rowIdx, $item[$key] ?? '');
            }
            $rowIdx++;
        }

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
        $writer->save('php://output');
        exit;
    }

    /**
     * Exportação para PDF (Listas Nominais)
     */
    public function exportarPdf($tipo, $id_turma = null)
    {
        $db = \Config\Database::connect();

        if ($tipo == 'alunos') {
            if ($id_turma) {
                $data['lista'] = $db->query("SELECT a.* FROM alunos a JOIN matriculas m ON m.id_aluno = a.id_aluno WHERE m.id_turma = ?", [$id_turma])->getResultArray();
                $turma = $db->table('turmas')->where('id_turma', $id_turma)->get()->getRowArray();
                $data['titulo'] = "LISTA DE TURMA: " . ($turma['nome_turma'] ?? '');
            } else {
                $data['lista'] = (new AlunosModel())->findAll();
                $data['titulo'] = "LISTA NOMINAL DE ALUNOS";
            }
            $data['colunas'] = ['ID', 'Nome', 'Gênero', 'Telefone'];
            $data['campos'] = ['id_aluno', 'nome', 'genero', 'telefone'];
        } elseif ($tipo == 'professores') {
            $data['lista'] = (new ProfessorModel())->findAll();
            $data['titulo'] = "CORPO DOCENTE - PROFESSORES";
            $data['colunas'] = ['ID', 'Nome', 'Especialidade', 'Email'];
            $data['campos'] = ['id_professor', 'nome', 'especialidade', 'email'];
        } else {
            $data['lista'] = (new TrabalhadorModel())->findAll();
            $data['titulo'] = "QUADRO DE PESSOAL - TRABALHADORES";
            $data['colunas'] = ['ID', 'Nome', 'Cargo', 'NIF'];
            $data['campos'] = ['id_trabalhador', 'nome', 'cargo', 'nif'];
        }

        $html = view('relatorios/pdf_template', $data);
        $this->gerarDompdf($html, $tipo . ".pdf");
    }

    /**
     * Mapa de Aproveitamento com Gráficos (PDF)
     */
    public function mapaAproveitamento($id_turma)
    {
        $db = \Config\Database::connect();
        
        $turma = $db->table('turmas')->where('id_turma', $id_turma)->get()->getRowArray();
        
        // Estatísticas dos 3 trimestres para o gráfico comparativo
        $stats = $db->query("
            SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN mt1 >= 9.5 THEN 1 ELSE 0 END) as pos1,
                SUM(CASE WHEN mt2 >= 9.5 THEN 1 ELSE 0 END) as pos2,
                SUM(CASE WHEN mt3 >= 9.5 THEN 1 ELSE 0 END) as pos3
            FROM notas n
            JOIN matriculas m ON n.id_aluno = m.id_aluno
            WHERE m.id_turma = ?
        ", [$id_turma])->getRowArray();

        $data = [
            'turma' => $turma,
            'stats' => $stats,
            'titulo' => "MAPA DE APROVEITAMENTO ESTATÍSTICO"
        ];

        $html = view('relatorios/mapa_aproveitamento_pdf', $data);
        $this->gerarDompdf($html, "mapa_aproveitamento.pdf");
    }

    /**
     * Função privada para evitar repetição de código Dompdf
     */
    private function gerarDompdf($html, $filename)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream($filename, ["Attachment" => false]);
        exit;
    }
}