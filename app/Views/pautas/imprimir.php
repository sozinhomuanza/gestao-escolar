<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<title>Mini Pauta – <?= esc($turma['nome_turma']) ?> – <?= esc($turma['nome_disciplina']) ?></title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: Arial, Helvetica, sans-serif; font-size: 9pt; background: #fff; color: #000; }

  @page { size: A4 landscape; margin: 8mm; }
  @media print { .no-print { display: none !important; } }

  .page-wrapper  { width: 100%; margin: 0 auto; padding: 5mm; }

  /* Ajuste do Novo Cabeçalho Oficial */
  .header-table { width: 100%; border-collapse: collapse; margin-bottom: 5mm; }
  .header-table td { vertical-align: middle; }
  
  .visto-area { text-align: center; font-size: 8pt; width: 220px; line-height: 1.2; }
  .school-logo { width: 55px; margin-bottom: 4px; }
  .signature-line-visto { border-top: 1px solid #000; width: 160px; margin: 12px auto 3px auto; }
  
  .central-area { text-align: center; }
  .insignia-republica { width: 45px; margin-bottom: 5px; }
  .inst-nome { font-size: 11pt; font-weight: bold; text-transform: uppercase; margin: 0; }
  .inst-sub { font-size: 9pt; font-weight: bold; margin-top: 2px; }

  .mini-pauta-title { 
    font-size: 12pt; font-weight: bold; text-align: center;
    border: 2px solid #000; display: inline-block;
    padding: 3px 30px; margin-top: 4mm; text-transform: uppercase; 
  }

  /* Grid de Metadados */
  .meta-grid { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2mm 6mm;
               margin-bottom: 4mm; font-size: 9pt; }
  .meta-grid .field { border-bottom: 1px solid #999; padding: 1px 0 2px; }
  .meta-grid .label { font-size: 7.5pt; color: #555; }

  /* Tabela de Notas */
  table.pauta { width: 100%; border-collapse: collapse; font-size: 8pt; }
  table.pauta th, table.pauta td { border: 1px solid #444; padding: 2px 4px; }
  table.pauta thead tr.trim-row th { text-align: center; font-weight: bold; font-size: 8pt; color: #fff; }
  .th-t0 { background: #2d3748; }
  .th-t1 { background: #1a3a5c; }
  .th-t2 { background: #1d4ed8; }
  .th-t3 { background: #166534; }
  .th-mfd{ background: #581c87; }
  table.pauta thead tr.sub-row th { text-align: center; font-size: 7pt; background: #f3f4f6; color: #000; }
  table.pauta tbody tr:nth-child(even) { background: #f9fafb; }
  table.pauta tbody td { text-align: center; }
  table.pauta tbody td.aluno-nome { text-align: left; font-size: 8pt; white-space: nowrap; }
  
  .pos  { font-weight: bold; color: #065f46; }
  .neg  { font-weight: bold; color: #991b1b; }
  .nd   { color: #9ca3af; }

  /* Estatísticas */
  .stats-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 3mm; margin-bottom: 4mm; }
  .stat-block { border: 1px solid #ccc; border-radius: 4px; padding: 4px 8px; font-size: 8pt; }
  .stat-block .stit { font-weight: bold; margin-bottom: 2px; border-bottom: 1px solid #eee; }
  .stat-block table { width: 100%; font-size: 7.5pt; }
  .stat-block td { border: none !important; padding: 1px 2px !important; background: transparent !important; text-align: left !important; }

  /* Assinaturas Finais */
  .footer-sign { margin-top: 6mm; display: flex; justify-content: space-around; }
  .sign-line   { text-align: center; width: 65mm; }
  .sign-line .line { border-top: 1px solid #000; margin-bottom: 2px; }

  .no-print    { margin: 15px; text-align: center; }
  .btn-print   { padding: 8px 24px; background: #1a3a5c; color: #fff; border: none;
                 border-radius: 6px; cursor: pointer; font-size: 11pt; font-weight: bold; }
</style>
</head>
<body>

<div class="no-print">
    <button class="btn-print" onclick="window.print()">🖨️ Imprimir / Guardar PDF</button>
    &nbsp;
    <button class="btn-print" style="background:#6c757d;" onclick="window.history.back()">✕ Fechar</button>
</div>

<div class="page-wrapper">

    <table class="header-table">
        <tr>
            <td class="visto-area">
                <img src="https://www.bing.com/th/id/OIP.HntJM2o6Oa20MWChOOSrqwHaHa?w=204&h=211&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" class="school-logo"><br>
                <strong>VISTO</strong><br>
                O SUB-DIRECTOR PEDAGÓGICO
                <div class="signature-line-visto"></div>
                <strong>MENDES ANTÓNIO DINÍS</strong>
            </td>
            <td class="central-area">
                <img src="https://th.bing.com/th/id/OIP.pM_9PbGxgrkMvyVVCcPhPAHaJG?w=155&h=191&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" class="insignia-republica">
                <div class="inst-nome">Instituto Politécnico Industrial Nº 6081 "17 de Dezembro"</div>
                <div class="inst-sub">Subdirecção Pedagógica | Área de Formação de Informática</div>
                <div class="inst-sub">Curso Técnico de Informática</div>
                <div><span class="mini-pauta-title">Mini Pauta</span></div>
            </td>
            <td style="width: 220px;"></td> </tr>
    </table>

    <div class="meta-grid">
        <div>
            <div class="label">Disciplina</div>
            <div class="field"><b><?= esc($turma['nome_disciplina']) ?></b></div>
        </div>
        <div>
            <div class="label">Professor(a)</div>
            <div class="field"><?= esc($turma['nome_professor'] ?? '–') ?></div>
        </div>
        <div>
            <div class="label">Turma</div>
            <div class="field"><?= esc($turma['nome_turma']) ?></div>
        </div>
        <div>
            <div class="label">Telefone</div>
            <div class="field"><?= esc($turma['tel_professor'] ?? '–') ?></div>
        </div>
        <div>
            <div class="label">Sala / Período</div>
            <div class="field"><?= esc(($turma['nome_sala'] ?? '–') . ' / ' . ($turma['periodo'] ?? '–')) ?></div>
        </div>
        <div>
            <div class="label">Ano Lectivo</div>
            <div class="field"><?= esc($turma['ano_letivo'] ?? '–') ?></div>
        </div>
    </div>

    <div class="stats-grid">
        <?php
        $trim_labels = ['', 'Iº Trimestre', 'IIº Trimestre', 'IIIº Trimestre'];
        foreach ([1, 2, 3] as $tr):
            $s = $stats[$tr];
        ?>
        <div class="stat-block">
            <div class="stit"><?= $trim_labels[$tr] ?></div>
            <table>
                <tr><td>Nº de Alunos:</td><td><b><?= $s['total_alunos'] ?></b></td></tr>
                <tr><td>% Positivas:</td><td><b><?= $s['pct_positivas'] ?>%</b></td></tr>
                <tr><td>% Negativas:</td><td><b><?= $s['pct_negativas'] ?>%</b></td></tr>
                <tr><td>Não Avaliados:</td><td><b><?= $s['nao_avaliados'] ?></b></td></tr>
            </table>
        </div>
        <?php endforeach; ?>
    </div>

    <table class="pauta">
        <thead>
            <tr class="trim-row">
                <th rowspan="2" class="th-t0" style="width:25px">#</th>
                <th rowspan="2" class="th-t0" style="width:180px;text-align:left;">Nome do Aluno</th>
                <th rowspan="2" class="th-t0" style="width:25px">G</th>
                <th colspan="4" class="th-t1">Iº Trimestre</th>
                <th colspan="4" class="th-t2">IIº Trimestre</th>
                <th colspan="4" class="th-t3">IIIº Trimestre</th>
                <th rowspan="2" class="th-mfd" style="width:32px">MFD</th>
            </tr>
            <tr class="sub-row">
                <th>MAC</th><th>NPP</th><th>NPT</th><th>MT1</th>
                <th>MAC</th><th>NPP</th><th>NPT</th><th>MT2</th>
                <th>MAC</th><th>NPP</th><th>NPT</th><th>MT3</th>
            </tr>
        </thead>
        <tbody>
        <?php
        function formatNota($v, $decimals = 1) {
            return $v !== null ? number_format($v, $decimals) : '<span class="nd">–</span>';
        }
        function classNota($v) {
            if ($v === null) return 'nd';
            return $v >= 10 ? 'pos' : 'neg';
        }
        foreach ($pauta as $i => $row):
        ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td class="aluno-nome"><?= esc($row['nome_aluno']) ?></td>
                <td><?= substr($row['genero'] ?? '-', 0, 1) ?></td>
                <td><?= formatNota($row['mac1'] ?? null) ?></td>
                <td><?= formatNota($row['npp1'] ?? null) ?></td>
                <td><?= formatNota($row['npt1'] ?? null) ?></td>
                <td class="<?= classNota($row['mt1'] ?? null) ?>"><?= formatNota($row['mt1'] ?? null) ?></td>
                <td><?= formatNota($row['mac2'] ?? null) ?></td>
                <td><?= formatNota($row['npp2'] ?? null) ?></td>
                <td><?= formatNota($row['npt2'] ?? null) ?></td>
                <td class="<?= classNota($row['mt2'] ?? null) ?>"><?= formatNota($row['mt2'] ?? null) ?></td>
                <td><?= formatNota($row['mac3'] ?? null) ?></td>
                <td><?= formatNota($row['npp3'] ?? null) ?></td>
                <td><?= formatNota($row['npt3'] ?? null) ?></td>
                <td class="<?= classNota($row['mt3'] ?? null) ?>"><?= formatNota($row['mt3'] ?? null) ?></td>
                <td class="<?= classNota($row['mfd'] ?? null) ?>"><?= formatNota($row['mfd'] ?? null) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p style="font-size:7pt; color:#555; margin-top:3mm;">
        <b>MAC</b>=Média Avaliação Contínua &nbsp;|&nbsp;
        <b>NPP</b>=Nota Prova Preparação &nbsp;|&nbsp;
        <b>NPT</b>=Nota Prova Trimestral &nbsp;|&nbsp;
        <b>MT</b>=Média Trimestral &nbsp;|&nbsp;
        <b>MFD</b>=Média Final da Disciplina
    </p>

    <div class="footer-sign">
        <div class="sign-line">
            <div style="height:12mm;"></div>
            <div class="line"></div>
            <small>O(A) Professor(a)</small>
        </div>
        <div class="sign-line">
            <div style="height:12mm;"></div>
            <div class="line"></div>
            <small>O(A) Subdirector(a) Pedagógico(a)</small>
        </div>
        <div class="sign-line">
            <div style="height:12mm;"></div>
            <div class="line"></div>
            <small>Luanda, _____ / _____ / 20_____</small>
        </div>
    </div>

</div>
</body>
</html>