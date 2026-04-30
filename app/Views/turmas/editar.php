<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Editar Turma: <strong><?= esc($turma['nome_turma']) ?></strong></h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Alterar Dados</h3>
            </div>
            
            <form action="<?= base_url('turmas/update') ?>" method="POST">
                <input type="hidden" name="id_turma" value="<?= $turma['id_turma'] ?>">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome da Turma *</label>
                                <input type="text" name="nome_turma" class="form-control" value="<?= esc($turma['nome_turma']) ?>" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Classe *</label>
                                <select name="classe" class="form-control" required>
                                    <option value="">-- Selecione a Classe --</option>
                                    <?php 
                                        $classes = ['10ª Classe', '11ª Classe', '12ª Classe', '13ª Classe'];
                                        foreach ($classes as $cl): 
                                    ?>
                                        <option value="<?= $cl ?>" <?= ($turma['classe'] == $cl) ? 'selected' : '' ?>>
                                            <?= $cl ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Período *</label>
                                <select name="periodo" class="form-control" required>
                                    <?php foreach (['Manhã','Tarde','Noite'] as $p): ?>
                                        <option value="<?= $p ?>" <?= $turma['periodo'] == $p ? 'selected' : '' ?>><?= $p ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sala</label>
                                <select name="id_sala" class="form-control">
                                    <option value="">— Sem sala —</option>
                                    <?php foreach ($salas as $s): ?>
                                        <option value="<?= $s['id_sala'] ?>" <?= $turma['id_sala'] == $s['id_sala'] ? 'selected' : '' ?>>
                                            <?= esc($s['nome_sala']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Professor</label>
                                <select name="id_professor" class="form-control">
                                    <option value="">— Sem professor —</option>
                                    <?php foreach ($professores as $p): ?>
                                        <option value="<?= $p['id_trabalhador'] ?>" <?= $turma['id_professor'] == $p['id_trabalhador'] ? 'selected' : '' ?>>
                                            <?= esc($p['nome']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Disciplina</label>
                                <select name="id_disciplina" class="form-control">
                                    <option value="">— Sem disciplina —</option>
                                    <?php foreach ($disciplinas as $d): ?>
                                        <option value="<?= $d['id_disciplina'] ?>" <?= $turma['id_disciplina'] == $d['id_disciplina'] ? 'selected' : '' ?>>
                                            <?= esc($d['nome_disciplina']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ano Lectivo *</label>
                                <input type="number" name="ano_letivo" class="form-control" value="<?= esc($turma['ano_letivo']) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Atualizar Turma</button>
                    <a href="<?= base_url('turmas') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>