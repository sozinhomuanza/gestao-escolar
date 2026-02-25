<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Declaração — <?= esc($aluno['nome']) ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
html,body{background:#CBD5E1;font-family:'Times New Roman',Times,serif;color:#000;}

/* TOOLBAR */
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
  padding:20mm 22mm 18mm 22mm;
  position:relative;
}

/* CABEÇALHO INSTITUCIONAL */
.inst-header{text-align:center;margin-bottom:22px;line-height:1.4;}
.insignia-img{width:75px; height:auto; margin-bottom:10px;}
.inst-republica{font-size:11px;font-weight:bold;text-transform:uppercase;letter-spacing:.05em;}
.inst-governo{font-size:10.5px;text-transform:uppercase;letter-spacing:.05em;}
.inst-nome{font-size:13px;font-weight:bold;text-transform:uppercase;text-decoration:underline;margin-top:4px;letter-spacing:.03em;}

/* TÍTULO */
.decl-titulo{text-align:center;margin:25px 0 30px;}
.decl-titulo-t{font-size:20px;font-weight:bold;letter-spacing:.25em;text-transform:uppercase;text-decoration:underline;}

/* TEXTO CORRIDO */
.corpo{font-size:13px;line-height:1.9;text-align:justify;margin-bottom:14px;}
.corpo .destaque{color:#000;font-weight:bold;font-size:14px; text-transform:uppercase;}
.corpo strong{font-weight:bold;}

/* SEPARADOR FREQUENTOU */
.sep-freq{
  display:flex;align-items:center;justify-content:center;
  margin:25px 0;font-size:12px;font-weight:bold;
  letter-spacing:.08em;text-transform:uppercase;
}
.sep-freq::before, .sep-freq::after{
  content:'«««««««««««««««««';
  font-weight:normal;font-size:11px;letter-spacing:-.02em;color:#555;
}
.sep-freq::before{margin-right:8px;}
.sep-freq::after{margin-left:8px;}

/* BLOCO FREQUENTOU */
.freq-bloco{
  font-size:13px;line-height:1.9;text-align:justify;
  margin-bottom:18px;
}
.freq-bloco strong{font-weight:bold;}

/* FINALIDADE */
.finalidade{
  font-size:13px;line-height:1.9;margin-bottom:18px;
}
.finalidade .fin-dest{
  font-size:14px;font-weight:bold;text-decoration:underline;
}

/* TEXTO FINAL */
.texto-final{font-size:13px;line-height:1.9;text-align:justify;margin-bottom:22px;}

/* LOCAL/DATA */
.local-data{
  font-size:12px;text-align:center;
  letter-spacing:.02em;line-height:1.6;margin:30px 0;
  font-weight:normal;
}

/* ASSINATURA */
.assinatura{text-align:center; margin-top: auto;}
.assin-titulo{font-size:12px;font-weight:bold;text-transform:uppercase;letter-spacing:.1em;margin-bottom:6px;}
.assin-linha{width:250px;height:1px;background:#000;margin:40px auto 6px;}
.assin-nome{font-size:12px;font-weight:bold;text-transform:uppercase;letter-spacing:.04em;}

@media print{
  body{background:white;}
  .tb{display:none!important;}
  .pg{margin:0;box-shadow:none;width:100%;min-height:100vh;padding:15mm 20mm;}
  @page{size:A4;margin:0;}
}
</style>
</head>
<body>

<div class="tb">
  <div class="tb-t"><i class="fas fa-file-alt"></i> Declaração — <?= esc($aluno['nome']) ?></div>
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
    <span class="decl-titulo-t">D E C L A R A Ç Ã O</span>
  </div>

  <?php
    $genero     = strtolower($aluno['genero'] ?? '');
    $isFem      = in_array($genero, ['feminino','f']);
    $filho      = $isFem ? 'Filha' : 'Filho';
    $nascida    = $isFem ? 'Nascida' : 'Nascido';
    $resp       = esc($aluno['nome_responsavel'] ?? '................................................');
    $classe     = !empty($aluno['classe']) ? esc($aluno['classe']) : '................';
    
    // Meses em Português
    $meses = ["January" => "Janeiro", "February" => "Fevereiro", "March" => "Março", "April" => "Abril", "May" => "Maio", "June" => "Junho", "July" => "Julho", "August" => "Agosto", "September" => "Setembro", "October" => "Outubro", "November" => "Novembro", "December" => "Dezembro"];
    $data_hoje = date('d') . ' de ' . $meses[date('F')] . ' de ' . date('Y');
  ?>

  <div class="corpo">
    Declara-se para os devidos efeitos que, <span class="destaque"><?= esc($aluno['nome']) ?></span>, 
    <?= $filho ?> de <?= $resp ?>, 
    <?= $nascida ?> aos <?= !empty($aluno['data_nascimento']) ? date('d/m/Y', strtotime($aluno['data_nascimento'])) : '___/___/____' ?>, 
    natural de <?= esc($aluno['naturalidade'] ?? '........') ?>, Província de <?= esc($aluno['provincia_natural'] ?? '........') ?>, 
    portador do B.I. nº <?= esc($aluno['bi'] ?? '........') ?>.
  </div>

  <div class="sep-freq">FREQUENTOU</div>

  <div class="freq-bloco">
    Nesta instituição de ensino, <strong><?= esc($escola['nome']) ?></strong>, 
    a <strong><?= $classe ?></strong>, 
    na turma <strong><?= esc($aluno['nome_turma'] ?? '—') ?></strong>, 
    período <strong><?= esc($aluno['periodo'] ?? '—') ?></strong>, 
    no Ano Lectivo <strong><?= esc($ano) ?></strong>.
  </div>

  <div class="finalidade">
    A presente Declaração destina-se para efeitos de: 
    <span class="fin-dest"><?= esc(service('request')->getGet('efeito') ?? 'SERVIÇO') ?></span>.
    «««««««««««««««««««««««««««««
  </div>

  <div class="texto-final">
    Por ser verdade e me ter sido solicitada, mandei passar a presente declaração que vai devidamente assinada e autenticada com o carimbo a óleo em uso nesta instituição.
  </div>

  <div class="local-data">
    <?= esc($escola['provincia'] ?? 'Luanda') ?>, aos <?= $data_hoje ?>.
  </div>

  <div class="assinatura">
    <div class="assin-titulo">A Directora</div>
    <div class="assin-linha"></div>
    <div class="assin-nome"><?= esc($escola['directora'] ?? 'JOANA FRANCISCO DA ROCHA FRANCISCO') ?></div>
  </div>

</div>
</body>
</html>