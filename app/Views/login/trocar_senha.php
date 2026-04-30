<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Trocar Senha</h1></div></section>
    <section class="content">
        <div class="col-md-6 mx-auto">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Alterar a sua Senha</h3></div>
                <form action="<?= base_url('login/store') ?>" method="POST">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('erro')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('erro') ?></div>
                        <?php endif; ?>
                        <div class="form-group"><label>Senha Atual *</label>
                            <input type="password" name="senha_atual" class="form-control" required></div>
                        <div class="form-group"><label>Nova Senha *</label>
                            <input type="password" name="nova_senha" class="form-control" required minlength="6"></div>
                        <div class="form-group"><label>Confirmar Nova Senha *</label>
                            <input type="password" name="confirmar_senha" class="form-control" required minlength="6"></div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> Alterar Senha</button>
                        <a href="<?= base_url('inicio') ?>" class="btn btn-default">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
