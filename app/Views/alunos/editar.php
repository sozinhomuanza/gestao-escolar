<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Editar Aluno: <strong><?= esc($aluno['nome']) ?></strong></h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Alterar Dados Institucionais e Pessoais</h3>
            </div>
            
            <form action="<?= base_url('alunos/update') ?>" method="POST">
                <input type="hidden" name="id_aluno" value="<?= $aluno['id_aluno'] ?>">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input type="text" name="nome" class="form-control" value="<?= esc($aluno['nome']) ?>" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Nº do Bilhete de Identidade (BI)</label>
                                <input type="text" name="bi" class="form-control" value="<?= esc($aluno['bi'] ?? '') ?>" placeholder="Ex: 002134567LA041">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Género</label>
                                <select name="genero" class="form-control">
                                    <?php foreach (['Masculino','Feminino','Outro'] as $g): ?>
                                    <option value="<?= $g ?>" <?= $aluno['genero'] == $g ? 'selected' : '' ?>><?= $g ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Data de Nascimento</label>
                                <input type="date" name="data_nascimento" class="form-control" value="<?= $aluno['data_nascimento'] ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Natural de (Município/Cidade)</label>
                                <input type="text" name="naturalidade" class="form-control" value="<?= esc($aluno['naturalidade'] ?? '') ?>" placeholder="Ex: Luanda">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Província de (Naturalidade)</label>
                                <input type="text" name="provincia_natural" class="form-control" value="<?= esc($aluno['provincia_natural'] ?? '') ?>" placeholder="Ex: Luanda">
                            </div>
                        </div>

                        <div class="col-12"><hr></div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Telefone do Aluno</label>
                                <input type="text" name="telefone" class="form-control" value="<?= esc($aluno['telefone']) ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= esc($aluno['email']) ?>">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Endereço Atual</label>
                                <input type="text" name="endereco" class="form-control" value="<?= esc($aluno['endereco']) ?>">
                            </div>
                        </div>

                        <div class="col-12"><hr></div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome do Pai ou Mãe (Responsável)</label>
                                <input type="text" name="nome_responsavel" class="form-control" value="<?= esc($aluno['nome_responsavel']) ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telefone do Responsável</label>
                                <input type="text" name="telefone_responsavel" class="form-control" value="<?= esc($aluno['telefone_responsavel']) ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <a href="<?= base_url('alunos') ?>" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Atualizar Dados do Aluno</button>
                </div>
            </form>
        </div>
    </section>
</div>