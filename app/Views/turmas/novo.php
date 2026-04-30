<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Nova Turma</h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Dados da Turma</h3>
            </div>
            
            <form action="<?= base_url('turmas/store') ?>" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome da Turma *</label>
                                <input type="text" name="nome_turma" class="form-control" placeholder="Ex: Turma A" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Classe *</label>
                                <select name="classe" class="form-control" required>
                                    <option value="">-- Selecione a Classe --</option>
                                    <option value="10ª Classe">10ª Classe</option>
                                    <option value="11ª Classe">11ª Classe</option>
                                    <option value="12ª Classe">12ª Classe</option>
                                    <option value="13ª Classe">13ª Classe</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Período *</label>
                                <select name="periodo" class="form-control" required>
                                    <option value="Manhã">Manhã</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noite">Noite</option>
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
                                    <option value="<?= $s['id_sala'] ?>"><?= esc($s['nome_sala']) ?> (Cap. <?= $s['capacidade'] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Professor Responsável</label>
                                <select name="id_professor" class="form-control">
                                    <option value="">— Sem professor —</option>
                                    <?php foreach ($professores as $p): ?>
                                    <option value="<?= $p['id_trabalhador'] ?>"><?= esc($p['nome']) ?> (<?= $p['funcao'] ?>)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Disciplina Principal</label>
                                <select name="id_disciplina" class="form-control">
                                    <option value="">— Sem disciplina —</option>
                                    <?php foreach ($disciplinas as $d): ?>
                                    <option value="<?= $d['id_disciplina'] ?>"><?= esc($d['nome_disciplina']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ano Lectivo</label>
                                <input type="number" name="ano_letivo" class="form-control" value="<?= date('Y') ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Criar Turma</button>
                    <a href="<?= base_url('turmas') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>