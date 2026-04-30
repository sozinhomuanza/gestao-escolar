<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Editar Sala: <strong><?= esc($sala['nome_sala']) ?></strong></h1></div></section>
    <section class="content">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">Alterar Dados</h3></div>
            <form action="<?= base_url('salas/store') ?>" method="POST">
                <input type="hidden" name="id_sala" value="<?= $sala['id_sala'] ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label>Nome da Sala *</label>
                            <input type="text" name="nome_sala" class="form-control" value="<?= esc($sala['nome_sala']) ?>" required></div></div>
                        <div class="col-md-3"><div class="form-group"><label>Capacidade</label>
                            <input type="number" name="capacidade" class="form-control" value="<?= $sala['capacidade'] ?>"></div></div>
                        <div class="col-md-3"><div class="form-group"><label>Tipo</label>
                            <select name="tipo" class="form-control">
                                <?php foreach (['Comum','Laboratório','Auditório','Biblioteca'] as $t): ?>
                                <option <?= $sala['tipo'] == $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select></div></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Atualizar</button>
                    <a href="<?= base_url('salas') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>
