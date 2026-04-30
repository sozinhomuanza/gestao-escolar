<?php
// Ficheiro: app/Models/SalaModel.php
namespace App\Models;
use CodeIgniter\Model;

class SalaModel extends Model {
    protected $table      = 'salas';
    protected $primaryKey = 'id_sala';
    protected $allowedFields = ['nome_sala', 'capacidade', 'tipo'];
    protected $useTimestamps = true;
}
