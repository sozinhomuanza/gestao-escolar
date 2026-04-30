<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --primary-color: #1a3a5c; /* Azul Acadêmico Profundo */
        --accent-color: #2575fc;  /* Azul Vibrante para Ação */
        --bg-light: #f8fbff;
        --success-academic: #28a745;
    }

    body { font-family: 'Inter', sans-serif; background-color: var(--bg-light); color: #333; }
    .content-wrapper { background: var(--bg-light); padding-top: 20px; }

    /* Cards de Estatística */
    .stats-mini-card {
        border-left: 5px solid var(--accent-color);
        border-radius: 12px;
        background: #fff;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .stats-mini-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
    .stats-title { text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1px; color: #6c757d; font-weight: 700; }
    .stats-number { font-size: 2rem; font-weight: 800; margin-bottom: 0; }

    /* Filtros e Pesquisa */
    .filter-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        background: #fff;
        margin-bottom: 30px;
    }
    .input-group-text { border-radius: 10px 0 0 10px; border: none; }
    .form-control { border-radius: 10px; }

    /* Tabela de Luxo */
    .table-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,0.08);
        background: #fff;
    }
    .table thead th {
        background-color: var(--primary-color);
        color: #fff;
        text-transform: uppercase;
        font-size: 0.7rem;
        padding: 20px;
        border: none;
    }
    .table tbody tr { transition: all 0.2s; border-bottom: 1px solid #f4f7f6; }
    .table tbody tr:hover { background-color: #f8fbff; box-shadow: inset 4px 0 0 var(--accent-color); }

    /* Botões de Ação */
    .btn-trim {
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        background: #fff;
        color: var(--primary-color);
        transition: 0.3s;
    }
    .btn-trim:hover { background: var(--accent-color); color: #fff; border-color: var(--accent-color); }
    .btn-view {
        background: var(--primary-color);
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        padding: 8px 20px;
    }
    .btn-view:hover { background: #122b46; color: #fff; }

    .badge-periodo { padding: 7px 15px; border-radius: 30px; font-weight: 700; font-size: 0.7rem; }
</style>

<div class="content-wrapper px-3">
    <div class="container-fluid">
        
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h2 class="font-weight-bold text-dark mb-0">Central de Lançamentos</h2>
                <p class="text-muted mb-0">Painel administrativo de turmas e notas - v3.1</p>
            </div>
            <div class="text-right">
                <span class="badge badge-light p-2 border">Ano Letivo Ativo: <strong>2026</strong></span>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stats-mini-card">
                    <p class="stats-title">Minhas Turmas Ativas</p>
                    <h3 class="stats-number text-primary counter-value"><?= $totalGeral ?? count($turmas) ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-mini-card" style="border-left-color: var(--success-academic);">
                    <p class="stats-title">Ano Corrente</p>
                    <h3 class="stats-number text-success">2026</h3>
                </div>
            </div>
        </div>

        <div class="card filter-card">
            <div class="card-body p-4">
                <form action="<?= current_url() ?>" method="get" class="row align-items-end">
                    <div class="col-lg-5">
                        <label class="small font-weight-bold">PESQUISAR</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="fas fa-search"></i></span>
                            <input type="text" name="busca" value="<?= esc($_GET['busca'] ?? '') ?>" 
                                   class="form-control border-0 bg-light" placeholder="Turma, Professor ou Disciplina...">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <label class="small font-weight-bold">PERÍODO</label>
                        <select name="periodo" class="form-control border-0 bg-light">
                            <option value="">Todos os turnos</option>
                            <option value="Manhã" <?= ($_GET['periodo'] ?? '') == 'Manhã' ? 'selected' : '' ?>>Manhã</option>
                            <option value="Tarde" <?= ($_GET['periodo'] ?? '') == 'Tarde' ? 'selected' : '' ?>>Tarde</option>
                        </select>
                    </div>
                    <div class="col-lg-4 d-flex">
                        <button type="submit" class="btn btn-primary w-100 mr-2 shadow-sm font-weight-bold">APLICAR FILTRO</button>
                        <a href="<?= base_url('pautas') ?>" class="btn btn-light w-100 border shadow-sm">REPOR</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-container mb-5">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 15%">Cód. Turma</th>
                            <th style="width: 25%">Disciplina / Curso</th>
                            <th style="width: 25%">Docente & Local</th>
                            <th style="width: 10%">Turno</th>
                            <th class="text-center" style="width: 25%">Lançamentos Trimestrais</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($turmas)): ?>
                            <tr><td colspan="5" class="text-center py-5 text-muted">Nenhum registo encontrado.</td></tr>
                        <?php else: ?>
                            <?php foreach ($turmas as $t): ?>
                            <tr>
                                <td class="pl-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center mr-3" style="width: 45px; height: 45px; font-weight: 800;">
                                            <?= strtoupper(substr($t['nome_turma'], 0, 2)) ?>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold d-block text-dark"><?= esc($t['nome_turma']) ?></span>
                                            <small class="text-muted">ID: #<?= $t['id_turma'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-weight-600 d-block"><?= esc($t['nome_disciplina']) ?></span>
                                    <small class="text-muted">Código: <?= rand(100, 999) ?></small>
                                </td>
                                <td>
                                    <div class="small font-weight-bold text-primary"><i class="fas fa-user-tie mr-2"></i><?= esc($t['nome_professor']) ?></div>
                                    <div class="small text-muted"><i class="fas fa-map-marker-alt mr-2"></i>Sala: <?= esc($t['nome_sala']) ?></div>
                                </td>
                                <td>
                                    <?php $badge = ($t['periodo'] == 'Manhã') ? 'bg-info' : 'bg-warning'; ?>
                                    <span class="badge <?= $badge ?> text-white badge-periodo"><?= strtoupper(esc($t['periodo'])) ?></span>
                                </td>
                                <td class="text-center pr-4">
                                    <div class="btn-group">
                                        <a href="<?= base_url("pautas/lancar/{$t['id_turma']}?trimestre=1") ?>" class="btn btn-trim">1º T</a>
                                        <a href="<?= base_url("pautas/lancar/{$t['id_turma']}?trimestre=2") ?>" class="btn btn-trim">2º T</a>
                                        <a href="<?= base_url("pautas/lancar/{$t['id_turma']}?trimestre=3") ?>" class="btn btn-trim">3º T</a>
                                        <a href="<?= base_url("pautas/ver/{$t['id_turma']}") ?>" class="btn btn-view ml-3">
                                            <i class="fas fa-file-invoice mr-2"></i>PAUTA
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Contador Animado (Performance Otimizada)
    const animateValue = (obj, start, end, duration) => {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            obj.innerHTML = Math.floor(progress * (end - start) + start);
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    };

    // Aplica a animação apenas nos valores marcados
    document.querySelectorAll('.counter-value').forEach(el => {
        const value = parseInt(el.innerText);
        if(value > 0) animateValue(el, 0, value, 1200);
    });

    // 2. Feedback de Carregamento nos Botões
    const actionBtns = document.querySelectorAll('.btn-trim, .btn-view');
    actionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const originalWidth = this.offsetWidth;
            this.style.width = originalWidth + 'px';
            this.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i>';
            this.classList.add('disabled');
        });
    });
});
</script>