<div class="content-wrapper">
    <section class="content-header">
        <h1><i class="fa fa-file-text-o"></i> Documentos e Notas</h1>
    </section>

    <section class="content">
        <?php if (session()->getFlashdata('sucesso')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <?= session()->getFlashdata('sucesso') ?>
            </div>
        <?php endif; ?>

        <div class="box box-solid">
            <div class="box-body">
                <form method="get" action="<?= base_url('documentos') ?>" class="row">
                    <div class="col-md-4">
                        <label>Pesquisar Aluno</label>
                        <input type="text" name="q" class="form-control" placeholder="Nome ou Turma..." value="<?= esc($search) ?>">
                    </div>
                    <div class="col-md-3">
                        <label>Turma</label>
                        <select name="turma_id" class="form-control">
                            <option value="">Todas as Turmas</option>
                            <?php foreach ($turmas as $t): ?>
                                <option value="<?= $t['id_turma'] ?>" <?= $turmaId == $t['id_turma'] ? 'selected' : '' ?>>
                                    <?= esc($t['nome_turma']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>Ano Letivo</label>
                        <select name="ano" class="form-control">
                            <?php foreach ($anos as $a): ?>
                                <option value="<?= $a['ano_letivo'] ?>" <?= $ano == $a['ano_letivo'] ? 'selected' : '' ?>>
                                    Ano Letivo: <?= $a['ano_letivo'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-filter"></i> Filtrar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Listagem de Alunos - <?= $ano ?></h3>
            </div>
            <div class="box-body no-padding">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nome do Aluno</th>
                                <th>Turma / Período</th>
                                <th>Status</th>
                                <th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($alunos)): foreach ($alunos as $aluno): 
                                // Cor do status
                                $labelClass = ($aluno['status_matricula'] == 'Ativo') ? 'label-success' : 'label-default';
                            ?>
                                <tr>
                                    <td style="vertical-align: middle;">
                                        <strong><?= esc($aluno['nome']) ?></strong>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <?= esc($aluno['nome_turma']) ?> <br>
                                        <small class="text-muted"><?= esc($aluno['periodo']) ?></small>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <span class="label <?= $labelClass ?>"><?= esc($aluno['status_matricula'] ?? 'Não matriculado') ?></span>
                                    </td>
                                    <td class="text-right">
                                        <a href="<?= base_url('documentos/lancar-notas/' . $aluno['id_aluno']) ?>?ano=<?= $ano ?>&turma_id=<?= $aluno['id_turma'] ?>" class="btn btn-warning btn-xs" title="Lançar Notas">
                                            <i class="fa fa-edit"></i> Notas
                                        </a>

                                        <a href="<?= base_url('documentos/boletim/' . $aluno['id_aluno']) ?>?ano=<?= $ano ?>" class="btn btn-info btn-xs" target="_blank">
                                            <i class="fa fa-print"></i> Boletim
                                        </a>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-file-pdf-o"></i> Declarações <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="<?= base_url('documentos/declaracaoComNotas/' . $aluno['id_aluno']) ?>?ano=<?= $ano ?>" target="_blank">Com Notas</a></li>
                                                <li><a href="<?= base_url('documentos/declaracaoSemNotas/' . $aluno['id_aluno']) ?>?ano=<?= $ano ?>" target="_blank">Sem Notas</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        <br>Nenhum aluno encontrado para os filtros selecionados.<br><br>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>