<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #1a3a5c; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #1a3a5c; color: white; padding: 8px; text-align: left; }
        td { border: 1px solid #ddd; padding: 8px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>PAUTA DE RENDIMENTO ACADÊMICO</h2>
        <p>Turma: <?= $turma['nome_turma'] ?> | Ano Letivo: 2026</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nº</th>
                <th>Nome do Aluno</th>
                <th>1º Trim</th>
                <th>2º Trim</th>
                <th>3º Trim</th>
                <th>Média Final</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($alunos as $idx => $aluno): ?>
            <tr>
                <td><?= $idx + 1 ?></td>
                <td><?= $aluno['nome'] ?></td>
                <td><?= $aluno['nota1'] ?></td>
                <td><?= $aluno['nota2'] ?></td>
                <td><?= $aluno['nota3'] ?></td>
                <td><strong><?= ($aluno['nota1'] + $aluno['nota2'] + $aluno['nota3']) / 3 ?></strong></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">Gerado automaticamente pelo Sistema em <?= date('d/m/Y H:i') ?></div>
</body>
</html>