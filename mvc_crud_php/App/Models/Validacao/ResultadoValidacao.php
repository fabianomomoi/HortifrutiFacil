<?php

/* Classe que armazena e retorna os erros de validação do model Pessoa. */

namespace App\Models\Validacao;

class ResultadoValidacao { //Classe responsável por armazenar e listar erros de validação.

    private $erros = []; //Atributo que armazena os erros.

    public function addErro($campo, $mensagem) { //Método para armazenar o erro, passando como parâmetro o campo e a mensagem de erro.
        $this->erros[$campo] = $mensagem;
    }

    public function getErros() { //Método para retornar a lista de erros da validação.
        return $this->erros;
    }

}
