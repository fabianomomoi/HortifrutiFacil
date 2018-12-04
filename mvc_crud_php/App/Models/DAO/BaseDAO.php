<?php

/* Na classe BaseDAO vamos tratar a persistência com o banco de dados utilizando como referência os métodos do PDO.*/

namespace App\Models\DAO;

use App\Lib\Conexao;

abstract class BaseDAO {

    private $conexao;
    
    public function __construct() { ////No método construtor chamamos a conexão com o banco de dados através de um método estático.
        $this->conexao = Conexao::getConnection();
    }

    public function select($sql) { ////O método select é responsável por executar uma query SQL no banco de dados e retornar o resultado em caso de sucesso
        if (!empty($sql)) { //Verifica caso a query enviada, através do parâmetro $sql, seja vazia e não executa.
            return $this->conexao->query($sql); //Executa a query SQL utilizando o método do PDO para execução.
        }
    }

    //A persistência com o banco de dados é feita através de instruções SQL.
    public function insert($table, $cols, $values) { //Método para efetuar a inclusão de dados no banco através de uma instrução SQL, utilizando prepare e execute, que são métodos do objeto PDO do PHP.
        if (!empty($table) && !empty($cols) && !empty($values)) { //Valida se os parâmetros estão vazios, pois neste método não pode existir nenhum parâmetro vazio.
            $parametros = $cols; //A variável parametros recebe as informações das colunas que devem ser persistidas no banco de dados. Esta informação é passada através da classe PessoaDAO utilizando o formato exigido pelo PDO ":nome,:usuario,:senha", onde cada coluna é referenciada com dois pontos “:”<nome coluna>.
            $colunas = str_replace(":", "", $cols); //A variável coluna será responsável por informar ao comando quais são as colunas. Precisamos neste momento remover os dois pontos para que a instrução SQL seja montada conforme o padrão.
         
            $stmt = $this->conexao->prepare("INSERT INTO $table ($colunas) VALUES ($parametros)"); //INSERT INTO pessoa (nome,usuario,senha) VALUES (:nome,:usuario,:senha);   
            $stmt->execute($values); //Agora vamos executar, através do atributo conexão, o prepare no banco de dados para validar e montar a instrução SQL.

            return $stmt->rowCount(); //// Caso esteja tudo funcionando com a estrutura prepare, é executada a persistência no banco de dados através do método execute, passando os valores para ele. Estes vem através de um array, que é um índice com o nome da coluna seguido de dois ponto - ":nome,:usuario,:senha".
        } else {
            return false;
        }
    }

    public function update($table, $cols, $values, $where = null) {
        if (!empty($table) && !empty($cols) && !empty($values)) {
            if ($where) {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("UPDATE $table SET $cols $where");
            $stmt->execute($values);

            return $stmt->rowCount();
        } else {
            return false;
        }
    }

    public function delete($table, $where = null) {
        if (!empty($table)) {
            /*
              DELETE pessoa WHERE id = 1
             */

            if ($where) {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("DELETE FROM $table $where");
            $stmt->execute();

            return $stmt->rowCount();
        } else {
            return false;
        }
    }

}
