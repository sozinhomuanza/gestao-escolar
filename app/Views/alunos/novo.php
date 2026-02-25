<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Registar Novo Aluno</h1>
        </div>
    </section>
    <section class="content">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Dados do Aluno</h3></div>
            <form action="<?= base_url('alunos/store') ?>" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Data de Nascimento</label>
                                <input type="date" name="data_nascimento" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Género</label>
                                <select name="genero" class="form-control">
                                    <option value="">— Selecionar —</option>
                                    <option>Masculino</option>
                                    <option>Feminino</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" name="telefone" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Endereço (Rua/Casa)</label>
                                <input type="text" name="endereco" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h5 class="text-muted">Naturalidade / Localização</h5>
                            <?= view('partials/localizacao_widget', [
                                'provincias'   => $provincias,
                                'id_provincia' => $id_provincia ?? null,
                                'id_municipio' => $id_municipio ?? null,
                                'id_comuna'    => $id_comuna ?? null,
                            ]) ?>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome do Responsável</label>
                                <input type="text" name="nome_responsavel" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone do Responsável</label>
                                <input type="text" name="telefone_responsavel" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registar</button>
                    <a href="<?= base_url('alunos') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>