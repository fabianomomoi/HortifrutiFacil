<?php

/* Esta classe vai validar as informações da pessoa através do objeto PessoaValidador,
 * que tem a responsabilidade de validar o model Pessoa. 
 * Ela possui o método validar que efetua as condições de validação e retorna um objeto ResultadoValidacao.
 */

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Estado;

class EstadoValidador {

    public function validar(Estado $estado) { //Método responsável por validar as informações. Para isso ele recebe como parâmetro o objeto do model Pessoa.
        $resultadoValidacao = new ResultadoValidacao(); //Cria uma instância do objeto ResultadoValidacao para armazenar erros de validação de forma genérica.

        //Apresenta as regras de validação da aplicação. No método validar podemos criar as regras de acordo com o contexto da aplicação.
        if (empty($estado->getNomestado())) {
            $resultadoValidacao->addErro('nomeestado', "Este campo não pode ser vazio");
        }

        return $resultadoValidacao; //Retorna o objeto contendo a lista de erros.
    }

}
