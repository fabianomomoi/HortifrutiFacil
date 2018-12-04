<?php

/* A classe App é a principal da nossa aplicação, pois é responsável por tratar 
 * as solicitações e integrar os componentes da aplicação.
 */

namespace App;

use App\Controllers\HomeController; //Classe HomeController é o controlador principal.
use Exception; //Classe do sistema para mensagens de erro.

class App {

    private $controller; //Variável responsável por armazenar o objeto do controller selecionado.
    private $controllerFile; //Variável responsável por armazenar o nome do controller a ser executado.
    private $action; //Variável responsável por armazenar o nome da action.
    private $params; //Variável responsável por armazenar os parâmetros da aplicação.
    public $controllerName; //Variável responsável por armazenar o nome do controller.

    public function __construct() {
        // Constantes do sistema
        define('APP_HOST', $_SERVER['HTTP_HOST'] . "/mvc_crud_php"); //Constante responsável por armazenar qual diretório a aplicação vai ser rodada.
        define('PATH', realpath('./')); //Constante responsável por armazenar o PATH para utilização interna da aplicação.
        define('TITLE', "CRUD com PHP");
        define('DB_HOST', "localhost"); //Constante responsável por armazenar o host da conexão com o banco de dados.
        define('DB_USER', "postgres"); //Constante responsável por armazenar o usuário de conexão com o banco de dados.
        define('DB_PASSWORD', "123456"); //Constante responsável por armazenar a senha de conexão com o banco de dados.
        define('DB_NAME', "mvc_banco"); //Constante responsável por armazenar nome do banco de dados.
        define('DB_DRIVER', "pgsql"); //Constante responsável por armazenar driver de conexão com o banco de dados.

        $this->url(); //Execução do método responsável por tratar a URL amigável.
    }

    // O método run() é o principal da classe App. É ele que que inicia as rotas da aplicação através da URL amigável e instancia os objetos dos controllers baseado no que foi solicitado.
    public function run() {
        if ($this->controller) { //Verifica se tem algum controlador definido através do atributo controller.
            $this->controllerName = ucwords($this->controller) . 'Controller'; //Caso exista, trata o resultado utilizando a função ucwords, convertendo para maiúsculas o primeiro caractere, concatenado com palavra Controller.
            $this->controllerName = preg_replace('/[^a-zA-Z]/i', '', $this->controllerName); //Utiliza a expressão regular para remover qualquer caractere diferente de (A até Z e a até z).
        } else {
            $this->controllerName = "HomeController"; //Se não encontrar nenhum controller, por padrão, o atributo controller recebe como padrão “HomeController”.
        }

        $this->controllerFile = $this->controllerName . '.php'; //O atributo controllerFile recebe o nome da classe controller e concatena com a extensão PHP para que seja verificada a existência deste arquivo mais a frente.
        $this->action = preg_replace('/[^a-zA-Z]/i', '', $this->action); //Atributo action recebe o seu nome utilizando a expressão regular para remover qualquer caractere diferente de (A até Z e a até z).

        if (!$this->controller) { //Caso o atributo controller não tenha sido definido, a aplicação instanciará HomeController.
            $this->controller = new HomeController($this); //O atributo controller vai receber a instância do HomeController.
            $this->controller->index(); //O objeto executará o método index(), por padrão.
        }

        if (!file_exists(PATH . '/App/Controllers/' . $this->controllerFile)) { //Verifica se arquivo da classe controller solicitada existe.
            throw new Exception("Página não encontrada.", 404); //Se não existir, vai ser executada uma exceção no sistema.
        }

        $nomeClasse = "\\App\\Controllers\\" . $this->controllerName; //A variável $nomeClasse recebe o nome com caminho completo da classe controller.
        $objetoController = new $nomeClasse($this); //A variável $objetoController recebe a instância do objeto controller solicitado.

        if (!class_exists($nomeClasse)) { //Verifica se a classe solicitada existe através da função nativa do PHP.
            throw new Exception("Erro na aplicação", 500); //Caso não exista, vai ser executada uma exceção no sistema.
        }

        if (method_exists($objetoController, $this->action)) { //Verifica se método da classe instanciada existe através da função nativa do PHP.
            $objetoController->{$this->action}($this->params); //Se existir, executará o método solicitado.
            return;
        } else if (!$this->action && method_exists($objetoController, 'index')) { //Se não existir nenhum método e a classe existir o método index será executado.
            $objetoController->index($this->params);
            return;
        } else {
            throw new Exception("Nosso suporte já esta verificando desculpe!", 500); // Se nenhuma opção for executada nesta validação, vai ser executada uma exceção.
        }
        throw new Exception("Página não encontrada.", 404); //Se nenhuma opção for executada vai ser executada uma exceção.
    }

    
    // O método url() foi criado para converter a URL solicitada e traduzir essa solicitação para a aplicação, de maneira que seja possível identificar qual controller e método foi solicitado.
    public function url() {

        if (isset($_GET['url'])) { //Utiliza a função isset para validar se esta variável foi criada.
            $path = $_GET['url']; //Cria a variável $url, recebendo valor da URL através do $_GET.
            $path = rtrim($path, '/'); //Retira espaços em branco do final da string recebida.
            $path = filter_var($path, FILTER_SANITIZE_URL); //Remove caracteres inválidos de uma URL.

            $path = explode('/', $path); //Separa a URL através de “/” e transforma em um array com a função explodedo PHP.

            $this->controller = $this->verificaArray($path, 0); //Atributo controller recebe o valor da posição 0 do array. Esta posição será o controller passado na URL.
            $this->action = $this->verificaArray($path, 1); //Atributo action recebe valor da posição 1 do array. Esta posição será a action.

            if ($this->verificaArray($path, 2)) { //Verifica se existe informações na posição 2 do array. Nesta posição serão passados os nossos parâmetros a URL.
                unset($path[0]); //Através da função unset a variável será eliminada.
                unset($path[1]);
                $this->params = array_values($path); //Atributo params recebe todas as posições do array, exceto das posições 0 e 1.
            }
        }
    }

    public function getController() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function getControllerName() {
        return $this->controllerName;
    }

    private function verificaArray($array, $key) {
        if (isset($array[$key]) && !empty($array[$key])) { //verificando se existe array com a posição solicitada (lembrando que o valor deste não pode ser nulo):
            return $array[$key]; //retorno do valor da posição solicitada, ou nulo.
        }
        return null;
    }

}
