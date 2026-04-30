<div class="card mb-3 shadow-sm border-0">
    <div class="card-body">
        <form action="<?= current_url() ?>" method="get" class="row g-2">
            <div class="col-md-6">
                <input type="text" name="busca" value="<?= set_value('busca', $_GET['busca'] ?? '') ?>" 
                       class="form-control" placeholder="🔍 Pesquisar por Turma ou Professor...">
            </div>
            <div class="col-md-4">
                <select name="periodo" class="form-select">
                    <option value="">Todos os Períodos</option>
                    <option value="Manhã" <?= ($_GET['periodo'] ?? '') == 'Manhã' ? 'selected' : '' ?>>Manhã</option>
                    <option value="Tarde" <?= ($_GET['periodo'] ?? '') == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                    <option value="Noite" <?= ($_GET['periodo'] ?? '') == 'Noite' ? 'selected' : '' ?>>Noite</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filtrar</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0" style="background: #fff;">
            <thead class="bg-light">
                <tr>
                    <th style="padding-left: 20px;">Turma / Curso</th>
                    <th>Disciplina</th>
                    <th>Professor</th>
                    <th>Período</th>
                    <th class="text-end" style="padding-right: 20px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($turmas)): foreach($turmas as $t): ?>
                <tr>
                    <td style="padding-left: 20px;">
                        <span class="fw-bold text-primary"><?= $t['nome_turma'] ?></span>
                        <div class="text-muted" style="font-size: 0.8rem;">Técnico de Informática</div>
                    </td>
                    <td><?= $t['nome_disciplina'] ?></td>
                    <td><small class="text-muted"><?= $t['nome_professor'] ?></small></td>
                    <td><span class="badge bg-light text-dark border"><?= $t['periodo'] ?></span></td>
                    <td class="text-end" style="padding-right: 20px;">
                        <div class="btn-group">
                            <a href="<?= base_url('pautas/lancar/'.$t['id_turma']) ?>" class="btn btn-sm btn-outline-secondary" title="Lançar Notas">
                                📝 Lançar
                            </a>
                            <a href="<?= base_url('relatorios/mini-pauta/'.$t['id_turma']) ?>" target="_blank" class="btn btn-sm btn-dark">
                                📄 Pauta
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; else: ?>
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Nenhuma turma encontrada com esses filtros.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>