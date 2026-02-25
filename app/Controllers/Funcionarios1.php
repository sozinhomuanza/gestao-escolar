<?php
namespace App\Controllers;
use App\Models\FuncionarioModel;
use CodeIgniter\Controller;
use CodeIgniter\Session\Session;

class Funcionarios  extends Controller{

private $funcionario_model;
function __construct()
{
$this->funcionario_model = new FuncionarioModel();

}

public function index(){

$funcionarios = $this->funcionario_model ->findAll();
$data['funcionarios']= $funcionarios;

echo View('templates/header');
echo View('funcionarios/index', $data);
echo View('templates/footer');
}


    public function novo()
    {
        echo View('templates/header');
        echo View('funcionarios/novo');
        echo View('templates/footer');
    }





    public function editar($id_funcionario){

      



        $funcionario = $this->funcionario_model

                        ->where('id_funcionario', $id_funcionario)
                        ->first();

        $data['funcionario']=$funcionario;
        echo View('templates/header');
        echo View('funcionarios/editar', $data);
        echo View('templates/footer');

    }




    public function store()
    {

   $dados = $this->request->getVar();

   //verificando se existe o id
if(isset($dados['id_funcionario'])):

    $this->funcionario_model

    ->where('id_funcionario', $dados['id_funcionario'])

    //Passando os dados do array
    ->set ($dados)
    ->update();

            $session = Session();

            $session->setFlashdata('alert', 'success_update');

    return redirect()->to("/funcionarios/editar/{$dados['id_funcionario']}");

    endif;
   $this->funcionario_model->insert($dados);

// Criando uma sessão para mostra o alerta de funcionario cadastrado com sucesso
   $session = Session();

   $session->setFlashdata('alert', 'success_create');

   return redirect()->to('/funcionarios/index');
    }

    public function excluir(){
        $session = Session();

        $session->setFlashdata('alert', 'success_delete');

        $id_funcionario=$this->request->getVar('id_funcionario');
        $this->funcionario_model

        ->where('id_funcionario', $id_funcionario)
        ->delete();
        return redirect()->to('/funcionarios/index');

    }

    public function ver($id_funcionario){

        $funcionario = $this->funcionario_model

        ->where ('id_funcionario', $id_funcionario)
        ->first();

        $data['funcionario']=$funcionario;

        echo View('templates/header');
        echo View('funcionarios/ver', $data);
        echo View('templates/footer');
    }



}


?>