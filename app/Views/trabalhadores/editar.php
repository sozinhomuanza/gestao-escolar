<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Editar Funcionário: <strong><?= esc($t['nome']) ?></strong></h1>
        </div>
    </section>
    <section class="content">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Alterar Informações</h3>
            </div>
            <form action="<?= base_url('trabalhadores/store') ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_trabalhador" value="<?= $t['id_trabalhador'] ?>">
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input type="text" name="nome" class="form-control" value="<?= esc($t['nome']) ?>" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Função</label>
                                <input type="text" name="funcao" class="form-control" value="<?= esc($t['funcao']) ?>">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" name="telefone" class="form-control" value="<?= esc($t['telefone']) ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="<?= esc($t['email']) ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data de Admissão</label>
                                <input type="date" name="data_admissao" class="form-control" value="<?= $t['data_admissao'] ?>">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h5 class="text-muted"><i class="fas fa-map-marker-alt"></i> Localização Atualizada</h5>
                            <?= view('partials/localizacao_widget', [
                                'provincias'   => $provincias,
                                'id_provincia' => $t['id_provincia'] ?? null,
                                'id_municipio' => $t['id_municipio'] ?? null,
                                'id_comuna'    => $t['id_comuna']    ?? null,
                            ]) ?>
                            <hr>
                        </div>
                        </div>
                    
                    <h5 class="text-warning"><i class="fas fa-file-alt"></i> Gestão de Documentos</h5>
                    <p class="text-muted small">Deixe vazio para manter o ficheiro atual.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cópia do BI</label>
                                <?php if (!empty($t['doc_bi'])): ?>
                                    <div class="mb-2">
                                        <a href="<?= base_url('uploads/documentos/'.$t['doc_bi']) ?>" target="_blank" class="btn btn-xs btn-info">
                                            <i class="fas fa-eye"></i> Ver BI Atual
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="custom-file">
                                    <input type="file" name="doc_bi" class="custom-file-input" id="bi">
                                    <label class="custom-file-label" for="bi">Substituir BI...</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Certificado de Habilitações</label>
                                <?php if (!empty($t['doc_certificado'])): ?>
                                    <div class="mb-2">
                                        <a href="<?= base_url('uploads/documentos/'.$t['doc_certificado']) ?>" target="_blank" class="btn btn-xs btn-primary">
                                            <i class="fas fa-eye"></i> Ver Certificado Atual
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="custom-file">
                                    <input type="file" name="doc_certificado" class="custom-file-input" id="cert">
                                    <label class="custom-file-label" for="cert">Substituir Certificado...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning"><i class="fas fa-sync-alt"></i> Atualizar Dados</button>
                    <a href="<?= base_url('trabalhadores') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('custom-file-input')) {
        e.target.nextElementSibling.innerText = e.target.files[0]?.name || 'Escolher ficheiro...';
    }
});
</script>