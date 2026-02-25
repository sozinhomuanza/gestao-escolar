<div class="modal fade" id="modal-confimacao-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('professores/excluir') ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Confirme sua ação</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente excluir esse professor?</p>
                    <input type="hidden" id="id_professor" name="id_professor" value="">
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
                    <h1 class="m-0">Professores</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Inicio</a></li>
                        <li class="breadcrumb-item active">Professores</li>
                    </ol>
                </div>
            </div>

            <?php
            $session = session();
            $alert = $session->get('alert');
            ?>

            <?php if (isset($alert)) : ?>
                <?php if ($alert == 'success_create') : ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Professor cadastrado com sucesso!
                    </div>
                <?php elseif ($alert == 'success_delete') : ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Professor excluído com sucesso!
                    </div>
                <?php elseif ($alert == 'success_update') : ?>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Professor atualizado com sucesso!
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="<?= base_url('professores/novo') ?>" class="btn btn-info"><i class="fas fa-user-plus"></i> Novo Professor</a>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Cód:</th>
                                        <th>Nome</th>
                                        <th>Endereço</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th>CPF</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($professores)) : ?>
                                        <?php foreach ($professores as $professor) : ?>
                                        <tr>
                                            <td><?= $professor['id_professor'] ?></td>
                                            <td><?= $professor['nome'] ?></td>
                                            <td><?= $professor['endereco'] ?></td>
                                            <td><?= $professor['email'] ?></td>
                                            <td><?= $professor['telefone'] ?></td>
                                            <td><?= $professor['cpf'] ?></td>
                                            <td>
                                                <a href="<?= base_url('professores/ver/'.$professor['id_professor']) ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                <a href="<?= base_url('professores/editar/'.$professor['id_professor']) ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>

                                                <button type="button" class="btn btn-danger"
                                                    onclick="document.getElementById('id_professor').value='<?= $professor['id_professor'] ?>'"
                                                    data-toggle="modal" data-target="#modal-confimacao-delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="7">Nenhum professor cadastrado!</td>
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