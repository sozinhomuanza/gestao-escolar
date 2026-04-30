<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Nova Disciplina</h1></div></section>
    <section class="content"><div class="card card-primary">
        <div class="card-header"><h3 class="card-title">Dados da Disciplina</h3></div>
        <form action="<?= base_url('disciplinas/store') ?>" method="POST">
            <div class="card-body"><div class="row">
                <div class="col-md-8"><div class="form-group"><label>Nome *</label>
                    <input type="text" name="nome_disciplina" class="form-control" required></div></div>
                <div class="col-md-4"><div class="form-group"><label>Carga Horária (h)</label>
                    <input type="number" name="carga_horaria" class="form-control"></div></div>
                <div class="col-md-12"><div class="form-group"><label>Descrição</label>
                    <textarea name="descricao" class="form-control" rows="3"></textarea></div></div>
            </div></div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                <a href="<?= base_url('disciplinas') ?>" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div></section>
</div>
