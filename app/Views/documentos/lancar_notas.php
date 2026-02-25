<div class="content-wrapper">
    <section class="content-header">
        <h1>Lançar Notas: <?= esc($aluno['nome']) ?></h1>
    </section>

    <section class="content">
        <form action="<?= base_url('documentos/salvar-notas') ?>" method="post">
            <input type="hidden" name="aluno_id" value="<?= $aluno['id_aluno'] ?>">
            <input type="hidden" name="turma_id" value="<?= $turmaId ?>">
            <input type="hidden" name="ano_letivo" value="<?= $ano ?>">

            <div class="box box-primary">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="bg-gray">
                                <th rowspan="2" style="vertical-align: middle;">Disciplina</th>
                                <th colspan="4">1º Trimestre</th>
                                <th colspan="4">2º Trimestre</th>
                                <th colspan="4">3º Trimestre</th>
                            </tr>
                            <tr class="bg-gray">
                                <th>MAC</th> <th>NPP</th> <th>NPT</th> <th>Faltas</th>
                                <th>MAC</th> <th>NPP</th> <th>NPT</th> <th>Faltas</th>
                                <th>MAC</th> <th>NPP</th> <th>NPT</th> <th>Faltas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($disciplinas as $d): $did = $d['id_disciplina']; ?>
                                <tr>
                                    <td class="text-left"><strong><?= esc($d['nome_disciplina']) ?></strong></td>
                                    <?php for ($tri = 1; $tri <= 3; $tri++): 
                                        $n = $notasExist[$did][$tri] ?? []; ?>
                                        <td><input type="number" step="0.1" name="notas[<?= $did ?>][<?= $tri ?>][mac]" value="<?= $n['mac'] ?? '' ?>" class="form-control input-sm"></td>
                                        <td><input type="number" step="0.1" name="notas[<?= $did ?>][<?= $tri ?>][npp]" value="<?= $n['npp'] ?? '' ?>" class="form-control input-sm"></td>
                                        <td><input type="number" step="0.1" name="notas[<?= $did ?>][<?= $tri ?>][npt]" value="<?= $n['npt'] ?? '' ?>" class="form-control input-sm"></td>
                                        <td><input type="number" name="notas[<?= $did ?>][<?= $tri ?>][falta]" value="<?= $n['falta'] ?? '0' ?>" class="form-control input-sm"></td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Gravar Todas as Notas</button>
                    <a href="<?= base_url('documentos') ?>" class="btn btn-default">Voltar</a>
                </div>
            </div>
        </form>
    </section>
</div>