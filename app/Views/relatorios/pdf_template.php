<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; color: #333; line-height: 1.4; }
        .header { text-align: center; border-bottom: 2px solid #444; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #1a3a5c; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #f2f2f2; border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 11px; }
        td { border: 1px solid #ddd; padding: 8px; font-size: 10px; }
        tr:nth-child(even) { background-color: #fafafa; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 9px; color: #888; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEMA DE GESTÃO ESCOLAR</h2>
        <p><strong><?= $titulo ?></strong><br>Data de Emissão: <?= date('d/m/Y H:i') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <?php foreach ($colunas as $col): ?>
                    <th><?= $col ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista as $item): ?>
            <tr>
                <?php foreach ($campos as $campo): ?>
                    <td><?= esc($item[$campo]) ?></td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        Gerado automaticamente pelo Sistema Escolar - Página 1
    </div>
</body>
</html>