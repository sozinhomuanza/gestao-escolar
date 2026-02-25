<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Sistema Escolar</title>
    <link rel="stylesheet" href="<?= base_url('theme/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('theme/dist/css/adminlte.min.css') ?>">
    <style>
        body { background: linear-gradient(135deg, #002244, #005599); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { background: #fff; border-radius: 12px; padding: 40px 35px; width: 100%; max-width: 420px; box-shadow: 0 20px 50px rgba(0,0,0,0.3); }
        .login-logo { text-align: center; margin-bottom: 25px; }
        .login-logo img { width: 70px; }
        .login-logo h1 { font-size: 20px; color: #002244; font-weight: 700; margin: 10px 0 2px; }
        .login-logo p { color: #888; font-size: 12px; }
        .btn-login { background: #002244; border: none; width: 100%; padding: 12px; font-size: 15px; font-weight: 600; border-radius: 6px; color: #fff; }
        .btn-login:hover { background: #003a7a; }
        .alert-erro { background: #ffeaea; border-left: 4px solid #dc3545; padding: 10px 15px; border-radius: 5px; margin-bottom: 20px; color: #721c24; font-size: 13px; }
    </style>
</head>
<body>
<div class="login-card">
    <div class="login-logo">
        <img src="<?= base_url('theme/dist/img/book.png') ?>" alt="Logo">
        <h1>Sistema Escolar</h1>
        <p>Instituto Politécnico Industrial 17 de Dezembro</p>
    </div>

    <?php if (session()->getFlashdata('erro')): ?>
        <div class="alert-erro">
            <i class="fas fa-exclamation-triangle"></i>
            <?= session()->getFlashdata('erro') ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('login/autenticar') ?>" method="POST">
        <div class="form-group">
            <label class="font-weight-bold" style="font-size:13px;">Utilizador ou Email</label>
            <div class="input-group">
                <input type="text" name="username" class="form-control" placeholder="Digite o seu utilizador" required autofocus>
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="font-weight-bold" style="font-size:13px;">Senha</label>
            <div class="input-group">
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Digite a sua senha" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary" onclick="toggleSenha()">
                        <i class="fas fa-eye" id="olho"></i>
                    </button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-login mt-2">
            <i class="fas fa-sign-in-alt"></i> Entrar no Sistema
        </button>
    </form>

    <p class="text-center mt-3" style="font-size:12px; color:#aaa;">
        Acesso restrito a utilizadores autorizados
    </p>
</div>

<script>
function toggleSenha() {
    const campo = document.getElementById('senha');
    const olho  = document.getElementById('olho');
    if (campo.type === 'password') {
        campo.type = 'text';
        olho.className = 'fas fa-eye-slash';
    } else {
        campo.type = 'password';
        olho.className = 'fas fa-eye';
    }
}
</script>
</body>
</html>
