    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>Sistema de Gestão Escolar</strong> — Instituto Politécnico Industrial 17 de Dezembro
        <div class="float-right d-none d-sm-inline-block">
            <b>All Tech School System</b> &mdash; <?= date('Y') ?>
        </div>
    </footer>

    <aside class="control-sidebar control-sidebar-dark"></aside>
</div><!-- ./wrapper -->

<script src="<?= base_url('theme/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('theme/dist/js/adminlte.min.js') ?>"></script>

<script>
// Auto-fechar alertas após 4 segundos
setTimeout(function() {
    document.querySelectorAll('.alert-msg').forEach(function(el) {
        el.style.transition = 'opacity 0.5s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 500);
    });
}, 4000);
</script>
</body>
</html>
