<?php

/* Essa função, que é padrão do PHP, é executada toda vez que uma classe é 
  instanciada na aplicação, sem que seja necessário importá-la manualmente.
 */
spl_autoload_register(function ($class) {
    //Obtem o diretório do arquivo, que aqui é o diretório raiz da aplicação.
    $base_dir = __DIR__ . '/';
    //Gera o nome do arquivo a ser importado, que deve ser o nome da classe com extensão .php
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';

    //Verifica se existe o arquivo antes de efetuar sua inclusão.
    if (file_exists($file)) {
        /* Inclui o arquivo solicitado, que nesse caso será o caminho completo
         * de uma classe instanciada. 
         * Exemplo: C:\wamp64\www\autoload\App\Controllers\PessoaController.php.
         */
        require_once $file;
    }
});
