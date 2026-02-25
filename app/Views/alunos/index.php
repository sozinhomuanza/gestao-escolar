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
                            <?php 
                                // Capturamos a turma atual da URL para anexar aos links de exportação
                                $query_string = isset($_GET['turma']) && !empty($_GET['turma']) ? '?turma=' . $_GET['turma'] : ''; 
                            ?>
                            <a class="dropdown-item" href="<?= base_url('alunos/excel' . $query_string) ?>">
                                <i class="fas fa-file-excel text-success"></i> Exportar Excel
                            </a>
                            <a class="dropdown-item" href="<?= base_url('alunos/imprimir' . $query_string) ?>" target="_blank">
                                <i class="fas fa-file-pdf text-danger"></i> Gerar PDF / Imprimir
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <form action="<?= base_url('alunos') ?>" method="GET" class="mb-3">
                    <div class="input-group input-group-sm" style="width: 300px;">
                        <select name="turma" class="form-control">
                            <option value="">Todas as Turmas</option>
                            <?php foreach ($turmas as $t): ?>
                                <option value="<?= $t['id_turma'] ?>" <?= (isset($_GET['turma']) && $_GET['turma'] == $t['id_turma']) ? 'selected' : '' ?>>
                                    <?= $t['nome_turma'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info">
                                <i class="fas fa-search"></i> Filtrar
                            </button>
                        </div>
                    </div>
                </form>

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
                                <button class="btn btn-danger btn-sm" onclick="confirmarExclusao('<?= $a['id_aluno'] ?>')"
                                    data-toggle="modal" data-target="#modal-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">Nenhum aluno encontrado para esta seleção.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

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