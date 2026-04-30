<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1><i class="fas fa-user-plus text-info"></i> Matricular Aluno em Turma</h1>
        </div>
    </section>

    <section class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title">Selecionar Aluno e Turma</h3>
                <div class="card-tools">
                    <span class="badge <?= ($rupes_disponiveis ?? 0) > 0 ? 'badge-warning' : 'badge-danger' ?>" title="Referências AGT disponíveis">
                        <i class="fas fa-ticket-alt"></i> RUPEs em Stock: <?= $rupes_disponiveis ?? 0 ?>
                    </span>
                </div>
            </div>

            <form action="<?= base_url('turmas/salvar_matricula') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="card-body">
                    
                    <?php if (session()->getFlashdata('erro')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="icon fas fa-ban"></i> <?= session()->getFlashdata('erro') ?>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Aluno *</label>
                                <select name="id_aluno" class="form-control select2" style="width: 100%;" required>
                                    <option value="">— Selecionar Aluno —</option>
                                    <?php foreach ($alunos as $a): ?>
                                        <option value="<?= $a['id_aluno'] ?>"><?= esc($a['nome']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Turma *</label>
                                <select name="id_turma" class="form-control select2" style="width: 100%;" required>
                                    <option value="">— Selecionar Turma —</option>
                                    <?php foreach ($turmas as $t): ?>
                                        <option value="<?= $t['id_turma'] ?>"><?= esc($t['nome_turma']) ?> (<?= $t['classe'] ?>ª Classe)</option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" name="gerar_rupe" class="custom-control-input" id="swRupe" value="1" <?= ($rupes_disponiveis > 0) ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="swRupe">
                                    Gerar Guia de Pagamento (RUPE) automaticamente ao finalizar
                                </label>
                                
                                <?php if(($rupes_disponiveis ?? 0) <= 0): ?>
                                    <small class="text-danger d-block mt-1">
                                        <i class="fas fa-exclamation-triangle"></i> 
                                        <strong>Atenção:</strong> Sem estoque de RUPEs. A matrícula será salva como pendente sem guia.
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Confirmar Matrícula
                    </button>
                    <a href="<?= base_url('turmas') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>