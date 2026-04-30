<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Gestão de RUPEs</h1>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Importar Novos Números</h3>
                        </div>
                        <form action="<?= base_url('financeiro/importar_rupes') ?>" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Lista de RUPEs (Cole aqui)</label>
                                    <textarea name="lista_rupes" class="form-control" rows="12" placeholder="001234567890&#10;001234567891&#10;..." required></textarea>
                                    <small class="text-muted">Um número por linha, conforme o Excel da AGT.</small>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-block">Salvar no Sistema</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Status do Estoque</h3>
                            <div class="card-tools">
                                <span class="badge badge-info">Disponíveis: <?= $total_livre ?></span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Número RUPE</th>
                                        <th>Estado</th>
                                        <th>Aluno / Uso</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rupes as $r): ?>
                                    <tr>
                                        <td><code><?= $r['numero_rupe'] ?></code></td>
                                        <td>
                                            <span class="badge badge-<?= ($r['status'] == 'livre') ? 'success' : 'secondary' ?>">
                                                <?= strtoupper($r['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= $r['nome_aluno'] ? esc($r['nome_aluno']) : '--' ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
