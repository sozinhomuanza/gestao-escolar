<?php
/**
 * Sidebar com controlo de permissões, Foto de Perfil Dinâmica e Módulo Financeiro
 */
$perfil       = strtolower(session()->get('perfil') ?? '');
$isAdmin      = ($perfil === 'administrador');
$isDirector   = in_array($perfil, ['director', 'directora', 'diretor', 'diretora']);
$isSecretario = in_array($perfil, ['secretario', 'secretária']);
$isProfessor  = in_array($perfil, ['professor', 'professora']);
$uri          = uri_string();

// Define a foto do utilizador (Lógica otimizada)
$sessionFoto = session()->get('foto');
if (!empty($sessionFoto) && file_exists(FCPATH . 'uploads/usuarios/' . $sessionFoto)) {
    $urlFoto = base_url('uploads/usuarios/' . $sessionFoto);
} else {
    $urlFoto = base_url('theme/dist/img/avatar5.png');
}
?>

<aside class="main-sidebar sidebar-light-danger elevation-4">
    <a href="<?= base_url('inicio') ?>" class="brand-link bg-purple">
        <img src="<?= base_url('theme/dist/img/book.png') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity:.8">
        <span class="brand-text font-weight-light">Sistema Escolar</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= $urlFoto ?>" class="img-circle elevation-2" alt="User Image" style="width: 40px; height: 40px; object-fit: cover;">
            </div>
            <div class="info">
                <a href="#" class="d-block text-bold"><?= session()->get('nome') ?></a>
                <small class="text-muted"><?= ucfirst($perfil) ?></small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= base_url('inicio') ?>" class="nav-link <?= $uri === 'inicio' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Início</p>
                    </a>
                </li>

                <li class="nav-item has-treeview <?= str_starts_with($uri, 'pautas') ? 'menu-open' : '' ?>">
                    <a href="#" class="nav-link <?= str_starts_with($uri, 'pautas') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>Mini Pautas <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('pautas') ?>" class="nav-link <?= $uri === 'pautas' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-th-list"></i>
                                <p>Seleccionar Turma</p>
                            </a>
                        </li>
                        <?php if (!$isProfessor): ?>
                            <li class="nav-item">
                                <a href="<?= base_url('pautas/lancar') ?>" class="nav-link <?= str_starts_with($uri, 'pautas/lancar') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-pen-nib"></i>
                                    <p>Lançar Notas</p>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <?php if ($isAdmin || $isDirector || $isSecretario): ?>
                    <li class="nav-item has-treeview <?= str_starts_with($uri, 'trabalhadores') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= str_starts_with($uri, 'trabalhadores') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Funcionários <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('trabalhadores') ?>" class="nav-link <?= $uri === 'trabalhadores' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Todos os Funcionários</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('trabalhadores/professores') ?>" class="nav-link <?= $uri === 'trabalhadores/professores' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                    <p>Professores</p>
                                </a>
                            </li>
                            <?php if ($isAdmin || $isSecretario): ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('trabalhadores/novo') ?>" class="nav-link <?= $uri === 'trabalhadores/novo' ? 'active' : '' ?>">
                                        <i class="nav-icon fas fa-user-plus"></i>
                                        <p>Novo Funcionário</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?= str_starts_with($uri, 'documentos') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= str_starts_with($uri, 'documentos') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Documentos <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('documentos') ?>" class="nav-link <?= $uri === 'documentos' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-list"></i>
                                    <p>Lista de Alunos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview <?= str_starts_with($uri, 'alunos') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= str_starts_with($uri, 'alunos') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Pessoas <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('alunos') ?>" class="nav-link <?= str_starts_with($uri, 'alunos') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>Alunos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php $inAcademico = str_starts_with($uri, 'turmas') || str_starts_with($uri, 'salas') || str_starts_with($uri, 'disciplinas'); ?>
                    <li class="nav-item has-treeview <?= $inAcademico ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $inAcademico ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-school"></i>
                            <p>Académico <i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('turmas') ?>" class="nav-link <?= $uri === 'turmas' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-chalkboard"></i>
                                    <p>Turmas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('turmas/matricular') ?>" class="nav-link <?= $uri === 'turmas/matricular' ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>Matricular Aluno</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('salas') ?>" class="nav-link <?= str_starts_with($uri, 'salas') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-door-open"></i>
                                    <p>Salas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('disciplinas') ?>" class="nav-link <?= str_starts_with($uri, 'disciplinas') ? 'active' : '' ?>">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>Disciplinas</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">FINANCEIRO</li>
                    <li class="nav-item">
                        <a href="<?= base_url('financeiro/lista_por_turma') ?>" class="nav-link <?= str_contains($uri, 'financeiro') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-money-bill-wave text-success"></i>
                            <p>Emitir RUPE (Turmas)</p>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($isAdmin): ?>
                    <li class="nav-header">ADMINISTRAÇÃO</li>
                    <li class="nav-item">
                        <a href="<?= base_url('importacao') ?>" class="nav-link <?= str_starts_with($uri, 'importacao') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-file-import"></i>
                            <p>Importações</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('usuarios') ?>" class="nav-link <?= str_starts_with($uri, 'usuarios') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-lock"></i>
                            <p>Acesso ao Sistema</p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-header">CONTA</li>
                <li class="nav-item">
                    <a href="<?= base_url('login/trocarsenha') ?>" class="nav-link <?= $uri === 'login/trocarsenha' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-key"></i>
                        <p>Trocar Senha</p>
                    </a>
                </li>
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