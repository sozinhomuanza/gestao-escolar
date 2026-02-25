<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Escolar | Sistema de Gestão</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        :root {
            --dark-blue: #1a237e;
            --light-blue: #e8eaf6;
            --success-soft: #e8f5e9;
            --success-text: #2e7d32;
        }
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { background-color: var(--dark-blue); min-height: 100vh; color: white; padding-top: 20px; }
        .sidebar a { color: rgba(255,255,255,0.8); padding: 12px 20px; display: block; text-decoration: none; }
        .sidebar a:hover { background: rgba(255,255,255,0.1); color: white; }
        .card-stats { border: none; border-radius: 15px; transition: transform 0.3s; }
        .card-stats:hover { transform: translateY(-5px); }
        .table-container { background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .avatar-circle { width: 40px; height: 40px; background: var(--light-blue); color: var(--dark-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; }
        .badge-success-soft { background-color: var(--success-soft); color: var(--success-text); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
                <h4 class="text-center mb-4">Escola CI4</h4>
                <a href="#"><i class="fas fa-home mr-2"></i> Dashboard</a>
                <a href="#"><i class="fas fa-user-graduate mr-2"></i> Alunos</a>
                <a href="#"><i class="fas fa-chalkboard-teacher mr-2"></i> Professores</a>
                <a href="#"><i class="fas fa-cog mr-2"></i> Configurações</a>
            </div>
        </nav>

        <main role="main" class="col-md-10 ml-sm-auto px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 text-dark">Dashboard de Gestão</h1>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card card-stats bg-primary text-white p-3">
                        <h6>Total de Alunos</h6>
                        <h3><?= $total_de_alunos ?></h3>
                        <small>Registrados no banco</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats bg-success text-white p-3">
                        <h6>Professores</h6>
                        <h3><?= $total_de_professores ?></h3>
                        <small>Ativos no sistema</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats bg-info text-white p-3">
                        <h6>Turmas</h6>
                        <h3><?= $total_de_turmas ?></h3>
                        <small>Ano letivo atual</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-stats bg-warning text-dark p-3">
                        <h6>Disciplinas</h6>
                        <h3><?= $total_de_disciplinas ?></h3>
                        <small>Grade curricular</small>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <h5 class="mb-4">Últimas Matrículas Realizadas</h5>
                <table class="table table-hover">
                    <thead>
                        <tr class="text-muted">
                            <th>Nome do Aluno</th>
                            <th>Data de Matrícula</th>
                            <th>Sexo</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($ultimos_alunos)): ?>
                            <?php foreach($ultimos_alunos as $aluno): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle mr-3">
                                            <?= strtoupper(substr($aluno['nome'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <span class="font-weight-bold d-block text-dark"><?= esc($aluno['nome']) ?></span>
                                            <small class="text-muted">ID: #<?= $aluno['id_aluno'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-muted">
                                    <?= date('d/m/Y', strtotime($aluno['created_at'])) ?>
                                </td>
                                <td class="align-middle"><?= esc($aluno['sexo']) ?></td>
                                <td class="align-middle text-center">
                                    <span class="badge badge-pill badge-success-soft">Ativo</span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Nenhum aluno encontrado no banco de dados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <footer class="mt-5 text-center text-muted pb-4">
                <small>&copy; <?= date('Y') ?> Sistema Escolar - CodeIgniter 4</small>
            </footer>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>