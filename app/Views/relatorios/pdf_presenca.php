<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .title { font-size: 18px; font-weight: bold; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 50px; text-align: center; }
        .signature { border-top: 1px solid #000; width: 300px; margin: 0 auto; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Sistema Escolar - Pauta de Presença</div>
        <p><strong>Turma:</strong> <?= $turma['nome_turma'] ?> | <strong>Período:</strong> <?= $turma['periodo'] ?></p>
        <p><strong>Data:</strong> ____/____/2026</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">Nº</th>
                <th width="65%">Nome Completo do Aluno</th>
                <th width="30%">Assinatura</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; foreach($alunos as $aluno): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= mb_strtoupper($aluno['nome']) ?></td>
                <td></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="signature">Assinatura do Professor</div>
    </div>
</body>
</html>