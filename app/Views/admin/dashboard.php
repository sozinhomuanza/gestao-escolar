<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php
$nome_user = esc($primeiro_nome ?? 'Administrador');
?>

<div class="content-wrapper" style="background: #f4f7fa; min-height: 100vh; padding: 30px;">
    
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="font-weight-bold" style="color: #2d3748;">Dashboard</h1>
                <p class="text-muted">Bem-vindo, <span class="text-primary font-weight-bold"><?= $nome_user ?></span></p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 p-3" style="border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div style="width:50px; height:50px; background: linear-gradient(135deg, #6a11cb, #2575fc); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                            <i class="fas fa-user-graduate fa-lg"></i>
                        </div>
                        <div class="ml-3">
                            <small class="text-muted font-weight-bold text-uppercase">Alunos</small>
                            <h2 class="mb-0 font-weight-bold"><?= $total_de_alunos ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 p-3" style="border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div style="width:50px; height:50px; background: linear-gradient(135deg, #11998e, #38ef7d); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                            <i class="fas fa-chalkboard-teacher fa-lg"></i>
                        </div>
                        <div class="ml-3">
                            <small class="text-muted font-weight-bold text-uppercase">Professores</small>
                            <h2 class="mb-0 font-weight-bold"><?= $total_de_professores ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 p-3" style="border-radius: 15px;">
                    <div class="d-flex align-items-center">
                        <div style="width:50px; height:50px; background: #17a2b8; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white;">
                            <i class="fas fa-users fa-lg"></i>
                        </div>
                        <div class="ml-3">
                            <small class="text-muted font-weight-bold text-uppercase">Total RH</small>
                            <h2 class="mb-0 font-weight-bold"><?= $total_trabalhadores ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <div class="card shadow-sm border-0 p-4" style="border-radius: 15px;">
                    <h5 class="font-weight-bold mb-4"><i class="fas fa-chart-bar mr-2 text-primary"></i> Visão Geral da Instituição</h5>
                    <div style="height: 350px;">
                        <canvas id="graficoReal"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('graficoReal').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Alunos', 'Docentes', 'RH Staff', 'Turmas'],
                datasets: [{
                    label: 'Registros no Banco',
                    data: [<?= $total_de_alunos ?>, <?= $total_de_professores ?>, <?= $total_trabalhadores ?>, <?= $total_de_turmas ?>],
                    backgroundColor: ['#2575fc', '#38ef7d', '#17a2b8', '#ffc107'],
                    borderRadius: 10
                }]
            },
            options: { 
                responsive: true, 
                maintainAspectRatio: false,
                scales: { y: { beginAtZero: true } }
            }
        });
    });
</script>