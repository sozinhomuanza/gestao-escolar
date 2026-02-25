<?php
/**
 * View: pautas/ver.php
 * Pauta completa com 3 trimestres, MFD e Exportação Dinâmica
 */

// 1. Declaração das funções de utilidade
if (!function_exists('fmtNota')) {
    function fmtNota($v) {
        return $v !== null ? number_format($v, 1) : '<span class="text-muted">–</span>';
    }
}

if (!function_exists('classeMT')) {
    function classeMT($v) {
        if ($v === null) return 'mt-nd';
        return $v >= 9.5 ? 'mt-pos' : 'mt-neg';
    }
}

if (!function_exists('fmtMT')) {
    function fmtMT($v) {
        return $v !== null ? number_format($v, 1) : '–';
    }
}
?>

<style>
    .pauta-view-header { background:linear-gradient(135deg,#1a3a5c,#2575fc); color:#fff; border-radius:0 0 20px 20px; padding:24px 32px; }
    .thead-trim th     { font-size:.72rem; text-transform:uppercase; letter-spacing:.5px; }
    .mt-cell           { font-weight:700; border-radius:6px; padding:3px 8px; display:inline-block; min-width:44px; text-align:center; font-size:.85rem; }
    .mt-pos { background:#d1fae5; color:#065f46; }
    .mt-neg { background:#fee2e2; color:#991b1b; }
    .mt-nd  { background:#f3f4f6; color:#9ca3af; }
    .mfd-high { background:#7c3aed; color:#fff; }
    .stat-card { border-radius:12px; padding:16px; text-align:center; }
    /* Ajuste para o dropdown de exportação */
    .btn-export-group .dropdown-menu { border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
</style>

<div class="content-wrapper" style="background:#f0f4f9; min-height:100vh;">

    <div class="pauta-view-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                <div>
                    <a href="<?= base_url('pautas') ?>" class="text-white" style="opacity:.75;">
                        <i class="fas fa-arrow-left mr-2"></i>Voltar
                    </a>
                    <h3 class="mb-0 mt-2 font-weight-bold">Mini Pauta Completa</h3>
                    <h5 style="opacity:.9;"><?= esc($turma['nome_disciplina']) ?> — <?= esc($turma['nome_turma']) ?></h5>
                    <small style="opacity:.75;">
                        Prof. <?= esc($turma['nome_professor']) ?> &nbsp;|&nbsp;
                        <?= esc($turma['nome_sala'] ?? '') ?> &nbsp;|&nbsp;
                        <?= esc($turma['periodo'] ?? '') ?>
                    </small>
                </div>
                
                <div class="d-flex gap-2 align-items-center">
                    <div class="dropdown d-inline-block mr-2">
                        <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                            <i class="fas fa-download mr-1"></i> Exportar
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= base_url("relatorio/excel/alunos/{$turma['id_turma']}") ?>">
                                <i class="fas fa-file-excel text-success mr-2"></i> Lista em Excel
                            </a>
                            <a class="dropdown-item" target="_blank" href="<?= base_url("relatorio/pdf/alunos/{$turma['id_turma']}") ?>">
                                <i class="fas fa-file-pdf text-danger mr-2"></i> Lista em PDF
                            </a>
                        </div>
                    </div>

                    <a href="<?= base_url("pautas/lancar/{$turma['id_turma']}") ?>" class="btn btn-light btn-sm mr-2">
                        <i class="fas fa-pen-nib mr-1"></i>Lançar Notas
                    </a>
                    <a href="<?= base_url("pautas/imprimir/{$turma['id_turma']}") ?>" target="_blank" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-print mr-1"></i>Imprimir
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content pt-4 pb-5">
        <div class="container-fluid">

            <div class="row mb-4">
                <?php
                $trim_labels = ['', 'Iº Trimestre', 'IIº Trimestre', 'IIIº Trimestre'];
                $trim_colors = ['', '#1a3a5c', '#0d6efd', '#198754'];
                foreach ([1,2,3] as $tr):
                    $s = $stats[$tr] ?? ['total_alunos'=>0, 'positivas'=>0, 'negativas'=>0, 'pct_positivas'=>0, 'pct_negativas'=>0];
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card shadow-sm border-0" style="border-radius:12px; border-top:4px solid <?= $trim_colors[$tr] ?>!important;">
                        <div class="card-body">
                            <h6 class="font-weight-bold mb-3" style="color:<?= $trim_colors[$tr] ?>">
                                <i class="fas fa-chart-bar mr-1"></i><?= $trim_labels[$tr] ?>
                            </h6>
                            <div class="row text-center">
                                <div class="col-4">
                                    <div class="font-weight-bold h4 mb-0"><?= $s['total_alunos'] ?></div>
                                    <small class="text-muted">Total</small>
                                </div>
                                <div class="col-4">
                                    <div class="font-weight-bold h4 mb-0 text-success"><?= $s['positivas'] ?></div>
                                    <small class="text-muted">Pos. (<?= $s['pct_positivas'] ?>%)</small>
                                </div>
                                <div class="col-4">
                                    <div class="font-weight-bold h4 mb-0 text-danger"><?= $s['negativas'] ?></div>
                                    <small class="text-muted">Neg. (<?= $s['pct_negativas'] ?>%)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="card shadow border-0" style="border-radius:12px;">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mb-0" id="tabelaPauta">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="align-middle text-center" style="background:#2d3748;color:#fff; width:35px">#</th>
                                    <th rowspan="2" class="align-middle" style="background:#2d3748;color:#fff;">Nome do Aluno</th>
                                    <th rowspan="2" class="align-middle text-center" style="background:#2d3748;color:#fff;width:40px">G</th>
                                    <th colspan="4" class="text-center" style="background:#1a3a5c;color:#fff;">Iº Trimestre</th>
                                    <th colspan="4" class="text-center" style="background:#0d6efd;color:#fff;">IIº Trimestre</th>
                                    <th colspan="4" class="text-center" style="background:#198754;color:#fff;">IIIº Trimestre</th>
                                    <th rowspan="2" class="align-middle text-center" style="background:#6f42c1;color:#fff;">MFD</th>
                                </tr>
                                <tr class="thead-trim">
                                    <th class="text-center" style="background:#1a3a5c;color:#e0e7ff;">MAC</th>
                                    <th class="text-center" style="background:#1a3a5c;color:#e0e7ff;">NPP</th>
                                    <th class="text-center" style="background:#1a3a5c;color:#e0e7ff;">NPT</th>
                                    <th class="text-center" style="background:#1a3a5c;color:#e0e7ff;">MT1</th>
                                    <th class="text-center" style="background:#0d6efd;color:#e0e7ff;">MAC</th>
                                    <th class="text-center" style="background:#0d6efd;color:#e0e7ff;">NPP</th>
                                    <th class="text-center" style="background:#0d6efd;color:#e0e7ff;">NPT</th>
                                    <th class="text-center" style="background:#0d6efd;color:#e0e7ff;">MT2</th>
                                    <th class="text-center" style="background:#198754;color:#e0e7ff;">MAC</th>
                                    <th class="text-center" style="background:#198754;color:#e0e7ff;">NPP</th>
                                    <th class="text-center" style="background:#198754;color:#e0e7ff;">NPT</th>
                                    <th class="text-center" style="background:#198754;color:#e0e7ff;">MT3</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pauta as $i => $row): ?>
                                <tr>
                                    <td class="text-center text-muted"><small><?= $i+1 ?></small></td>
                                    <td><?= esc($row['nome_aluno']) ?></td>
                                    <td class="text-center">
                                        <small class="badge <?= ($row['genero'] ?? '') == 'Feminino' ? 'badge-danger' : 'badge-secondary' ?>">
                                            <?= substr($row['genero'] ?? '-', 0, 1) ?>
                                        </small>
                                    </td>
                                    <td class="text-center"><?= fmtNota($row['mac1']) ?></td>
                                    <td class="text-center"><?= fmtNota($row['npp1']) ?></td>
                                    <td class="text-center"><?= fmtNota($row['npt1']) ?></td>
                                    <td class="text-center"><span class="mt-cell <?= classeMT($row['mt1']) ?>"><?= fmtMT($row['mt1']) ?></span></td>
                                    <td class="text-center"><?= fmtNota($row['mac2']) ?></td>
                                    <td class="text-center"><?= fmtNota($row['npp2']) ?></td>
                                    <td class="text-center"><?= fmtNota($row['npt2']) ?></td>
                                    <td class="text-center"><span class="mt-cell <?= classeMT($row['mt2']) ?>"><?= fmtMT($row['mt2']) ?></span></td>
                                    <td class="text-center"><?= fmtNota($row['mac3']) ?></td>
                                    <td class="text-center"><?= fmtNota($row['npp3']) ?></td>
                                    <td class="text-center"><?= fmtNota($row['npt3']) ?></td>
                                    <td class="text-center"><span class="mt-cell <?= classeMT($row['mt3']) ?>"><?= fmtMT($row['mt3']) ?></span></td>
                                    <td class="text-center">
                                        <span class="mt-cell <?= ($row['mfd'] ?? null) !== null ? (($row['mfd'] >= 9.5) ? 'mfd-high' : 'mt-neg') : 'mt-nd' ?>">
                                            <?= isset($row['mfd']) && $row['mfd'] !== null ? number_format($row['mfd'], 1) : '–' ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <p class="text-muted small mt-2">
                <b>MAC</b> = Média Avaliação Contínua &nbsp;|&nbsp; <b>NPP</b> = Nota Prova Preparação &nbsp;|&nbsp; 
                <b>NPT</b> = Nota Prova Trimestral &nbsp;|&nbsp; <b>MT</b> = Média Trimestral &nbsp;|&nbsp; 
                <b>MFD</b> = Média Final da Disciplina
            </p>
        </div>
    </section>
</div>