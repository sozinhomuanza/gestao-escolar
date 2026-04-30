<!DOCTYPE html>
<html>
<head>
    <title><?= $titulo ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>MINISTÉRIO DA EDUCAÇÃO</h2>
        <h3><?= $titulo ?></h3>
        <p>Data de Emissão: <?= date('d/m/Y H:i') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Gênero</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($alunos as $a): ?>
            <tr>
                <td><?= $a['id_aluno'] ?></td>
                <td><?= $a['nome'] ?></td>
                <td><?= $a['genero'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>