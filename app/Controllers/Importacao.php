<?php

namespace App\Controllers;

class Importacao extends BaseController
{
    // ─────────────────────────────────────────────────────────
    // PÁGINA PRINCIPAL DE IMPORTAÇÃO
    // ─────────────────────────────────────────────────────────
    public function index()
    {
        $this->proteger(['admin', 'secretario']);
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('importacao/index');
        echo view('templates/footer');
    }

    // ─────────────────────────────────────────────────────────
    // IMPORTAR ALUNOS
    // ─────────────────────────────────────────────────────────
    public function alunos()
    {
        $this->proteger(['admin', 'secretario']);

        $file = $this->request->getFile('ficheiro_excel');

        if (!$file || !$file->isValid()) {
            session()->setFlashdata('erro', 'Ficheiro inválido ou não enviado.');
            return redirect()->to(base_url('importacao'));
        }

        $ext = strtolower($file->getClientExtension());
        if (!in_array($ext, ['xlsx', 'xls', 'csv'])) {
            session()->setFlashdata('erro', 'Formato não suportado. Use .xlsx, .xls ou .csv');
            return redirect()->to(base_url('importacao'));
        }

        // Mover para pasta temporária
        $tmpName = 'import_alunos_' . time() . '.' . $ext;
        $file->move(WRITEPATH . 'uploads/importacao/', $tmpName);
        $filePath = WRITEPATH . 'uploads/importacao/' . $tmpName;

        try {
            $rows = $this->lerExcel($filePath, $ext);
        } catch (\Exception $e) {
            session()->setFlashdata('erro', 'Erro ao ler o ficheiro: ' . $e->getMessage());
            return redirect()->to(base_url('importacao'));
        }

        $db         = db_connect();
        $inseridos  = 0;
        $ignorados  = 0;
        $erros      = [];

        // Cabeçalhos esperados (linha 1 do Excel)
        // Nome | Data Nascimento | Género | Telefone | Email | Endereço | Nome Responsável | Tel. Responsável

        foreach ($rows as $i => $row) {
            // Ignorar linha de cabeçalho
            if ($i === 0) continue;

            // Ignorar linhas vazias
            $nome = trim($row[0] ?? '');
            if (empty($nome)) continue;

            // Verificar duplicado pelo nome
            $existe = $db->table('alunos')->where('nome', $nome)->countAllResults();
            if ($existe > 0) {
                $ignorados++;
                continue;
            }

            // Tratar data
            $dataNasc = null;
            if (!empty($row[1])) {
                $dataNasc = $this->formatarData($row[1]);
            }

            // Tratar género
            $genero = null;
            $generoRaw = strtolower(trim($row[2] ?? ''));
            if (in_array($generoRaw, ['masculino', 'm', 'masc'])) {
                $genero = 'Masculino';
            } elseif (in_array($generoRaw, ['feminino', 'f', 'fem'])) {
                $genero = 'Feminino';
            } elseif (!empty($generoRaw)) {
                $genero = 'Outro';
            }

            $dados = [
                'nome'                 => $nome,
                'data_nascimento'      => $dataNasc,
                'genero'               => $genero,
                'telefone'             => trim($row[3] ?? '') ?: null,
                'email'                => trim($row[4] ?? '') ?: null,
                'endereco'             => trim($row[5] ?? '') ?: null,
                'nome_responsavel'     => trim($row[6] ?? '') ?: null,
                'telefone_responsavel' => trim($row[7] ?? '') ?: null,
            ];

            try {
                $db->table('alunos')->insert($dados);
                $inseridos++;
            } catch (\Exception $e) {
                $erros[] = 'Linha ' . ($i + 1) . ': ' . $e->getMessage();
            }
        }

        // Apagar ficheiro temporário
        @unlink($filePath);

        $msg = "Importação concluída: {$inseridos} aluno(s) inserido(s), {$ignorados} ignorado(s) (duplicados).";
        if (!empty($erros)) {
            $msg .= ' Erros: ' . implode(' | ', array_slice($erros, 0, 5));
            session()->setFlashdata('erro', $msg);
        } else {
            session()->setFlashdata('sucesso', $msg);
        }

        return redirect()->to(base_url('importacao'));
    }

    // ─────────────────────────────────────────────────────────
    // IMPORTAR TRABALHADORES (PROFESSORES/SECRETÁRIOS)
    // ─────────────────────────────────────────────────────────
    public function trabalhadores()
    {
        $this->proteger(['admin', 'secretario']);

        $file = $this->request->getFile('ficheiro_excel');

        if (!$file || !$file->isValid()) {
            session()->setFlashdata('erro', 'Ficheiro inválido ou não enviado.');
            return redirect()->to(base_url('importacao'));
        }

        $ext = strtolower($file->getClientExtension());
        if (!in_array($ext, ['xlsx', 'xls', 'csv'])) {
            session()->setFlashdata('erro', 'Formato não suportado. Use .xlsx, .xls ou .csv');
            return redirect()->to(base_url('importacao'));
        }

        $tmpName = 'import_trab_' . time() . '.' . $ext;
        $file->move(WRITEPATH . 'uploads/importacao/', $tmpName);
        $filePath = WRITEPATH . 'uploads/importacao/' . $tmpName;

        try {
            $rows = $this->lerExcel($filePath, $ext);
        } catch (\Exception $e) {
            session()->setFlashdata('erro', 'Erro ao ler o ficheiro: ' . $e->getMessage());
            return redirect()->to(base_url('importacao'));
        }

        $db        = db_connect();
        $inseridos = 0;
        $ignorados = 0;
        $erros     = [];

        // Cabeçalhos esperados:
        // Nome | Função | Telefone | Email | Data Admissão

        foreach ($rows as $i => $row) {
            if ($i === 0) continue;

            $nome = trim($row[0] ?? '');
            if (empty($nome)) continue;

            // Verificar duplicado pelo nome
            $existe = $db->table('trabalhadores')->where('nome', $nome)->countAllResults();
            if ($existe > 0) {
                $ignorados++;
                continue;
            }

            $funcao = trim($row[1] ?? 'Professor');
            if (empty($funcao)) $funcao = 'Professor';

            $dataAdm = null;
            if (!empty($row[4])) {
                $dataAdm = $this->formatarData($row[4]);
            }

            $dados = [
                'nome'          => $nome,
                'funcao'        => $funcao,
                'telefone'      => trim($row[2] ?? '') ?: null,
                'email'         => trim($row[3] ?? '') ?: null,
                'data_admissao' => $dataAdm,
            ];

            try {
                $db->table('trabalhadores')->insert($dados);
                $inseridos++;
            } catch (\Exception $e) {
                $erros[] = 'Linha ' . ($i + 1) . ': ' . $e->getMessage();
            }
        }

        @unlink($filePath);

        $msg = "Importação concluída: {$inseridos} funcionário(s) inserido(s), {$ignorados} ignorado(s) (duplicados).";
        if (!empty($erros)) {
            $msg .= ' Erros: ' . implode(' | ', array_slice($erros, 0, 5));
            session()->setFlashdata('erro', $msg);
        } else {
            session()->setFlashdata('sucesso', $msg);
        }

        return redirect()->to(base_url('importacao'));
    }

    // ─────────────────────────────────────────────────────────
    // DOWNLOAD DO TEMPLATE EXCEL
    // ─────────────────────────────────────────────────────────
    public function template(string $tipo)
    {
        $this->proteger(['admin', 'secretario']);

        if ($tipo === 'alunos') {
            $headers = ['Nome', 'Data Nascimento (AAAA-MM-DD)', 'Género (Masculino/Feminino)', 'Telefone', 'Email', 'Endereço', 'Nome Responsável', 'Tel. Responsável'];
            $exemplo = ['João Manuel Silva', '2005-03-15', 'Masculino', '923456789', 'joao@email.com', 'Luanda, Maianga', 'Manuel Silva', '912345678'];
            $filename = 'template_alunos.csv';
        } elseif ($tipo === 'trabalhadores') {
            $headers = ['Nome', 'Função (Professor/Secretário)', 'Telefone', 'Email', 'Data Admissão (AAAA-MM-DD)'];
            $exemplo = ['Maria José Santos', 'Professor', '912345678', 'maria@escola.ao', '2020-01-15'];
            $filename = 'template_trabalhadores.csv';
        } else {
            return redirect()->to(base_url('importacao'));
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Pragma: no-cache');

        $output = fopen('php://output', 'w');
        // BOM para Excel reconhecer UTF-8
        fputs($output, "\xEF\xBB\xBF");
        fputcsv($output, $headers, ';');
        fputcsv($output, $exemplo, ';');
        fclose($output);
        exit;
    }

    // ─────────────────────────────────────────────────────────
    // MÉTODO AUXILIAR: LER EXCEL/CSV SEM DEPENDÊNCIAS EXTERNAS
    // ─────────────────────────────────────────────────────────
    private function lerExcel(string $filePath, string $ext): array
    {
        if ($ext === 'csv') {
            return $this->lerCSV($filePath);
        }

        // Para .xlsx — ler o XML interno do ZIP
        if (!class_exists('ZipArchive')) {
            throw new \Exception('Extensão ZipArchive não disponível. Use ficheiros CSV.');
        }

        $zip = new \ZipArchive();
        if ($zip->open($filePath) !== true) {
            throw new \Exception('Não foi possível abrir o ficheiro Excel.');
        }

        // Ler strings partilhadas
        $sharedStrings = [];
        $ssXml = $zip->getFromName('xl/sharedStrings.xml');
        if ($ssXml) {
            $ssDoc = simplexml_load_string($ssXml);
            foreach ($ssDoc->si as $si) {
                $text = '';
                if (isset($si->t)) {
                    $text = (string)$si->t;
                } elseif (isset($si->r)) {
                    foreach ($si->r as $r) {
                        $text .= (string)$r->t;
                    }
                }
                $sharedStrings[] = $text;
            }
        }

        // Ler primeira folha
        $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
        $zip->close();

        if (!$sheetXml) {
            throw new \Exception('Não foi possível ler a folha de cálculo.');
        }

        $sheet = simplexml_load_string($sheetXml);
        $rows  = [];

        foreach ($sheet->sheetData->row as $row) {
            $rowData = [];
            $lastCol = -1;

            foreach ($row->c as $cell) {
                // Calcular índice da coluna
                preg_match('/([A-Z]+)(\d+)/', (string)$cell['r'], $m);
                $colIndex = $this->colToIndex($m[1]);

                // Preencher colunas vazias entre colunas
                while ($lastCol < $colIndex - 1) {
                    $rowData[] = '';
                    $lastCol++;
                }

                $type  = (string)$cell['t'];
                $value = isset($cell->v) ? (string)$cell->v : '';

                if ($type === 's') {
                    // String partilhada
                    $value = $sharedStrings[(int)$value] ?? '';
                } elseif ($type === 'b') {
                    $value = $value ? 'TRUE' : 'FALSE';
                }

                $rowData[] = $value;
                $lastCol   = $colIndex;
            }

            $rows[] = $rowData;
        }

        return $rows;
    }

    private function lerCSV(string $filePath): array
    {
        $rows = [];
        // Tentar detectar delimitador
        $firstLine = fgets(fopen($filePath, 'r'));
        $delim = substr_count($firstLine, ';') > substr_count($firstLine, ',') ? ';' : ',';

        if (($handle = fopen($filePath, 'r')) !== false) {
            // Remover BOM se existir
            $bom = fread($handle, 3);
            if ($bom !== "\xEF\xBB\xBF") rewind($handle);

            while (($data = fgetcsv($handle, 1000, $delim)) !== false) {
                $rows[] = $data;
            }
            fclose($handle);
        }
        return $rows;
    }

    private function colToIndex(string $col): int
    {
        $index = 0;
        $len   = strlen($col);
        for ($i = 0; $i < $len; $i++) {
            $index = $index * 26 + (ord($col[$i]) - ord('A') + 1);
        }
        return $index - 1;
    }

    private function formatarData($value): ?string
    {
        if (empty($value)) return null;

        // Se for número serial do Excel (ex: 45678)
        if (is_numeric($value) && $value > 1000) {
            $timestamp = ($value - 25569) * 86400;
            return date('Y-m-d', $timestamp);
        }

        // Tentar parsear string de data
        $formats = ['d/m/Y', 'Y-m-d', 'd-m-Y', 'm/d/Y', 'd.m.Y'];
        foreach ($formats as $fmt) {
            $date = \DateTime::createFromFormat($fmt, trim($value));
            if ($date) return $date->format('Y-m-d');
        }

        return null;
    }
}