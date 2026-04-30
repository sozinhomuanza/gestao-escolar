<?php
$nomes_trimestre = ['', 'Iº Trimestre', 'IIº Trimestre', 'IIIº Trimestre'];
?>
<?php $this->include('templates/header') ?>
<?php $this->include('templates/sidebar') ?>

<style>
.pauta-wrapper    { background:#f0f4f9; min-height:100vh; }
.pauta-header     { background:linear-gradient(135deg,#1a3a5c 0%,#2575fc 100%);
                    color:#fff; border-radius:0 0 20px 20px; padding:24px 32px 30px; }
.trim-tab         { border-radius:8px 8px 0 0 !important; font-weight:600; }
.trim-tab.active  { background:#fff !important; color:#1a3a5c !important; }
.nota-input       { width:60px; text-align:center; border-radius:8px;
                    border:1px solid #ced4da; padding:4px 6px;
                    font-weight:600; font-size:.9rem; }
.nota-input:focus { outline:none; border-color:#2575fc; box-shadow:0 0 0 2px rgba(37,117,252,.2); }
.nota-input.positiva { border-color:#198754 !important; background:#f0fff4; color:#155724; }
.nota-input.negativa { border-color:#dc3545 !important; background:#fff5f5; color:#721c24; }
.mt-badge         { display:inline-block; min-width:52px; text-align:center;
                    border-radius:8px; padding:4px 8px; font-weight:700; font-size:.88rem; }
.mt-pos           { background:#d1fae5; color:#065f46; }
.mt-neg           { background:#fee2e2; color:#991b1b; }
.mt-vazio         { background:#f3f4f6; color:#9ca3af; }
.stat-box         { background:#fff; border-radius:12px; padding:14px 18px;
                    text-align:center; box-shadow:0 2px 8px rgba(0,0,0,.06); }
.stat-box .value  { font-size:1.8rem; font-weight:800; line-height:1.1; }
.stat-box .label  { font-size:.75rem; text-transform:uppercase; color:#6c757d; font-weight:600; letter-spacing:.5px; }
.row-aluno:hover  { background:#f8faff; }
.row-aluno td     { vertical-align:middle; }
.thead-pauta th   { background:linear-gradient(135deg,#1a3a5c,#2575fc);
                    color:#fff; font-size:.75rem; text-transform:uppercase;
                    letter-spacing:.5px; font-weight:600; }
.falta-check      { width:18px; height:18px; cursor:pointer; accent-color:#dc3545; }
.btn-salvar-float { position:fixed; bottom:30px; right:30px; z-index:999;
                    border-radius:50px; padding:14px 28px; font-weight:700;
                    box-shadow:0 6px 20px rgba(37,117,252,.4); transition:.2s; }
.btn-salvar-float:hover { transform:translateY(-2px); box-shadow:0 10px 28px rgba(37,117,252,.5); }
.info-pill { display:inline-flex; align-items:center; gap:6px;
             background:rgba(255,255,255,.15); border-radius:20px;
             padding:5px 14px; font-size:.82rem; }
</style>

<div class="content-wrapper pauta-wrapper">

    <!-- Cabeçalho -->
    <div class="pauta-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-start flex-wrap">
                <div>
                    <div class="d-flex align-items-center mb-1">
                        <a href="<?= base_url('pautas') ?>" class="text-white mr-3" style="opacity:.7;">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h2 class="mb-0 font-weight-bold">Mini Pauta</h2>
                    </div>
                    <h4 class="mb-2" style="opacity:.9;"><?= esc($turma['nome_disciplina']) ?></h4>
                    <div class="d-flex flex-wrap" style="gap:8px;">
                        <span class="info-pill"><i class="fas fa-layer-group"></i> <?= esc($turma['nome_turma']) ?></span>
                        <span class="info-pill"><i class="fas fa-chalkboard-teacher"></i> <?= esc($turma['nome_professor'] ?? 'N/D') ?></span>
                        <span class="info-pill"><i class="fas fa-door-open"></i> <?= esc($turma['nome_sala'] ?? 'N/D') ?></span>
                        <?php if (!empty($turma['tel_professor'])): ?>
                        <span class="info-pill"><i class="fas fa-phone"></i> <?= esc($turma['tel_professor']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="<?= base_url("pautas/ver/{$turma['id_turma']}") ?>" class="btn btn-light btn-sm mr-2">
                        <i class="fas fa-eye mr-1"></i>Ver Completa
                    </a>
                    <a href="<?= base_url("pautas/imprimir/{$turma['id_turma']}") ?>" target="_blank" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-print mr-1"></i>Imprimir PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content pt-4 pb-5">
        <div class="container-fluid">

            <!-- Tabs de Trimestre -->
            <ul class="nav nav-tabs border-0 mb-0" style="gap:4px;">
                <?php for ($tr = 1; $tr <= 3; $tr++): ?>
                <li class="nav-item">
                    <a href="<?= base_url("pautas/lancar/{$turma['id_turma']}?trimestre={$tr}") ?>"
                       class="nav-link trim-tab <?= $trimestre == $tr ? 'active shadow-sm' : 'text-muted' ?>"
                       style="background:<?= $trimestre == $tr ? '#fff' : 'rgba(255,255,255,.6)' ?>;">
                        <i class="fas fa-calendar-alt mr-1"></i><?= $nomes_trimestre[$tr] ?>
                    </a>
                </li>
                <?php endfor; ?>
            </ul>

            <!-- Card Principal -->
            <div class="card shadow border-0" style="border-radius:0 12px 12px 12px;">
                <div class="card-body p-4">

                    <!-- Estatísticas -->
                    <?php if (!empty($alunos)): ?>
                    <div class="row mb-4">
                        <div class="col-6 col-md-2 mb-2">
                            <div class="stat-box">
                                <div class="value text-primary"><?= $stats['total_alunos'] ?></div>
                                <div class="label">Total Alunos</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="stat-box">
                                <div class="value text-success"><?= $stats['positivas'] ?></div>
                                <div class="label">Positivas</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="stat-box">
                                <div class="value text-danger"><?= $stats['negativas'] ?></div>
                                <div class="label">Negativas</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="stat-box">
                                <div class="value text-warning"><?= $stats['nao_avaliados'] ?></div>
                                <div class="label">Não Aval.</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="stat-box">
                                <div class="value"><?= $stats['pct_positivas'] ?>%</div>
                                <div class="label">% Positivas</div>
                            </div>
                        </div>
                        <div class="col-6 col-md-2 mb-2">
                            <div class="stat-box">
                                <div class="value"><?= $stats['pct_negativas'] ?>%</div>
                                <div class="label">% Negativas</div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (empty($alunos)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            Não existem alunos matriculados (confirmados) nesta turma.
                            <a href="<?= base_url('turmas/matricular') ?>">Matricular alunos</a>
                        </div>
                    <?php else: ?>

                    <!-- Formulário de Notas -->
                    <form method="POST" action="<?= base_url('pautas/salvar') ?>" id="formNotas">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_turma"  value="<?= $turma['id_turma'] ?>">
                        <input type="hidden" name="trimestre" value="<?= $trimestre ?>">

                        <!-- Legenda -->
                        <div class="d-flex flex-wrap mb-2" style="gap:12px;">
                            <small class="text-muted"><b>MAC</b> = Média Avaliação Contínua</small>
                            <small class="text-muted"><b>NPP</b> = Nota Prova Preparação</small>
                            <small class="text-muted"><b>NPT</b> = Nota Prova Trimestral</small>
                            <small class="text-muted"><b>MT</b> = Média Trimestral (auto)</small>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="tabelaNotas">
                                <thead class="thead-pauta">
                                    <tr>
                                        <th style="width:40px">#</th>
                                        <th>Nome do Aluno</th>
                                        <th style="width:50px">Gén.</th>
                                        <th style="width:70px" class="text-center">MAC<br><small style="font-weight:400;font-size:.7rem;">0–20</small></th>
                                        <th style="width:70px" class="text-center">NPP<br><small style="font-weight:400;font-size:.7rem;">0–20</small></th>
                                        <th style="width:70px" class="text-center">NPT<br><small style="font-weight:400;font-size:.7rem;">0–20</small></th>
                                        <th style="width:70px" class="text-center">MT</th>
                                        <th style="width:50px" class="text-center" title="Faltou à prova">F</th>
                                        <th>Obs.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($alunos as $i => $a): ?>
                                    <?php
                                    $aid = $a['id_aluno'];
                                    $mac = $a['mac'] ?? '';
                                    $npp = $a['npp'] ?? '';
                                    $npt = $a['npt'] ?? '';
                                    $mt  = $a['mt']  ?? null;
                                    ?>
                                    <tr class="row-aluno">
                                        <td>
                                            <small class="text-muted"><?= $i + 1 ?></small>
                                            <input type="hidden" name="aluno_id[]" value="<?= $aid ?>">
                                        </td>
                                        <td class="font-weight-bold"><?= esc($a['nome_aluno']) ?></td>
                                        <td>
                                            <small class="badge <?= ($a['genero'] ?? '') == 'Feminino' ? 'badge-danger' : 'badge-secondary' ?>">
                                                <?= substr($a['genero'] ?? '-', 0, 1) ?>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="mac_<?= $aid ?>"
                                                   class="nota-input nota-field"
                                                   data-aluno="<?= $aid ?>" data-tipo="mac"
                                                   value="<?= $mac !== '' ? esc($mac) : '' ?>"
                                                   min="0" max="20" step="0.1" placeholder="–">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="npp_<?= $aid ?>"
                                                   class="nota-input nota-field"
                                                   data-aluno="<?= $aid ?>" data-tipo="npp"
                                                   value="<?= $npp !== '' ? esc($npp) : '' ?>"
                                                   min="0" max="20" step="0.1" placeholder="–">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="npt_<?= $aid ?>"
                                                   class="nota-input nota-field"
                                                   data-aluno="<?= $aid ?>" data-tipo="npt"
                                                   value="<?= $npt !== '' ? esc($npt) : '' ?>"
                                                   min="0" max="20" step="0.1" placeholder="–">
                                        </td>
                                        <td class="text-center">
                                            <span class="mt-badge <?= $mt !== null ? ($mt >= 10 ? 'mt-pos' : 'mt-neg') : 'mt-vazio' ?>"
                                                  id="mt_<?= $aid ?>">
                                                <?= $mt !== null ? number_format($mt, 1) : '–' ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" class="falta-check"
                                                   name="falta_<?= $aid ?>"
                                                   title="Assinalar falta à prova"
                                                   <?= !empty($a['falta']) ? 'checked' : '' ?>>
                                        </td>
                                        <td>
                                            <input type="text" name="obs_<?= $aid ?>"
                                                   class="form-control form-control-sm"
                                                   style="min-width:100px;"
                                                   value="<?= esc($a['observacao'] ?? '') ?>"
                                                   placeholder="(opcional)">
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <button type="submit" class="btn btn-primary btn-salvar-float">
                            <i class="fas fa-save mr-2"></i>Guardar Notas
                        </button>
                    </form>

                    <?php endif; ?>
                </div>
            </div>

        </div>
    </section>
</div>

<?php $this->include('templates/footer') ?>

<script>
(function () {
    const notas = {};

    document.querySelectorAll('.nota-field').forEach(function (el) {
        const aid  = el.dataset.aluno;
        const tipo = el.dataset.tipo;
        if (!notas[aid]) notas[aid] = { mac: null, npp: null, npt: null };
        notas[aid][tipo] = el.value !== '' ? parseFloat(el.value) : null;
        colorirInput(el);
    });

    document.querySelectorAll('.nota-field').forEach(function (el) {
        el.addEventListener('input', function () {
            const aid  = this.dataset.aluno;
            const tipo = this.dataset.tipo;
            const val  = this.value !== '' ? parseFloat(this.value) : null;
            if (val !== null && (val < 0 || val > 20)) {
                this.style.borderColor = '#ffc107';
                return;
            }
            notas[aid][tipo] = val;
            colorirInput(this);
            calcularMT(aid);
        });
    });

    function calcularMT(aid) {
        const n    = notas[aid];
        const span = document.getElementById('mt_' + aid);
        if (!span) return;
        if (n.mac !== null && n.npp !== null && n.npt !== null) {
            const mt = (n.mac + n.npp + n.npt) / 3;
            span.textContent = mt.toFixed(1);
            span.className   = 'mt-badge ' + (mt >= 10 ? 'mt-pos' : 'mt-neg');
        } else {
            span.textContent = '–';
            span.className   = 'mt-badge mt-vazio';
        }
    }

    function colorirInput(el) {
        const v = parseFloat(el.value);
        el.classList.remove('positiva', 'negativa');
        if (!isNaN(v)) el.classList.add(v >= 10 ? 'positiva' : 'negativa');
    }
})();

// Confirmação antes de sair com alterações não guardadas
(function () {
    let modificado = false;
    document.querySelectorAll('.nota-field, .falta-check').forEach(function (el) {
        el.addEventListener('change', function () { modificado = true; });
        el.addEventListener('input',  function () { modificado = true; });
    });
    document.getElementById('formNotas')?.addEventListener('submit', function () {
        modificado = false;
    });
    window.addEventListener('beforeunload', function (e) {
        if (modificado) { e.preventDefault(); e.returnValue = ''; }
    });
})();
</script>