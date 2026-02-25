<?php

namespace App\Models;

use CodeIgniter\Model;

class NotaModel extends Model
{
    protected $table      = 'notas';
    protected $primaryKey = 'id_nota';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_aluno', 'id_turma', 'id_disciplina', 'id_professor',
        'trimestre', 'mac', 'npp', 'npt', 'falta', 'observacao'
    ];

    public function getPautaCompleta(int $id_turma, int $id_disciplina): array
    {
        return $this->getPautaAnual($id_turma, $id_disciplina);
    }

    public function getPautaAnual(int $id_turma, int $id_disciplina): array
    {
        return $this->db->query("
            SELECT 
                sub.id_aluno, 
                sub.nome_aluno, 
                sub.genero,
                sub.mac1, sub.npp1, sub.npt1, sub.mt1,
                sub.mac2, sub.npp2, sub.npt2, sub.mt2,
                sub.mac3, sub.npp3, sub.npt3, sub.mt3,
                -- Cálculo da MFD (Média Final da Disciplina)
                CASE 
                    WHEN sub.mt1 IS NOT NULL AND sub.mt2 IS NOT NULL AND sub.mt3 IS NOT NULL 
                    THEN (sub.mt1 + sub.mt2 + sub.mt3) / 3 
                    ELSE NULL 
                END AS mfd
            FROM (
                SELECT 
                    a.id_aluno, a.nome AS nome_aluno, a.genero,
                    MAX(CASE WHEN n.trimestre = 1 THEN n.mac END) AS mac1,
                    MAX(CASE WHEN n.trimestre = 1 THEN n.npp END) AS npp1,
                    MAX(CASE WHEN n.trimestre = 1 THEN n.npt END) AS npt1,
                    MAX(CASE WHEN n.trimestre = 1 THEN n.mt END) AS mt1,
                    MAX(CASE WHEN n.trimestre = 2 THEN n.mac END) AS mac2,
                    MAX(CASE WHEN n.trimestre = 2 THEN n.npp END) AS npp2,
                    MAX(CASE WHEN n.trimestre = 2 THEN n.npt END) AS npt2,
                    MAX(CASE WHEN n.trimestre = 2 THEN n.mt END) AS mt2,
                    MAX(CASE WHEN n.trimestre = 3 THEN n.mac END) AS mac3,
                    MAX(CASE WHEN n.trimestre = 3 THEN n.npp END) AS npp3,
                    MAX(CASE WHEN n.trimestre = 3 THEN n.npt END) AS npt3,
                    MAX(CASE WHEN n.trimestre = 3 THEN n.mt END) AS mt3
                FROM matriculas m
                JOIN alunos a ON a.id_aluno = m.id_aluno
                LEFT JOIN notas n ON n.id_aluno = a.id_aluno 
                    AND n.id_turma = m.id_turma 
                    AND n.id_disciplina = ?
                WHERE m.id_turma = ? AND m.status = 'Confirmada'
                GROUP BY a.id_aluno, a.nome, a.genero
            ) AS sub
            ORDER BY sub.nome_aluno ASC
        ", [$id_disciplina, $id_turma])->getResultArray();
    }

    public function getEstatisticas(int $id_turma, int $id_disciplina, int $trimestre): array
    {
        $totalAlunos = $this->db->table('matriculas')
            ->where(['id_turma' => $id_turma, 'status' => 'Confirmada'])
            ->countAllResults();

        $result = $this->db->query("
            SELECT
                COUNT(id_nota) AS avaliados,
                SUM(CASE WHEN mt >= 9.5 THEN 1 ELSE 0 END) AS positivas,
                SUM(CASE WHEN mt < 9.5 AND mt IS NOT NULL THEN 1 ELSE 0 END) AS negativas
            FROM notas
            WHERE id_turma = ? AND id_disciplina = ? AND trimestre = ?
        ", [$id_turma, $id_disciplina, $trimestre])->getRowArray();

        $avaliados = (int)($result['avaliados'] ?? 0);
        return [
            'total_alunos'  => $totalAlunos,
            'avaliados'     => $avaliados,
            'nao_avaliados' => $totalAlunos - $avaliados,
            'positivas'     => (int)($result['positivas'] ?? 0),
            'negativas'     => (int)($result['negativas'] ?? 0),
            'pct_positivas' => $avaliados > 0 ? round(($result['positivas'] / $avaliados) * 100, 1) : 0,
            'pct_negativas' => $avaliados > 0 ? round(($result['negativas'] / $avaliados) * 100, 1) : 0
        ];
    }

    public function getTurmasProfessor(int $id_professor): array
    {
        return $this->db->table('turmas t')
            ->select('t.*, d.nome_disciplina')
            ->join('disciplinas d', 'd.id_disciplina = t.id_disciplina', 'left')
            ->where('t.id_professor', $id_professor)
            ->get()->getResultArray();
    }

    public function salvarLote(array $lote): bool
    {
        if (empty($lote)) return false;
        foreach ($lote as $nota) {
            $this->db->table($this->table)->replace($nota);
        }
        return true;
    }
}