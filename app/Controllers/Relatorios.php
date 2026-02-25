<?php

namespace App\Controllers;

// Importação das bibliotecas necessárias
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controllers\BaseController;

class Relatorio extends BaseController
{
    /**
     * Método gerar: Responsável por buscar os dados e renderizar o PDF
     * O nome deve ser exatamente 'gerar' para bater com a rota definida
     */
    public function gerar($id_turma = null)
    {
        // Validação básica para evitar erros sem ID
        if (!$id_turma) {
            return "Erro: ID da turma não fornecido.";
        }

        $db = \Config\Database::connect();

        // 1. Busca os detalhes da Turma
        $turma = $db->table('turmas')
            ->select('turmas.*, trabalhadores.nome as nome_professor, disciplinas.nome_disciplina, salas.nome_sala')
            ->join('trabalhadores', 'trabalhadores.id_trabalhador = turmas.id_professor', 'left')
            ->join('disciplinas', 'disciplinas.id_disciplina = turmas.id_disciplina', 'left')
            ->join('salas', 'salas.id_sala = turmas.id_sala', 'left')
            ->where('turmas.id_turma', $id_turma)
            ->get()->getRowArray();

        if (!$turma) {
            return "Erro: Turma #$id_turma não encontrada no banco de dados.";
        }

        // 2. Busca os Alunos matriculados nesta turma
        $alunos = $db->table('matriculas')
            ->join('alunos', 'alunos.id_aluno = matriculas.id_aluno')
            ->where('id_turma', $id_turma)
            ->where('status', 'Confirmada')
            ->orderBy('alunos.nome', 'ASC')
            ->get()->getResultArray();

        // 3. Configura o Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Permite carregar imagens de URLs externas
        $options->set('defaultFont', 'Helvetica');
        
        $dompdf = new Dompdf($options);

        // 4. Prepara o conteúdo HTML das linhas da tabela
        $linhasHtml = '';
        if (!empty($alunos)) {
            foreach ($alunos as $index => $aluno) {
                $num = $index + 1;
                $linhasHtml .= "
                <tr>
                    <td style='border: 1px solid #000; text-align: center; padding: 5px;'>{$num}</td>
                    <td style='border: 1px solid #000; padding: 5px; text-transform: uppercase;'>{$aluno['nome']}</td>
                    <td style='border: 1px solid #000; padding: 5px;'></td>
                </tr>";
            }
        } else {
            $linhasHtml = '<tr><td colspan="3" style="text-align:center; padding: 20px;">Nenhum aluno confirmado nesta turma.</td></tr>';
        }

        // 5. Estrutura completa do Documento (HTML)
        $html = "
        <html>
        <head>
            <style>
                body { font-family: sans-serif; font-size: 12px; }
                .header { text-align: center; margin-bottom: 20px; }
                .titulo { font-weight: bold; font-size: 16px; color: #1a3a5c; margin-top: 10px; }
                table { width: 100%; border-collapse: collapse; margin-top: 15px; }
                th { background-color: #f2f2f2; border: 1px solid #000; padding: 8px; text-align: left; }
                .info-box { margin-bottom: 10px; border: 1px solid #ccc; padding: 10px; background: #fafafa; }
            </style>
        </head>
        <body>
            <div class='header'>
                <div class='titulo'>PAUTA DE PRESENÇA - 2026</div>
            </div>

            <div class='info-box'>
                <strong>TURMA:</strong> {$turma['nome_turma']} | 
                <strong>DISCIPLINA:</strong> {$turma['nome_disciplina']} <br>
                <strong>PROFESSOR:</strong> {$turma['nome_professor']} | 
                <strong>SALA:</strong> {$turma['nome_sala']}
            </div>

            <table>
                <thead>
                    <tr>
                        <th width='40'>Nº</th>
                        <th>NOME COMPLETO DO ALUNO</th>
                        <th width='150'>ASSINATURA</th>
                    </tr>
                </thead>
                <tbody>
                    {$linhasHtml}
                </tbody>
            </table>
            
            <p style='font-size: 9px; margin-top: 30px;'>Gerado em: " . date('d/m/Y H:i') . "</p>
        </body>
        </html>";

        // 6. Renderização
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // 7. Saída para o navegador
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setBody($dompdf->output());
    }
}