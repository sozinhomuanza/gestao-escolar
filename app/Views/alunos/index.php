<?php
// Helper para montar links preservando todos os filtros activos
function pag_url($params = [])
{
    $base = array_filter([
        'turma'      => $_GET['turma']      ?? '',
        'por_pagina' => $_GET['por_pagina'] ?? '',
        'pagina'     => $_GET['pagina']     ?? '',
    ]);
    $merged = array_filter(array_merge($base, $params), fn($v) => $v !== '' && $v !== null);
    return '?' . http_build_query($merged);
}

$inicio_reg = $total_alunos > 0 ? ($pagina_atual - 1) * $por_pagina + 1 : 0;
$fim_reg    = min($pagina_atual * $por_pagina, $total_alunos);
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Lista de Alunos</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Início</a></li>
                        <li class="breadcrumb-item active">Alunos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="<?= base_url('alunos/novo') ?>" class="btn btn-info">
                        <i class="fas fa-user-plus"></i> Novo Aluno
                    </a>

                    <div class="btn-group">
                        <button type="button" class="btn btn-default">
                            <i class="fas fa-download"></i> Exportar
                        </button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <?php $qs = isset($_GET['turma']) && $_GET['turma'] !== '' ? '?turma=' . $_GET['turma'] : ''; ?>
                            <a class="dropdown-item" href="<?= base_url('alunos/excel' . $qs) ?>">
                                <i class="fas fa-file-excel text-success"></i> Exportar Excel
                            </a>
                            <a class="dropdown-item" href="<?= base_url('alunos/imprimir' . $qs) ?>" target="_blank">
                                <i class="fas fa-file-pdf text-danger"></i> Gerar PDF / Imprimir
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">

                <!-- Filtro de turma + selector de itens por página -->
                <div class="d-flex flex-wrap align-items-end justify-content-between mb-3">

                    <form action="<?= base_url('alunos') ?>" method="GET" class="mb-0">
                        <div class="input-group input-group-sm">
                            <select name="turma" class="form-control">
                                <option value="">Todas as Turmas</option>
                                <?php foreach ($turmas as $t): ?>
                                    <option value="<?= $t['id_turma'] ?>"
                                        <?= ($turma_selecionada == $t['id_turma']) ? 'selected' : '' ?>>
                                        <?= esc($t['nome_turma']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="por_pagina" value="<?= $por_pagina ?>">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-info btn-sm">
                                    <i class="fas fa-search"></i> Filtrar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="d-flex align-items-center mt-2 mt-sm-0">
                        <small class="text-muted mr-2">Mostrar</small>
                        <div class="btn-group btn-group-sm">
                            <?php foreach ([10, 25, 50, 100] as $n): ?>
                                <a href="<?= base_url('alunos') . pag_url(['por_pagina' => $n, 'pagina' => 1]) ?>"
                                   class="btn btn-<?= $por_pagina == $n ? 'info' : 'default' ?>">
                                    <?= $n ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <small class="text-muted ml-2">por página</small>
                    </div>

                </div>

                <!-- Tabela -->
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Género</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Responsável</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($alunos)): foreach ($alunos as $a): ?>
                        <tr>
                            <td><?= mb_strtoupper(esc($a['nome'])) ?></td>
                            <td><?= $a['genero'] ?? '—' ?></td>
                            <td><?= $a['telefone'] ?? '—' ?></td>
                            <td><?= $a['email'] ?? '—' ?></td>
                            <td><?= $a['nome_responsavel'] ?? '—' ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('alunos/editar/'.$a['id_aluno']) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger btn-sm"
                                    onclick="confirmarExclusao('<?= $a['id_aluno'] ?>')"
                                    data-toggle="modal" data-target="#modal-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Nenhum aluno encontrado para esta seleção.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Rodapé: contagem + navegação de páginas -->
                <?php if ($total_alunos > 0): ?>
                <div class="d-flex flex-wrap align-items-center justify-content-between mt-3">

                    <small class="text-muted">
                        Mostrando <strong><?= $inicio_reg ?></strong> a <strong><?= $fim_reg ?></strong>
                        de <strong><?= $total_alunos ?></strong> aluno<?= $total_alunos != 1 ? 's' : '' ?>
                    </small>

                    <?php if ($total_paginas > 1): ?>
                    <nav aria-label="Paginação de alunos">
                        <ul class="pagination pagination-sm mb-0">

                            <!-- Anterior -->
                            <li class="page-item <?= $pagina_atual <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= base_url('alunos') . pag_url(['pagina' => $pagina_atual - 1]) ?>">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>

                            <?php
                                $janela   = 2;
                                $p_inicio = max(1, $pagina_atual - $janela);
                                $p_fim    = min($total_paginas, $pagina_atual + $janela);
                                if ($p_fim - $p_inicio < $janela * 2) {
                                    if ($p_inicio == 1) $p_fim = min($total_paginas, $p_inicio + $janela * 2);
                                    else $p_inicio = max(1, $p_fim - $janela * 2);
                                }
                            ?>

                            <?php if ($p_inicio > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= base_url('alunos') . pag_url(['pagina' => 1]) ?>">1</a>
                                </li>
                                <?php if ($p_inicio > 2): ?>
                                    <li class="page-item disabled"><span class="page-link">…</span></li>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php for ($p = $p_inicio; $p <= $p_fim; $p++): ?>
                                <li class="page-item <?= $p == $pagina_atual ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= base_url('alunos') . pag_url(['pagina' => $p]) ?>"><?= $p ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($p_fim < $total_paginas): ?>
                                <?php if ($p_fim < $total_paginas - 1): ?>
                                    <li class="page-item disabled"><span class="page-link">…</span></li>
                                <?php endif; ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= base_url('alunos') . pag_url(['pagina' => $total_paginas]) ?>"><?= $total_paginas ?></a>
                                </li>
                            <?php endif; ?>

                            <!-- Próxima -->
                            <li class="page-item <?= $pagina_atual >= $total_paginas ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= base_url('alunos') . pag_url(['pagina' => $pagina_atual + 1]) ?>">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>

                        </ul>
                    </nav>
                    <?php endif; ?>

                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
</div>

<!-- Modal de exclusão -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <form action="<?= base_url('alunos/excluir') ?>" method="POST">
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title">Confirmar Exclusão</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja remover este aluno?</p>
                    <input type="hidden" name="id_aluno" id="id_excluir">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim, remover</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function confirmarExclusao(id) {
    document.getElementById('id_excluir').value = id;
}
</script>
