<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <h1 class="m-0">Dados do Funcionário</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="/funcionarios" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-arrow-circle-left"></i> Voltar </a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/funcionarios">Funcionários</a></li>
                        <li class="breadcrumb-item active">Dados do Funcionário</li>
                    </ol>


                </div><!-- /.col -->
            </div>



            <?php

            $session = session();

            $alert = $session->get('alert');

            ?>


            <?php
            if (isset($alert) && $alert == ('success_update')) : ?>

                <div class="row">

                    <div class="col-md-12">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Funcionário Atualizado com sucesso!
                        </div>
                    </div>
                </div>
            <?php endif; ?>







            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dados Pessoais</h3>
                    </div>

                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="nome" value="<?= $funcionario['nome'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Data de Nascimento</label>
                                        <input type="date" class="form-control" name="data_de_nascimento" value="<?= $funcionario['data_de_nascimento'] ?>" readonly>
                                    </div>
                                </div>
                                <div class=" col-lg-3">

                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control" name="telefone" value="<?= $funcionario['telefone'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-8">

                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" class="form-control" name="endereco" value="<?= $funcionario['endereco'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-4">

                                    <div class="form-group">
                                        <label>Data de Contratação</label>
                                        <input type="date" class="form-control" name="data_de_contratacao" value="<?= $funcionario['data_de_contratacao'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-4">

                                    <div class="form-group">
                                        <label>Identidade</label>
                                        <input type="text" class="form-control" name="rg" value="<?= $funcionario['rg'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-4">

                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" class="form-control" name="cpf" value="<?= $funcionario['cpf'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-4">

                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input type="text" class="form-control" name="cargo" value="<?= $funcionario['cargo'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-6">

                                    <div class="form-group">
                                        <label>Salário</label>
                                        <input type="text" class="form-control" name="salario" value="<?= $funcionario['salario'] ?>" readonly>
                                    </div>
                                </div>
                                <div class=" col-lg-6">

                                    <div class="form-group">
                                        <label>Dia de Pagamento</label>
                                        <input type="text" class="form-control" name="dia_de_pagamento" value="<?= $funcionario['dia_de_pagamento'] ?>" readonly>
                                    </div>
                                </div>

                                <input type="hidden" name="id_funcionario" value="<?= $funcionario['id_funcionario'] ?>">
                            </div>

                           
                   
                </div>
            </div>

        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->