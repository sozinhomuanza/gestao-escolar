<!-- Ficheiro: app/Views/usuarios/index.php -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Gestão de Utilizadores</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Início</a></li>
                        <li class="breadcrumb-item active">Utilizadores</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="<?= base_url('usuarios/novo') ?>" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Novo Utilizador
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Nome</th>
                            <th>Utilizador</th>
                            <th>Email</th>
                            <th>Perfil</th>
                            <th>Último Acesso</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): foreach ($usuarios as $u): ?>
                        <tr class="<?= !$u['ativo'] ? 'table-secondary' : '' ?>">
                            <td><?= esc($u['nome']) ?></td>
                            <td><code><?= esc($u['username']) ?></code></td>
                            <td><?= esc($u['email']) ?></td>
                            <td>
                                <span class="badge badge-<?= $u['perfil'] === 'Administrador' ? 'danger' : ($u['perfil'] === 'Professor' ? 'info' : 'success') ?>">
                                    <?= $u['perfil'] ?>
                                </span>
                            </td>
                            <td><?= $u['ultimo_acesso'] ? date('d/m/Y H:i', strtotime($u['ultimo_acesso'])) : '—' ?></td>
                            <td class="text-center">
                                <form action="<?= base_url('usuarios/toggle_ativo') ?>" method="POST" class="d-inline">
                                    <input type="hidden" name="id_usuario" value="<?= $u['id_usuario'] ?>">
                                    <button type="submit" class="btn btn-xs btn-<?= $u['ativo'] ? 'success' : 'secondary' ?>">
                                        <i class="fas fa-<?= $u['ativo'] ? 'check-circle' : 'times-circle' ?>"></i>
                                        <?= $u['ativo'] ? 'Ativo' : 'Inativo' ?>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('usuarios/editar/'.$u['id_usuario']) ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php if ($u['id_usuario'] != session()->get('id_usuario')): ?>
                                <button class="btn btn-danger btn-sm" onclick="confirmarExclusao('<?= $u['id_usuario'] ?>')"
                                    data-toggle="modal" data-target="#modal-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-4">Nenhum utilizador encontrado.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Modal Exclusão -->
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <form action="<?= base_url('usuarios/excluir') ?>" method="POST">
                <div class="modal-header bg-danger"><h4 class="modal-title text-white">Confirmar Exclusão</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este utilizador? Esta ação não pode ser desfeita.</p>
                    <input type="hidden" name="id_usuario" id="id_excluir">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sim, excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>function confirmarExclusao(id) { document.getElementById('id_excluir').value = id; }</script>
