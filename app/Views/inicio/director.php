<!-- app/Views/inicio/director.php -->
<?php
$primeiro_nome        = esc(session()->get('primeiro_nome') ?? 'Director');
$hora                 = (int)date('H');
$saudacao             = $hora < 12 ? 'Bom dia' : ($hora < 18 ? 'Boa tarde' : 'Boa noite');
$emoji                = $hora < 12 ? '🌅' : ($hora < 18 ? '☀️' : '🌙');

$total_de_alunos      = $total_de_alunos      ?? 0;
$total_de_professores = $total_de_professores ?? 0;
$total_trabalhadores  = $total_trabalhadores  ?? 0;
$total_de_turmas      = $total_de_turmas      ?? 0;
$total_de_disciplinas = $total_de_disciplinas ?? 0;
$matriculas_pendentes = $matriculas_pendentes ?? 0;
$staff_admin          = $total_trabalhadores - $total_de_professores;
?>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<style>
:root {
  --blue      : #1d6fce;
  --blue-dark : #0f2d5e;
  --blue-mid  : #1a4a8a;
  --green     : #16a34a;
  --amber     : #d97706;
  --purple    : #7c3aed;
  --teal      : #0d9488;
  --red       : #dc2626;
  --bg        : #eef2f8;
  --card      : #ffffff;
  --muted     : #64748b;
  --border    : #e2e8f0;
  --radius    : 16px;
  --radius-sm : 10px;
  --shadow    : 0 1px 8px rgba(15,45,94,.08);
  --shadow-md : 0 4px 20px rgba(15,45,94,.12);
  --shadow-lg : 0 8px 32px rgba(15,45,94,.18);
}
.content-wrapper { background: var(--bg) !important; font-family:'Nunito',sans-serif; }

/* ── HERO ── */
.dir-hero {
  background: linear-gradient(135deg, #0a1f3d 0%, #0f2d5e 40%, #1a4a8a 75%, #2575fc 100%);
  padding: 30px 36px 72px;
  color: #fff; position: relative; overflow: hidden;
}
.dir-hero::before {
  content:''; position:absolute; top:-100px; right:-80px;
  width:380px; height:380px; background:rgba(255,255,255,.04); border-radius:50%;
}
.dir-hero::after {
  content:''; position:absolute; bottom:-120px; left:15%;
  width:600px; height:220px; background:rgba(255,255,255,.03); border-radius:50%;
}
.hero-inner { position:relative; z-index:2; }
.hero-badge {
  display:inline-flex; align-items:center; gap:6px;
  background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25);
  border-radius:30px; padding:4px 16px;
  font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.6px;
  margin-bottom:10px;
}
.dir-hero h2 {
  font-size:1.8rem; font-weight:900; margin:0 0 5px;
  text-shadow:0 2px 10px rgba(0,0,0,.2);
}
.dir-hero p  { opacity:.8; margin:0; font-size:.9rem; font-weight:300; }
.hero-school { font-size:.72rem; opacity:.6; margin-top:10px; text-transform:uppercase; letter-spacing:.8px; }

/* Data/hora no hero */
.hero-datetime {
  position:absolute; top:24px; right:36px; z-index:2;
  text-align:right; color:#fff;
}
.hero-hora { font-size:1.6rem; font-weight:900; letter-spacing:2px; line-height:1; }
.hero-data { font-size:.72rem; opacity:.7; text-transform:uppercase; letter-spacing:.5px; }

/* ── STAT CARDS FLUTUANTES ── */
.stats-grid {
  padding: 0 28px;
  margin-top: -48px;
  position: relative; z-index:10;
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  gap: 14px;
}
@media(max-width:1200px){ .stats-grid { grid-template-columns: repeat(3,1fr); } }
@media(max-width:768px) { .stats-grid { grid-template-columns: repeat(2,1fr); } }
@media(max-width:480px) { .stats-grid { grid-template-columns: 1fr; padding:0 14px; } }

.stat-card {
  background:var(--card);
  border-radius:var(--radius);
  box-shadow:var(--shadow-md);
  padding:18px 16px;
  text-decoration:none; color:inherit;
  transition:transform .22s, box-shadow .22s;
  border-bottom:4px solid transparent;
  border:1px solid var(--border);
  border-bottom-width:4px;
  display:flex; flex-direction:column; align-items:center;
  text-align:center;
}
.stat-card:hover { transform:translateY(-5px); box-shadow:var(--shadow-lg); text-decoration:none; color:inherit; }
.stat-card.c1 { border-bottom-color:#1d6fce; }
.stat-card.c2 { border-bottom-color:#16a34a; }
.stat-card.c3 { border-bottom-color:#0d9488; }
.stat-card.c4 { border-bottom-color:#d97706; }
.stat-card.c5 { border-bottom-color:#7c3aed; }
.stat-card.c6 { border-bottom-color:#dc2626; }

.stat-icon {
  width:44px; height:44px; border-radius:12px;
  display:flex; align-items:center; justify-content:center;
  font-size:1.2rem; margin-bottom:10px; flex-shrink:0;
}
.stat-val { font-size:1.9rem; font-weight:900; line-height:1; margin-bottom:3px; }
.stat-lbl { font-size:.62rem; text-transform:uppercase; color:var(--muted); font-weight:700; letter-spacing:.3px; }
.stat-sub { font-size:.65rem; color:var(--muted); margin-top:2px; }

/* ── CORPO ── */
.dir-body { padding:26px 28px 40px; }
@media(max-width:640px){ .dir-body { padding:16px; } }

.section-hdr {
  font-size:.68rem; font-weight:800; text-transform:uppercase;
  color:var(--muted); letter-spacing:1.2px;
  display:flex; align-items:center; gap:8px; margin-bottom:16px;
}
.section-hdr::after { content:''; flex:1; height:1px; background:var(--border); }

/* Chart cards */
.chart-panel {
  background:var(--card); border-radius:var(--radius);
  box-shadow:var(--shadow); border:1px solid var(--border);
  padding:22px 24px; height:100%;
}
.chart-panel .cp-title {
  font-size:.75rem; font-weight:800; text-transform:uppercase;
  color:var(--muted); letter-spacing:.5px; margin-bottom:16px;
  display:flex; align-items:center; gap:6px;
}
.chart-wrap { position:relative; height:240px; }

/* KPI cards (segunda linha) */
.kpi-card {
  background:var(--card); border-radius:var(--radius);
  box-shadow:var(--shadow); border:1px solid var(--border);
  padding:20px 22px; height:100%;
}
.kpi-row { display:flex; flex-direction:column; gap:10px; }
.kpi-item {
  display:flex; align-items:center; justify-content:space-between;
  padding:10px 14px; border-radius:var(--radius-sm);
  border:1px solid var(--border); text-decoration:none;
  color:inherit; transition:.18s;
}
.kpi-item:hover { background:#f8faff; border-color:#bfdbfe; text-decoration:none; color:inherit; }
.kpi-left { display:flex; align-items:center; gap:12px; }
.kpi-icon { width:38px; height:38px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1rem; flex-shrink:0; }
.kpi-label { font-size:.82rem; font-weight:700; color:#1e293b; }
.kpi-sub   { font-size:.68rem; color:var(--muted); }
.kpi-val   { font-size:1.3rem; font-weight:900; font-family:'Nunito',sans-serif; }
.kpi-arrow { font-size:.85rem; color:var(--muted); margin-left:6px; }

/* Pendentes badge */
.pend-badge {
  background:#fef3c7; color:#92400e; border:1px solid #fde68a;
  border-radius:20px; padding:2px 10px; font-size:.7rem; font-weight:800;
}

/* Info box */
.info-box-dir {
  background: linear-gradient(135deg, #0f2d5e, #2575fc);
  border-radius:var(--radius); padding:22px 24px; color:#fff;
  position:relative; overflow:hidden;
}
.info-box-dir::after {
  content:''; position:absolute; bottom:-30px; right:-30px;
  width:120px; height:120px; background:rgba(255,255,255,.06); border-radius:50%;
}
.info-box-dir h3 { font-size:2.4rem; font-weight:900; margin:0 0 4px; }
.info-box-dir p  { opacity:.8; font-size:.82rem; margin:0; }
.info-sub { display:flex; gap:16px; margin-top:14px; flex-wrap:wrap; }
.info-sub-item { background:rgba(255,255,255,.12); border:1px solid rgba(255,255,255,.2); border-radius:8px; padding:8px 14px; }
.info-sub-item .isv { font-size:1.3rem; font-weight:900; }
.info-sub-item .isl { font-size:.65rem; opacity:.8; text-transform:uppercase; font-weight:700; }

/* Aviso card */
.aviso-dir {
  border-radius:var(--radius-sm); padding:13px 16px; margin-bottom:9px;
  display:flex; align-items:flex-start; gap:12px;
  font-size:.82rem; border:1px solid transparent;
}
.aviso-dir.warn { background:#fffbeb; border-color:#fde68a; }
.aviso-dir.info { background:#eff6ff; border-color:#bfdbfe; }
.aviso-dir a { color:var(--blue); font-weight:700; text-decoration:none; }
.aviso-dir a:hover { text-decoration:underline; }
.aviso-dir .av-icon { font-size:1.1rem; flex-shrink:0; margin-top:1px; }

/* Acesso rápido director (só consulta) */
.dir-quick { display:grid; grid-template-columns:repeat(2,1fr); gap:10px; }
.dir-qbtn {
  background:var(--card); border:1px solid var(--border); border-radius:var(--radius-sm);
  padding:14px 12px; text-align:center; text-decoration:none; color:#1e293b;
  transition:.2s; display:flex; flex-direction:column; align-items:center; gap:8px;
}
.dir-qbtn:hover { border-color:var(--blue); background:#f0f6ff; text-decoration:none; color:var(--blue); transform:translateY(-2px); box-shadow:var(--shadow); }
.dir-qbtn .dqi  { width:42px; height:42px; border-radius:10px; display:flex; align-items:center; justify-content:center; font-size:1.1rem; }
.dir-qbtn span  { font-size:.73rem; font-weight:700; }
.dir-badge-ro   { font-size:.6rem; background:#f1f5f9; color:var(--muted); border-radius:10px; padding:1px 6px; font-weight:600; margin-top:2px; }
</style>

<div class="content-wrapper" style="background:var(--bg,#eef2f8);">

    <!-- ── HERO ── -->
    <div class="dir-hero">
        <div class="hero-datetime">
            <div class="hero-hora" id="heroHora">--:--</div>
            <div class="hero-data" id="heroDia"></div>
        </div>
        <div class="hero-inner">
            <div class="hero-badge">
                <i class="bi bi-building"></i> Director
            </div>
            <h2><?= $saudacao ?>, <?= $primeiro_nome ?>! <?= $emoji ?></h2>
            <p>Painel de gestão e consulta — visão geral da escola</p>
            <div class="hero-school">
                <i class="bi bi-geo-alt me-1"></i>
                Instituto Politécnico Industrial "17 de Dezembro"
            </div>
        </div>
    </div>

    <!-- ── STAT CARDS ── -->
    <div class="stats-grid">

        <a href="<?= base_url('alunos') ?>" class="stat-card c1">
            <div class="stat-icon" style="background:#eff6ff; color:#1d6fce;">
                <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="stat-val" style="color:#1d6fce;"><?= number_format($total_de_alunos) ?></div>
            <div class="stat-lbl">Alunos</div>
            <div class="stat-sub"><i class="bi bi-arrow-right"></i> Ver lista</div>
        </a>

        <a href="<?= base_url('trabalhadores/professores') ?>" class="stat-card c2">
            <div class="stat-icon" style="background:#f0fdf4; color:#16a34a;">
                <i class="bi bi-person-video3"></i>
            </div>
            <div class="stat-val" style="color:#16a34a;"><?= number_format($total_de_professores) ?></div>
            <div class="stat-lbl">Docentes</div>
            <div class="stat-sub"><i class="bi bi-arrow-right"></i> Ver lista</div>
        </a>

        <a href="<?= base_url('trabalhadores') ?>" class="stat-card c3">
            <div class="stat-icon" style="background:#f0fdfa; color:#0d9488;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-val" style="color:#0d9488;"><?= number_format($staff_admin) ?></div>
            <div class="stat-lbl">Staff Admin.</div>
            <div class="stat-sub"><i class="bi bi-arrow-right"></i> Ver lista</div>
        </a>

        <a href="<?= base_url('turmas') ?>" class="stat-card c4">
            <div class="stat-icon" style="background:#fffbeb; color:#d97706;">
                <i class="bi bi-collection-fill"></i>
            </div>
            <div class="stat-val" style="color:#d97706;"><?= number_format($total_de_turmas) ?></div>
            <div class="stat-lbl">Turmas</div>
            <div class="stat-sub"><i class="bi bi-arrow-right"></i> Ver turmas</div>
        </a>

        <a href="<?= base_url('disciplinas') ?>" class="stat-card c5">
            <div class="stat-icon" style="background:#faf5ff; color:#7c3aed;">
                <i class="bi bi-book-fill"></i>
            </div>
            <div class="stat-val" style="color:#7c3aed;"><?= number_format($total_de_disciplinas) ?></div>
            <div class="stat-lbl">Disciplinas</div>
            <div class="stat-sub"><i class="bi bi-arrow-right"></i> Ver lista</div>
        </a>

        <a href="<?= base_url('turmas') ?>" class="stat-card c6">
            <div class="stat-icon" style="background:#fff1f2; color:#dc2626;">
                <i class="bi bi-hourglass-split"></i>
            </div>
            <div class="stat-val" style="color:<?= $matriculas_pendentes > 0 ? '#dc2626' : '#16a34a' ?>;">
                <?= number_format($matriculas_pendentes) ?>
            </div>
            <div class="stat-lbl">Matrículas Pend.</div>
            <div class="stat-sub"><?= $matriculas_pendentes > 0 ? '⚠️ Requer atenção' : '✅ Em dia' ?></div>
        </a>

    </div>

    <!-- ── CORPO ── -->
    <div class="dir-body">

        <!-- Linha 1: Gráficos + KPIs -->
        <div class="row mb-4">

            <!-- Gráfico barras -->
            <div class="col-lg-5 mb-3">
                <div class="chart-panel">
                    <div class="cp-title"><i class="bi bi-bar-chart-fill"></i> Visão Geral da Escola</div>
                    <div class="chart-wrap">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico rosca -->
            <div class="col-lg-3 mb-3">
                <div class="chart-panel">
                    <div class="cp-title"><i class="bi bi-pie-chart-fill"></i> Proporção RH</div>
                    <div class="chart-wrap">
                        <canvas id="rhChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- KPIs / Consultas rápidas -->
            <div class="col-lg-4 mb-3">
                <div class="kpi-card">
                    <div class="cp-title" style="font-size:.68rem; font-weight:800; text-transform:uppercase; color:var(--muted); letter-spacing:1px; margin-bottom:14px;">
                        <i class="bi bi-lightning-fill"></i> Consultas Rápidas
                    </div>
                    <div class="kpi-row">
                        <a href="<?= base_url('alunos') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-icon" style="background:#eff6ff; color:#1d6fce;"><i class="bi bi-mortarboard-fill"></i></div>
                                <div>
                                    <div class="kpi-label">Lista de Alunos</div>
                                    <div class="kpi-sub">Consulta completa</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="kpi-val text-primary"><?= $total_de_alunos ?></span>
                                <i class="bi bi-chevron-right kpi-arrow"></i>
                            </div>
                        </a>
                        <a href="<?= base_url('trabalhadores') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-icon" style="background:#f0fdf4; color:#16a34a;"><i class="bi bi-person-badge-fill"></i></div>
                                <div>
                                    <div class="kpi-label">Funcionários</div>
                                    <div class="kpi-sub">Docentes e staff</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="kpi-val text-success"><?= $total_trabalhadores ?></span>
                                <i class="bi bi-chevron-right kpi-arrow"></i>
                            </div>
                        </a>
                        <a href="<?= base_url('turmas') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-icon" style="background:#fffbeb; color:#d97706;"><i class="bi bi-collection-fill"></i></div>
                                <div>
                                    <div class="kpi-label">Turmas</div>
                                    <div class="kpi-sub">Todas as turmas</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="kpi-val text-warning"><?= $total_de_turmas ?></span>
                                <i class="bi bi-chevron-right kpi-arrow"></i>
                            </div>
                        </a>
                        <a href="<?= base_url('pautas') ?>" class="kpi-item">
                            <div class="kpi-left">
                                <div class="kpi-icon" style="background:#fff1f2; color:#e11d48;"><i class="bi bi-clipboard2-data-fill"></i></div>
                                <div>
                                    <div class="kpi-label">Mini Pautas</div>
                                    <div class="kpi-sub">Ver notas por turma</div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="kpi-val text-danger"><?= $total_de_turmas ?></span>
                                <i class="bi bi-chevron-right kpi-arrow"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Linha 2: RH Total + Avisos + Acesso -->
        <div class="row">

            <!-- Card RH Total -->
            <div class="col-lg-4 mb-3">
                <div class="section-hdr"><i class="bi bi-people-fill"></i> Recursos Humanos</div>
                <div class="info-box-dir">
                    <p style="opacity:.7; font-size:.75rem; margin-bottom:6px; text-transform:uppercase; letter-spacing:.5px;">Total de Colaboradores</p>
                    <h3><?= number_format($total_trabalhadores) ?></h3>
                    <p>Todos os funcionários da escola</p>
                    <div class="info-sub">
                        <div class="info-sub-item">
                            <div class="isv"><?= $total_de_professores ?></div>
                            <div class="isl">Docentes</div>
                        </div>
                        <div class="info-sub-item">
                            <div class="isv"><?= $staff_admin ?></div>
                            <div class="isl">Administrativos</div>
                        </div>
                        <div class="info-sub-item">
                            <div class="isv"><?= $total_de_alunos ?></div>
                            <div class="isl">Alunos</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Avisos -->
            <div class="col-lg-4 mb-3">
                <div class="section-hdr"><i class="bi bi-bell-fill"></i> Avisos da Escola</div>

                <?php if ($matriculas_pendentes > 0): ?>
                <div class="aviso-dir warn">
                    <i class="bi bi-exclamation-triangle-fill text-warning av-icon"></i>
                    <div>
                        <strong><?= $matriculas_pendentes ?> matrícula(s) pendente(s)</strong> aguardam confirmação do secretariado.
                    </div>
                </div>
                <?php else: ?>
                <div class="aviso-dir" style="background:#f0fdf4; border-color:#bbf7d0;">
                    <i class="bi bi-check-circle-fill text-success av-icon"></i>
                    <div><strong>Matrículas em dia.</strong> Nenhuma pendente de confirmação.</div>
                </div>
                <?php endif; ?>

                <?php if ($total_de_alunos == 0): ?>
                <div class="aviso-dir warn">
                    <i class="bi bi-person-x-fill text-warning av-icon"></i>
                    <div>Não há alunos registados no sistema.</div>
                </div>
                <?php endif; ?>

                <div class="aviso-dir info">
                    <i class="bi bi-info-circle-fill text-primary av-icon"></i>
                    <div>Para consultar notas por turma, aceda a <a href="<?= base_url('pautas') ?>"><strong>Mini Pautas</strong></a>.</div>
                </div>
                <div class="aviso-dir info">
                    <i class="bi bi-eye-fill text-primary av-icon"></i>
                    <div>O Director tem acesso de <strong>consulta</strong> a todos os módulos do sistema.</div>
                </div>
            </div>

            <!-- Acesso rápido Director -->
            <div class="col-lg-4 mb-3">
                <div class="section-hdr"><i class="bi bi-grid-fill"></i> Acesso Rápido</div>
                <div class="dir-quick">
                    <a href="<?= base_url('alunos') ?>" class="dir-qbtn">
                        <div class="dqi" style="background:#eff6ff; color:#1d6fce;"><i class="bi bi-mortarboard-fill"></i></div>
                        <span>Alunos</span>
                        <span class="dir-badge-ro">👁 Consulta</span>
                    </a>
                    <a href="<?= base_url('trabalhadores') ?>" class="dir-qbtn">
                        <div class="dqi" style="background:#f0fdf4; color:#16a34a;"><i class="bi bi-person-badge-fill"></i></div>
                        <span>Funcionários</span>
                        <span class="dir-badge-ro">👁 Consulta</span>
                    </a>
                    <a href="<?= base_url('pautas') ?>" class="dir-qbtn">
                        <div class="dqi" style="background:#fff1f2; color:#e11d48;"><i class="bi bi-clipboard2-data-fill"></i></div>
                        <span>Mini Pautas</span>
                        <span class="dir-badge-ro">👁 Consulta</span>
                    </a>
                    <a href="<?= base_url('turmas') ?>" class="dir-qbtn">
                        <div class="dqi" style="background:#fffbeb; color:#d97706;"><i class="bi bi-collection-fill"></i></div>
                        <span>Turmas</span>
                        <span class="dir-badge-ro">👁 Consulta</span>
                    </a>
                    <a href="<?= base_url('disciplinas') ?>" class="dir-qbtn">
                        <div class="dqi" style="background:#faf5ff; color:#7c3aed;"><i class="bi bi-book-fill"></i></div>
                        <span>Disciplinas</span>
                        <span class="dir-badge-ro">👁 Consulta</span>
                    </a>
                    <a href="<?= base_url('login/trocarsenha') ?>" class="dir-qbtn">
                        <div class="dqi" style="background:#f0fdfa; color:#0d9488;"><i class="bi bi-key-fill"></i></div>
                        <span>Trocar Senha</span>
                        <span class="dir-badge-ro">⚙ Pessoal</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <footer class="main-footer">
        <strong>Sistema de Gestão Escolar</strong> — Instituto Politécnico Industrial 17 de Dezembro
        <div class="float-right d-none d-sm-inline-block">
         &mdash; <?= date('Y') ?>
        </div>
    </footer>

</div><!-- /.content-wrapper -->

<script>
(function(){
    // Relógio
    const days = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
    function tick(){
        const n  = new Date();
        const hh = String(n.getHours()).padStart(2,'0');
        const mm = String(n.getMinutes()).padStart(2,'0');
        const r  = document.getElementById('heroHora');
        const d  = document.getElementById('heroDia');
        if(r) r.textContent = hh + ':' + mm;
        if(d) d.textContent = days[n.getDay()] + ', ' + n.getDate() + '/' + String(n.getMonth()+1).padStart(2,'0');
    }
    tick(); setInterval(tick, 1000);

    Chart.defaults.font.family = "'Nunito', sans-serif";
    Chart.defaults.color = '#64748b';

    const dados = {
        alunos:     <?= (int)$total_de_alunos ?>,
        docentes:   <?= (int)$total_de_professores ?>,
        staff:      <?= (int)$staff_admin ?>,
        turmas:     <?= (int)$total_de_turmas ?>,
        disciplinas:<?= (int)$total_de_disciplinas ?>
    };

    // Gráfico de barras
    const ctxBar = document.getElementById('barChart');
    if(ctxBar){
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Alunos','Docentes','Staff','Turmas','Disciplinas'],
                datasets:[{
                    label:'Total',
                    data:[dados.alunos, dados.docentes, dados.staff, dados.turmas, dados.disciplinas],
                    backgroundColor:['#1d6fce22','#16a34a22','#0d948822','#d9770622','#7c3aed22'],
                    borderColor:    ['#1d6fce',  '#16a34a',  '#0d9488',  '#d97706',  '#7c3aed'],
                    borderWidth:2, borderRadius:8, borderSkipped:false,
                }]
            },
            options:{
                responsive:true, maintainAspectRatio:false,
                plugins:{ legend:{ display:false } },
                scales:{
                    x:{ grid:{ display:false }, ticks:{ font:{ weight:'700', size:11 } } },
                    y:{ beginAtZero:true, grid:{ color:'#f1f5f9' }, ticks:{ precision:0 } }
                }
            }
        });
    }

    // Gráfico rosca RH
    const ctxRH = document.getElementById('rhChart');
    if(ctxRH){
        new Chart(ctxRH, {
            type: 'doughnut',
            data:{
                labels:['Docentes','Staff Admin.'],
                datasets:[{
                    data:[dados.docentes, dados.staff],
                    backgroundColor:['#1d6fce','#0d9488'],
                    borderWidth:0, hoverOffset:8
                }]
            },
            options:{
                responsive:true, maintainAspectRatio:false,
                cutout:'68%',
                plugins:{
                    legend:{ position:'bottom', labels:{ padding:16, font:{ weight:'700', size:11 } } }
                }
            }
        });
    }
})();
</script>