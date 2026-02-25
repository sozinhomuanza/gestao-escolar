<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #444; margin-bottom: 20px; }
        .chart-section { margin-top: 30px; }
        .bar-container { width: 100%; background: #eee; height: 30px; border-radius: 15px; margin: 10px 0; overflow: hidden; }
        .bar-fill { height: 100%; line-height: 30px; color: white; text-align: right; padding-right: 15px; font-weight: bold; }
        .t1 { background-color: #3498db; } /* Azul para T1 */
        .t2 { background-color: #9b59b6; } /* Roxo para T2 */
        .t3 { background-color: #2ecc71; } /* Verde para T3 */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 12px; text-align: center; }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <div class="header">
        <h2><?= $titulo ?></h2>
        <p>Turma: <strong><?= $turma['nome_turma'] ?></strong> | Total de Alunos: <?= $stats['total'] ?></p>
    </div>

    <div class="chart-section">
        <h3>Evolução do Aproveitamento Positivo (%)</h3>

        <?php 
            $p1 = ($stats['total'] > 0) ? ($stats['pos1'] / $stats['total']) * 100 : 0;
            $p2 = ($stats['total'] > 0) ? ($stats['pos2'] / $stats['total']) * 100 : 0;
            $p3 = ($stats['total'] > 0) ? ($stats['pos3'] / $stats['total']) * 100 : 0;
        ?>

        <p>Iº Trimestre</p>
        <div class="bar-container"><div class="bar-fill t1" style="width: <?= $p1 ?>%"><?= round($p1) ?>%</div></div>

        <p>IIº Trimestre</p>
        <div class="bar-container"><div class="bar-fill t2" style="width: <?= $p2 ?>%"><?= round($p2) ?>%</div></div>

        <p>IIIº Trimestre</p>
        <div class="bar-container"><div class="bar-fill t3" style="width: <?= $p3 ?>%"><?= round($p3) ?>%</div></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Trimestre</th>
                <th>Alunos Positivos</th>
                <th>Alunos Negativos</th>
                <th>Aproveitamento %</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Iº Trimestre</td>
                <td><?= $stats['pos1'] ?></td>
                <td><?= $stats['total'] - $stats['pos1'] ?></td>
                <td><?= round($p1, 1) ?>%</td>
            </tr>
            </tbody>
    </table>
</body>
</html>