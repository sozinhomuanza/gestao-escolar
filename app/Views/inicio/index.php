<!-- app/Views/inicio/index.php — Dashboard Administrador -->
<?php
$total_de_alunos      = $total_de_alunos      ?? 0;
$total_de_professores = $total_de_professores ?? 0;
$total_trabalhadores  = $total_trabalhadores  ?? 0;
$total_de_turmas      = $total_de_turmas      ?? 0;
$total_de_disciplinas = $total_de_disciplinas ?? 0;
$matriculas_pendentes = $matriculas_pendentes ?? 0;
$staff_admin          = $total_trabalhadores - $total_de_professores;
$primeiro_nome        = esc(session()->get('primeiro_nome') ?? 'Administrador');
$hora                 = (int)date('H');
$saudacao             = $hora < 12 ? 'Bom dia' : ($hora < 18 ? 'Boa tarde' : 'Boa noite');
$emoji                = $hora < 12 ? '🌅' : ($hora < 18 ? '☀️' : '🌙');
$mes_nome             = ['','Janeiro','Fevereiro','Março','Abril','Maio','Junho',
                          'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'][(int)date('n')];
?>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<style>
/* ════════════════════════════════════════════════════════════
   VARIÁVEIS
════════════════════════════════════════════════════════════ */
:root {
  --blue      : #1d6fce;
  --blue-dark : #0f2d5e;
  --blue-mid  : #1a4a8a;
  --green     : #16a34a;
  --amber     : #d97706;
  --purple    : #7c3aed;
  --teal      : #0d9488;
  --red       : #dc2626;
  --indigo    : #4338ca;
  --bg        : #eef2f8;
  --card      : #ffffff;
  --muted     : #64748b;
  --border    : #e2e8f0;
  --radius    : 16px;
  --radius-sm : 10px;
  --shadow    : 0 1px 8px rgba(15,45,94,.07);
  --shadow-md : 0 4px 20px rgba(15,45,94,.11);
  --shadow-lg : 0 10px 36px rgba(15,45,94,.17);
}
.content-wrapper { background: var(--bg) !important; font-family: 'Nunito', sans-serif; }

/* ── HERO ── */
.adm-hero {
  background: linear-gradient(135deg, #060f1f 0%, #0f2d5e 35%, #1a4a8a 65%, #2575fc 100%);
  padding: 28px 36px 76px;
  color: #fff; position: relative; overflow: hidden;
}
.adm-hero::before {
  content:''; position:absolute; top:-120px; right:-100px;
  width:420px; height:420px; background:rgba(255,255,255,.03); border-radius:50%;
}
.adm-hero::after {
  content:''; position:absolute; bottom:-130px; left:10%;
  width:700px; height:240px; background:rgba(255,255,255,.025); border-radius:50%;
}
/* Decoração técnica no hero */
.adm-hero .deco-grid {
  position:absolute; top:0; right:0; bottom:0; width:40%;
  background-image: linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
  background-size: 30px 30px;
  pointer-events:none;
}
.hero-inner { position:relative; z-index:2; }

.hero-badge {
  display:inline-flex; align-items:center; gap:6px;
  background:rgba(255,255,255,.13); border:1px solid rgba(255,255,255,.22);
  border-radius:30px; padding:4px 16px;
  font-size:.7rem; font-weight:700; text-transform:uppercase; letter-spacing:.7px;
  margin-bottom:10px;
}
.adm-hero h2 {
  font-size:1.85rem; font-weight:900; margin:0 0 5px;
  text-shadow:0 2px 12px rgba(0,0,0,.25);
}
.adm-hero .hero-sub { opacity:.75; font-size:.88rem; font-weight:300; margin:0; }
.hero-school {
  margin-top:12px; font-size:.7rem; opacity:.55;
  text-transform:uppercase; letter-spacing:.9px;
  display:flex; align-items:center; gap:6px;
}

/* Data/hora hero */
.hero-dt {
  position:absolute; top:22px; right:36px; z-index:3;
  text-align:right; color:#fff;
}
.hero-dt .hora  { font-size:1.8rem; font-weight:900; letter-spacing:2px; line-height:1; }
.hero-dt .data  { font-size:.68rem; opacity:.65; text-transform:uppercase; letter-spacing:.5px; margin-top:2px; }
.hero-dt .dia   { font-size:.72rem; opacity:.8; font-weight:600; }

/* ── 6 STAT CARDS ── */
.stat-grid {
  padding: 0 28px;
  margin-top: -52px;
  position:relative; z-index:10;
  display:grid;
  grid-template-columns: repeat(6,1fr);
  gap: 14px;
}
@media(max-width:1200px){ .stat-grid { grid-template-columns:repeat(3,1fr); } }
@media(max-width:768px) { .stat-grid { grid-template-columns:repeat(2,1fr); } }
@media(max-width:480px) { .stat-grid { grid-template-columns:1fr; padding:0 14px; } }

.s-card {
  background:var(--card); border-radius:var(--radius);
  box-shadow:var(--shadow-md); padding:16px 14px;
  text-decoration:none; color:inherit;
  transition:transform .22s, box-shadow .22s;
  border:1px solid var(--border);
  border-left:5px solid transparent;
  display:flex; flex-direction:column; align-items:center; text-align:center;
}
.s-card:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); text-decoration:none; color:inherit; }
.s-card.s1 { border-left-color:#1d6fce; }
.s-card.s2 { border-left-color:#16a34a; }
.s-card.s3 { border-left-color:#0d9488; }
.s-card.s4 { border-left-color:#d97706; }
.s-card.s5 { border-left-color:#7c3aed; }
.s-card.s6 { border-left-color:#dc2626; }

.s-icon {
  width:42px; height:42px; border-radius:11px;
  display:flex; align-items:center; justify-content:center;
  font-size:1.15rem; margin-bottom:9px;
}
.s-val { font-size:1.85rem; font-weight:900; line-height:1; margin-bottom:3px; }
.s-lbl { font-size:.6rem; text-transform:uppercase; color:var(--muted); font-weight:700; letter-spacing:.4px; }
.s-sub { font-size:.62rem; color:var(--muted); margin-top:2px; }

/* ── CORPO ── */
.adm-body { padding:24px 28px 40px; }
@media(max-width:640px){ .adm-body { padding:14px; } }

.sec-hdr {
  font-size:.68rem; font-weight:800; text-transform:uppercase;
  color:var(--muted); letter-spacing:1.2px;
  display:flex; align-items:center; gap:8px; margin-bottom:16px;
}
.sec-hdr::after { content:''; flex:1; height:1px; background:var(--border); }

/* Chart panel */
.chart-panel {
  background:var(--card); border-radius:var(--radius);
  box-shadow:var(--shadow); border:1px solid var(--border);
  padding:20px 22px; height:100%;
}
.cp-title {
  font-size:.72rem; font-weight:800; text-transform:uppercase;
  color:var(--muted); letter-spacing:.5px; margin-bottom:14px;
  display:flex; align-items:center; gap:6px;
}
.chart-wrap { position:relative; height:230px; }

/* KPI rápido (tabela-style) */
.kpi-panel {
  background:var(--card); border-radius:var(--radius);
  box-shadow:var(--shadow); border:1px solid var(--border);
  overflow:hidden; height:100%;
}
.kpi-panel-header {
  background:linear-gradient(135deg,#0f2d5e,#2575fc);
  padding:14px 18px; color:#fff;
}
.kpi-panel-header h6 { margin:0; font-size:.75rem; font-weight:800; text-transform:uppercase; letter-spacing:.5px; }
.kpi-list { padding:12px 16px; display:flex; flex-direction:column; gap:8px; }
.kpi-item {
  display:flex; align-items:center; justify-content:space-between;
  padding:9px 12px; border-radius:var(--radius-sm);
  border:1px solid var(--border); text-decoration:none; color:inherit;
  transition:.18s;
}
.kpi-item:hover { background:#f0f6ff; border-color:#bfdbfe; text-decoration:none; }
.kpi-left { display:flex; align-items:center; gap:10px; }
.kpi-ic   { width:34px; height:34px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:.95rem; flex-shrink:0; }
.kpi-lbl  { font-size:.8rem; font-weight:700; color:#1e293b; }
.kpi-sub  { font-size:.65rem; color:var(--muted); }
.kpi-val  { font-size:1.25rem; font-weight:900; font-family:'Nunito',sans-serif; }

/* Acesso rápido Admin */
.quick-grid {
  display:grid; grid-template-columns:repeat(4,1fr); gap:10px;
}
@media(max-width:992px){ .quick-grid { grid-template-columns:repeat(2,1fr); } }

.q-btn {
  background:var(--card); border:1px solid var(--border); border-radius:var(--radius-sm);
  padding:16px 10px; text-align:center; text-decoration:none; color:#1e293b;
  transition:.2s; display:flex; flex-direction:column; align-items:center; gap:8px;
}
.q-btn:hover { border-color:var(--blue); background:#f0f6ff; color:var(--blue); text-decoration:none; transform:translateY(-2px); box-shadow:var(--shadow); }
.q-btn .qi { width:44px; height:44px; border-radius:11px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; transition:.2s; }
.q-btn:hover .qi { transform:scale(1.1); }
.q-btn span { font-size:.72rem; font-weight:700; }

/* Aviso */
.aviso {
  border-radius:var(--radius-sm); padding:12px 15px; margin-bottom:8px;
  display:flex; align-items:flex-start; gap:11px;
  font-size:.8rem; border:1px solid transparent;
}
.aviso.warn { background:#fffbeb; border-color:#fde68a; }
.aviso.info { background:#eff6ff; border-color:#bfdbfe; }
.aviso.ok   { background:#f0fdf4; border-color:#bbf7d0; }
.aviso .av-ic { font-size:1.1rem; flex-shrink:0; margin-top:1px; }
.aviso a { color:var(--blue); font-weight:700; text-decoration:none; }
.aviso a:hover { text-decoration:underline; }

/* Info institucional */
.inst-card {
  background:linear-gradient(135deg,#060f1f,#0f2d5e,#1a4a8a);
  border-radius:var(--radius); padding:22px 24px; color:#fff;
  position:relative; overflow:hidden;
}
.inst-card::before {
  content:''; position:absolute; top:-40px; right:-40px;
  width:150px; height:150px; background:rgba(255,255,255,.05); border-radius:50%;
}
.inst-card::after {
  content:''; position:absolute; bottom:-50px; left:-20px;
  width:180px; height:100px; background:rgba(255,255,255,.04); border-radius:50%;
}
.inst-inner { position:relative; z-index:2; }
.inst-card h4 { font-size:1rem; font-weight:800; margin-0; }
.inst-card p  { opacity:.7; font-size:.78rem; margin:4px 0 16px; }
.inst-stats { display:grid; grid-template-columns:repeat(3,1fr); gap:8px; }
.inst-stat  { background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.15); border-radius:9px; padding:10px; text-align:center; }
.inst-stat .iv { font-size:1.5rem; font-weight:900; }
.inst-stat .il { font-size:.6rem; opacity:.75; text-transform:uppercase; font-weight:700; margin-top:2px; letter-spacing:.3px; }

/* Linha de ano lectivo */
.ano-bar {
  background:var(--card); border:1px solid var(--border);
  border-radius:var(--radius); padding:16px 22px;
  display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px;
}
.ano-bar .ab-label { font-size:.7rem; text-transform:uppercase; font-weight:800; color:var(--muted); letter-spacing:.5px; }
.ano-bar .ab-val   { font-size:1rem; font-weight:900; color:var(--blue-dark); }
.ano-bar .ab-item  { display:flex; flex-direction:column; align-items:center; text-align:center; }
.ano-bar .divider  { width:1px; height:36px; background:var(--border); }
.pend-pill {
  background:#fef3c7; color:#92400e; border:1px solid #fde68a;
  border-radius:20px; padding:4px 12px; font-size:.72rem; font-weight:800;
  display:inline-flex; align-items:center; gap:5px;
}
.pend-pill.ok { background:#d1fae5; color:#065f46; border-color:#6ee7b7; }
</style>

<div class="content-wrapper" style="background:var(--bg);">

    <!-- ── HERO ── -->
    <div class="adm-hero">
        <div class="deco-grid"></div>
        <div class="hero-dt">
            <div class="hora" id="heroHora">--:--</div>
            <div class="dia"  id="heroDia"></div>
            <div class="data"><?= date('d') ?>/<?= date('m') ?>/<?= date('Y') ?></div>
        </div>
        <div class="hero-inner">
            <div class="hero-badge">
                <i class="bi bi-shield-fill-check"></i> Administrador do Sistema
            </div>
            <h2><?= $saudacao ?>, <?= $primeiro_nome ?>! <?= $emoji ?></h2>
            <p class="hero-sub">Painel de administração e gestão académica — acesso total ao sistema</p>
            <div class="hero-school">
                <i class="bi bi-building"></i>
                Instituto Politécnico Industrial "17 de Dezembro"
                <span style="opacity:.5;">·</span>
                Ano Lectivo <?= date('Y') ?>
            </div>
        </div>
    </div>

    <!-- ── STAT CARDS ── -->
    <div class="stat-grid">

        <a href="<?= base_url('alunos') ?>" class="s-card s1">
            <div class="s-icon" style="background:#eff6ff; color:#1d6fce;"><i class="bi bi-mortarboard-fill"></i></div>
            <div class="s-val" style="color:#1d6fce;"><?= number_format($total_de_alunos) ?></div>
            <div class="s-lbl">Alunos</div>
            <div class="s-sub">→ Ver lista</div>
        </a>

        <a href="<?= base_url('trabalhadores/professores') ?>" class="s-card s2">
            <div class="s-icon" style="background:#f0fdf4; color:#16a34a;"><i class="bi bi-person-video3"></i></div>
            <div class="s-val" style="color:#16a34a;"><?= number_format($total_de_professores) ?></div>
            <div class="s-lbl">Docentes</div>
            <div class="s-sub">→ Ver lista</div>
        </a>

        <a href="<?= base_url('trabalhadores') ?>" class="s-card s3">
            <div class="s-icon" style="background:#f0fdfa; color:#0d9488;"><i class="bi bi-person-badge-fill"></i></div>
            <div class="s-val" style="color:#0d9488;"><?= number_format($staff_admin) ?></div>
            <div class="s-lbl">Total de Funciónarios.</div>
            <div class="s-sub">→ Ver lista</div>
        </a>

        <a href="<?= base_url('turmas') ?>" class="s-card s4">
            <div class="s-icon" style="background:#fffbeb; color:#d97706;"><i class="bi bi-collection-fill"></i></div>
            <div class="s-val" style="color:#d97706;"><?= number_format($total_de_turmas) ?></div>
            <div class="s-lbl">Turmas</div>
            <div class="s-sub">→ Ver turmas</div>
        </a>

        <a href="<?= base_url('disciplinas') ?>" class="s-card s5">
            <div class="s-icon" style="background:#faf5ff; color:#7c3aed;"><i class="bi bi-book-fill"></i></div>
            <div class="s-val" style="color:#7c3aed;"><?= number_format($total_de_disciplinas) ?></div>
            <div class="s-lbl">Disciplinas</div>
            <div class="s-sub">→ Ver lista</div>
        </a>

        <a href="<?= base_url('turmas') ?>" class="s-card s6">
            <div class="s-icon" style="background:#fff1f2; color:#dc2626;"><i class="bi bi-hourglass-split"></i></div>
            <div class="s-val" style="color:<?= $matriculas_pendentes > 0 ? '#dc2626' : '#16a34a' ?>;">
                <?= number_format($matriculas_pendentes) ?>
            </div>
            <div class="s-lbl">Matrículas Pend.</div>
            <div class="s-sub"><?= $matriculas_pendentes > 0 ? '⚠️ Pendentes' : '✅ Em dia' ?></div>
        </a>

    </div>

    <!-- ── CORPO ── -->
    <div class="adm-body">

        <!-- Barra ano lectivo -->
        <div class="ano-bar mb-4 shadow-sm">
            <div class="ab-item">
                <div class="ab-label">Ano Lectivo</div>
                <div class="ab-val"><?= date('Y') ?></div>
            </div>
            <div class="divider"></div>
            <div class="ab-item">
                <div class="ab-label">Trimestre Actual</div>
                <div class="ab-val">
                    <?php $m=(int)date('n'); echo $m<=4?'Iº':($m<=8?'IIº':'IIIº'); ?> Trimestre
                </div>
            </div>
            <div class="divider"></div>
            <div class="ab-item">
                <div class="ab-label">Mês</div>
                <div class="ab-val"><?= $mes_nome ?> <?= date('Y') ?></div>
            </div>
            <div class="divider"></div>
            <div class="ab-item">
                <div class="ab-label">Matrículas</div>
                <div class="ab-val">
                    <?php if ($matriculas_pendentes > 0): ?>
                    <span class="pend-pill">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <?= $matriculas_pendentes ?> Pendente(s)
                    </span>
                    <?php else: ?>
                    <span class="pend-pill ok"><i class="bi bi-check-circle-fill"></i> Em dia</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="divider d-none d-lg-block"></div>
            <div class="ab-item d-none d-lg-flex">
                <div class="ab-label">Rácio Aluno/Docente</div>
                <div class="ab-val">
                    <?= $total_de_professores > 0 ? round($total_de_alunos / $total_de_professores, 1) : '—' ?>:1
                </div>
            </div>
        </div>

        <!-- Linha 1: Gráficos -->
        <div class="sec-hdr"><i class="bi bi-bar-chart-fill"></i> Análise Académica</div>
        <div class="row mb-4">

            <!-- Gráfico barras geral -->
            <div class="col-xl-5 col-lg-6 mb-3">
                <div class="chart-panel">
                    <div class="cp-title"><i class="bi bi-bar-chart-line-fill"></i> Visão Geral da Instituição</div>
                    <div class="chart-wrap"><canvas id="barChart"></canvas></div>
                </div>
            </div>

            <!-- Gráfico rosca RH -->
            <div class="col-xl-3 col-lg-6 mb-3">
                <div class="chart-panel">
                    <div class="cp-title"><i class="bi bi-pie-chart-fill"></i> Distribuição RH</div>
                    <div class="chart-wrap"><canvas id="rhChart"></canvas></div>
                </div>
            </div>

            <!-- KPI rápidos -->
            <div class="col-xl-4 col-lg-12 mb-3">
                <div class="kpi-panel">
                    <div class="kpi-panel-header">
                        <h6><i class="bi bi-activity me-1"></i> Indicadores Chave</h6>
                    </div>
                    <div class="kpi-list">
                        <a href="<?= base_url('alunos') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-ic" style="background:#eff6ff;color:#1d6fce;"><i class="bi bi-mortarboard-fill"></i></div>
                                <div><div class="kpi-lbl">Total de Alunos</div><div class="kpi-sub">Matrículas confirmadas</div></div>
                            </div>
                            <span class="kpi-val text-primary"><?= $total_de_alunos ?></span>
                        </a>
                        <a href="<?= base_url('trabalhadores') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-ic" style="background:#f0fdf4;color:#16a34a;"><i class="bi bi-people-fill"></i></div>
                                <div><div class="kpi-lbl">Total de Funcionários</div><div class="kpi-sub">Docentes + funcionários</div></div>
                            </div>
                            <span class="kpi-val text-success"><?= $total_trabalhadores ?></span>
                        </a>
                        <a href="<?= base_url('turmas') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-ic" style="background:#fffbeb;color:#d97706;"><i class="bi bi-collection-fill"></i></div>
                                <div><div class="kpi-lbl">Turmas Activas</div><div class="kpi-sub">Ano lectivo <?= date('Y') ?></div></div>
                            </div>
                            <span class="kpi-val text-warning"><?= $total_de_turmas ?></span>
                        </a>
                        <a href="<?= base_url('disciplinas') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-ic" style="background:#faf5ff;color:#7c3aed;"><i class="bi bi-book-fill"></i></div>
                                <div><div class="kpi-lbl">Disciplinas</div><div class="kpi-sub">Currículo técnico-industrial</div></div>
                            </div>
                            <span class="kpi-val text-purple" style="color:#7c3aed;"><?= $total_de_disciplinas ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Linha 2: Acesso rápido + Avisos + Institucional -->
        <div class="row">

            <!-- Acesso rápido Admin -->
            <div class="col-lg-6 mb-4">
                <div class="sec-hdr"><i class="bi bi-lightning-fill"></i> Acesso Rápido — Gestão Completa</div>
                <div class="quick-grid">
                    <a href="<?= base_url('alunos/novo') ?>" class="q-btn">
                        <div class="qi" style="background:#eff6ff;color:#1d6fce;"><i class="bi bi-person-plus-fill"></i></div>
                        <span>Novo Aluno</span>
                    </a>
                    <a href="<?= base_url('trabalhadores/novo') ?>" class="q-btn">
                        <div class="qi" style="background:#f0fdf4;color:#16a34a;"><i class="bi bi-person-badge-fill"></i></div>
                        <span>Novo Func.</span>
                    </a>
                    <a href="<?= base_url('turmas/novo') ?>" class="q-btn">
                        <div class="qi" style="background:#fffbeb;color:#d97706;"><i class="bi bi-plus-circle-fill"></i></div>
                        <span>Nova Turma</span>
                    </a>
                    <a href="<?= base_url('turmas/matricular') ?>" class="q-btn">
                        <div class="qi" style="background:#fdf4ff;color:#9333ea;"><i class="bi bi-ui-checks"></i></div>
                        <span>Matricular</span>
                    </a>
                    <a href="<?= base_url('pautas') ?>" class="q-btn">
                        <div class="qi" style="background:#fff1f2;color:#e11d48;"><i class="bi bi-clipboard2-data-fill"></i></div>
                        <span>Mini Pautas</span>
                    </a>
                    <a href="<?= base_url('importacao') ?>" class="q-btn">
                        <div class="qi" style="background:#f0fdfa;color:#0d9488;"><i class="bi bi-file-earmark-arrow-up-fill"></i></div>
                        <span>Importar</span>
                    </a>
                    <a href="<?= base_url('usuarios/novo') ?>" class="q-btn">
                        <div class="qi" style="background:#f0f4ff;color:#4338ca;"><i class="bi bi-key-fill"></i></div>
                        <span>Novo Acesso</span>
                    </a>
                    <a href="<?= base_url('salas') ?>" class="q-btn">
                        <div class="qi" style="background:#fff7ed;color:#ea580c;"><i class="bi bi-door-open-fill"></i></div>
                        <span>Salas</span>
                    </a>
                </div>
            </div>

            <!-- Col direita: Avisos + Institucional -->
            <div class="col-lg-6 mb-4">

                <!-- Avisos -->
                <div class="sec-hdr"><i class="bi bi-bell-fill"></i> Avisos do Sistema</div>

                <?php if ($matriculas_pendentes > 0): ?>
                <div class="aviso warn">
                    <i class="bi bi-exclamation-triangle-fill text-warning av-ic"></i>
                    <div>
                        <strong><?= $matriculas_pendentes ?> matrícula(s) pendente(s)</strong> aguardam confirmação.
                        <a href="<?= base_url('turmas/matricular') ?>"> Confirmar agora →</a>
                    </div>
                </div>
                <?php else: ?>
                <div class="aviso ok">
                    <i class="bi bi-check-circle-fill text-success av-ic"></i>
                    <div><strong>Matrículas em dia.</strong> Nenhuma pendente de confirmação.</div>
                </div>
                <?php endif; ?>

                <?php if ($total_de_alunos == 0): ?>
                <div class="aviso warn">
                    <i class="bi bi-person-x-fill text-warning av-ic"></i>
                    <div>Sem alunos registados. <a href="<?= base_url('alunos/novo') ?>">Registar agora →</a></div>
                </div>
                <?php endif; ?>

                <div class="aviso info">
                    <i class="bi bi-shield-fill-check text-primary av-ic"></i>
                    <div>Gerencie os acessos dos utilizadores em <a href="<?= base_url('usuarios') ?>">Acesso ao Sistema</a>.</div>
                </div>
                <div class="aviso info">
                    <i class="bi bi-file-earmark-arrow-up-fill text-primary av-ic"></i>
                    <div>Importe listas de alunos e docentes via <a href="<?= base_url('importacao') ?>">Importação Excel</a>.</div>
                </div>

                <!-- Card institucional -->
                <div class="inst-card mt-3">
                    <div class="inst-inner">
                        <h4><i class="bi bi-building me-2"></i>Instituto Politécnico Industrial</h4>
                        <p>"17 de Dezembro" — Cursos Técnicos e Profissionais</p>
                        <div class="inst-stats">
                            <div class="inst-stat">
                                <div class="iv"><?= $total_de_alunos ?></div>
                                <div class="il">Alunos</div>
                            </div>
                            <div class="inst-stat">
                                <div class="iv"><?= $total_de_professores ?></div>
                                <div class="il">Docentes</div>
                            </div>
                            <div class="inst-stat">
                                <div class="iv"><?= $total_de_turmas ?></div>
                                <div class="il">Turmas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <strong>Sistema de Gestão Escolar</strong> — Instituto Politécnico Industrial "17 de Dezembro"
        <div class="float-right d-none d-sm-inline-block">
            &mdash; <?= date('Y') ?>
        </div>
    </footer>

</div><!-- /.content-wrapper -->

<script>
(function(){
    const days = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
    function tick(){
        const n  = new Date();
        const hh = String(n.getHours()).padStart(2,'0');
        const mm = String(n.getMinutes()).padStart(2,'0');
        const r  = document.getElementById('heroHora');
        const d  = document.getElementById('heroDia');
        if(r) r.textContent = hh + ':' + mm;
        if(d) d.textContent = days[n.getDay()];
    }
    tick(); setInterval(tick, 60000);

    Chart.defaults.font.family = "'Nunito', sans-serif";
    Chart.defaults.color = '#64748b';

    const d = {
        alunos:     <?= (int)$total_de_alunos ?>,
        docentes:   <?= (int)$total_de_professores ?>,
        staff:      <?= (int)$staff_admin ?>,
        turmas:     <?= (int)$total_de_turmas ?>,
        disciplinas:<?= (int)$total_de_disciplinas ?>
    };

    // Gráfico de barras
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: ['Alunos','Docentes','Staff Admin.','Turmas','Disciplinas'],
            datasets:[{
                label:'Total',
                data:[d.alunos, d.docentes, d.staff, d.turmas, d.disciplinas],
                backgroundColor:['#1d6fce22','#16a34a22','#0d948822','#d9770622','#7c3aed22'],
                borderColor:    ['#1d6fce',  '#16a34a',  '#0d9488',  '#d97706',  '#7c3aed'],
                borderWidth:2.5, borderRadius:9, borderSkipped:false,
            }]
        },
        options:{
            responsive:true, maintainAspectRatio:false,
            plugins:{ legend:{ display:false },
                tooltip:{ callbacks:{ label: ctx => ' ' + ctx.parsed.y + ' registado(s)' } }
            },
            scales:{
                x:{ grid:{ display:false }, ticks:{ font:{ weight:'700', size:11 } } },
                y:{ beginAtZero:true, grid:{ color:'#f1f5f9' }, ticks:{ precision:0 } }
            }
        }
    });

    // Gráfico rosca RH
    new Chart(document.getElementById('rhChart'), {
        type: 'doughnut',
        data:{
            labels:['Docentes','Staff Admin.','Alunos'],
            datasets:[{
                data:[d.docentes, d.staff, d.alunos],
                backgroundColor:['#1d6fce','#0d9488','#7c3aed'],
                borderWidth:0, hoverOffset:10
            }]
        },
        options:{
            responsive:true, maintainAspectRatio:false, cutout:'65%',
            plugins:{
                legend:{ position:'bottom', labels:{ padding:14, font:{ weight:'700', size:10 }, boxWidth:12 } }
            }
        }
    });
})();
</script>