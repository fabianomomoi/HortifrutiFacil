<?php

/* Esta classe vai validar as informações da pessoa através do objeto PessoaValidador,
 * que tem a responsabilidade de validar o model Pessoa. 
 * Ela possui o método validar que efetua as condições de validação e retorna um objeto ResultadoValidacao.
 */

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Pessoa;

class PessoaValidador {

    public function validar(Pessoa $pessoa) { //Método responsável por validar as informações. Para isso ele recebe como parâmetro o objeto do model Pessoa.
        $resultadoValidacao = new ResultadoValidacao(); //Cria uma instância do objeto ResultadoValidacao para armazenar erros de validação de forma genérica.

        //Apresenta as regras de validação da aplicação. No método validar podemos criar as regras de acordo com o contexto da aplicação.
        if (empty($pessoa->getNome())) {
            $resultadoValidacao->addErro('nome', "Este campo não pode ser vazio");
        }

        if (empty($pessoa->getUsuario())) {
            $resultadoValidacao->addErro('usuario', "Este campo não pode ser vazio");
        }

        if (empty($pessoa->getSenha())) {
            $resultadoValidacao->addErro('senha', "Este campo não pode ser vazio");
        }
        if (empty($pessoa->getEmail())) {
            $resultadoValidacao->addErro('email', "Este campo não pode ser vazio");
        }

        return $resultadoValidacao; //Retorna o objeto contendo a lista de erros.
    }

}
