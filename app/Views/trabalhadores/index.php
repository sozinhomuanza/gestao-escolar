<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1><?= $titulo_pagina ?? 'Trabalhadores' ?></h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('inicio') ?>">Início</a></li>
                        <li class="breadcrumb-item active"><?= $titulo_pagina ?? 'Trabalhadores' ?></li>
                    </ol>
                </div>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="icon fas fa-check"></i> <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="content">
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <form action="<?= current_url() ?>" method="get">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="text" name="busca" class="form-control" placeholder="Pesquisar por nome do trabalhador..." value="<?= $busca ?? '' ?>">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Filtrar
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <?php if (!empty($busca)): ?>
                                <a href="<?= current_url() ?>" class="btn btn-default btn-block">Limpar</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <a href="<?= base_url('trabalhadores/novo') ?>" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i>
                    <?= (isset($titulo_pagina) && strpos($titulo_pagina, 'Professores') !== false) ? 'Adicionar Professor' : 'Adicionar Funcionário' ?>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th>Nome</th>
                                <th>Função</th>
                                <th>Localização</th> <th>Contacto</th>
                                <th class="text-center">Documentos</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($trabalhadores)): foreach ($trabalhadores as $t): ?>
                            <tr>
                                <td><strong><?= esc($t['nome']) ?></strong></td>
                                <td><span class="badge badge-light border"><?= $t['funcao'] ?></span></td>
                                <td>
                                    <small class="text-muted d-block">
                                        <i class="fas fa-map-marker-alt text-danger"></i> 
                                        <?= $t['provincia_nome'] ?? 'Desconhecida' ?>
                                    </small>
                                    <small><?= $t['municipio_nome'] ?? '' ?></small>
                                </td>
                                <td>
                                    <div style="font-size: 0.85rem">
                                        <i class="fas fa-phone-alt text-muted"></i> <?= $t['telefone'] ?? '—' ?><br>
                                        <i class="fas fa-envelope text-muted"></i> <?= $t['email'] ?? '—' ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <?php if (!empty($t['doc_bi'])): ?>
                                            <a href="<?= base_url('uploads/documentos/'.$t['doc_bi']) ?>" target="_blank" class="btn btn-info btn-xs" title="Ver BI"><i class="fas fa-id-card"></i> BI</a>
                                        <?php endif; ?>

                                        <?php if (!empty($t['doc_certificado'])): ?>
                                            <a href="<?= base_url('uploads/documentos/'.$t['doc_certificado']) ?>" target="_blank" class="btn btn-primary btn-xs" title="Ver Certificado"><i class="fas fa-file-alt"></i> Cert.</a>
                                        <?php endif; ?>
                                        
                                        <?php if (empty($t['doc_bi']) && empty($t['doc_certificado'])): ?>
                                            <span class="text-muted small italic">Sem anexos</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('trabalhadores/editar/'.$t['id_trabalhador']) ?>" class="btn btn-warning btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger btn-sm" onclick="document.getElementById('id_excluir').value=<?= $t['id_trabalhador'] ?>" data-toggle="modal" data-target="#modal-delete" title="Excluir"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="fas fa-info-circle fa-2x mb-2"></i><br>
                                    Nenhum registo encontrado <?= !empty($busca) ? "para: '<strong>$busca</strong>'" : "" ?>.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <form action="<?= base_url('trabalhadores/excluir') ?>" method="POST">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-white">Confirmar Exclusão</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Tem certeza que deseja excluir este trabalhador?</p>
                    <p class="text-sm text-danger"><strong>Atenção:</strong> Os documentos BI e Certificado também serão apagados do servidor.</p>
                    <input type="hidden" name="id_trabalhador" id="id_excluir">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger shadow">Sim, excluir permanentemente</button>
                </div>
            </form>
        </div>
    </div>
</div>