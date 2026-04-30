<!-- Content Wrapper. Contains page content -->

<!-- Modal de confimação de exclusãoo-->

<div class="modal fade" id="modal-confimacao-delete">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="/funcionarios/excluir" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Confirme sua ação</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente excluir esse funcionário?</p>
                    <input type="hidden" id="id_funcionario" name="id_funcionario" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Fim do modal de confirmação de exclusão-->





<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">


            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Funcionários</h1>
                </div><!-- /.col -->





                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item active">Funcionários</li>
                    </ol>
                </div><!-- /.col -->
            </div>




            <?php

            $session = session();

            $alert = $session->get('alert');

            ?>


            <?php
            if (isset($alert)) :

            ?>

                <?php if ($alert == 'success_create') : ?>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Funcionário cadastrado com sucesso!
                            </div>
                        </div>
                    </div>

                <?php elseif ($alert == 'success_delete') : ?>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Funcionário Excluido com sucesso!
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php elseif ($alert == 'success_update') : ?>

                <div class="row">

                    <div class="col-md-12">
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Funcionário Excluido com sucesso!
                        </div>
                    </div>
                </div>
            <?php endif; ?>









        </div><!-- /.row -->
    </div><!-- /.container-fluid -->




    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">



                    <div class="card">
                        <div class="card-header">
                            <a href="/funcionarios/novo" class="btn btn-info "><i class="fas fa-user-plus"></i> Novo Funcionário</a>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Cód:</th>
                                        <th>Nome</th>

                                        <th>Telefone</th>
                                        <th>Endereço</th>
                                        <th>Cargo</th>
                                        <th>Salário</th>
                                        <th>Pagamento</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php if (!empty($funcionarios)) : ?>
                                        <?php foreach ($funcionarios as $funcionario) : ?>
                                            <tr>

                                                <td><?= $funcionario['id_funcionario'] ?></td>
                                                <td><?= $funcionario['nome'] ?></td>

                                                <td><?= $funcionario['telefone'] ?></td>
                                                <td><?= $funcionario['endereco'] ?></td>
                                                <td><?= $funcionario['cargo'] ?></td>
                                                <td><?= $funcionario['salario'] ?></td>
                                                <td>Dia <?= $funcionario['dia_de_pagamento'] ?></td>

                                                <td>
                                                    <a href="/funcionarios/ver/<?= $funcionario['id_funcionario'] ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                                    <a href="/funcionarios/editar/<?= $funcionario['id_funcionario'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i></a>

                                                    <button type="button" class="btn btn-danger" onclick="document.getElementById('id_funcionario').value='<?= $funcionario['id_funcionario'] ?>'" data-toggle="modal" data-target="#modal-confimacao-delete"><i class="fas fa-trash-alt"></i></button>
                                                </td>




                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>

                                        <tr>
                                            <td colspan="7">Nenhum funcionario cadastrado!</td>
                                        </tr>

                                    <?php endif; ?>





                                </tbody>
                            </table>
                        </div>


                    </div>



                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<!-- /.content-wrapper -->