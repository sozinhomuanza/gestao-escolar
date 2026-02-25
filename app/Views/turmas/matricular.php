<div class="content-wrapper">
    <section class="content-header"><div class="container-fluid"><h1>Matricular Aluno em Turma</h1></div></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header"><h3 class="card-title">Selecionar Aluno e Turma</h3></div>
            <form action="<?= base_url('turmas/salvar_matricula') ?>" method="POST">
                <div class="card-body">
                    <?php if (session()->getFlashdata('erro')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('erro') ?></div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-md-6"><div class="form-group"><label>Aluno *</label>
                            <select name="id_aluno" class="form-control" required>
                                <option value="">— Selecionar Aluno —</option>
                                <?php foreach ($alunos as $a): ?>
                                <option value="<?= $a['id_aluno'] ?>"><?= esc($a['nome']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div></div>
                        <div class="col-md-6"><div class="form-group"><label>Turma *</label>
                            <select name="id_turma" class="form-control" required>
                                <option value="">— Selecionar Turma —</option>
                                <?php foreach ($turmas as $t): ?>
                                <option value="<?= $t['id_turma'] ?>"><?= esc($t['nome_turma']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div></div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info"><i class="fas fa-clipboard-list"></i> Realizar Inscrição</button>
                    <a href="<?= base_url('turmas') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>
