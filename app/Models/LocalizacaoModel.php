<?php

namespace App\Models;

use CodeIgniter\Model;

class LocalizacaoModel extends Model
{
    // Definimos a tabela principal como províncias, 
    // mas usaremos o db->table() para as outras.
    protected $table      = 'provincias'; 
    protected $primaryKey = 'id_provincia';
    protected $returnType = 'array';

    /**
     * Retorna todas as províncias ordenadas por nome
     */
    public function getProvincias()
    {
        return $this->orderBy('nome', 'ASC')->findAll();
    }

    /**
     * Retorna municípios baseados no ID da província
     */
    public function getMunicipios($id_provincia)
    {
        return $this->db->table('municipios')
                        ->where('id_provincia', (int)$id_provincia)
                        ->orderBy('nome', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Retorna comunas baseadas no ID do município
     */
    public function getComunas($id_municipio)
    {
        return $this->db->table('comunas')
                        ->where('id_municipio', (int)$id_municipio)
                        ->orderBy('nome', 'ASC')
                        ->get()
                        ->getResultArray();
    }

    /**
     * Útil para exibir nomes em listas/tabelas de Alunos/Trabalhadores
     * Retorna o nome completo da localização dado os IDs
     */
    public function getLocalizacaoCompleta($id_prov, $id_mun, $id_com)
    {
        $prov = $this->find($id_prov)['nome'] ?? '';
        
        $mun = $this->db->table('municipios')
                        ->where('id_municipio', $id_mun)
                        ->get()->getRowArray()['nome'] ?? '';
                        
        $com = $this->db->table('comunas')
                        ->where('id_comuna', $id_com)
                        ->get()->getRowArray()['nome'] ?? '';

        return ['provincia' => $prov, 'municipio' => $mun, 'comuna' => $com];
    }
}