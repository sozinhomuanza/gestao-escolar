        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-lg-6">
                            <h1 class="m-0">Atualizar Professor</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <a href="/professores" class="btn btn-info" style="margin-right: 15px;"><i class="fas fa-arrow-circle-left"></i> Voltar </a>
                                <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="/professores">Professores</a></li>
                                <li class="breadcrumb-item active">Novo</li>
                            </ol>

                        </div>
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
                                Professor Atualizado com sucesso!
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados do Professor</h3>
                        </div>


                        <form action="/professores/store" method="post">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input type="text" class="form-control" name="nome" value="<?= $professor['nome'] ?>">
                                        </div>
                                    </div>

                                    <div class=" col-lg-3">

                                        <div class="form-group">
                                            <label>cpf</label>
                                            <input type="text" class="form-control" name="cpf" value="<?= $professor['cpf'] ?>">
                                        </div>
                                    </div>
                                    <div class=" col-lg-3">

                                        <div class="form-group">
                                            <label>Telefone</label>
                                            <input type="text" class="form-control" name="telefone" value="<?= $professor['telefone'] ?>">
                                        </div>
                                    </div>

                                    <div class=" col-lg-6">

                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input type="text" class="form-control" name="email" value="<?= $professor['email'] ?>">
                                        </div>
                                    </div>

                                    <div class=" col-lg-6">

                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <input type="text" class="form-control" name="endereco" value="<?= $professor['endereco'] ?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_professor" value="<?= $professor['id_professor'] ?>">

                                    <div class=" card-footer">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Atualizar</button>
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