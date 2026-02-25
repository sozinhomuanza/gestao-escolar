<!-- app/Views/salas/index.php -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Salas de Aula</h1>
        </div>
    </section>
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="<?= base_url('salas/novo') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Nova Sala</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead><tr>
                        <th>Nome da Sala</th><th>Capacidade</th><th>Tipo</th><th class="text-center">Ações</th>
                    </tr></thead>
                    <tbody>
                        <?php if (!empty($salas)): foreach ($salas as $s): ?>
                        <tr>
                            <td><?= esc($s['nome_sala']) ?></td>
                            <td><?= $s['capacidade'] ?> alunos</td>
                            <td><?= $s['tipo'] ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('salas/editar/'.$s['id_sala']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" onclick="confirmarExclusao('<?= $s['id_sala'] ?>')"
                                    data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Nenhuma sala registada.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-delete"><div class="modal-dialog"><div class="modal-content border-danger">
    <form action="<?= base_url('salas/excluir') ?>" method="POST">
        <div class="modal-header bg-danger"><h4 class="modal-title text-white">Excluir Sala</h4>
            <button type="button" class="close text-white" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">Tem certeza?<input type="hidden" name="id_sala" id="id_excluir"></div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
        </div>
    </form>
</div></div></div>
<script>function confirmarExclusao(id) { document.getElementById('id_excluir').value = id; }</script>
