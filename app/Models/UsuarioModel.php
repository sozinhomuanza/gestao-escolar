<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $allowedFields = [
        'nome',
        'email',
        'username',
        'senha',
        'perfil',
        'ativo',
        'ultimo_acesso',
    ];

    protected $useTimestamps = true;

    // Oculta a senha em resultados por padrão
    protected $hidden = ['senha'];
}
