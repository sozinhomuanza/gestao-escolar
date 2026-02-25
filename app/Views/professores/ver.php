        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <h1 class="m-0">Dados do Professor</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="/professores" class="btn btn-info" style="margin-right: 15px;"><i
                                        class="fas fa-arrow-circle-left"></i> Voltar </a>
                                <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/professores">Professores</a></li>
                                <li class="breadcrumb-item active">Novo</li>
                            </ol>

                        </div>
                    </div><!-- /.col -->
                </div>



                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados do Pessoais</h3>
                        </div>



                        <div class="card-body">
                            <div class="row">

                                <div class="col-lg-6">

                                    <div class="form-group">
                                        <label>Nome</label>
                                        <input type="text" class="form-control" name="nome"
                                            value="<?= $professor['nome'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-3">

                                    <div class="form-group">
                                        <label>cpf</label>
                                        <input type="text" class="form-control" name="cpf"
                                            value="<?= $professor['cpf'] ?>" readonly>
                                    </div>
                                </div>
                                <div class=" col-lg-3">

                                    <div class="form-group">
                                        <label>Telefone</label>
                                        <input type="text" class="form-control" name="telefone"
                                            value="<?= $professor['telefone'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-6">

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="text" class="form-control" name="email"
                                            value="<?= $professor['email'] ?>" readonly>
                                    </div>
                                </div>

                                <div class=" col-lg-6">

                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" class="form-control" name="endereco"
                                            value="<?= $professor['endereco'] ?>" readonly>
                                    </div>
                                </div>


                             


                            </div>
                        </div>

                    </div><!-- /.row -->

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->