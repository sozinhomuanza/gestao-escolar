<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <h1 class="m-0">Novo Funcionário</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="/clientes" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-arrow-circle-left"></i> Voltar </a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/clientes">Funcionários</a></li>
                        <li class="breadcrumb-item active">Novo</li>
                    </ol>


                </div><!-- /.col -->
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Dados Pessoais</h3>
                    </div>


                    <form action="/funcionarios/store" method="post">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="nome">
                                    </div>
                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Data de Nascimento</label>
                                        <input type="date" class="form-control" name="data_de_nascimento">
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control" name="telefone">
                                    </div>
                                </div>

                                <div class="col-lg-8">

                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" class="form-control" name="endereco">
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label>Data de Contratação</label>
                                        <input type="date" class="form-control" name="data_de_contratacao">
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label>Identidade</label>
                                        <input type="text" class="form-control" name="rg">
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label>CPF</label>
                                        <input type="text" class="form-control" name="cpf">
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label>Cargo</label>
                                        <input type="text" class="form-control" name="cargo">
                                    </div>
                                </div>

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Salário</label>
                                        <input type="text" class="form-control" name="salario">
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Dia de Pagamento</label>
                                        <input type="text" class="form-control" name="dia_de_pagamento">
                                    </div>
                                </div>


                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cadastrar</button>
                            </div>
                    </form>
                </div>
            </div>

        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->