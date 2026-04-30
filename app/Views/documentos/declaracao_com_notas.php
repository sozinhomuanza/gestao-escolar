<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Declaração com Notas — <?= esc($aluno['nome']) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Times+New+Roman:wght@400;700&family=Arial:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
html,body{background:#CBD5E1;font-family:'Times New Roman',Times,serif;color:#000;}

/* TOOLBAR — só no ecrã */
.tb{background:#1a5276;padding:11px 28px;display:flex;align-items:center;justify-content:space-between;gap:16px;position:sticky;top:0;z-index:100;}
.tb-t{color:#fff;font-weight:600;font-size:14px;display:flex;align-items:center;gap:9px;}
.tbtn{display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:8px;font-size:13px;font-weight:600;cursor:pointer;text-decoration:none;border:none;font-family:Arial,sans-serif;}
.tbtn.w{background:#fff;color:#1a5276;}
.tbtn.g{background:rgba(255,255,255,.15);color:#fff;border:1px solid rgba(255,255,255,.25);}

/* PÁGINA A4 */
.pg{
  width:210mm;min-height:297mm;background:#fff;
  margin:24px auto;
  box-shadow:0 8px 48px rgba(0,0,0,.25);
  display:flex;flex-direction:column;
  padding:20mm 20mm 18mm 20mm;
  position:relative;
}

/* ── CABEÇALHO INSTITUCIONAL ── */
.inst-header{text-align:center;margin-bottom:18px;line-height:1.4;}
.insignia-img{width:75px; height:auto; margin-bottom:10px;}
.inst-republica{font-size:12px;font-weight:bold;text-transform:uppercase;letter-spacing:.05em;}
.inst-governo{font-size:11px;font-weight:normal;text-transform:uppercase;letter-spacing:.05em;}
.inst-nome{font-size:13px;font-weight:bold;text-transform:uppercase;text-decoration:underline;letter-spacing:.03em;margin-top:4px;}

/* ── TÍTULO ── */
.decl-titulo{text-align:center;margin:22px 0 20px;}
.decl-titulo-t{font-size:18px;font-weight:bold;letter-spacing:.2em;text-transform:uppercase;}

/* ── CORPO TEXTO ── */
.corpo{font-size:13px;line-height:1.8;text-align:justify;margin-bottom:14px;}
.corpo .destaque{color:#000;font-weight:bold;font-size:14px; text-transform:uppercase;}
.corpo strong{font-weight:bold;color:#000;}

/* ── LISTA DE DISCIPLINAS ── */
.disciplinas{margin:10px 0 20px 0;width:100%;}
.disc-item{display:flex;align-items:baseline;font-size:13px;line-height:1.8;padding:0 8px;}
.disc-nome{white-space:nowrap;font-weight:normal;}
.disc-dots{flex:1;border-bottom:1px dotted #555;margin:0 4px;min-width:20px;position:relative;top:-4px;}
.disc-nota{white-space:nowrap;font-weight:bold;min-width:100px;text-align:right;}

/* ── TEXTO FINAL ── */
.texto-final{font-size:13px;line-height:1.8;text-align:justify;margin:12px 0;}

/* ── LOCAL E DATA ── */
.local-data{font-size:12px;text-align:center; margin:25px 0; line-height:1.6;}

/* ── ASSINATURA ── */
.assinatura{text-align:center;margin-top:10px;}
.assin-titulo{font-size:12px;font-weight:bold;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px;}
.assin-linha{width:250px;height:1px;background:#000;margin:40px auto 6px;}
.assin-nome{font-size:12px;font-weight:bold;text-transform:uppercase;letter-spacing:.04em;}

/* ── OBS ── */
.obs{margin-top:auto;font-size:11px;border-top:1px solid #eee;padding-top:10px;}
.obs strong{text-decoration:underline;}

@media print{
  body{background:white;}
  .tb{display:none!important;}
  .pg{margin:0;box-shadow:none;width:100%;min-height:100vh;padding:15mm 18mm;}
  @page{size:A4;margin:0;}
}
</style>
</head>
<body>

<div class="tb">
  <div class="tb-t"><i class="fas fa-file-invoice"></i> Declaração com Notas — <?= esc($aluno['nome']) ?></div>
  <div style="display:flex;gap:8px;">
    <a href="<?= base_url('documentos') ?>" class="tbtn g"><i class="fas fa-arrow-left"></i> Voltar</a>
    <button onclick="window.print()" class="tbtn w"><i class="fas fa-print"></i> Imprimir / PDF</button>
  </div>
</div>

<div class="pg">

  <div class="inst-header">
    <img src="https://th.bing.com/th/id/OIP.7m_uYNH6BDksPDVzJ1v96AHaIe?w=167&h=191&c=7&r=0&o=7&dpr=1.3&pid=1.7&rm=3" class="insignia-img" alt="Insígnia de Angola">
    <div class="inst-republica">República de Angola</div>
    <div class="inst-governo">Governo da Província de <?= esc($escola['provincia'] ?? 'Luanda') ?></div>
    <div class="inst-nome"><?= esc($escola['nome']) ?></div>
  </div>

  <div class="decl-titulo">
    <div class="decl-titulo-t">D E C L A R A Ç Ã O</div>
  </div>

  <?php
    $nomeAluno   = esc($aluno['nome']);
    $genero      = strtolower($aluno['genero'] ?? 'Masculino');
    $filho       = in_array($genero,['feminino','f']) ? 'Filha' : 'Filho';
    $nascido     = in_array($genero,['feminino','f']) ? 'Nascida' : 'Nascido';
    $turma       = esc($aluno['nome_turma'] ?? '—');
    $classe      = !empty($aluno['classe']) ? esc($aluno['classe']) : '................';
    $periodo     = esc($aluno['periodo'] ?? '—');
    $anoLetivo   = esc($ano);
    $resp        = esc($aluno['nome_responsavel'] ?? '................................................');
  ?>

  <div class="corpo">
    Para os devidos efeitos, declara-se que, <span class="destaque"><?= $nomeAluno ?></span>, 
    <?= $filho ?> de <?= $resp ?>, 
    <?= $nascido ?> aos <?= !empty($aluno['data_nascimento']) ? date('d/m/Y', strtotime($aluno['data_nascimento'])) : '___/___/____' ?>, 
    natural de <?= esc($aluno['naturalidade'] ?? '........') ?>, Província de <?= esc($aluno['provincia_natural'] ?? '........') ?>, 
    portador do B.I. nº <?= esc($aluno['bi'] ?? '........') ?>, 
    frequentou a <strong><?= $classe ?></strong> no ano lectivo <strong><?= $anoLetivo ?></strong>, na turma <strong><?= $turma ?></strong>, 
    período <strong><?= $periodo ?></strong>, nesta instituição de ensino, tendo obtido as seguintes médias:
  </div>

  <div class="disciplinas">
    <?php if (!empty($notas)): ?>
      <?php foreach ($notas as $n):
        $mf  = $n['media_final'] !== null ? round($n['media_final'], 0) : null;
        $notaStr = $mf !== null ? str_pad($mf, 2, '0', STR_PAD_LEFT) . ' Valores' : '(--) Valores';
      ?>
      <div class="disc-item">
        <span class="disc-nome"><?= esc($n['nome_disciplina']) ?></span>
        <span class="disc-dots"></span>
        <span class="disc-nota"><?= $notaStr ?></span>
      </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div style="text-align:center;padding:20px;color:#888;font-size:12px;">
        Nenhuma nota registada para o ano lectivo <?= esc($ano) ?>.
      </div>
    <?php endif; ?>
  </div>

  <?php
      // Lógica de Transição
      $medias = array_filter(array_column($notas ?? [], 'media_final'));
      $mg = count($medias) ? round(array_sum($medias)/count($medias), 1) : 0;
      $status = ($mg >= 10) ? "TRANSITA" : "NÃO TRANSITA";
  ?>

  <div class="corpo">
    Com uma média geral de <strong><?= $mg ?></strong> valores, o aluno <strong><?= $status ?></strong> de classe.
  </div>

  <div class="texto-final">
    Por ser verdade e me ter sido solicitado, mandei passar a presente declaração que vai por mim assinada e autenticada com o carimbo a óleo em uso nesta instituição.
  </div>

  <?php
    $meses = ["January" => "Janeiro", "February" => "Fevereiro", "March" => "Março", "April" => "Abril", "May" => "Maio", "June" => "Junho", "July" => "Julho", "August" => "Agosto", "September" => "Setembro", "October" => "Outubro", "November" => "Novembro", "December" => "Dezembro"];
    $data_extenso = date('d') . ' de ' . $meses[date('F')] . ' de ' . date('Y');
  ?>
  <div class="local-data">
    <?= esc($escola['provincia'] ?? 'Luanda') ?>, <?= $data_extenso ?>.
  </div>

  <div class="assinatura">
    <div class="assin-titulo">A Directora</div>
    <div class="assin-linha"></div>
    <div class="assin-nome"><?= esc($escola['directora'] ?? 'JOANA FRANCISCO DA ROCHA FRANCISCO') ?></div>
  </div>

  <div class="obs">
    OBS: <strong>SÓ É VÁLIDA A ORIGINAL E SEM EMENDAS.</strong>
  </div>

</div>
</body>
</html>