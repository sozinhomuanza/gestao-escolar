<div class="form-group mb-3">
    <label for="classe">Classe</label>
    <select name="classe" id="classe" class="form-control" required>
        <option value="">-- Selecione a Classe --</option>
        <option value="10ª Classe" <?= (isset($turma) && $turma['classe'] == '10ª Classe') ? 'selected' : '' ?>>10ª Classe</option>
        <option value="11ª Classe" <?= (isset($turma) && $turma['classe'] == '11ª Classe') ? 'selected' : '' ?>>11ª Classe</option>
        <option value="12ª Classe" <?= (isset($turma) && $turma['classe'] == '12ª Classe') ? 'selected' : '' ?>>12ª Classe</option>
        <option value="13ª Classe" <?= (isset($turma) && $turma['classe'] == '13ª Classe') ? 'selected' : '' ?>>13ª Classe</option>
    </select>
</div>