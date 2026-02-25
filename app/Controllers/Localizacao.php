<?php
namespace App\Controllers;

use App\Models\LocalizacaoModel;
use CodeIgniter\API\ResponseTrait;

class Localizacao extends BaseController
{
    use ResponseTrait; // Opcional, mas ajuda a padronizar respostas API

    private LocalizacaoModel $locModel;

    public function __construct()
    {
        $this->locModel = new LocalizacaoModel();
    }

    /**
     * Retorna os municípios de uma província em formato JSON
     */
    public function municipios($id_provincia = null)
    {
        if (!$id_provincia) {
            return $this->response->setJSON([]);
        }

        $dados = $this->locModel->getMunicipios((int)$id_provincia);
        return $this->response->setJSON($dados);
    }

    /**
     * Retorna as comunas de um município em formato JSON
     */
    public function comunas($id_municipio = null)
    {
        if (!$id_municipio) {
            return $this->response->setJSON([]);
        }

        $dados = $this->locModel->getComunas((int)$id_municipio);
        return $this->response->setJSON($dados);
    }
}