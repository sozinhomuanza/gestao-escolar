<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Guias por Turma</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary:       #6366f1;
            --primary-dark:  #4f46e5;
            --primary-soft:  #eef2ff;
            --primary-glow:  rgba(99,102,241,.18);
            --accent:        #06b6d4;
            --accent-soft:   #ecfeff;
            --surface:       #ffffff;
            --surface-2:     #f8faff;
            --border:        #e5e7f0;
            --text:          #1e1b4b;
            --muted:         #6b7280;
            --success:       #10b981;
            --success-soft:  #ecfdf5;
            --warning:       #f59e0b;
            --warning-soft:  #fffbeb;
            --radius:        14px;
            --shadow-sm:     0 1px 4px rgba(99,102,241,.08), 0 1px 2px rgba(0,0,0,.04);
            --shadow-md:     0 8px 32px rgba(99,102,241,.14);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #faf5ff 50%, #f0fdff 100%);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── Wrapper ── */
        .page-wrapper {
            max-width: 980px;
            margin: 0 auto;
            padding: 2.5rem 1rem 5rem;
        }

        /* ── Hero header ── */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 60%, #7c3aed 100%);
            border-radius: 20px;
            padding: 2rem 2rem 2rem 2.25rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            box-shadow: 0 12px 40px rgba(99,102,241,.35);
            position: relative;
            overflow: hidden;
        }
        .page-header::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 200px; height: 200px;
            background: rgba(255,255,255,.07);
            border-radius: 50%;
        }
        .page-header::after {
            content: '';
            position: absolute;
            bottom: -60px; right: 80px;
            width: 160px; height: 160px;
            background: rgba(255,255,255,.05);
            border-radius: 50%;
        }
        .page-header .icon-box {
            width: 56px; height: 56px;
            background: rgba(255,255,255,.18);
            border: 1.5px solid rgba(255,255,255,.3);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            backdrop-filter: blur(4px);
        }
        .page-header .icon-box i {
            font-size: 1.7rem;
            color: #fff;
        }
        .page-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
            line-height: 1.2;
        }
        .page-header p {
            font-size: .875rem;
            color: rgba(255,255,255,.75);
            margin: .3rem 0 0;
        }

        /* ── Card ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        /* ── Card header com gradiente suave ── */
        .card-header-custom {
            background: linear-gradient(90deg, var(--primary-soft) 0%, #f5f3ff 100%);
            border-bottom: 1px solid #ddd6fe;
            padding: 1.1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .75rem;
        }
        .card-header-custom h6 {
            font-weight: 700;
            font-size: .8rem;
            color: var(--primary-dark);
            text-transform: uppercase;
            letter-spacing: .07em;
            margin: 0;
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        /* ── Select ── */
        .turma-select-wrapper {
            position: relative;
            max-width: 440px;
        }
        .turma-select-wrapper .select-icon {
            position: absolute;
            left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 1.1rem;
            pointer-events: none;
            z-index: 2;
        }
        .turma-select-wrapper select {
            padding-left: 2.6rem;
            font-weight: 600;
            border: 2px solid #c7d2fe;
            border-radius: 11px;
            height: 50px;
            font-size: .95rem;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
            background: var(--surface) url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 16 16'%3E%3Cpath fill='%236366f1' d='M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E") no-repeat right 14px center;
            color: var(--text);
            cursor: pointer;
        }
        .turma-select-wrapper select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-glow);
            outline: none;
        }

        /* ── Botão imprimir lote ── */
        .btn-lote {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: .55rem 1.3rem;
            font-size: .875rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            text-decoration: none;
            transition: all .2s;
            box-shadow: 0 4px 14px var(--primary-glow);
        }
        .btn-lote:hover {
            background: linear-gradient(135deg, var(--primary-dark), #7c3aed);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99,102,241,.35);
        }

        /* ── Tabela ── */
        .table-wrapper { overflow-x: auto; }
        table.table {
            margin: 0;
            font-size: .9rem;
        }
        table.table thead th {
            background: linear-gradient(90deg, var(--primary-soft), #f5f3ff);
            color: var(--primary-dark);
            font-weight: 700;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: .07em;
            border-bottom: 2px solid #ddd6fe;
            padding: .9rem 1.25rem;
            white-space: nowrap;
        }
        table.table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f8;
        }
        table.table tbody tr:last-child td { border-bottom: none; }
        table.table tbody tr { transition: background .15s; }
        table.table tbody tr:hover { background: var(--primary-soft); }

        /* ── Nº linha ── */
        .row-num {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, var(--primary-soft), #ede9fe);
            border: 1.5px solid #c7d2fe;
            border-radius: 9px;
            display: inline-flex;
            align-items: center; justify-content: center;
            font-size: .78rem;
            font-weight: 700;
            color: var(--primary-dark);
        }

        /* ── Nome aluno ── */
        .aluno-nome {
            font-weight: 700;
            color: var(--text);
            letter-spacing: .01em;
        }

        /* ── RUPE badge ── */
        .rupe-badge {
            font-family: 'Courier New', monospace;
            font-size: .82rem;
            font-weight: 700;
            background: var(--success-soft);
            color: var(--success);
            border: 1px solid #a7f3d0;
            padding: .3em .8em;
            border-radius: 7px;
            display: inline-block;
        }
        .rupe-badge.sem-rupe {
            background: var(--warning-soft);
            color: #b45309;
            border-color: #fcd34d;
        }

        /* ── Botão imprimir individual ── */
        .btn-imprimir {
            background: linear-gradient(135deg, var(--accent), #0891b2);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: .45rem 1.1rem;
            font-size: .82rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            text-decoration: none;
            transition: all .2s;
            box-shadow: 0 2px 8px rgba(6,182,212,.25);
            white-space: nowrap;
        }
        .btn-imprimir:hover {
            background: linear-gradient(135deg, #0891b2, #0e7490);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(6,182,212,.35);
        }
        .btn-imprimir:active { transform: translateY(0); }

        /* ── Estado vazio ── */
        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
        }
        .empty-state .empty-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, var(--primary-soft), #ede9fe);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 16px var(--primary-glow);
        }
        .empty-state .empty-icon i {
            font-size: 2.2rem;
            color: var(--primary);
        }
        .empty-state h5 {
            font-weight: 700;
            color: var(--text);
            margin-bottom: .4rem;
        }
        .empty-state p {
            color: var(--muted);
            font-size: .9rem;
        }

        /* ── Rodapé tabela ── */
        .table-footer {
            padding: .9rem 1.5rem;
            background: linear-gradient(90deg, var(--primary-soft), #f5f3ff);
            border-top: 1px solid #ddd6fe;
            font-size: .82rem;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: .5rem;
        }
        .table-footer strong { color: var(--primary-dark); }
        .badge-turma {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            font-weight: 700;
            font-size: .73rem;
            padding: .35em .85em;
            border-radius: 20px;
            letter-spacing: .03em;
        }

        /* ── Responsive ── */
        @media (max-width: 576px) {
            .page-header { padding: 1.5rem 1.25rem; }
            .page-header h1 { font-size: 1.2rem; }
            .turma-select-wrapper { max-width: 100%; }
            .card-header-custom { flex-direction: column; align-items: flex-start; }
            table.table thead th,
            table.table tbody td { padding: .75rem .875rem; }
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <!-- ── Hero header ── -->
    <div class="page-header">
        <div class="icon-box">
            <i class="bi bi-receipt-cutoff"></i>
        </div>
        <div>
            <h1>Gerar Guias por Turma</h1>
            <p>Selecione uma turma para visualizar e imprimir as guias de pagamento (RUPE)</p>
        </div>
    </div>

    <!-- ── Card ── -->
    <div class="card">

        <div class="card-header-custom">
            <h6><i class="bi bi-funnel-fill"></i> Filtrar por Turma</h6>
            <?php if ($id_turma_selecionada && count($alunos) > 0): ?>
                <a href="<?= base_url('financeiro/imprimir_lote/' . $id_turma_selecionada) ?>"
                   target="_blank" class="btn-lote">
                    <i class="bi bi-printer-fill"></i> Imprimir Turma Toda
                </a>
            <?php endif; ?>
        </div>

        <div class="p-4 pb-3">
            <div class="turma-select-wrapper w-100" style="max-width:440px">
                <i class="bi bi-mortarboard-fill select-icon"></i>
                <select class="form-select"
                    onchange="window.location.href='<?= base_url('financeiro/lista_por_turma') ?>/' + this.value">
                    <option value="">-- Selecione uma turma --</option>
                    <?php foreach ($turmas as $t): ?>
                        <option value="<?= $t['id_turma'] ?>"
                            <?= ($id_turma_selecionada == $t['id_turma']) ? 'selected' : '' ?>>
                            <?= esc($t['nome_turma']) ?> — <?= $t['classe'] ?>ª Classe
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <?php if ($id_turma_selecionada && count($alunos) > 0): ?>

            <div class="table-wrapper">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th style="width:50px">#</th>
                            <th>Nome do Aluno</th>
                            <th>Referência RUPE</th>
                            <th class="text-center" style="width:140px">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alunos as $i => $a): ?>
                        <tr>
                            <td><span class="row-num"><?= $i + 1 ?></span></td>
                            <td><span class="aluno-nome"><?= mb_strtoupper(esc($a['nome'])) ?></span></td>
                            <td>
                                <?php if ($a['rupe']): ?>
                                    <span class="rupe-badge"><?= esc($a['rupe']) ?></span>
                                <?php else: ?>
                                    <span class="rupe-badge sem-rupe">
                                        <i class="bi bi-exclamation-circle me-1"></i>Sem RUPE
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('financeiro/imprimir_guia/'.$a['id_aluno'].'/'.urlencode($a['rupe'])) ?>"
                                   target="_blank" class="btn-imprimir">
                                    <i class="bi bi-printer"></i> Imprimir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <span><strong><?= count($alunos) ?></strong> aluno<?= count($alunos) != 1 ? 's' : '' ?> encontrado<?= count($alunos) != 1 ? 's' : '' ?></span>
                <span class="badge-turma">
                    <i class="bi bi-mortarboard me-1"></i>
                    <?= esc($alunos[0]['nome_turma']) ?> — <?= $alunos[0]['classe'] ?>ª Classe
                </span>
            </div>

        <?php elseif ($id_turma_selecionada): ?>

            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-person-x"></i></div>
                <h5>Nenhum aluno matriculado</h5>
                <p>Esta turma não tem alunos matriculados de momento.</p>
            </div>

        <?php else: ?>

            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-arrow-up-circle"></i></div>
                <h5>Selecione uma turma</h5>
                <p>Escolha uma turma no filtro acima para visualizar os alunos e gerar as guias.</p>
            </div>

        <?php endif; ?>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
