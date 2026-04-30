<?php
namespace App\Models;
use CodeIgniter\Model;

class LocalizacaoModel extends Model
{
    public function getProvincias(): array
    {
        return $this->db->table('provincias')
            ->orderBy('nome', 'ASC')
            ->get()->getResultArray();
    }

    public function getMunicipios(int $id_provincia): array
    {
        return $this->db->table('municipios')
            ->where('id_provincia', $id_provincia)
            ->orderBy('nome', 'ASC')
            ->get()->getResultArray();
    }

    public function getComunas(int $id_municipio): array
    {
        return $this->db->table('comunas')
            ->where('id_municipio', $id_municipio)
            ->orderBy('nome', 'ASC')
            ->get()->getResultArray();
    }
}