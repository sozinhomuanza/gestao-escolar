<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Disciplinas</h1></div></section>
    <section class="content">
        <div class="card card-outline card-success">
            <div class="card-header">
                <a href="<?= base_url('disciplinas/novo') ?>" class="btn btn-success"><i class="fas fa-plus"></i> Nova Disciplina</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead><tr><th>Nome</th><th>Carga Horária</th><th>Descrição</th><th class="text-center">Ações</th></tr></thead>
                    <tbody>
                        <?php if (!empty($disciplinas)): foreach ($disciplinas as $d): ?>
                        <tr>
                            <td><?= esc($d['nome_disciplina']) ?></td>
                            <td><?= $d['carga_horaria'] ? $d['carga_horaria'].'h' : '—' ?></td>
                            <td><?= esc($d['descricao'] ?? '—') ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('disciplinas/editar/'.$d['id_disciplina']) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-sm" onclick="document.getElementById('id_excluir').value=<?= $d['id_disciplina'] ?>" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Nenhuma disciplina registada.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="modal-delete"><div class="modal-dialog"><div class="modal-content border-danger">
    <form action="<?= base_url('disciplinas/excluir') ?>" method="POST">
        <div class="modal-header bg-danger"><h4 class="modal-title text-white">Excluir Disciplina</h4><button type="button" class="close text-white" data-dismiss="modal">&times;</button></div>
        <div class="modal-body">Tem certeza?<input type="hidden" name="id_disciplina" id="id_excluir"></div>
        <div class="modal-footer justify-content-between"><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-danger">Excluir</button></div>
    </form>
</div></div></div>
