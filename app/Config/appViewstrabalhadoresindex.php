<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('trabalhadores/excluir') ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmar Exclusão</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Deseja excluir este trabalhador?</p>
                    <input type="hidden" name="id_trabalhador" id="id_trabalhador">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Trabalhadores</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Início</a></li>
                        <li class="breadcrumb-item active">Trabalhadores</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-header">
                <a href="<?= base_url('trabalhadores/novo') ?>" class="btn btn-primary">Novo Trabalhador</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Função</th>
                            <th>Telefone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($trabalhadores as $t): ?>
                        <tr>
                            <td><?= $t['nome'] ?></td>
                            <td><?= $t['funcao'] ?></td>
                            <td><?= $t['telefone'] ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="document.getElementById('id_trabalhador').value='<?= $t['id_trabalhador'] ?>'" data-toggle="modal" data-target="#modal-delete">Excluir</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>