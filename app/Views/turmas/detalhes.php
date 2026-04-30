<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1>Turma: <strong><?= esc($turma['nome_turma'] ?? '') ?></strong></h1></div>
                <div class="col-sm-6">
                    <a href="<?= base_url('relatorios/presenca/'.$turma['id_turma']) ?>" target="_blank" class="btn btn-secondary float-right">
                        <i class="fas fa-file-pdf"></i> Pauta de Presença (PDF)
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-info">
                    <div class="card-header"><h3 class="card-title">Informações da Turma</h3></div>
                    <div class="card-body">
                        <p><strong>Professor:</strong> <?= $turma['nome_professor'] ?? '—' ?></p>
                        <p><strong>Disciplina:</strong> <?= $turma['nome_disciplina'] ?? '—' ?></p>
                        <p><strong>Sala:</strong> <?= $turma['nome_sala'] ?? '—' ?></p>
                        <p><strong>Período:</strong> <?= $turma['periodo'] ?></p>
                        <p><strong>Ano Letivo:</strong> <?= $turma['ano_letivo'] ?></p>
                        <p><strong>Total de Alunos:</strong> <?= count($alunos) ?></p>
                    </div>
                    <div class="card-footer">
                        <a href="<?= base_url('turmas/matricular') ?>" class="btn btn-info btn-block">
                            <i class="fas fa-user-plus"></i> Matricular Aluno
                        </a>
                        <a href="<?= base_url('turmas/editar/'.$turma['id_turma']) ?>" class="btn btn-warning btn-block">
                            <i class="fas fa-edit"></i> Editar Turma
                        </a>
                        <a href="<?= base_url('turmas') ?>" class="btn btn-default btn-block">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-outline card-success">
                    <div class="card-header"><h3 class="card-title">Alunos Matriculados</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Nome do Aluno</th>
                                    <th>Telefone</th>
                                    <th>Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($alunos)): foreach ($alunos as $i => $a): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= esc($a['nome']) ?></td>
                                    <td><?= $a['telefone'] ?? '—' ?></td>
                                    <td>
                                        <span class="badge badge-<?= $a['status'] === 'Confirmada' ? 'success' : ($a['status'] === 'Cancelada' ? 'danger' : 'warning') ?>">
                                            <?= $a['status'] ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($a['status'] === 'Pendente'): ?>
                                        <a href="<?= base_url('turmas/confirmar/'.$a['id_matricula']) ?>" class="btn btn-success btn-xs" title="Confirmar Matrícula">
                                            <i class="fas fa-check"></i> Confirmar
                                        </a>
                                        <?php endif; ?>
                                        <?php if ($a['status'] !== 'Cancelada'): ?>
                                        <a href="<?= base_url('turmas/cancelar_matricula/'.$a['id_matricula']) ?>" class="btn btn-danger btn-xs" title="Cancelar">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="5" class="text-center py-4 text-muted">Nenhum aluno matriculado.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
