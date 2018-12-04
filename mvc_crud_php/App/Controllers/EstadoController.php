<?php

/* Neste controller vamos ter actions para renderizar páginas de consulta, 
 * insercao, edicao e exclusao. 
 */

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Estado;
use App\Models\Validacao\EstadoValidador;

class EstadoController extends Controller {

    public function consulta() { //Método responsável por exibir a página de listagem de dados:
        $estadoDAO = new EstadoDAO(); //Criamos uma instância do PessoaDAO para conectar ao Banco de Dados.

        self::setViewParam('listaEstados', $estadoDAO->consultar()); //O método setViewParam envia uma lista de pessoas selecionados no BD para ser utilizada na view. Essas informações são solicitadas através do consultar.

        $this->render('/estado/pg_consultar'); //Renderiza a view pg_consultar do controller pessoa.

        Sessao::limpaMensagem(); //Limpamos os dados da sessão para evitar manter erros que já foram exibidos em tela.
    }

    public function insercao() {
        $this->render('/estado/pg_inserir'); //Chamamos o método da classe pai para renderizar e passamos como parâmetro a view que queremos renderizar.

        Sessao::limpaFormulario(); //Caso exista algum formulário em sessão usamos a método da classe Sessao para poder limpar o formulário.
        Sessao::limpaMensagem(); //Caso exista alguma mensagem em sessão usamos a método da classe Sessao para limpar a mensagem gravada.
        Sessao::limpaErro();
    }

    public function inserir() { //O método inserir é responsável por armazenar, através da classe PessoaDAO no banco de dados, as informações enviadas para ele.
        //Instanciamos o objeto Pessoa e o alimentamos com as informações recebidas do formulário através dos métodos setters.
        $Estado = new Estado();
        $Estado->setNomestado($_GET['nomeestado']);

        Sessao::gravaFormulario($_GET); //Salvaremos as informações na sessão. Serão gravadas todas as informações do formulário antes de gravar no banco de dados, caso precise recuperar o formulário na view.

        $estadoValidador = new EstadoValidador(); //Instanciamos a nossa classe responsável pela validação da Pessoa (PessoaValidador).
        $resultadoValidacao = $estadoValidador->validar($Estado); //Criamos uma variável para receber o resultado da validação com o objeto contendo a lista de erros.

        if ($resultadoValidacao->getErros()) { //Verificamos se existe uma lista de erros.
            Sessao::gravaErro($resultadoValidacao->getErros()); //Gravamos os erros através do método da lib Sessao utilizando o método gravaErro para armazenar todos os erros retornados.
            $this->redirect('/estado/pg_inserir'); //Redirecionamos para página de cadastro de pessoa.
        }

        $estadoDAO = new EstadoDAO(); //Instanciamos a classe PessoaDao, responsável por efetuar a persistência das informações no banco de dados.

        $estadoDAO->inserir($Estado); //Utilizamos para isso o método inserir passando o objeto do model.
        //Efetua a limpeza das informações na sessão.
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Estado inserido com sucesso!");

        $this->redirect('/estado/consulta'); //Redireciona para a lista de pessoas na action index.
    }

    public function edicao($params) { //Este método recebe uma lista de parâmetros, mas neste caso utilizamos apenas um para poder representar o id.
        $idEstado = $params[0]; //Pegamos a posição zero do array que contém a lista de parâmetros, pois este será o nosso id.

        $estadoDAO = new EstadoDAO(); //Instanciamos o objeto PessoaDAO.

        $estado = $estadoDAO->consultar($idEstado); //Chamamos o método consultar, passando como parâmetro o $id para retornar apenas um pessoa selecionada.

        //Verifica se retorna uma pessoa, caso contrário grava uma mensagem na sessão e redireciona para lista de pessoas.
        if (!$estado) {
            Sessao::gravaMensagem("Estado inexistente");
            $this->redirect('/estado/consulta');
        }

        self::setViewParam('estado', $estado); //Envia as informações da pessoa para a view.

        $this->render('/estado/pg_editar'); //Renderiza a view pessoa/pg_editar.php.

        Sessao::limpaMensagem();
    }

    public function editar() { //O método editar é responsável por receber as informações do formulário e persistir em banco de dados utilizando o objeto PessoaDAO. 

        //Vamos instanciar o nosso objeto Pessoa e passar as informações recebidas do formulário.
        $Estado = new Estado();
        $Estado->setIdestado($_GET['idestado']);
        $Estado->setNomestado($_GET['nomeestado']);
        

        Sessao::gravaFormulario($_GET); //Salva as informações do formulário na sessão.

        $estadoValidador = new EstadoValidador(); //Instanciamos o objeto para validar as informações recebidas do formulário.
        $resultadoValidacao = $estadoValidador->validar($Estado); //Executamos o método para validar as informações.

        //Verificamos se algum erro existe: caso sim, grava mensagem e redireciona para o view de edição de pessoa. Caso contrário, atualiza as informações da pessoa.
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/estado/edicao/' . $_GET['idestado']);
        }

        $estadoDAO = new EstadoDAO(); //Instancia o objeto PessoaDAO.

        $estadoDAO->editar($Estado); //O método atualizar recebe o objeto Pessoa e persiste no banco de dados.

        //Limpa as informações da sessão.
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Cidade alterada com sucesso!");

        $this->redirect('/estado/consulta'); //Redireciona para lista de pessoas caso não exista nenhum problema.
    }

    public function exclusao($params) { //Este método é responsável por renderizar uma view para confirmar a exclusão de uma pessoa.
        $idEstado = $params[0]; //A variável $params contém uma lista de parâmetros que são passados através da URL. O primeiro parâmetro está na posição “0” do array, que é o id da pessoa.

        //Após instanciar PessoaDAO utilizamos o método consultar, passando o id da pessoa. Será retornado um único registro contendo a pessoa selecionado.
        $estadoDAO = new EstadoDAO(); 
        $estado = $estadoDAO->consultar($idEstado);

        //Verificamos se a pessoa existe: caso sim, renderiza a página de confirmação de exclusão. Caso contrário, grava uma mensagem de erro e redireciona para lista de pessoas.
        if (!$estado) {
            Sessao::gravaMensagem("Estado inexistente");
            $this->redirect('/estado/consulta');
        }

        self::setViewParam('estado', $estado); //Registra as informações da pessoa para que a view possa utilizar.

        $this->render('/estado/pg_excluir'); //Renderiza a view.

        Sessao::limpaMensagem(); //Limpa as mensagens de sessão.
    }

    public function excluir() { //Este método é responsável por realizar a exclusão da pessoa no banco de dados.
        
        //Instanciamos o objeto Pessoa e passamos a informação do id da pessoa que queremos excluir.
        $Estado = new Estado();
        $Estado->setIdestado($_GET['idestado']);

        $estadoDAO = new EstadoDAO();

        
        //Utilizamos o objeto pessoaDAO para excluir, executando uma instrução SQL no banco de dados. Caso não identifique a pessoa, será redirecionado para a lista de pessoas, exibindo uma mensagem de erro.
        if (!$estadoDAO->excluir($Estado)) {
            Sessao::gravaMensagem("Estado inexistente"); //Caso ocorra tudo certo, gravamos uma mensagem de erro.
            $this->redirect('/estado/consulta');
        }

        ////Redireciona para página com a lista de pessoas informando que foi excluída com sucesso.
        Sessao::gravaMensagem("Estado excluído com sucesso!"); 
        $this->redirect('/estado/consulta');
    }

}
