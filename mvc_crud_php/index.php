<?php

/* O index.php é o arquivo inicial da aplicação. 
 * É ele que recebe as requisições e as direciona para os demais componentes do sistema.
 * Neste caso veremos que o index.php instancia a classe App, que é o núcleo da nossa estrutura de classes.
 * E caso ocorra alguma exceção, temos ainda uma classe Error para renderizar essas mensagens de forma amigável. 
 */

use App\App; //Utilizamos a classe App através do namespace para encapsular os itens, evitando a colisão do mesmo e nomeando o diretório.
use App\Lib\Erro; //Importação da classe Lib\Erro para tratamento de erro na aplicação.

session_start(); //A função session_start() é uma função utilizada para iniciar a sessão de uma aplicação em PHP.

error_reporting(E_ALL & ~E_NOTICE); //Define quais erros devem ser reportados.

//O Required Once é a forma de incluir e informar a aplicação que você precisa incluir um arquivo para ser utilizado. Esta função verificará se o arquivo já foi incluído e, em caso afirmativo, não vai incluí-lo novamente. 
//O autoload é um arquivo de configuração no qual informamos o diretório que conterá as nossas classes. Ele mapeará todos o arquivos.
require_once 'autoload.php'; 

try { //Inicia o tratamento de erro da aplicação.
    $app = new App(); //Instancia o objeto da aplicação.
    $app->run(); //Executando o método para iniciar a aplicação.
} catch (\Exception $e) {
    $oError = new Erro($e); //Instanciando a classe de erro da aplicação.
    $oError->render(); //Renderizando o erro para o usuário.
}