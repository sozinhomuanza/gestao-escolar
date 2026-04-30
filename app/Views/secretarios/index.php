<div class="modal fade" id="modal-confimacao-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('secretarios/excluir') ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Confirme sua ação</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente excluir esse secretário?</p>
                    <input type="hidden" id="id_secretario" name="id_secretario" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
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
                <div class="col-sm-6">
                    <h1 class="m-0">Secretários</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Secretários</li>
                    </ol>
                </div>
            </div>

            <?php $alert = session()->getFlashdata('alert'); ?>
            <?php if (isset($alert)) : ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert <?= ($alert == 'success_update') ? 'alert-warning' : 'alert-success' ?> alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas <?= ($alert == 'success_delete') ? 'fa-trash' : 'fa-check' ?>"></i>
                            <?php 
                                if($alert == 'success_create') echo "Secretário cadastrado com sucesso!";
                                if($alert == 'success_update') echo "Dados do secretário atualizados com sucesso!";
                                if($alert == 'success_delete') echo "Secretário excluído com sucesso!";
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('secretarios/novo') ?>" class="btn btn-info">
                                <i class="fas fa-user-plus"></i> Novo Secretário
                            </a>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Cód:</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>Telefone</th>
                                        <th>Email</th>
                                        <th>Endereço</th>
                                        <th style="width: 130px">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($secretarios)) : ?>
                                        <?php foreach ($secretarios as $secretario) : ?>
                                            <tr>
                                                <td><?= $secretario['id_secretario'] ?></td>
                                                <td><?= $secretario['nome'] ?></td>
                                                <td><?= $secretario['cpf'] ?></td>
                                                <td><?= $secretario['telefone'] ?></td>
                                                <td><?= $secretario['email'] ?></td>
                                                <td><?= $secretario['endereco'] ?></td>
                                                <td>
                                                    <a href="<?= base_url('secretarios/ver/' . $secretario['id_secretario']) ?>" class="btn btn-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?= base_url('secretarios/editar/' . $secretario['id_secretario']) ?>" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="document.getElementById('id_secretario').value='<?= $secretario['id_secretario'] ?>'"
                                                        data-toggle="modal" data-target="#modal-confimacao-delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Nenhum secretário cadastrado!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>