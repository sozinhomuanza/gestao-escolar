<?= $this->extend('layouts/main') ?> <?= $this->section('conteudo') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="h3 mb-0 text-gray-800">Lista de Professores</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: transparent; padding: 0;">
                    <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Início</a></li>
                    <li class="breadcrumb-item active">Lista de Professores</li>
                </ol>
            </nav>
        </div>
        <a href="<?= base_url('trabalhadores/novo') ?>" class="btn btn-primary shadow-sm">
            <i class="fas fa-user-plus fa-sm text-white-50"></i> Adicionar Professor
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('trabalhadores/professores') ?>" method="get" class="row gx-3 align-items-center">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-right-0">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" name="busca" class="form-control bg-light border-left-0" 
                               placeholder="Digite o nome do professor..." 
                               value="<?= esc($busca ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter mr-1"></i> Filtrar
                        </button>
                        <?php if(!empty($busca)): ?>
                            <a href="<?= base_url('trabalhadores/professores') ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-undo"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Listagem de Professores</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Nome</th>
                            <th>Função</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Documentos</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($trabalhadores)): ?>
                            <?php foreach ($trabalhadores as $p): ?>
                                <tr>
                                    <td class="font-weight-bold text-dark"><?= esc($p['nome']) ?></td>
                                    <td><span class="badge badge-info">Professor</span></td>
                                    <td><?= esc($p['telefone'] ?: '---') ?></td>
                                    <td><?= esc($p['email'] ?: '---') ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-info" title="BI"><i class="fas fa-id-card"></i> BI</button>
                                        <button class="btn btn-sm btn-primary" title="Certificado"><i class="fas fa-file-alt"></i> Cert.</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('trabalhadores/editar/'.$p['id_trabalhador']) ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    Nenhum professor encontrado para: <strong>"<?= esc($busca) ?>"</strong>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>