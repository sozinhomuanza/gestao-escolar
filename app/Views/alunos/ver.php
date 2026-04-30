<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-lg-6">
                    <h1 class="m-0">Dados do Cliente</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="/clientes" class="btn btn-info" style="margin-right: 15px;">Voltar </a>
                        <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="/clientes">Clientes</a></li>
                        <li class="breadcrumb-item active">Dados do cliente</li>
                    </ol>


                </div><!-- /.col -->
            </div>
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
                                        <input type="text" class="form-control" name="nome" value="<?= $cliente['nome'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Data de Nascimento</label>
                                        <input type="date" class="form-control" name="data_de_nascimento" value="<?= $cliente['data_de_nascimento'] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-3">

                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control" name="telefone" value="<?= $cliente['telefone'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-8">

                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" class="form-control" name="endereco" value="<?= $cliente['endereco'] ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-lg-4">

                                    <div class="form-group">
                                        <label>Limite de Crédito</label>
                                        <input type="text" class="form-control" name="limite_de_credito" value="<?= $cliente['limite_de_credito'] ?>" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
                            </div>

                           
                    
                </div>
            </div>

        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->