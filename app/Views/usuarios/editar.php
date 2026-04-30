<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Editar Utilizador: <strong><?= esc($usuario['nome']) ?></strong></h1>
        </div>
    </section>
    <section class="content">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Alterar Dados</h3>
            </div>
            
            <form action="<?= base_url('usuarios/update') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                
                <div class="card-body">
                    <?php if (session()->getFlashdata('erro')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('erro') ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-12 text-center mb-4">
                            <label>Fotografia de Perfil</label>
                            <div class="mt-2">
                                <?php 
                                    $fotoPath = ($usuario['foto'] && $usuario['foto'] != 'default.png') 
                                                ? base_url('uploads/usuarios/' . $usuario['foto']) 
                                                : base_url('theme/dist/img/avatar5.png');
                                ?>
                                <img src="<?= $fotoPath ?>" id="preview" class="img-thumbnail img-circle shadow-sm" style="width: 150px; height: 150px; object-fit: cover;">
                            </div>
                            <div class="mt-3 d-flex justify-content-center">
                                <div class="custom-file" style="max-width: 300px;">
                                    <input type="file" name="foto" class="custom-file-input" id="inputFoto" accept="image/*">
                                    <label class="custom-file-label" for="inputFoto">Escolher nova foto</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome Completo</label>
                                <input type="text" name="nome" class="form-control" value="<?= esc($usuario['nome']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= esc($usuario['email']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Perfil de Acesso</label>
                                <select name="perfil" class="form-control">
                                    <?php foreach (['Secretário','Professor','Administrador','Director'] as $p): ?>
                                    <option value="<?= $p ?>" <?= $usuario['perfil'] == $p ? 'selected' : '' ?>><?= $p ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Estado</label>
                                <select name="ativo" class="form-control">
                                    <option value="1" <?= $usuario['ativo'] ? 'selected' : '' ?>>Ativo</option>
                                    <option value="0" <?= !$usuario['ativo'] ? 'selected' : '' ?>>Inativo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nova Senha <small class="text-muted">(deixe vazio para manter)</small></label>
                                <input type="password" name="nova_senha" class="form-control" minlength="6" placeholder="Nova senha...">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Atualizar Dados</button>
                    <a href="<?= base_url('usuarios') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
    document.getElementById('inputFoto').onchange = evt => {
        const [file] = document.getElementById('inputFoto').files
        if (file) {
            document.getElementById('preview').src = URL.createObjectURL(file)
            // Atualiza o nome no label do AdminLTE
            let fileName = document.getElementById('inputFoto').value.split('\\').pop();
            document.querySelector('.custom-file-label').innerHTML = fileName;
        }
    }
</script>