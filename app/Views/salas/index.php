<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="fas fa-door-open mr-2"></i>Gestão de Salas de Aula</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Início</a></li>
                        <li class="breadcrumb-item active">Salas</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            
            <div class="card card-outline card-primary shadow-sm">
                <div class="card-header border-0">
                    <h3 class="card-title">Listagem de Salas Registadas</h3>
                    <div class="card-tools">
                        <a href="<?= base_url('salas/novo') ?>" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="fas fa-plus mr-1"></i> Adicionar Nova Sala
                        </a>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped m-0" id="tabela-salas">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 40%">Nome da Sala</th>
                                    <th class="text-center">Capacidade</th>
                                    <th class="text-center">Tipo / Categoria</th>
                                    <th class="text-center" style="width: 150px">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($salas)): foreach ($salas as $s): ?>
                                <tr>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="btn btn-default btn-sm mr-3"><i class="fas fa-chalkboard text-primary"></i></div>
                                            <span class="font-weight-bold"><?= esc($s['nome_sala']) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-info px-2 py-1">
                                            <i class="fas fa-users mr-1"></i> <?= $s['capacidade'] ?> alunos
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <span class="badge badge-secondary px-2 py-1 text-uppercase" style="font-size: 0.8rem;">
                                            <?= esc($s['tipo']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div class="btn-group">
                                            <a href="<?= base_url('salas/editar/'.$s['id_sala']) ?>" 
                                               class="btn btn-info btn-sm shadow-sm" 
                                               title="Editar Sala">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-danger btn-sm shadow-sm" 
                                                    onclick="confirmarExclusao('<?= $s['id_sala'] ?>')"
                                                    data-toggle="modal" data-target="#modal-delete"
                                                    title="Excluir Sala">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-50">
                                        <p class="text-muted">Nenhuma sala encontrada no sistema.</p>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-top">
                    <small class="text-muted text-uppercase font-weight-bold">
                        Total: <?= count($salas ?? []) ?> salas cadastradas
                    </small>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow">
            <div class="modal-header bg-white border-0">
                <h5 class="modal-title font-weight-bold text-danger">Confirmar Exclusão</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('salas/excluir') ?>" method="POST">
                <div class="modal-body text-center py-4">
                    <i class="fas fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <p class="mb-0 font-weight-bold">Deseja realmente excluir esta sala?</p>
                    <p class="text-muted small">Esta ação não poderá ser desfeita e pode afetar turmas vinculadas.</p>
                    <input type="hidden" name="id_sala" id="id_excluir">
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal">Manter Sala</button>
                    <button type="submit" class="btn btn-danger px-4">Sim, Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmarExclusao(id) {
        document.getElementById('id_excluir').value = id;
    }

    // Se tiveres o DataTables instalado, ativa-o aqui:
    /*
    $(document).ready(function() {
        $('#tabela-salas').DataTable({
            "language": { "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json" },
            "responsive": true
        });
    });
    */
</script>