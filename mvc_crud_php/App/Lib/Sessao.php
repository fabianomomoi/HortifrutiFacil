<?php

/* A classe Sessao é responsável pela manipulação da informação que nossa aplicação utiliza. 
 * Ela é armazenada em sessão utilizando variável superglobal $_SESSION. 
 * A variável global de sessão armazena informações que ficam disponíveis em todo escopo. 
 * Foi criada uma classe para fazer o tratamento desta informação deixando, de uma forma mais genérica e reutilizável.
 */

namespace App\Lib;

class Sessao {

    public static function gravaMensagem($mensagem) { //O método é responsável por definir uma mensagem em sessão para ser utilizada em toda a aplicação até ela ser removida.
        $_SESSION['mensagem'] = $mensagem; //A informação é armazenada na variável “superglobal”. Isso significa que ela está disponível em todos os escopos pelo script.
    }

    public static function limpaMensagem() { //O método é responsável por limpar uma mensagem em sessão.
        unset($_SESSION['mensagem']); //A informação é removida após executar unset, que destrói esta variável.
    }

    public static function retornaMensagem() { //O método é responsável por retornar a mensagem gravada em sessão.
        return ($_SESSION['mensagem']) ? $_SESSION['mensagem'] : ""; //Caso exista uma mensagem, ela será retornada. Senão, retorna vazio.
    }

    public static function gravaFormulario($form) { //Método responsável por gravar um formulário na sessão para ser utilizado em todo o sistema.
        $_SESSION['form'] = $form; //Armazena o formulário em sessão.
    }

    public static function limpaFormulario() { //Limpa o formulário da sessão.
        unset($_SESSION['form']); //Através da função unset destrói a variável da sessão.
    }

    public static function retornaValorFormulario($key) { //Através do parâmetro informado retorna a informação na posição do array do formulário.
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : ""; //Caso exista a chave solicitada do array no formulário retorna o valor dele. Caso contrário, retorna vazio.
    }

    public static function existeFormulario() { //Verifica se algum formulário existe registrado na sessão.
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : ""; //Caso não exista, retorna vazio.
    }

    public static function gravaErro($erros) {
        $_SESSION['erro'] = $erros;
    }

    public static function retornaErro() {
        return (isset($_SESSION['erro'])) ? $_SESSION['erro'] : false;
    }

    public static function limpaErro() {
        unset($_SESSION['erro']);
    }

}
