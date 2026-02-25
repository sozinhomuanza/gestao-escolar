<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Boletim Oficial - <?= esc($aluno['nome']) ?></title>
    <style>
        @page { size: A4; margin: 1cm; }
        body { font-family: 'Segoe UI', Arial, sans-serif; color: #333; line-height: 1.2; margin: 0; padding: 0; background-color: #f5f5f5; }
        
        .page { width: 21cm; min-height: 29.7cm; padding: 1.5cm; margin: 1cm auto; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); position: relative; box-sizing: border-box; overflow: hidden; }

        /* Novo Cabeçalho Oficial */
        .official-header { text-align: center; margin-bottom: 25px; position: relative; }
        .insignia { height: 80px; width: auto; margin-bottom: 10px; }
        .school-logo { position: absolute; right: 0; top: 0; height: 70px; width: auto; }
        
        .official-header h1 { font-size: 16px; margin: 2px 0; text-transform: uppercase; font-weight: 600; }
        .official-header h2 { font-size: 18px; margin: 2px 0; color: #000; font-weight: 800; text-transform: uppercase; }
        .official-header h3 { font-size: 14px; margin: 2px 0; font-weight: 600; text-transform: uppercase; }

        .doc-title-box { background: #1D4ED8; color: white; padding: 8px 25px; margin-top: 15px; border-radius: 4px; display: inline-block; font-weight: 700; font-size: 14px; letter-spacing: 1px; }

        /* Grade de Informações */
        .student-info { display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 15px; margin-bottom: 25px; font-size: 12px; background: #f8fafc; padding: 15px; border: 1px solid #e2e8f0; border-radius: 4px; }
        .info-group b { display: block; color: #64748b; font-size: 9px; text-transform: uppercase; margin-bottom: 3px; }
        .info-group span { font-size: 13px; font-weight: 700; color: #1e293b; }

        /* Tabela Estilizada */
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background-color: #f1f5f9; color: #334155; font-size: 10px; text-transform: uppercase; padding: 10px 5px; border: 1px solid #cbd5e1; text-align: center; }
        td { padding: 8px 5px; border: 1px solid #e2e8f0; font-size: 12px; text-align: center; }
        td:first-child { text-align: left; font-weight: 600; padding-left: 10px; }
        .bg-gray { background-color: #f8fafc; font-weight: 700; }

        /* Status */
        .status { font-weight: 800; text-transform: uppercase; font-size: 10px; padding: 2px 6px; border-radius: 4px; }
        .aprovado { color: #15803d; background: #f0fdf4; }
        .reprovado { color: #b91c1c; background: #fef2f2; }

        /* Assinaturas baseadas na imagem de referência */
        .signatures { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 50px; text-align: center; }
        .visto-box { border: 1px solid #e2e8f0; padding: 10px; font-size: 11px; }
        .sig-line { margin-top: 40px; border-top: 1px solid #000; display: inline-block; width: 80%; padding-top: 5px; font-weight: 600; }

        /* Marca d'água */
        .watermark { position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%) rotate(-45deg); font-size: 100px; color: rgba(0,0,0,0.02); font-weight: 900; z-index: 0; pointer-events: none; text-transform: uppercase; }

        @media print {
            body { background: none; }
            .page { margin: 0; box-shadow: none; border: none; }
            .no-print { display: none; }
        }
        
        .no-print { text-align: center; padding: 20px; }
        .btn-print { background: #1D4ED8; color: white; padding: 12px 35px; border: none; border-radius: 6px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 6px rgba(29, 78, 216, 0.2); }
    </style>
</head>
<body>

    <div class="no-print">
        <button onclick="window.print()" class="btn-print">🖨️ IMPRIMIR BOLETIM OFICIAL</button>
    </div>

    <div class="page">
        <div class="watermark">CONFIDENCIAL</div>

        <div class="official-header">
            <img src="https://www.seekpng.com/png/full/138-1381453_emblem-of-angola-insignia-da-republica-de-angola.png" class="insignia" alt="Insígnia de Angola">
            <img src="https://th.bing.com/th/id/OIP.hFWNV3f0kyC81w6DOeDJsAHaHa?pid=1.7" class="school-logo" alt="Logo Escola">
            
            <h1><?= esc($escola['ministerio']) ?></h1>
            <h2><?= esc($escola['nome']) ?></h2>
            <h3>SUBDIRECÇÃO PEDAGÓGICA</h3>
            
            <div class="doc-title-box">BOLETIM DE NOTAS - ANO LECTIVO <?= $ano ?></div>
        </div>

        <div class="student-info">
            <div class="info-group">
                <b>Nome Completo</b>
                <span><?= esc($aluno['nome']) ?></span>
            </div>
            <div class="info-group">
                <b>Turma | Período</b>
                <span><?= esc($aluno['nome_turma']) ?> | <?= esc($aluno['periodo']) ?></span>
            </div>
            <div class="info-group" style="text-align: right;">
                <b>Data de Emissão</b>
                <span><?= date('d/m/Y') ?></span>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 30%;">Disciplinas Curriculares</th>
                    <th>MT1</th>
                    <th>MT2</th>
                    <th>MT3</th>
                    <th style="background:#e2e8f0">Média Anual</th>
                    <th>Faltas</th>
                    <th>Situação Final</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($notas as $n): ?>
                <tr>
                    <td><?= esc($n['disciplina']) ?></td>
                    <td><?= number_format($n['trimestres'][1]['mt'] ?? 0, 2) ?></td>
                    <td><?= isset($n['trimestres'][2]['mt']) ? number_format($n['trimestres'][2]['mt'], 2) : '-' ?></td>
                    <td><?= isset($n['trimestres'][3]['mt']) ? number_format($n['trimestres'][3]['mt'], 2) : '-' ?></td>
                    <td class="bg-gray"><?= number_format($n['media_anual'] ?? 0, 2) ?></td>
                    <td><?= $n['total_faltas'] ?></td>
                    <td>
                        <span class="status <?= ($n['media_anual'] >= 10) ? 'aprovado' : 'reprovado' ?>">
                            <?= ($n['media_anual'] >= 10) ? 'Aprovado' : 'Reprovado' ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="signatures">
            <div class="visto-box">
                VISTO<br>
                <b>O SUBDIRETO PEDAGÓGICO</b>
                <div class="sig-line">MENDES ANTÓNIO DINÍS</div>
            </div>
            <div>
                <br>
                <b>O ENCARREGADO DE EDUCAÇÃO</b>
                <div class="sig-line" style="border-top-style: dashed;">Assinatura</div>
            </div>
        </div>

        <div style="position: absolute; bottom: 1.5cm; left: 1.5cm; right: 1.5cm; text-align: center; font-size: 9px; color: #94a3b8; border-top: 1px solid #f1f5f9; padding-top: 10px;">
            Este documento é processado por computador e só é válido com o carimbo a óleo da instituição.
            <br><b>All Tech School System — Angola</b>
        </div>
    </div>

</body>
</html>