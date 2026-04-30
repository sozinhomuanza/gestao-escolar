<?php
/**
 * WIDGET REUTILIZÁVEL — Província → Município → Comuna
 * Ajustado para garantir o carregamento em cascata na edição.
 */
?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Província</label>
            <select name="id_provincia" id="sel_provincia" class="form-control">
                <option value="">-- Seleccionar --</option>
                <?php foreach ($provincias as $p): ?>
                    <option value="<?= $p['id_provincia'] ?>" 
                        <?= (isset($id_provincia) && $id_provincia == $p['id_provincia']) ? 'selected' : '' ?>>
                        <?= esc($p['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Município</label>
            <select name="id_municipio" id="sel_municipio" class="form-control" <?= empty($id_municipio) ? 'disabled' : '' ?>>
                <option value="">-- Seleccionar --</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Comuna</label>
            <select name="id_comuna" id="sel_comuna" class="form-control" <?= empty($id_comuna) ? 'disabled' : '' ?>>
                <option value="">-- Seleccionar --</option>
            </select>
        </div>
    </div>
</div>

<script>
(function () {
    // Garante que a barra final exista na URL base
    const BASE = "<?= rtrim(base_url(), '/') . '/' ?>";
    const selProv = document.getElementById('sel_provincia');
    const selMun  = document.getElementById('sel_municipio');
    const selCom  = document.getElementById('sel_comuna');
    
    // Pegamos os valores iniciais (caso seja edição)
    const preMunId = "<?= $id_municipio ?? '' ?>";
    const preComId = "<?= $id_comuna ?? '' ?>";

    function resetSelect(sel, label) {
        sel.innerHTML = '<option value="">-- ' + label + ' --</option>';
        sel.disabled = true;
    }

    function carregarMunicipios(id_prov, id_municipio_para_selecionar = null) {
        if (!id_prov) {
            resetSelect(selMun, 'Seleccionar');
            resetSelect(selCom, 'Seleccionar');
            return;
        }

        fetch(BASE + 'localizacao/municipios/' + id_prov)
            .then(r => r.json())
            .then(data => {
                selMun.innerHTML = '<option value="">-- Seleccionar --</option>';
                selMun.disabled = false;
                data.forEach(m => {
                    const selected = (id_municipio_para_selecionar == m.id_municipio) ? 'selected' : '';
                    selMun.innerHTML += `<option value="${m.id_municipio}" ${selected}>${m.nome}</option>`;
                });
                
                // Se carregamos um município e temos um ID de comuna, dispara a carga das comunas
                if (id_municipio_para_selecionar) {
                    carregarComunas(id_municipio_para_selecionar, preComId);
                }
            });
    }

    function carregarComunas(id_mun, id_comuna_para_selecionar = null) {
        if (!id_mun) {
            resetSelect(selCom, 'Seleccionar');
            return;
        }

        fetch(BASE + 'localizacao/comunas/' + id_mun)
            .then(r => r.json())
            .then(data => {
                selCom.innerHTML = '<option value="">-- Seleccionar --</option>';
                selCom.disabled = false;
                data.forEach(c => {
                    const selected = (id_comuna_para_selecionar == c.id_comuna) ? 'selected' : '';
                    selCom.innerHTML += `<option value="${c.id_comuna}" ${selected}>${c.nome}</option>`;
                });
            });
    }

    // Eventos de mudança
    selProv.addEventListener('change', function() {
        carregarMunicipios(this.value);
    });

    selMun.addEventListener('change', function() {
        carregarComunas(this.value);
    });

    // Gatilho inicial: se já houver província selecionada (Edição)
    if (selProv.value) {
        carregarMunicipios(selProv.value, preMunId);
    }
})();
</script>