<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
/* ... (Mantive o seu CSS original que está excelente) ... */
:root{
  --ink:#0C1A2E;--ink-2:#334155;--ink-3:#64748B;--ink-4:#94A3B8;
  --bg:#F1F5F9;--surface:#fff;--border:#E2E8F0;
  --primary:#1D4ED8;--pri-l:#EFF6FF;--pri-g:rgba(29,78,216,.18);
  --success:#059669;--suc-l:#ECFDF5;
  --warning:#D97706;--warn-l:#FFFBEB;
  --danger:#DC2626;
  --r-lg:16px;--r-md:10px;--r-sm:6px;
  --sh-sm:0 1px 4px rgba(12,26,46,.07);--sh-md:0 4px 16px rgba(12,26,46,.09);
  --tr:all .22s cubic-bezier(.4,0,.2,1);
  --ffd:'Syne',sans-serif;--ffb:'DM Sans',sans-serif;
}
.dp*{box-sizing:border-box;}
.dp{font-family:var(--ffb);color:var(--ink);background:var(--bg);min-height:100vh;padding-bottom:60px;}
.dp-hero{background:linear-gradient(135deg,#0C1A2E 0%,#1E3A6E 55%,#1D4ED8 100%); padding:44px 0 80px;position:relative;overflow:hidden;}
.dp-hero::before{content:'';position:absolute;inset:0; background:radial-gradient(ellipse 55% 90% at 85% 40%,rgba(29,78,216,.28) 0%,transparent 70%), radial-gradient(ellipse 35% 50% at 5% 90%,rgba(5,150,105,.12) 0%,transparent 60%);}
.dp-hero-grid{position:absolute;inset:0; background-image:linear-gradient(rgba(255,255,255,.025) 1px,transparent 1px), linear-gradient(90deg,rgba(255,255,255,.025) 1px,transparent 1px); background-size:48px 48px;}
.dp-hero-inner{position:relative;z-index:2;max-width:1300px;margin:0 auto;padding:0 28px; display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;}
.dp-hero-badge{display:inline-flex;align-items:center;gap:7px;background:rgba(29,78,216,.3); border:1px solid rgba(29,78,216,.5);color:#93C5FD;font-size:11px;font-weight:700; letter-spacing:.1em;text-transform:uppercase;padding:5px 14px;border-radius:100px;margin-bottom:18px;}
.dp-hero-title{font-family:var(--ffd);font-size:clamp(24px,3.5vw,40px);font-weight:800; color:#fff;margin:0 0 10px;letter-spacing:-.02em;line-height:1.1;}
.dp-hero-title span{background:linear-gradient(90deg,#60A5FA,#34D399); -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.dp-hero-sub{color:rgba(255,255,255,.5);font-size:14px;max-width:440px;line-height:1.6;margin:0;}
.dp-filter{background:rgba(255,255,255,.07);backdrop-filter:blur(12px); border:1px solid rgba(255,255,255,.12);border-radius:var(--r-lg); padding:18px 20px;display:flex;gap:10px;flex-wrap:wrap;align-items:flex-end;min-width:320px;}
.dp-filter label{font-size:10.5px;font-weight:700;text-transform:uppercase; letter-spacing:.08em;color:rgba(255,255,255,.45);display:block;margin-bottom:5px;}
.dp-filter input,.dp-filter select{ background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15); border-radius:var(--r-sm);padding:8px 12px;font-size:13px;color:#fff; font-family:var(--ffb);width:100%;outline:none;transition:var(--tr);}
.dp-filter select option{background:#1E3A6E;}
.dp-fg{flex:1;min-width:130px;}
.dp-fbtn{background:linear-gradient(135deg,#1D4ED8,#1E40AF);color:#fff;border:none; border-radius:var(--r-sm);padding:8px 18px;font-size:13px;font-weight:600;cursor:pointer; transition:var(--tr);display:flex;align-items:center;gap:7px;font-family:var(--ffb);white-space:nowrap;}
.dp-body{max-width:1300px;margin:-44px auto 0;padding:0 28px;position:relative;z-index:10;}
.dp-stats{display:flex;gap:16px;margin-bottom:24px;flex-wrap:wrap;}
.dp-sc{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-md); padding:14px 20px;display:flex;align-items:center;gap:14px;box-shadow:var(--sh-sm); flex:1;min-width:150px;transition:var(--tr);}
.dp-si{width:40px;height:40px;border-radius:var(--r-sm);display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;}
.dp-si.blue{background:var(--pri-l);color:var(--primary);}
.dp-si.green{background:var(--suc-l);color:var(--success);}
.dp-si.amber{background:var(--warn-l);color:var(--warning);}
.dp-sn{font-family:var(--ffd);font-size:24px;font-weight:800;color:var(--ink);line-height:1;}
.dp-sl{font-size:12px;color:var(--ink-3);margin-top:2px;}
.dp-card{background:var(--surface);border:1px solid var(--border);border-radius:var(--r-lg);box-shadow:var(--sh-sm);overflow:hidden;}
.dp-ch{padding:16px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap;}
.dp-ct{font-family:var(--ffd);font-weight:700;font-size:15px;color:var(--ink);display:flex;align-items:center;gap:8px;}
.dp-cc{font-size:12px;color:var(--ink-3);background:var(--bg);padding:3px 12px;border-radius:100px;border:1px solid var(--border);}
.dp-tbl{width:100%;border-collapse:collapse;}
.dp-tbl thead tr{background:var(--bg);}
.dp-tbl thead th{padding:10px 14px;text-align:left;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--ink-3);border-bottom:1px solid var(--border);white-space:nowrap;}
.dp-tbl tbody tr{border-bottom:1px solid var(--border);transition:var(--tr);}
.dp-tbl tbody tr:hover{background:#F8FAFF;}
.dp-tbl tbody td{padding:13px 14px;font-size:13.5px;color:var(--ink-2);vertical-align:middle;}
.dp-av{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--ffd);font-weight:700;font-size:13px;flex-shrink:0;}
.dp-ac{display:flex;align-items:center;gap:11px;}
.dp-an{font-weight:600;color:var(--ink);font-size:14px;}
.dp-aid{font-size:11px;color:var(--ink-4);}
.dp-badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:100px;font-size:12px;font-weight:600;}
.dp-badge.turma{background:var(--pri-l);color:var(--primary);border:1px solid rgba(29,78,216,.2);}
.dp-badge.st{background:var(--bg);color:var(--ink-4);border:1px solid var(--border);}
.dp-badge.conf{background:var(--suc-l);color:var(--success);}
.dp-badge.pend{background:var(--warn-l);color:var(--warning);}
.dp-acts{display:flex;gap:5px;flex-wrap:wrap;justify-content:flex-end;}
.dp-btn{display:inline-flex;align-items:center;gap:5px;padding:6px 11px;border-radius:var(--r-sm); font-size:11.5px;font-weight:600;text-decoration:none;border:1.5px solid;cursor:pointer; transition:var(--tr);background:none;font-family:var(--ffb);white-space:nowrap;}
.dp-btn.warn{color:var(--warning);border-color:rgba(217,119,6,.3);background:var(--warn-l);}
.dp-btn.warn:hover{background:var(--warning);color:#fff;border-color:var(--warning);}
.dp-btn.prim{color:var(--primary);border-color:rgba(29,78,216,.3);background:var(--pri-l);}
.dp-btn.prim:hover{background:var(--primary);color:#fff;border-color:var(--primary);}
.dp-btn.succ{color:var(--success);border-color:rgba(5,150,105,.3);background:var(--suc-l);}
.dp-btn.succ:hover{background:var(--success);color:#fff;border-color:var(--success);}
.dp-btn.gray{color:var(--ink-3);border-color:var(--border);background:var(--bg);}
.dp-btn.gray:hover{background:var(--ink-2);color:#fff;border-color:var(--ink-2);}
.dp-empty{text-align:center;padding:60px 24px;}
.dp-alert{display:flex;align-items:center;gap:12px;padding:13px 18px;border-radius:var(--r-md);margin-bottom:20px;font-size:14px;}
.dp-alert.s{background:var(--suc-l);border:1px solid rgba(5,150,105,.3);color:#065F46;}
.dp-alert.e{background:#FEF2F2;border:1px solid rgba(220,38,38,.3);color:#991B1B;}
</style>

<div class="dp content-wrapper">

  <div class="dp-hero">
    <div class="dp-hero-grid"></div>
    <div class="dp-hero-inner">
      <div>
        <div class="dp-hero-badge"><i class="fas fa-file-alt"></i> Centro de Documentos</div>
        <h1 class="dp-hero-title">Boletins &amp; <span>Declarações</span></h1>
        <p class="dp-hero-sub">Gere boletins de notas e declarações oficiais. Visualize e imprima em PDF.</p>
      </div>
      
      <form method="GET" action="<?= base_url('documentos') ?>">
        <div class="dp-filter">
          <div class="dp-fg" style="flex:2;">
            <label>Pesquisar aluno</label>
            <input type="text" name="q" placeholder="Nome do aluno..." value="<?= esc($search ?? '') ?>">
          </div>
          <div class="dp-fg">
            <label>Turma</label>
            <select name="turma_id">
              <option value="">Todas</option>
              <?php if(!empty($turmas)): foreach ($turmas as $t): ?>
              <option value="<?= $t['id_turma'] ?>" <?= (isset($turmaId) && $turmaId == $t['id_turma']) ? 'selected' : '' ?>>
                <?= esc($t['nome_turma']) ?>
              </option>
              <?php endforeach; endif; ?>
            </select>
          </div>
          <div class="dp-fg" style="max-width:110px;">
            <label>Ano letivo</label>
            <select name="ano">
              <?php if(!empty($anos)): foreach ($anos as $a): ?>
              <option value="<?= $a['ano_letivo'] ?>" <?= (isset($ano) && $ano == $a['ano_letivo']) ? 'selected' : '' ?>>
                <?= $a['ano_letivo'] ?>
              </option>
              <?php endforeach; else: ?>
                <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
              <?php endif; ?>
            </select>
          </div>
          <button type="submit" class="dp-fbtn"><i class="fas fa-search"></i></button>
        </div>
      </form>
    </div>
  </div>

  <div class="dp-body">

    <?php if (session()->getFlashdata('sucesso')): ?>
      <div class="dp-alert s"><i class="fas fa-check-circle"></i> <?= session()->getFlashdata('sucesso') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('erro')): ?>
      <div class="dp-alert e"><i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('erro') ?></div>
    <?php endif; ?>

    <div class="dp-stats">
      <div class="dp-sc">
        <div class="dp-si blue"><i class="fas fa-users"></i></div>
        <div><div class="dp-sn"><?= count($alunos ?? []) ?></div><div class="dp-sl">Alunos</div></div>
      </div>
      <div class="dp-sc">
        <div class="dp-si green"><i class="fas fa-check-circle"></i></div>
        <div>
          <div class="dp-sn"><?= count(array_filter($alunos ?? [], fn($a) => ($a['status_matricula'] ?? '') === 'Confirmada')) ?></div>
          <div class="dp-sl">Confirmados</div>
        </div>
      </div>
      <div class="dp-sc">
        <div class="dp-si amber"><i class="fas fa-calendar-alt"></i></div>
        <div><div class="dp-sn"><?= esc($ano ?? date('Y')) ?></div><div class="dp-sl">Ano Corrente</div></div>
      </div>
    </div>

    <div class="dp-card">
      <div class="dp-ch">
        <div class="dp-ct"><i class="fas fa-list"></i> Registos</div>
        <div class="dp-cc"><?= count($alunos ?? []) ?> total</div>
      </div>

      <?php if (empty($alunos)): ?>
        <div class="dp-empty">
          <i class="fas fa-user-slash"></i>
          <div class="dp-empty-t">Nenhum registo encontrado</div>
          <div class="dp-empty-s">Tente mudar os filtros de pesquisa ou ano letivo.</div>
        </div>
      <?php else: ?>
        <div style="overflow-x:auto;">
          <table class="dp-tbl">
            <thead>
              <tr>
                <th>Aluno</th>
                <th>Turma / Período</th>
                <th>Matrícula</th>
                <th style="text-align:right;">Documentos e Notas</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $cores=['#1D4ED8','#059669','#7C3AED','#D97706','#DC2626'];
              foreach ($alunos as $a): 
                $cor = $cores[crc32($a['nome']) % count($cores)];
                $nomes = explode(' ', trim($a['nome']));
                $iniciais = strtoupper(($nomes[0][0] ?? '') . (isset($nomes[1]) ? $nomes[1][0] : ''));
                $query = "?ano=" . ($ano ?? date('Y'));
              ?>
              <tr>
                <td>
                  <div class="dp-ac">
                    <div class="dp-av" style="background:<?= $cor ?>15; color:<?= $cor ?>"><?= $iniciais ?></div>
                    <div>
                      <div class="dp-an"><?= esc($a['nome']) ?></div>
                      <div class="dp-aid">ID: <?= str_pad($a['id_aluno'], 4, '0', STR_PAD_LEFT) ?></div>
                    </div>
                  </div>
                </td>
                <td>
                  <?php if (!empty($a['nome_turma'])): ?>
                    <span class="dp-badge turma"><?= esc($a['nome_turma']) ?></span>
                    <div style="font-size:11px; color:var(--ink-3); margin-left:5px;"><?= esc($a['periodo'] ?? '') ?></div>
                  <?php else: ?>
                    <span class="dp-badge st">Sem Turma</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php 
                  $st = $a['status_matricula'] ?? 'Pendente';
                  $cl = ($st === 'Confirmada') ? 'conf' : (($st === 'Pendente') ? 'pend' : 'st');
                  ?>
                  <span class="dp-badge <?= $cl ?>"><?= $st ?></span>
                </td>
                <td>
                  <div class="dp-acts">
                    <a href="<?= base_url("documentos/lancar-notas/{$a['id_aluno']}{$query}") ?>" class="dp-btn warn" title="Notas">
                      <i class="fas fa-edit"></i> Notas
                    </a>
                    <a href="<?= base_url("documentos/boletim/{$a['id_aluno']}{$query}") ?>" target="_blank" class="dp-btn prim">
                      <i class="fas fa-file-pdf"></i> Boletim
                    </a>
                    <a href="<?= base_url("documentos/declaracao-com-notas/{$a['id_aluno']}{$query}") ?>" target="_blank" class="dp-btn succ">
                      <i class="fas fa-file-contract"></i> Decl. Notas
                    </a>
                    <a href="<?= base_url("documentos/declaracao-sem-notas/{$a['id_aluno']}{$query}") ?>" target="_blank" class="dp-btn gray">
                      <i class="fas fa-file-alt"></i> Decl. Simples
                    </a>
                  </div>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>