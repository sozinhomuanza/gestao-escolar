<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Novo Utilizador</h1>
        </div>
    </section>
    <section class="content">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Dados de Acesso</h3></div>
            <form action="<?= base_url('usuarios/store') ?>" method="POST">
                <div class="card-body">
                    <?php if (session()->getFlashdata('erro')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('erro') ?></div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome de Utilizador (login) *</label>
                                <input type="text" name="username" class="form-control" required>
                                <small class="text-muted">Sem espaços ou caracteres especiais</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Senha *</label>
                                <input type="password" name="senha" class="form-control" required minlength="6">
                                <small class="text-muted">Mínimo 6 caracteres</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Perfil de Acesso *</label>
                                <select name="perfil" class="form-control" required>
                                    <option value="Secretário">Secretário</option>
                                    <option value="Professor">Professor</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Criar Utilizador</button>
                    <a href="<?= base_url('usuarios') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>
