<div class="content-wrapper">
    <section class="content pt-4">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="card-title text-white">
                        Painel de Gerenciamento de Usuários
                    </h3>
                </div>

                <div class="card-body">
                    <h4>Bem-vindo, <?= session()->get('primeiro_nome'); ?> 👋</h4>
                    <p>Você está acessando como:</p>

                    <span class="badge badge-success">
                        <?= session()->get('nivel'); ?>
                    </span>
                </div>
            </div>

        </div>
    </section>
</div>

