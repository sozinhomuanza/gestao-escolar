<!-- app/Views/inicio/professor.php -->
<?php
$primeiro_nome   = esc(session()->get('primeiro_nome') ?? 'Professor');
$trimestre_atual = $trimestre_atual ?? 1;
$nomes_trim      = ['', 'Iº Trimestre', 'IIº Trimestre', 'IIIº Trimestre'];
$cores_trim      = ['', '#1d6fce', '#16a34a', '#7c3aed'];
$hora            = (int)date('H');
$saudacao        = $hora < 12 ? 'Bom dia' : ($hora < 18 ? 'Boa tarde' : 'Boa noite');
$emoji           = $hora < 12 ? '🌅' : ($hora < 18 ? '☀️' : '🌙');
$total_sem_nota  = array_sum(array_column($alertas ?? [], 'sem'));
?>

<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
/* ═══════════════════════════════════════════════════════ */
:root {
  --blue      : #1d6fce;
  --blue-dark : #0f2d5e;
  --green     : #16a34a;
  --amber     : #d97706;
  --purple    : #7c3aed;
  --red       : #dc2626;
  --bg        : #eef2f8;
  --card      : #ffffff;
  --muted     : #64748b;
  --border    : #e8edf5;
  --radius    : 16px;
  --radius-sm : 10px;
  --shadow    : 0 1px 8px rgba(15,45,94,.08);
  --shadow-md : 0 4px 20px rgba(15,45,94,.12);
  --shadow-lg : 0 8px 32px rgba(15,45,94,.16);
}

.content-wrapper { background: var(--bg) !important; }

/* ─── HERO ──────────────────────────────────────────────── */
.prof-hero {
  background: linear-gradient(135deg, #0f2d5e 0%, #1a4a8a 45%, #2575fc 100%);
  padding: 28px 32px 70px;
  color: #fff;
  position: relative;
  overflow: hidden;
}
.prof-hero::before {
  content: '';
  position: absolute; top: -80px; right: -80px;
  width: 320px; height: 320px;
  background: rgba(255,255,255,.04);
  border-radius: 50%;
}
.prof-hero::after {
  content: '';
  position: absolute; bottom: -100px; left: 20%;
  width: 500px; height: 200px;
  background: rgba(255,255,255,.03);
  border-radius: 50%;
}
.hero-inner { position: relative; z-index: 2; }
.hero-badge {
  display: inline-flex; align-items: center; gap: 6px;
  background: rgba(255,255,255,.15);
  border: 1px solid rgba(255,255,255,.25);
  border-radius: 30px; padding: 4px 14px;
  font-size: .72rem; font-weight: 700;
  text-transform: uppercase; letter-spacing: .6px;
  margin-bottom: 10px;
}
.prof-hero h2 {
  font-size: 1.75rem; font-weight: 900;
  margin: 0 0 4px; font-family: 'Nunito', sans-serif;
  text-shadow: 0 2px 8px rgba(0,0,0,.15);
}
.prof-hero p { opacity: .8; margin: 0; font-size: .9rem; font-weight: 300; }

/* Trim pills no hero */
.trim-pills { display: flex; gap: 8px; margin-top: 14px; flex-wrap: wrap; }
.trim-pill {
  padding: 5px 14px; border-radius: 20px; font-size: .75rem; font-weight: 700;
  text-decoration: none; transition: .2s;
  border: 1.5px solid rgba(255,255,255,.3);
  color: rgba(255,255,255,.75);
}
.trim-pill:hover { text-decoration: none; color: #fff; background: rgba(255,255,255,.15); }
.trim-pill.active { background: #fff; color: var(--blue-dark); border-color: transparent; box-shadow: 0 2px 10px rgba(0,0,0,.15); }

/* ─── CARDS FLUTUANTES ──────────────────────────────────── */
.cards-wrap {
  padding: 0 28px;
  margin-top: -44px;
  position: relative; z-index: 10;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}
@media(max-width: 640px) { .cards-wrap { padding: 0 14px; grid-template-columns: 1fr; } }

.turma-card {
  background: var(--card);
  border-radius: var(--radius);
  box-shadow: var(--shadow-md);
  overflow: hidden;
  transition: transform .25s, box-shadow .25s;
  border: 1px solid var(--border);
}
.turma-card:hover {
  transform: translateY(-6px);
  box-shadow: var(--shadow-lg);
}

/* Header do card */
.tc-header {
  padding: 18px 20px 14px;
  background: linear-gradient(135deg, #0f2d5e, #1d6fce);
  color: #fff;
  position: relative;
}
.tc-header::after {
  content: '';
  position: absolute; bottom: -1px; left: 0; right: 0;
  height: 20px;
  background: var(--card);
  border-radius: 18px 18px 0 0;
}
.tc-turma  { font-size: 1.1rem; font-weight: 900; font-family: 'Nunito', sans-serif; margin: 0 0 2px; }
.tc-disc   { font-size: .8rem; opacity: .85; }
.tc-periodo {
  position: absolute; top: 14px; right: 16px;
  background: rgba(255,255,255,.2);
  border: 1px solid rgba(255,255,255,.3);
  border-radius: 20px; padding: 2px 10px;
  font-size: .7rem; font-weight: 700;
}

.tc-body { padding: 16px 20px 20px; }

/* Mini stats redesenhados */
.tc-stats {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 10px; margin-bottom: 14px;
}
.tc-stat {
  background: #f8faff;
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  padding: 10px 8px;
  text-align: center;
  transition: .2s;
}
.tc-stat:hover { background: #eef4ff; }
.tc-stat .v { font-size: 1.35rem; font-weight: 900; line-height: 1; font-family: 'Nunito', sans-serif; }
.tc-stat .l { font-size: .6rem; text-transform: uppercase; color: var(--muted); font-weight: 700; margin-top: 3px; letter-spacing: .3px; }

/* Barra progresso redesenhada */
.prog-wrap { margin: 0 0 10px; }
.prog-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px; }
.prog-label  { font-size: .72rem; color: var(--muted); font-weight: 600; }
.prog-pct    { font-size: .72rem; font-weight: 800; color: var(--blue); }
.prog-bar    { height: 7px; background: #e8edf5; border-radius: 4px; overflow: hidden; }
.prog-fill   { height: 100%; border-radius: 4px; transition: width .7s cubic-bezier(.4,0,.2,1); }
.prog-status { margin-top: 5px; font-size: .72rem; display: flex; align-items: center; gap: 4px; }

/* Botões trimestre */
.tc-trims { display: grid; grid-template-columns: repeat(3,1fr); gap: 7px; margin: 14px 0 12px; }
.tc-trim-btn {
  border-radius: var(--radius-sm); padding: 8px 4px;
  font-size: .73rem; font-weight: 700; text-align: center;
  text-decoration: none; transition: all .2s; border: 2px solid transparent;
  display: flex; align-items: center; justify-content: center; gap: 4px;
}
.tc-trim-btn:hover { text-decoration: none; transform: translateY(-2px); }
.tc-trim-btn.t1        { background: #eff6ff; color: #1d6fce; border-color: #bfdbfe; }
.tc-trim-btn.t2        { background: #f0fdf4; color: #16a34a; border-color: #bbf7d0; }
.tc-trim-btn.t3        { background: #faf5ff; color: #7c3aed; border-color: #e9d5ff; }
.tc-trim-btn.t1.active { background: #1d6fce; color: #fff; border-color: #1d6fce; box-shadow: 0 3px 10px rgba(29,111,206,.35); }
.tc-trim-btn.t2.active { background: #16a34a; color: #fff; border-color: #16a34a; box-shadow: 0 3px 10px rgba(22,163,74,.35); }
.tc-trim-btn.t3.active { background: #7c3aed; color: #fff; border-color: #7c3aed; box-shadow: 0 3px 10px rgba(124,58,237,.35); }

/* Botão principal */
.btn-lancar {
  display: flex; align-items: center; justify-content: center; gap: 8px;
  padding: 11px 16px;
  background: linear-gradient(135deg, #0f2d5e, #2575fc);
  color: #fff !important; border-radius: var(--radius-sm);
  font-weight: 800; text-decoration: none; font-size: .85rem;
  font-family: 'Nunito', sans-serif;
  transition: all .25s;
  box-shadow: 0 4px 14px rgba(37,117,252,.3);
}
.btn-lancar:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(37,117,252,.45);
  text-decoration: none; color: #fff;
}
.btn-lancar .arrow { transition: transform .2s; }
.btn-lancar:hover .arrow { transform: translateX(4px); }

/* Links secundários */
.tc-links {
  display: flex; justify-content: center; gap: 16px;
  margin-top: 10px;
}
.tc-link {
  font-size: .73rem; color: var(--muted); text-decoration: none;
  display: flex; align-items: center; gap: 4px;
  padding: 4px 8px; border-radius: 6px; transition: .15s;
}
.tc-link:hover { background: #f0f4f8; color: var(--blue); text-decoration: none; }

/* ─── CORPO ──────────────────────────────────────────────── */
.prof-body { padding: 24px 28px 40px; }
@media(max-width:640px){ .prof-body { padding: 16px; } }

.section-hdr {
  font-size: .68rem; font-weight: 800; text-transform: uppercase;
  color: var(--muted); letter-spacing: 1.2px;
  display: flex; align-items: center; gap: 8px; margin-bottom: 14px;
}
.section-hdr::after { content: ''; flex: 1; height: 1px; background: var(--border); }

/* Cards de aviso */
.aviso-card {
  border-radius: var(--radius-sm);
  padding: 13px 16px; margin-bottom: 9px;
  display: flex; align-items: flex-start; gap: 12px;
  font-size: .82rem; border: 1px solid transparent;
}
.aviso-card.warn { background: #fffbeb; border-color: #fde68a; }
.aviso-card.ok   { background: #f0fdf4; border-color: #bbf7d0; }
.aviso-card .av-icon { font-size: 1.1rem; flex-shrink: 0; margin-top: 1px; }
.aviso-card strong { font-weight: 800; }
.aviso-card a { color: var(--blue); font-weight: 700; text-decoration: none; }
.aviso-card a:hover { text-decoration: underline; }

/* Info box lateral */
.info-panel {
  background: var(--card); border-radius: var(--radius);
  box-shadow: var(--shadow); border: 1px solid var(--border);
  overflow: hidden;
}
.info-panel-header {
  background: linear-gradient(135deg, #0f2d5e, #1d6fce);
  padding: 16px 20px; color: #fff;
}
.info-panel-header .hora {
  font-size: 2.2rem; font-weight: 900;
  font-family: 'Nunito', sans-serif; letter-spacing: 1px;
}
.info-panel-header .dia {
  font-size: .72rem; opacity: .8; text-transform: uppercase; font-weight: 700;
}
.info-panel-body { padding: 16px 20px; }
.info-stat {
  text-align: center; padding: 12px;
  border-radius: var(--radius-sm); border: 1px solid var(--border);
}
.info-stat .v { font-size: 1.8rem; font-weight: 900; font-family: 'Nunito', sans-serif; }
.info-stat .l { font-size: .65rem; text-transform: uppercase; color: var(--muted); font-weight: 700; }

/* Sem turmas */
.sem-turmas-card {
  background: var(--card); border-radius: var(--radius);
  box-shadow: var(--shadow); border: 1px solid var(--border);
  padding: 60px 20px; text-align: center; color: var(--muted);
  grid-column: 1 / -1;
}
.sem-turmas-card i { font-size: 3rem; opacity: .2; display: block; margin-bottom: 16px; }
</style>

<div class="content-wrapper" style="background:var(--bg,#eef2f8);">

    <!-- ── HERO ── -->
    <div class="prof-hero">
        <div class="hero-inner">
            <div class="hero-badge">
                <i class="bi bi-person-video3"></i> Professor
            </div>
            <h2><?= $saudacao ?>, <?= $primeiro_nome ?>! <?= $emoji ?></h2>
            <p>Painel das suas turmas — <?= $nomes_trim[$trimestre_atual] ?></p>

            <!-- Pills de trimestre no hero -->
            <div class="trim-pills">
                <?php for ($tr = 1; $tr <= 3; $tr++): ?>
                <a href="<?= base_url('inicio') ?>?trimestre=<?= $tr ?>"
                   class="trim-pill <?= $tr == $trimestre_atual ? 'active' : '' ?>">
                    <i class="bi bi-calendar-week mr-1"></i><?= $nomes_trim[$tr] ?>
                </a>
                <?php endfor; ?>
            </div>
        </div>
    </div>

    <!-- ── CARDS DE TURMAS ── -->
    <div class="cards-wrap">
        <?php if (empty($turmas)): ?>
        <div class="sem-turmas-card">
            <i class="bi bi-journal-x"></i>
            <p class="font-weight-bold mb-1">Não tem turmas atribuídas</p>
            <small>Contacte o secretariado para atribuição de turmas.</small>
        </div>
        <?php else: ?>
        <?php foreach ($turmas as $t): ?>
        <?php
            $s         = $t['stats'] ?? ['total_alunos'=>0,'positivas'=>0,'negativas'=>0,'nao_avaliados'=>0];
            $avaliados = $s['total_alunos'] - $s['nao_avaliados'];
            $pct       = $s['total_alunos'] > 0 ? round(($avaliados / $s['total_alunos']) * 100) : 0;
            $cor_prog  = $pct >= 80 ? '#16a34a' : ($pct >= 40 ? '#d97706' : '#dc2626');
        ?>
        <div class="turma-card">
            <div class="tc-header">
                <div class="tc-periodo"><?= esc($t['periodo'] ?? 'Manhã') ?></div>
                <p class="tc-turma"><?= esc($t['nome_turma']) ?></p>
                <p class="tc-disc mb-0"><?= esc($t['nome_disciplina'] ?? 'Sem disciplina') ?></p>
            </div>

            <div class="tc-body">
                <!-- Estatísticas -->
                <div class="tc-stats">
                    <div class="tc-stat">
                        <div class="v text-primary"><?= $s['total_alunos'] ?></div>
                        <div class="l">Alunos</div>
                    </div>
                    <div class="tc-stat">
                        <div class="v text-success"><?= $s['positivas'] ?></div>
                        <div class="l">Positivas</div>
                    </div>
                    <div class="tc-stat">
                        <div class="v text-danger"><?= $s['negativas'] ?></div>
                        <div class="l">Negativas</div>
                    </div>
                </div>

                <!-- Progresso -->
                <div class="prog-wrap">
                    <div class="prog-header">
                        <span class="prog-label">Notas lançadas</span>
                        <span class="prog-pct" style="color:<?= $cor_prog ?>;"><?= $pct ?>%</span>
                    </div>
                    <div class="prog-bar">
                        <div class="prog-fill" style="width:<?= $pct ?>%; background:<?= $cor_prog ?>;"></div>
                    </div>
                    <div class="prog-status">
                        <?php if ($s['nao_avaliados'] > 0): ?>
                        <i class="bi bi-exclamation-triangle-fill text-warning"></i>
                        <span class="text-warning font-weight-bold"><?= $s['nao_avaliados'] ?> aluno(s) sem nota</span>
                        <?php else: ?>
                        <i class="bi bi-check-circle-fill text-success"></i>
                        <span class="text-success font-weight-bold">Todos os alunos avaliados!</span>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Botões de trimestre -->
                <div class="tc-trims">
                    <?php for ($tr = 1; $tr <= 3; $tr++): ?>
                    <a href="<?= base_url("pautas/lancar/{$t['id_turma']}?trimestre={$tr}") ?>"
                       class="tc-trim-btn t<?= $tr ?> <?= $tr == $trimestre_atual ? 'active' : '' ?>">
                        <i class="bi bi-pencil-fill"></i><?= $tr ?>º Trim.
                    </a>
                    <?php endfor; ?>
                </div>

                <!-- Botão principal -->
                <a href="<?= base_url("pautas/lancar/{$t['id_turma']}?trimestre={$trimestre_atual}") ?>"
                   class="btn-lancar">
                    <i class="bi bi-clipboard2-data-fill"></i>
                    Lançar Notas — <?= $nomes_trim[$trimestre_atual] ?>
                    <i class="bi bi-arrow-right arrow"></i>
                </a>

                <!-- Links secundários -->
                <div class="tc-links">
                    <a href="<?= base_url("pautas/ver/{$t['id_turma']}") ?>" class="tc-link">
                        <i class="bi bi-eye"></i> Ver pauta
                    </a>
                    <a href="<?= base_url("pautas/imprimir/{$t['id_turma']}") ?>" target="_blank" class="tc-link">
                        <i class="bi bi-printer"></i> Imprimir
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- ── CORPO ── -->
    <div class="prof-body">
        <div class="row">

            <!-- Avisos -->
            <div class="col-lg-8 mb-4">
                <div class="section-hdr"><i class="bi bi-bell-fill"></i> Avisos</div>
                <?php if (!empty($alertas)): ?>
                    <?php foreach ($alertas as $al): ?>
                    <div class="aviso-card warn">
                        <i class="bi bi-exclamation-triangle-fill text-warning av-icon"></i>
                        <div>
                            <strong><?= esc($al['turma']) ?></strong> —
                            <?= $al['sem'] ?> de <?= $al['total'] ?> aluno(s) ainda sem nota no <?= $nomes_trim[$trimestre_atual] ?>.
                            <br><a href="<?= $al['url'] ?>"><i class="bi bi-arrow-right-circle mr-1"></i>Lançar notas agora</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="aviso-card ok">
                        <i class="bi bi-check-circle-fill text-success av-icon"></i>
                        <div>
                            <strong>Tudo em dia!</strong> Todas as notas do <?= $nomes_trim[$trimestre_atual] ?> estão lançadas. Excelente trabalho! 🎉
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Painel lateral -->
            <div class="col-lg-4 mb-4">
                <div class="section-hdr"><i class="bi bi-info-circle-fill"></i> Resumo</div>
                <div class="info-panel">
                    <div class="info-panel-header">
                        <div class="hora" id="relogio">--:--:--</div>
                        <div class="dia" id="diaSemana">carregando...</div>
                        <small style="opacity:.65; font-size:.7rem;"><?= date('d/m/Y') ?></small>
                    </div>
                    <div class="info-panel-body">
                        <div class="row g-2">
                            <div class="col-6">
                                <div class="info-stat">
                                    <div class="v text-primary"><?= count($turmas) ?></div>
                                    <div class="l">Turma(s)</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-stat">
                                    <div class="v <?= $total_sem_nota > 0 ? 'text-warning' : 'text-success' ?>">
                                        <?= $total_sem_nota ?>
                                    </div>
                                    <div class="l">Sem Nota</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 pt-2" style="border-top:1px solid var(--border);">
                            <a href="<?= base_url('pautas') ?>"
                               class="btn btn-primary btn-block btn-sm font-weight-bold mb-2">
                                <i class="bi bi-list-check mr-1"></i>Ver Todas as Turmas
                            </a>
                            <a href="<?= base_url('login/trocarsenha') ?>"
                               class="btn btn-outline-secondary btn-block btn-sm">
                                <i class="bi bi-key mr-1"></i>Trocar Senha
                            </a>
                        </div>
                    </div>
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
    const days = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
    function tick(){
        const n  = new Date();
        const r  = document.getElementById('relogio');
        const d  = document.getElementById('diaSemana');
        if(r) r.textContent = [n.getHours(),n.getMinutes(),n.getSeconds()]
            .map(v=>String(v).padStart(2,'0')).join(':');
        if(d) d.textContent = days[n.getDay()];
    }
    tick(); setInterval(tick, 1000);

    // Animar barras de progresso ao carregar
    document.querySelectorAll('.prog-fill').forEach(function(bar){
        const w = bar.style.width;
        bar.style.width = '0';
        setTimeout(function(){ bar.style.width = w; }, 200);
    });
})();
</script>