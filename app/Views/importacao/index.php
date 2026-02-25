<!-- app/Views/importacao/index.php -->

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
  /* ══════════════════════════════════════════
     VARIÁVEIS & RESET
  ══════════════════════════════════════════ */
  :root {
    --primary:       #2563EB;
    --primary-light: #EFF6FF;
    --primary-glow:  rgba(37,99,235,0.15);
    --success:       #059669;
    --success-light: #ECFDF5;
    --success-glow:  rgba(5,150,105,0.15);
    --danger:        #DC2626;
    --warning:       #D97706;
    --surface:       #FFFFFF;
    --surface-2:     #F8FAFC;
    --border:        #E2E8F0;
    --border-focus:  #93C5FD;
    --text-primary:  #0F172A;
    --text-secondary:#64748B;
    --text-muted:    #94A3B8;
    --radius-lg:     16px;
    --radius-md:     10px;
    --radius-sm:     6px;
    --shadow-sm:     0 1px 3px rgba(15,23,42,.06), 0 1px 2px rgba(15,23,42,.04);
    --shadow-md:     0 4px 16px rgba(15,23,42,.08), 0 2px 6px rgba(15,23,42,.04);
    --shadow-lg:     0 16px 48px rgba(15,23,42,.12), 0 4px 16px rgba(15,23,42,.06);
    --transition:    all .25s cubic-bezier(.4,0,.2,1);
    --font-display:  'Syne', sans-serif;
    --font-body:     'DM Sans', sans-serif;
  }

  .imp-page * { box-sizing: border-box; }

  /* ══════════════════════════════════════════
     WRAPPER
  ══════════════════════════════════════════ */
  .imp-page {
    font-family: var(--font-body);
    color: var(--text-primary);
    background: var(--surface-2);
    min-height: 100vh;
    padding-bottom: 60px;
  }

  /* ══════════════════════════════════════════
     HERO HEADER
  ══════════════════════════════════════════ */
  .imp-hero {
    background: linear-gradient(135deg, #0F172A 0%, #1E3A5F 50%, #1E40AF 100%);
    padding: 48px 0 80px;
    position: relative;
    overflow: hidden;
  }

  .imp-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 60% 80% at 80% 50%, rgba(37,99,235,.25) 0%, transparent 70%),
      radial-gradient(ellipse 40% 60% at 10% 80%, rgba(5,150,105,.15) 0%, transparent 60%);
  }

  .imp-hero::after {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: rgba(37,99,235,.08);
    border: 1px solid rgba(255,255,255,.06);
  }

  /* Grid decorativo */
  .imp-hero-grid {
    position: absolute;
    inset: 0;
    background-image:
      linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
    background-size: 40px 40px;
  }

  .imp-hero-inner {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  /* Breadcrumb */
  .imp-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 28px;
    font-size: 13px;
    font-weight: 500;
    color: rgba(255,255,255,.5);
  }
  .imp-breadcrumb a {
    color: rgba(255,255,255,.6);
    text-decoration: none;
    transition: var(--transition);
  }
  .imp-breadcrumb a:hover { color: #fff; }
  .imp-breadcrumb-sep { color: rgba(255,255,255,.3); font-size: 11px; }
  .imp-breadcrumb-current { color: rgba(255,255,255,.9); }

  /* Título */
  .imp-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(37,99,235,.3);
    border: 1px solid rgba(37,99,235,.5);
    color: #93C5FD;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .1em;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 100px;
    margin-bottom: 20px;
  }

  .imp-hero-title {
    font-family: var(--font-display);
    font-size: clamp(28px, 4vw, 44px);
    font-weight: 800;
    color: #fff;
    line-height: 1.1;
    margin: 0 0 14px;
    letter-spacing: -.02em;
  }

  .imp-hero-title span {
    background: linear-gradient(90deg, #60A5FA, #34D399);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .imp-hero-sub {
    color: rgba(255,255,255,.55);
    font-size: 15px;
    font-weight: 400;
    max-width: 500px;
    line-height: 1.6;
    margin: 0;
  }

  /* Stats */
  .imp-hero-stats {
    display: flex;
    gap: 24px;
    margin-top: 36px;
    flex-wrap: wrap;
  }
  .imp-stat {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: var(--radius-md);
    padding: 10px 16px;
    backdrop-filter: blur(8px);
  }
  .imp-stat-icon {
    width: 32px; height: 32px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
  }
  .imp-stat-icon.blue  { background: rgba(37,99,235,.3); color: #93C5FD; }
  .imp-stat-icon.green { background: rgba(5,150,105,.3); color: #6EE7B7; }
  .imp-stat-icon.orange{ background: rgba(217,119,6,.3); color: #FCD34D; }
  .imp-stat-label { font-size: 12px; color: rgba(255,255,255,.45); font-weight: 500; }
  .imp-stat-val   { font-size: 13px; color: rgba(255,255,255,.85); font-weight: 600; }

  /* ══════════════════════════════════════════
     CONTEÚDO PRINCIPAL
  ══════════════════════════════════════════ */
  .imp-body {
    max-width: 1200px;
    margin: -40px auto 0;
    padding: 0 24px;
    position: relative;
    z-index: 10;
  }

  /* ══════════════════════════════════════════
     BANNER DE INSTRUÇÕES
  ══════════════════════════════════════════ */
  .imp-guide {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 24px 28px;
    margin-bottom: 28px;
    box-shadow: var(--shadow-sm);
    display: flex;
    gap: 20px;
    align-items: flex-start;
  }
  .imp-guide-icon {
    flex-shrink: 0;
    width: 44px; height: 44px;
    background: #EFF6FF;
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    color: var(--primary);
    font-size: 18px;
  }
  .imp-guide-content h6 {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 15px;
    color: var(--text-primary);
    margin: 0 0 10px;
  }
  .imp-guide-steps {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }
  .imp-guide-step {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: var(--text-secondary);
  }
  .imp-guide-step-num {
    width: 22px; height: 22px;
    border-radius: 50%;
    background: var(--primary);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .imp-guide-step-arrow {
    color: var(--border);
    font-size: 12px;
  }

  /* ══════════════════════════════════════════
     CARDS DE IMPORTAÇÃO
  ══════════════════════════════════════════ */
  .imp-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
    gap: 24px;
  }

  @media (max-width: 1020px) {
    .imp-grid { grid-template-columns: 1fr; }
  }

  .imp-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: var(--transition);
  }
  .imp-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
  }

  /* Topo colorido */
  .imp-card-header {
    padding: 20px 24px 0;
    display: flex;
    align-items: center;
    gap: 14px;
    position: relative;
  }
  .imp-card-header::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 0;
  }
  .imp-card.is-primary .imp-card-header::before { background: linear-gradient(90deg, #2563EB, #60A5FA); }
  .imp-card.is-success .imp-card-header::before { background: linear-gradient(90deg, #059669, #34D399); }

  .imp-card-icon {
    width: 48px; height: 48px;
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }
  .imp-card.is-primary .imp-card-icon { background: var(--primary-light); color: var(--primary); }
  .imp-card.is-success .imp-card-icon { background: var(--success-light); color: var(--success); }

  .imp-card-title {
    font-family: var(--font-display);
    font-weight: 700;
    font-size: 17px;
    color: var(--text-primary);
    margin: 0 0 2px;
  }
  .imp-card-subtitle {
    font-size: 12px;
    color: var(--text-muted);
    margin: 0;
  }

  .imp-card-body {
    padding: 20px 24px 24px;
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  /* Botão de template download */
  .imp-template-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    padding: 9px 18px;
    border-radius: var(--radius-sm);
    text-decoration: none;
    transition: var(--transition);
    border: 1.5px solid;
    width: fit-content;
  }
  .imp-card.is-primary .imp-template-btn {
    color: var(--primary);
    border-color: rgba(37,99,235,.35);
    background: var(--primary-light);
  }
  .imp-card.is-primary .imp-template-btn:hover {
    background: var(--primary);
    color: #fff;
    border-color: var(--primary);
    box-shadow: 0 4px 16px var(--primary-glow);
  }
  .imp-card.is-success .imp-template-btn {
    color: var(--success);
    border-color: rgba(5,150,105,.35);
    background: var(--success-light);
  }
  .imp-card.is-success .imp-template-btn:hover {
    background: var(--success);
    color: #fff;
    border-color: var(--success);
    box-shadow: 0 4px 16px var(--success-glow);
  }

  /* Tabela de colunas */
  .imp-cols-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .08em;
    color: var(--text-muted);
    margin-bottom: 10px;
  }
  .imp-cols {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
  }
  .imp-col-pill {
    display: flex;
    align-items: center;
    gap: 5px;
    background: var(--surface-2);
    border: 1px solid var(--border);
    border-radius: 100px;
    padding: 4px 10px;
    font-size: 11.5px;
    color: var(--text-secondary);
    font-weight: 500;
  }
  .imp-col-pill .col-letter {
    font-weight: 700;
    font-size: 10px;
    width: 16px; height: 16px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
  }
  .imp-card.is-primary .col-letter { background: var(--primary-light); color: var(--primary); }
  .imp-card.is-success .col-letter { background: var(--success-light); color: var(--success); }
  .imp-col-pill .col-req {
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .05em;
  }
  .imp-col-pill.required { border-color: rgba(220,38,38,.25); background: #FEF2F2; }
  .imp-col-pill.required .col-req { color: var(--danger); }

  /* ══════════════════════════════════════════
     DROP ZONE
  ══════════════════════════════════════════ */
  .imp-dropzone {
    border: 2px dashed var(--border);
    border-radius: var(--radius-md);
    padding: 28px 20px;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    background: var(--surface-2);
  }
  .imp-dropzone input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
    z-index: 2;
  }
  .imp-card.is-primary .imp-dropzone:hover,
  .imp-card.is-primary .imp-dropzone.drag-over {
    border-color: var(--primary);
    background: var(--primary-light);
  }
  .imp-card.is-success .imp-dropzone:hover,
  .imp-card.is-success .imp-dropzone.drag-over {
    border-color: var(--success);
    background: var(--success-light);
  }
  .imp-dropzone.has-file {
    border-style: solid;
  }
  .imp-card.is-primary .imp-dropzone.has-file { border-color: var(--primary); background: var(--primary-light); }
  .imp-card.is-success .imp-dropzone.has-file { border-color: var(--success); background: var(--success-light); }

  .imp-dz-icon {
    width: 52px; height: 52px;
    margin: 0 auto 12px;
    border-radius: var(--radius-md);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px;
    transition: var(--transition);
  }
  .imp-card.is-primary .imp-dz-icon { background: var(--primary-light); color: var(--primary); }
  .imp-card.is-success .imp-dz-icon { background: var(--success-light); color: var(--success); }

  .imp-dz-title {
    font-weight: 600;
    font-size: 14px;
    color: var(--text-primary);
    margin-bottom: 4px;
  }
  .imp-dz-sub {
    font-size: 12px;
    color: var(--text-muted);
  }
  .imp-dz-sub strong { font-weight: 600; }

  .imp-dz-file-preview {
    display: none;
    align-items: center;
    gap: 10px;
    justify-content: center;
  }
  .imp-dz-file-preview.visible { display: flex; }
  .imp-dz-file-icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
  }
  .imp-card.is-primary .imp-dz-file-icon { background: var(--primary); color: #fff; }
  .imp-card.is-success .imp-dz-file-icon { background: var(--success); color: #fff; }
  .imp-dz-file-name {
    font-weight: 600;
    font-size: 14px;
    color: var(--text-primary);
  }
  .imp-dz-file-size {
    font-size: 12px;
    color: var(--text-secondary);
  }
  .imp-dz-file-remove {
    background: #FEF2F2;
    border: none;
    width: 28px; height: 28px;
    border-radius: 50%;
    color: var(--danger);
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px;
    z-index: 5;
    position: relative;
    transition: var(--transition);
    flex-shrink: 0;
  }
  .imp-dz-file-remove:hover { background: var(--danger); color: #fff; }

  /* ══════════════════════════════════════════
     BOTÃO SUBMIT
  ══════════════════════════════════════════ */
  .imp-submit-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 13px 20px;
    border: none;
    border-radius: var(--radius-md);
    font-family: var(--font-body);
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
  }
  .imp-card.is-primary .imp-submit-btn {
    background: linear-gradient(135deg, #2563EB, #1D4ED8);
    color: #fff;
    box-shadow: 0 4px 14px rgba(37,99,235,.35);
  }
  .imp-card.is-primary .imp-submit-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #1D4ED8, #1E40AF);
    box-shadow: 0 6px 20px rgba(37,99,235,.45);
    transform: translateY(-1px);
  }
  .imp-card.is-success .imp-submit-btn {
    background: linear-gradient(135deg, #059669, #047857);
    color: #fff;
    box-shadow: 0 4px 14px rgba(5,150,105,.35);
  }
  .imp-card.is-success .imp-submit-btn:hover:not(:disabled) {
    background: linear-gradient(135deg, #047857, #065F46);
    box-shadow: 0 6px 20px rgba(5,150,105,.45);
    transform: translateY(-1px);
  }
  .imp-submit-btn:disabled {
    opacity: .7;
    cursor: not-allowed;
    transform: none !important;
  }

  /* Progress bar dentro do botão */
  .imp-btn-progress {
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 0%;
    background: rgba(255,255,255,.15);
    transition: width .3s ease;
    pointer-events: none;
  }

  /* ══════════════════════════════════════════
     ALERTAS FLASH
  ══════════════════════════════════════════ */
  .imp-alert {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    padding: 16px 20px;
    border-radius: var(--radius-md);
    margin-bottom: 24px;
    font-size: 14px;
    animation: slideInDown .35s ease;
  }
  .imp-alert-success {
    background: var(--success-light);
    border: 1px solid rgba(5,150,105,.3);
    color: #065F46;
  }
  .imp-alert-error {
    background: #FEF2F2;
    border: 1px solid rgba(220,38,38,.3);
    color: #991B1B;
  }
  .imp-alert-icon {
    width: 32px; height: 32px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
  }
  .imp-alert-success .imp-alert-icon { background: #D1FAE5; color: var(--success); }
  .imp-alert-error   .imp-alert-icon { background: #FEE2E2; color: var(--danger); }
  .imp-alert-close {
    margin-left: auto;
    background: none;
    border: none;
    cursor: pointer;
    opacity: .5;
    font-size: 16px;
    padding: 0;
    line-height: 1;
    transition: var(--transition);
    color: inherit;
    flex-shrink: 0;
  }
  .imp-alert-close:hover { opacity: 1; }

  /* ══════════════════════════════════════════
     ANIMAÇÕES
  ══════════════════════════════════════════ */
  @keyframes slideInDown {
    from { opacity: 0; transform: translateY(-12px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }

  .imp-spinner {
    display: inline-block;
    width: 16px; height: 16px;
    border: 2px solid rgba(255,255,255,.4);
    border-top-color: #fff;
    border-radius: 50%;
    animation: spin .7s linear infinite;
  }

  /* Entrada dos cards */
  .imp-card { animation: fadeInUp .4s ease both; }
  .imp-card:nth-child(2) { animation-delay: .1s; }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* ══════════════════════════════════════════
     RESPONSIVO
  ══════════════════════════════════════════ */
  @media (max-width: 600px) {
    .imp-hero { padding: 36px 0 72px; }
    .imp-guide { flex-direction: column; }
    .imp-hero-stats { gap: 10px; }
    .imp-stat-val, .imp-stat-label { font-size: 11px; }
  }
</style>

<div class="imp-page content-wrapper">

  <!-- ══════ HERO ══════ -->
  <div class="imp-hero">
    <div class="imp-hero-grid"></div>
    <div class="imp-hero-inner">

      <nav class="imp-breadcrumb" aria-label="Breadcrumb">
        <a href="<?= base_url('inicio') ?>"><i class="fas fa-home"></i></a>
        <span class="imp-breadcrumb-sep">›</span>
        <span class="imp-breadcrumb-current">Importação de Dados</span>
      </nav>

      <div class="imp-hero-badge">
        <i class="fas fa-file-import"></i>
        Módulo de Importação
      </div>

      <h1 class="imp-hero-title">
        Importar <span>Dados em Massa</span>
      </h1>
      <p class="imp-hero-sub">
        Importe alunos e funcionários rapidamente a partir de ficheiros Excel (.xlsx) ou CSV. Registos duplicados são ignorados automaticamente.
      </p>

      <div class="imp-hero-stats">
        <div class="imp-stat">
          <div class="imp-stat-icon blue"><i class="fas fa-file-excel"></i></div>
          <div>
            <div class="imp-stat-label">Formatos</div>
            <div class="imp-stat-val">.xlsx, .xls, .csv</div>
          </div>
        </div>
        <div class="imp-stat">
          <div class="imp-stat-icon green"><i class="fas fa-shield-alt"></i></div>
          <div>
            <div class="imp-stat-label">Duplicados</div>
            <div class="imp-stat-val">Ignorados automaticamente</div>
          </div>
        </div>
        <div class="imp-stat">
          <div class="imp-stat-icon orange"><i class="fas fa-upload"></i></div>
          <div>
            <div class="imp-stat-label">Tamanho máx.</div>
            <div class="imp-stat-val">5 MB por ficheiro</div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- ══════ BODY ══════ -->
  <div class="imp-body">

    <!-- Alertas Flash -->
    <?php if (session()->getFlashdata('sucesso')): ?>
    <div class="imp-alert imp-alert-success" role="alert">
      <div class="imp-alert-icon"><i class="fas fa-check"></i></div>
      <div><?= session()->getFlashdata('sucesso') ?></div>
      <button class="imp-alert-close" onclick="this.closest('.imp-alert').remove()" aria-label="Fechar">&times;</button>
    </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('erro')): ?>
    <div class="imp-alert imp-alert-error" role="alert">
      <div class="imp-alert-icon"><i class="fas fa-exclamation-triangle"></i></div>
      <div><?= session()->getFlashdata('erro') ?></div>
      <button class="imp-alert-close" onclick="this.closest('.imp-alert').remove()" aria-label="Fechar">&times;</button>
    </div>
    <?php endif; ?>

    <!-- Guia de instruções -->
    <div class="imp-guide">
      <div class="imp-guide-icon"><i class="fas fa-info-circle"></i></div>
      <div class="imp-guide-content">
        <h6>Como importar dados</h6>
        <div class="imp-guide-steps">
          <div class="imp-guide-step">
            <div class="imp-guide-step-num">1</div>
            <span>Descarregue o template CSV</span>
          </div>
          <span class="imp-guide-step-arrow">→</span>
          <div class="imp-guide-step">
            <div class="imp-guide-step-num">2</div>
            <span>Preencha sem alterar cabeçalhos</span>
          </div>
          <span class="imp-guide-step-arrow">→</span>
          <div class="imp-guide-step">
            <div class="imp-guide-step-num">3</div>
            <span>Faça upload do ficheiro</span>
          </div>
          <span class="imp-guide-step-arrow">→</span>
          <div class="imp-guide-step">
            <div class="imp-guide-step-num">4</div>
            <span>Confirme os resultados</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Grid de cards -->
    <div class="imp-grid">

      <!-- ──────────── CARD ALUNOS ──────────── -->
      <div class="imp-card is-primary">
        <div class="imp-card-header">
          <div class="imp-card-icon"><i class="fas fa-user-graduate"></i></div>
          <div>
            <div class="imp-card-title">Importar Alunos</div>
            <div class="imp-card-subtitle">Lista de alunos em massa via Excel ou CSV</div>
          </div>
        </div>

        <div class="imp-card-body">

          <!-- Template download -->
          <a href="<?= base_url('importacao/template/alunos') ?>" class="imp-template-btn">
            <i class="fas fa-download"></i>
            Descarregar Template Alunos (.csv)
          </a>

          <!-- Colunas -->
          <div>
            <div class="imp-cols-label">Estrutura do ficheiro</div>
            <div class="imp-cols">
              <div class="imp-col-pill required">
                <span class="col-letter">A</span>
                <span>Nome</span>
                <span class="col-req">Obr.</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">B</span>
                <span>Data Nasc.</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">C</span>
                <span>Género</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">D</span>
                <span>Telefone</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">E</span>
                <span>Email</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">F</span>
                <span>Endereço</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">G</span>
                <span>Nome Responsável</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">H</span>
                <span>Tel. Responsável</span>
              </div>
            </div>
          </div>

          <!-- Form upload -->
          <form action="<?= base_url('importacao/alunos') ?>" method="POST"
                enctype="multipart/form-data" id="formAlunos" class="d-contents">
            <?= csrf_field() ?>

            <!-- Drop Zone -->
            <div class="imp-dropzone" id="dzAlunos">
              <input type="file" name="ficheiro_excel" id="fileAlunos"
                     accept=".xlsx,.xls,.csv"
                     onchange="handleFile(this,'dzAlunos','previewAlunos','defaultAlunos')" required>

              <!-- Estado padrão -->
              <div id="defaultAlunos">
                <div class="imp-dz-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <div class="imp-dz-title">Arraste o ficheiro aqui</div>
                <div class="imp-dz-sub">ou <strong>clique para selecionar</strong></div>
                <div class="imp-dz-sub" style="margin-top:6px;font-size:11px;">.xlsx · .xls · .csv · máx. 5 MB</div>
              </div>

              <!-- Estado com ficheiro -->
              <div id="previewAlunos" class="imp-dz-file-preview">
                <div class="imp-dz-file-icon"><i class="fas fa-file-excel"></i></div>
                <div>
                  <div class="imp-dz-file-name" id="fnAlunos"></div>
                  <div class="imp-dz-file-size" id="fsAlunos"></div>
                </div>
                <button type="button" class="imp-dz-file-remove"
                        onclick="clearFile('fileAlunos','dzAlunos','previewAlunos','defaultAlunos')"
                        title="Remover ficheiro">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="imp-submit-btn" id="btnAlunos">
              <span class="imp-btn-progress" id="progAlunos"></span>
              <i class="fas fa-upload"></i>
              <span>Importar Alunos</span>
            </button>
          </form>

        </div>
      </div>

      <!-- ──────────── CARD FUNCIONÁRIOS ──────────── -->
      <div class="imp-card is-success">
        <div class="imp-card-header">
          <div class="imp-card-icon"><i class="fas fa-chalkboard-teacher"></i></div>
          <div>
            <div class="imp-card-title">Importar Funcionários</div>
            <div class="imp-card-subtitle">Professores e secretários via Excel ou CSV</div>
          </div>
        </div>

        <div class="imp-card-body">

          <!-- Template download -->
          <a href="<?= base_url('importacao/template/trabalhadores') ?>" class="imp-template-btn">
            <i class="fas fa-download"></i>
            Descarregar Template Funcionários (.csv)
          </a>

          <!-- Colunas -->
          <div>
            <div class="imp-cols-label">Estrutura do ficheiro</div>
            <div class="imp-cols">
              <div class="imp-col-pill required">
                <span class="col-letter">A</span>
                <span>Nome</span>
                <span class="col-req">Obr.</span>
              </div>
              <div class="imp-col-pill required">
                <span class="col-letter">B</span>
                <span>Função</span>
                <span class="col-req">Obr.</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">C</span>
                <span>Telefone</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">D</span>
                <span>Email</span>
              </div>
              <div class="imp-col-pill">
                <span class="col-letter">E</span>
                <span>Data Admissão</span>
              </div>
            </div>
          </div>

          <!-- Form upload -->
          <form action="<?= base_url('importacao/trabalhadores') ?>" method="POST"
                enctype="multipart/form-data" id="formTrab" class="d-contents">
            <?= csrf_field() ?>

            <!-- Drop Zone -->
            <div class="imp-dropzone" id="dzTrab">
              <input type="file" name="ficheiro_excel" id="fileTrab"
                     accept=".xlsx,.xls,.csv"
                     onchange="handleFile(this,'dzTrab','previewTrab','defaultTrab')" required>

              <!-- Estado padrão -->
              <div id="defaultTrab">
                <div class="imp-dz-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                <div class="imp-dz-title">Arraste o ficheiro aqui</div>
                <div class="imp-dz-sub">ou <strong>clique para selecionar</strong></div>
                <div class="imp-dz-sub" style="margin-top:6px;font-size:11px;">.xlsx · .xls · .csv · máx. 5 MB</div>
              </div>

              <!-- Estado com ficheiro -->
              <div id="previewTrab" class="imp-dz-file-preview">
                <div class="imp-dz-file-icon"><i class="fas fa-file-excel"></i></div>
                <div>
                  <div class="imp-dz-file-name" id="fnTrab"></div>
                  <div class="imp-dz-file-size" id="fsTrab"></div>
                </div>
                <button type="button" class="imp-dz-file-remove"
                        onclick="clearFile('fileTrab','dzTrab','previewTrab','defaultTrab')"
                        title="Remover ficheiro">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>

            <button type="submit" class="imp-submit-btn" id="btnTrab">
              <span class="imp-btn-progress" id="progTrab"></span>
              <i class="fas fa-upload"></i>
              <span>Importar Funcionários</span>
            </button>
          </form>

        </div>
      </div>

    </div><!-- /.imp-grid -->
  </div><!-- /.imp-body -->
</div><!-- /.imp-page -->

<script>
/* ══════════════════════════════════════════
   FUNÇÕES DE DROP ZONE
══════════════════════════════════════════ */
function formatBytes(bytes) {
  if (bytes < 1024) return bytes + ' B';
  if (bytes < 1048576) return (bytes / 1024).toFixed(1) + ' KB';
  return (bytes / 1048576).toFixed(1) + ' MB';
}

function handleFile(input, dzId, previewId, defaultId) {
  const file    = input.files[0];
  const dz      = document.getElementById(dzId);
  const preview = document.getElementById(previewId);
  const def     = document.getElementById(defaultId);

  if (!file) return;

  // Validar tamanho (5MB)
  if (file.size > 5 * 1024 * 1024) {
    showToast('Ficheiro demasiado grande. Máximo: 5 MB.', 'error');
    input.value = '';
    return;
  }

  // Validar extensão
  const ext = file.name.split('.').pop().toLowerCase();
  if (!['xlsx','xls','csv'].includes(ext)) {
    showToast('Formato inválido. Use .xlsx, .xls ou .csv', 'error');
    input.value = '';
    return;
  }

  // Preencher preview
  const fnEl = preview.querySelector('[id^="fn"]');
  const fsEl = preview.querySelector('[id^="fs"]');
  if (fnEl) fnEl.textContent = file.name;
  if (fsEl) fsEl.textContent = formatBytes(file.size);

  // Alternar estados
  def.style.display = 'none';
  preview.classList.add('visible');
  dz.classList.add('has-file');
}

function clearFile(inputId, dzId, previewId, defaultId) {
  document.getElementById(inputId).value = '';
  const dz      = document.getElementById(dzId);
  const preview = document.getElementById(previewId);
  const def     = document.getElementById(defaultId);

  def.style.display = '';
  preview.classList.remove('visible');
  dz.classList.remove('has-file');
}

/* ══════════════════════════════════════════
   DRAG & DROP NATIVO
══════════════════════════════════════════ */
document.querySelectorAll('.imp-dropzone').forEach(function(dz) {
  dz.addEventListener('dragover', function(e) {
    e.preventDefault();
    dz.classList.add('drag-over');
  });
  dz.addEventListener('dragleave', function() {
    dz.classList.remove('drag-over');
  });
  dz.addEventListener('drop', function(e) {
    e.preventDefault();
    dz.classList.remove('drag-over');
    const input = dz.querySelector('input[type="file"]');
    const dt = e.dataTransfer;
    if (dt.files.length) {
      // Criar DataTransfer para atribuir ao input
      try {
        const transfer = new DataTransfer();
        transfer.items.add(dt.files[0]);
        input.files = transfer.files;
        input.dispatchEvent(new Event('change'));
      } catch(err) {
        // Fallback: mostrar nome sem atribuir ao input
        console.warn('DataTransfer não suportado neste browser.');
      }
    }
  });
});

/* ══════════════════════════════════════════
   SUBMIT COM LOADING
══════════════════════════════════════════ */
document.querySelectorAll('.imp-submit-btn').forEach(function(btn) {
  btn.closest('form').addEventListener('submit', function(e) {
    const input = this.querySelector('input[type="file"]');
    if (!input.files.length) {
      e.preventDefault();
      showToast('Selecione um ficheiro antes de importar.', 'error');
      return;
    }

    btn.disabled = true;
    const icon = btn.querySelector('i');
    const text = btn.querySelector('span:last-child');
    const prog = btn.querySelector('.imp-btn-progress');

    icon.className = '';
    icon.innerHTML = '<span class="imp-spinner"></span>';
    if (text) text.textContent = 'A importar...';

    // Simular progresso visual
    let w = 0;
    const timer = setInterval(function() {
      w = Math.min(w + Math.random() * 12, 85);
      if (prog) prog.style.width = w + '%';
    }, 300);
  });
});

/* ══════════════════════════════════════════
   TOAST NOTIFICATION
══════════════════════════════════════════ */
function showToast(msg, type) {
  // Remover toast anterior se existir
  const prev = document.getElementById('imp-toast');
  if (prev) prev.remove();

  const toast = document.createElement('div');
  toast.id = 'imp-toast';
  toast.style.cssText = `
    position:fixed; bottom:24px; right:24px; z-index:9999;
    padding:14px 20px; border-radius:10px; font-size:14px; font-weight:500;
    display:flex; align-items:center; gap:10px; max-width:380px;
    box-shadow:0 8px 32px rgba(0,0,0,.15);
    animation:slideInDown .3s ease;
    font-family:'DM Sans',sans-serif;
  `;
  if (type === 'error') {
    toast.style.background = '#FEF2F2';
    toast.style.border = '1px solid rgba(220,38,38,.3)';
    toast.style.color = '#991B1B';
    toast.innerHTML = '<i class="fas fa-exclamation-circle" style="color:#DC2626;flex-shrink:0"></i>' + msg;
  } else {
    toast.style.background = '#ECFDF5';
    toast.style.border = '1px solid rgba(5,150,105,.3)';
    toast.style.color = '#065F46';
    toast.innerHTML = '<i class="fas fa-check-circle" style="color:#059669;flex-shrink:0"></i>' + msg;
  }

  document.body.appendChild(toast);
  setTimeout(function() {
    toast.style.opacity = '0';
    toast.style.transition = 'opacity .3s';
    setTimeout(function() { toast.remove(); }, 300);
  }, 4000);
}
</script>