<?php

namespace App\Controller;

use \Core\View;
use \App\Model\Usuario;

/**
 * UsuarioController CRUD de usuario
 *
 */
class UsuarioController extends \Core\Controller
{

    /**
     * Todos os usuários
     *
     * @return void
     */
    public function indexAction()
    {
        $usuarioDAO = new Usuario();

        $itensPerPage = 10;
        if(isset($_GET['itensPerPage']))
            $itensPerPage = $_GET['itensPerPage'];
        
        $pagina = 1;
        if(isset($_GET['pagina']))
            $pagina = $_GET['pagina'];

        $entities = $usuarioDAO->getAllPagination($pagina, $itensPerPage);

        $total = $usuarioDAO->getTotal();

        $totalPaginas = ceil($total / $itensPerPage);      

        View::renderTemplate('Usuario/index.html',['entity'=>$usuarioDAO,'entities'=>$entities,'total'=>$total,'pagina'=>$pagina,'itensPerPage'=>$itensPerPage,'totalPaginas'=>$totalPaginas]);
    }

    /**
     * Novo usuário
     *
     * @return void
     */
    public function insertAction()
    {
        $usuarioDAO = new Usuario();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dados = $_POST;
            if(array_key_exists('ativo',$dados)){
                $dados['ativo'] = 1;
            } else {
                $dados['ativo'] = 0;
            }
            $dados['senha'] = md5($dados['senha']);

            $resp = $usuarioDAO->insert($dados);
            if($resp){
                header('Location: /usuarios');
	            exit;
            }
            // die(var_dump($resp));
        }

        View::renderTemplate('Usuario/form.html',['entity'=>$usuarioDAO]);
    }

    /**
     * Show the nova page
     *
     * @return void
     */
    public function novaAction()
    {        
        $usuarioDAO = new Usuario();
        // $usuarioDAO->criarTabela();
        // $usuarioDAO->dadosIniciais();
        $result = $usuarioDAO->getAll();

        $metodoHTTP = $_SERVER['REQUEST_METHOD'];

        View::renderTemplate('Home/nova.html', ['usuarios'=>$result, 'metodo'=> $metodoHTTP]);
    }    

    /**
     * exemplo de tratar e renderizar com variavel de rota
     *
     * @return void
     */
    public function umUsuarioAction()
    {
        $usuarioDAO = new Usuario();        

        $result = $usuarioDAO->getOne($this->route_params['id']);

        $metodoHTTP = $_SERVER['REQUEST_METHOD'];

        View::renderTemplate('Usuario/ver-usuario.html', ['usuario'=>$result, 'metodo'=> $metodoHTTP]);
    }    
}