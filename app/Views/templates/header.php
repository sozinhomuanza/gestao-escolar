<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" href="<?= base_url('theme/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('theme/dist/css/adminlte.min.css') ?>">
    <style>
        .sidebar-mini .nav-sidebar .nav-link { font-size: 13px; }
        .alert-msg { position: fixed; top: 70px; right: 20px; z-index: 9999; min-width: 280px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,.15); }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-user-circle"></i>
                <span class="ml-1"><?= session()->get('primeiro_nome') ?? 'Utilizador' ?></span>
                <small class="badge badge-light ml-1"><?= session()->get('perfil') ?? '' ?></small>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('login/trocarsenha') ?>" class="dropdown-item">
                    <i class="fas fa-key mr-2"></i> Trocar Senha
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('login/logout') ?>" class="dropdown-item text-danger">
                    <i class="fas fa-sign-out-alt mr-2"></i> Sair
                </a>
            </div>
        </li>
    </ul>
</nav>

<!-- Mensagens Flash -->
<?php if (session()->getFlashdata('sucesso')): ?>
<div class="alert alert-success alert-dismissible alert-msg fade show">
    <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('sucesso') ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('erro')): ?>
<div class="alert alert-danger alert-dismissible alert-msg fade show">
    <i class="fas fa-exclamation-circle mr-2"></i> <?= session()->getFlashdata('erro') ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php endif; ?>
