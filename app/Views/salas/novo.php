<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Nova Sala</h1></div></section>
    <section class="content">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Dados da Sala</h3></div>
            <form action="<?= base_url('salas/store') ?>" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label>Nome da Sala *</label>
                            <input type="text" name="nome_sala" class="form-control" placeholder="Ex: Sala A-01" required></div></div>
                        <div class="col-md-3"><div class="form-group"><label>Capacidade</label>
                            <input type="number" name="capacidade" class="form-control" value="30" min="1"></div></div>
                        <div class="col-md-3"><div class="form-group"><label>Tipo</label>
                            <select name="tipo" class="form-control">
                                <option>Comum</option><option>Laboratório</option><option>Auditório</option><option>Biblioteca</option>
                            </select></div></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    <a href="<?= base_url('salas') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>
