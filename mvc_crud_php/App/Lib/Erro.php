<?php

/* A classe Error foi criada com a finalidade de renderização de erros em uma forma amigável para o usuário,
 *  baseando-se nos códigos de status do HTTP (400, 404, 500, etc.). 
 * Para cada situação essa classe exibe uma view com os dados do problema.*/

namespace App\Lib; //Foi utilizado o namespace para encapsular as libs da aplicação.

use Exception; //Exception é uma classe de tratamento de erro do PHP.

class Erro {

    private $message; //Variável privada responsável por armazenar as informações de exceções.
    private $code; //Variável privada responsável por armazenar o código de erro.

    public function __construct($objetoException = Exception::class) { //Método construtor da classe que recebe o objeto Exception.
        $this->code = $objetoException->getCode(); //Recebendo código de erro do objeto Exception.
        $this->message = $objetoException->getMessage(); //Recebendo mensagem de erro objeto Exception.
    }

    public function render() { //Método responsável por renderizar uma view de erro.
        $varMessage = $this->message; //Variável responsável por injetar informações na view.

        if (file_exists(PATH . "/App/Views/error/" . $this->code . ".php")) { //Função para verificar se o arquivo existe.
            require_once PATH . "/App/Views/error/" . $this->code . ".php"; //Inclui o arquivo na aplicação e renderiza.
        } else { // Caso não encontre o arquivo solicitado inclui o arquivo 500.php, por padrão.
            require_once PATH . "/App/Views/error/500.php";
        }
        exit; //Finaliza a aplicação para que nada seja executado após o erro.
    }

}
