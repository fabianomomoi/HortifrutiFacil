<?php

/* A conexão com o banco de dados é uma das classes mais importantes em uma aplicação, pois podemos armazenar diversas informações para serem reutilizadas posteriormente pelos usuários.
 * Vamos utilizar o PDO, pois ele fornece uma camada de abstração em relação a conexão com o banco de dados, visto que o PDO efetua a conexão com diversos BDs da mesma maneira, modificando apenas a sua string de conexão. 
 * Criamos uma classe singleton para que tenha maior segurança ao efetuar uma conexão com o banco de dados, pois quando executar o método para retornar a conexão sempre vai ser validado se já existe alguma existente,
 * evitando problemas futuros de stack overflow (estouro de pilha).
 */

namespace App\Lib;

use PDO;
use PDOException;
use Exception;

class Conexao { //Classe seguindo o padrão singleton, isso porque ele previne um possível stack overflow (estouro de pilha).

    private static $connection; //Atributo para armazenar a conexão da instância do PDO.

    private function __construct() { // Método construtor privado para evitar que seja instanciada a classe.
    }

    public static function getConnection() { //Método para retornar a instância da conexão com o banco de dados, utilizando o PDO.
        
        $pdoConfig = DB_DRIVER . ":" . "host=" . DB_HOST . ";" . "dbname=" . DB_NAME . ";"; //Variável que armazena a string de conexão com o banco de dados e os parâmetros. Esses valores são definidos na classe App.

        try {
            if (!isset(self::$connection)) { //Verifica se já existe o atributo connection antes de criar mais uma instancia de conexão com o banco de dados.
                self::$connection = new PDO($pdoConfig, DB_USER, DB_PASSWORD); //Atributo connection recebe a instância da conexão.
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //O erro padrão do PDO é o PDO::ERRMODE_SILENT, mas no nosso código usamos o PDO::ERRMODE_EXCEPTION para que seja lançada uma exceção em caso de erro do PDO.
            }
            return self::$connection; //Retorna a conexão com o banco de dados.
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão com o banco de dados", 500); //Lança uma exceção na aplicação em caso de erro.
        }
    }

}
