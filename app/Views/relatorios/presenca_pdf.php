<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Pauta de Presença - <?= esc($turma['nome_turma']) ?></title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; color: #1a3a5c; }
        
        .info-table { width: 100%; margin-bottom: 15px; background: #f9f9f9; padding: 10px; border: 1px solid #ddd; }
        .info-table td { padding: 3px 5px; }

        table.pauta { width: 100%; border-collapse: collapse; }
        table.pauta th, table.pauta td { border: 1px solid #000; padding: 5px; }
        table.pauta th { background-color: #eee; font-weight: bold; text-align: center; }
        
        .col-num { width: 25px; text-align: center; }
        .col-nome { width: 250px; }
        .col-dia { width: 22px; }
        
        .footer { position: fixed; bottom: 0; width: 100%; font-size: 9px; text-align: right; color: #777; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Pauta de Presença</h2>
        <span>Ano Lectivo: <?= $turma['ano_letivo'] ?></span>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>Turma:</strong> <?= esc($turma['nome_turma']) ?> (<?= esc($turma['classe']) ?>)</td>
            <td><strong>Disciplina:</strong> <?= esc($turma['nome_disciplina'] ?: 'Geral') ?></td>
        </tr>
        <tr>
            <td><strong>Professor:</strong> <?= esc($turma['nome_professor'] ?: '---') ?></td>
            <td><strong>Período:</strong> <?= esc($turma['periodo']) ?> | <strong>Sala:</strong> <?= esc($turma['nome_sala']) ?></td>
        </tr>
    </table>

    <table class="pauta">
        <thead>
            <tr>
                <th class="col-num">Nº</th>
                <th class="col-nome">Nome Completo do Aluno</th>
                <?php for($i=1; $i<=12; $i++): ?>
                    <th class="col-dia"></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($alunos)): foreach ($alunos as $index => $aluno): ?>
            <tr>
                <td class="col-num"><?= $index + 1 ?></td>
                <td class="col-nome"><?= mb_strtoupper(esc($aluno['nome'])) ?></td>
                <?php for($i=1; $i<=12; $i++): ?>
                    <td></td>
                <?php endfor; ?>
            </tr>
            <?php endforeach; else: ?>
            <tr>
                <td colspan="14" style="text-align: center; padding: 20px;">Nenhum aluno confirmado nesta turma.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Impresso em: <?= date('d/m/Y H:i') ?> | Sistema de Gestão Escolar
    </div>

</body>
</html>