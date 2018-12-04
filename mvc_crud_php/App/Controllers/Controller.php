<?php

/* A aplicação foi desenvolvida utilizando PHP com os padrões de arquitetura MVC, 
 * criamos uma página principal “home” e uma página de “cadastro de pessoa”. 
 * Foi utilizado framework Bootstrap e jQuery na estrutura front-end. 
 * O controller pai da aplicação é responsável por fornecer métodos importantes
 * como o de renderizar uma view, assim como outros.
 */

namespace App\Controllers;

use App\Lib\Sessao;

abstract class Controller
{
    protected $app; // Atributo app responsável por receber objeto da classe App.
    private $viewVar; //Atributo viewVar responsável para injetar array de informações para view.

    public function __construct($app)
    {
        $this->setViewParam('nameController',$app->getControllerName()); //Seta na variável do array com a chave nameController o valor do controller selecionado.
        $this->setViewParam('nameAction',$app->getAction());
    }

    public function render($view) //Método para renderizar a view.
    {
        $viewVar   = $this->getViewVar(); //Pega o array de informações e envia para view.
        $Sessao    = Sessao::class; 

        require_once PATH . '/App/Views/layouts/header.php'; //Utiliza a função required_once para incluir arquivo header.php.
        require_once PATH . '/App/Views/layouts/menu.php'; //Utiliza a função required_once para incluir arquivo menu.php.
        require_once PATH . '/App/Views/' . $view . '.php'; //Utiliza a função required_once para incluir um arquivo que o nome será definido através da atributo $view passado no método render.
        require_once PATH . '/App/Views/layouts/footer.php'; //Utiliza a função required_once para incluir o arquivo footer.php
    }

    public function redirect($view) //Método utilizado para redirecionar utilizando a função header nativa do PHP.
    {
        header('Location: http://' . APP_HOST . $view); //Header é usado para enviar um cabeçalho HTTP bruto, como um redirecionamento, um cabeçalho JSON.
        exit; //Saí da aplicação para evitar execuções posteriores.
    }

    public function getViewVar() //Método utilizado para retornar informações injetadas na view.
    {
        return $this->viewVar;
    }

    public function setViewParam($varName, $varValue) //Método utilizado para injetar informações na view.
    {
        if ($varName != "" && $varValue != "") {
            $this->viewVar[$varName] = $varValue; //Monta um array com as informações passadas pelo método.
        }
    }
}