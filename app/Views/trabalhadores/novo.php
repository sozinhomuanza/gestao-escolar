<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Novo Funcionário</h1>
        </div>
    </section>
    <section class="content">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">Dados do Funcionário</h3></div>
            <form action="<?= base_url('trabalhadores/store') ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nome Completo *</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Função *</label>
                                <select name="funcao" class="form-control" required>
                                    <option value="">— Selecionar —</option>
                                    <option>Professor</option>
                                    <option>Professora</option>
                                    <option>Secretário</option>
                                    <option>Secretária</option>
                                    <option>Diretor</option>
                                    <option>Diretora</option>
                                    <option>Auxiliar</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Telefone</label>
                                <input type="text" name="telefone" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data de Admissão</label>
                                <input type="date" name="data_admissao" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                            <h5 class="text-muted">Localização / Residência</h5>
                            <?= view('partials/localizacao_widget', [
                                'provincias'   => $provincias,
                                'id_provincia' => $id_provincia ?? null,
                                'id_municipio' => $id_municipio ?? null,
                                'id_comuna'    => $id_comuna ?? null,
                            ]) ?>
                        </div>
                        </div>
                    
                    <hr>
                    <h5 class="text-primary"><i class="fas fa-file-alt"></i> Documentos (Opcional)</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cópia do BI</label>
                                <div class="custom-file">
                                    <input type="file" name="doc_bi" class="custom-file-input" id="doc_bi">
                                    <label class="custom-file-label" for="doc_bi">Escolher ficheiro...</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Certificado de Habilitações</label>
                                <div class="custom-file">
                                    <input type="file" name="doc_certificado" class="custom-file-input" id="doc_cert">
                                    <label class="custom-file-label" for="doc_cert">Escolher ficheiro...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registar</button>
                    <a href="<?= base_url('trabalhadores') ?>" class="btn btn-default">Cancelar</a>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
// Script para mostrar o nome do arquivo selecionado no input customizado
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('custom-file-input')) {
        let fileName = e.target.files[0]?.name || 'Escolher ficheiro...';
        e.target.nextElementSibling.innerText = fileName;
    }
});
</script>