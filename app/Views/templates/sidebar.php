<?php
/**
 * app/Views/templates/sidebar.php
 * Sidebar com controlo de permissões por perfil:
 *   admin      → tudo
 *   director   → consulta tudo, sem gestão de utilizadores/importação
 *   secretario → gestão académica, sem utilizadores
 *   professor  → apenas Mini Pautas
 */
$perfil = strtolower(session()->get('perfil') ?? '');
$isAdmin      = ($perfil === 'administrador');
$isDirector   = in_array($perfil, ['director', 'directora', 'diretor', 'diretora']);
$isSecretario = in_array($perfil, ['secretario', 'secretária']);
$isProfessor  = in_array($perfil, ['professor', 'professora']);
$uri          = uri_string();
?>
<aside class="main-sidebar sidebar-light-danger elevation-4">
    <a href="<?= base_url('inicio') ?>" class="brand-link bg-purple">
        <img src="<?= base_url('theme/dist/img/book.png') ?>" alt="Logo"
             class="brand-image img-circle elevation-3" style="opacity:.8">
        <span class="brand-text font-weight-light">Sistema Escolar</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('theme/dist/img/avatar5.png') ?>"
                     class="img-circle elevation-2" alt="Utilizador">
            </div>
            <div class="info">
                <a href="<?= base_url('login/trocarsenha') ?>" class="d-block">
                    <?= esc(session()->get('nome_usuario') ?? 'Utilizador') ?>
                </a>
                <small class="text-muted"><?= esc(session()->get('perfil')) ?></small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu" data-accordion="false">

                <!-- ── INÍCIO (todos) ── -->
                <li class="nav-item">
                    <a href="<?= base_url('inicio') ?>"
                       class="nav-link <?= $uri === 'inicio' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i><p>Início</p>
                    </a>
                </li>

                <!-- ── MINI PAUTAS (todos) ── -->
                <li class="nav-item has-treeview <?= str_starts_with($uri,'pautas') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= str_starts_with($uri,'pautas') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Mini Pautas
                            <i class="right fas fa-angle-left"></i>
                            <span class="badge badge-danger right">NEW</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('pautas') ?>"
                               class="nav-link <?= $uri === 'pautas' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Seleccionar Turma</p>
                            </a>
                        </li>
                        <?php if (!$isProfessor): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('pautas') ?>"
                               class="nav-link <?= str_starts_with($uri,'pautas/lancar') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-pen-nib"></i>
                                <p>Lançar Notas</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <!-- ── DOCUMENTOS (admin, director, secretário) ── -->
                <?php if ($isAdmin || $isDirector || $isSecretario): ?>
                <li class="nav-item has-treeview <?= str_starts_with($uri,'documentos') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= str_starts_with($uri,'documentos') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Documentos <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('documentos') ?>"
                               class="nav-link <?= $uri === 'documentos' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Lista de Alunos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('documentos') ?>"
                               class="nav-link <?= str_starts_with($uri,'documentos/boletim') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Boletim de Notas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('documentos') ?>"
                               class="nav-link <?= str_starts_with($uri,'documentos/declaracao') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-file-invoice"></i>
                                <p>Declarações</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- ── PESSOAS (admin, director, secretário) ── -->
                <?php if ($isAdmin || $isDirector || $isSecretario): ?>
                <li class="nav-item has-treeview <?= str_starts_with($uri,'alunos') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= str_starts_with($uri,'alunos') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pessoas <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('alunos') ?>"
                               class="nav-link <?= str_starts_with($uri,'alunos') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>Alunos</p>
                            </a>
                        </li>
                        <?php if ($isAdmin || $isSecretario): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('alunos/novo') ?>"
                               class="nav-link <?= $uri === 'alunos/novo' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Novo Aluno</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- ── FUNCIONÁRIOS (admin, director, secretário) ── -->
                <?php if ($isAdmin || $isDirector || $isSecretario): ?>
                <li class="nav-item has-treeview <?= str_starts_with($uri,'trabalhadores') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= str_starts_with($uri,'trabalhadores') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Funcionários <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('trabalhadores') ?>"
                               class="nav-link <?= $uri === 'trabalhadores' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Todos os Funcionários</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('trabalhadores/professores') ?>"
                               class="nav-link <?= $uri === 'trabalhadores/professores' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>Professores</p>
                            </a>
                        </li>
                        <?php if ($isAdmin || $isSecretario): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('trabalhadores/novo') ?>"
                               class="nav-link <?= $uri === 'trabalhadores/novo' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Novo Funcionário</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- ── TURMAS / MATRÍCULAS (admin, director, secretário) ── -->
                <?php if ($isAdmin || $isDirector || $isSecretario): ?>
                <?php $inTurmas = str_starts_with($uri,'turmas') || str_starts_with($uri,'salas') || str_starts_with($uri,'disciplinas'); ?>
                <li class="nav-item has-treeview <?= $inTurmas ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= $inTurmas ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-school"></i>
                        <p>Turmas/Matrículas <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('turmas') ?>"
                               class="nav-link <?= $uri === 'turmas' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-chalkboard"></i>
                                <p>Turmas</p>
                            </a>
                        </li>
                        <?php if ($isAdmin || $isSecretario): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('turmas/matricular') ?>"
                               class="nav-link <?= $uri === 'turmas/matricular' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Matricular Aluno</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('salas') ?>"
                               class="nav-link <?= str_starts_with($uri,'salas') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-door-open"></i>
                                <p>Salas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('disciplinas') ?>"
                               class="nav-link <?= str_starts_with($uri,'disciplinas') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Disciplinas</p>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if ($isDirector): ?>
                        <li class="nav-item">
                            <a href="<?= base_url('disciplinas') ?>"
                               class="nav-link <?= str_starts_with($uri,'disciplinas') ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Disciplinas</p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- ── IMPORTAÇÕES (admin e secretário apenas) ── -->
                <?php if ($isAdmin || $isSecretario): ?>
                <li class="nav-item has-treeview <?= str_starts_with($uri,'importacao') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= str_starts_with($uri,'importacao') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-import"></i>
                        <p>Importações <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('importacao') ?>"
                               class="nav-link <?= $uri === 'importacao' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>Importar Excel</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- ── ACESSO AO SISTEMA (apenas admin) ── -->
                <?php if ($isAdmin): ?>
                <li class="nav-item has-treeview <?= str_starts_with($uri,'usuarios') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= str_starts_with($uri,'usuarios') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-lock"></i>
                        <p>Acesso ao Sistema <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('usuarios') ?>"
                               class="nav-link <?= $uri === 'usuarios' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>Gerir Utilizadores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('usuarios/novo') ?>"
                               class="nav-link <?= $uri === 'usuarios/novo' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>Novo Utilizador</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- ── TROCAR SENHA (todos) ── -->
                <li class="nav-item">
                    <a href="<?= base_url('login/trocarsenha') ?>"
                       class="nav-link <?= $uri === 'login/trocarsenha' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Trocar Senha</p>
                    </a>
                </li>

                <!-- ── SAIR (todos) ── -->
                <li class="nav-item">
                    <a href="<?= base_url('login/logout') ?>" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Sair</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>