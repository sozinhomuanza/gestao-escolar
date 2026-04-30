<!-- app/Views/turmas/index.php -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Gerenciamento de Turmas</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Início</a></li>
                        <li class="breadcrumb-item active">Turmas</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-outline card-warning">
            <div class="card-header">
                <a href="<?= base_url('turmas/novo') ?>" class="btn btn-warning">
                    <i class="fas fa-plus"></i> Nova Turma
                </a>
                <a href="<?= base_url('turmas/matricular') ?>" class="btn btn-info ml-2">
                    <i class="fas fa-user-plus"></i> Matricular Aluno
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Turma</th>
                            <th>Professor Responsável</th>
                            <th>Disciplina</th>
                            <th>Sala</th>
                            <th>Período</th>
                            <th>Ano</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($turmas)): foreach ($turmas as $t): ?>
                        <tr>
                            <td><strong><?= esc($t['nome_turma']) ?></strong></td>
                            <td><?= $t['nome_professor'] ?? '<span class="text-danger">Não definido</span>' ?></td>
                            <td><?= $t['nome_disciplina'] ?? '—' ?></td>
                            <td><?= $t['nome_sala'] ?? '—' ?></td>
                            <td><?= $t['periodo'] ?></td>
                            <td><?= $t['ano_letivo'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('turmas/detalhes/'.$t['id_turma']) ?>" class="btn btn-sm btn-info" title="Ver Alunos">
                                    <i class="fas fa-eye"></i> Alunos
                                </a>
                                <a href="<?= base_url('relatorios/presenca/'.$t['id_turma']) ?>" class="btn btn-sm btn-secondary" target="_blank" title="Pauta PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                                <a href="<?= base_url('turmas/editar/'.$t['id_turma']) ?>" class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="confirmarExclusao('<?= $t['id_turma'] ?>')"
                                    data-toggle="modal" data-target="#modal-delete" title="Excluir">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">Nenhuma turma encontrada.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-delete">
    <div class="modal-dialog"><div class="modal-content border-danger">
        <form action="<?= base_url('turmas/excluir') ?>" method="POST">
            <div class="modal-header bg-danger"><h4 class="modal-title text-white">Excluir Turma</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">Tem certeza? Todas as matrículas desta turma serão removidas.
                <input type="hidden" name="id_turma" id="id_excluir">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Sim, excluir</button>
            </div>
        </form>
    </div></div>
</div>
<script>function confirmarExclusao(id) { document.getElementById('id_excluir').value = id; }</script>
