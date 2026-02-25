<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Editar Disciplina</h1></div></section>
    <section class="content"><div class="card card-warning">
        <div class="card-header"><h3 class="card-title">Alterar Dados</h3></div>
        <form action="<?= base_url('disciplinas/update') ?>" method="POST">
            <input type="hidden" name="id_disciplina" value="<?= $disciplina['id_disciplina'] ?>">
            <div class="card-body"><div class="row">
                <div class="col-md-8"><div class="form-group"><label>Nome *</label>
                    <input type="text" name="nome_disciplina" class="form-control" value="<?= esc($disciplina['nome_disciplina']) ?>" required></div></div>
                <div class="col-md-4"><div class="form-group"><label>Carga Horária (h)</label>
                    <input type="number" name="carga_horaria" class="form-control" value="<?= $disciplina['carga_horaria'] ?>"></div></div>
                <div class="col-md-12"><div class="form-group"><label>Descrição</label>
                    <textarea name="descricao" class="form-control" rows="3"><?= esc($disciplina['descricao']) ?></textarea></div></div>
            </div></div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Atualizar</button>
                <a href="<?= base_url('disciplinas') ?>" class="btn btn-default">Cancelar</a>
            </div>
        </form>
    </div></section>
</div>
