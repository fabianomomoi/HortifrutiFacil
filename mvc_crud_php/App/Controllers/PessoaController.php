<?php

/* Neste controller vamos ter actions para renderizar páginas de consulta, 
 * insercao, edicao e exclusao. 
 */

namespace App\Controllers;
use App\Models\DAO\EstadoDAO;
use App\Models\DAO\CidadeDAO;
use App\Lib\Sessao;
use App\Models\DAO\PessoaDAO;
use App\Models\Entidades\Pessoa;
use App\Models\Validacao\PessoaValidador;


class PessoaController extends Controller {

    public function consulta() { //Método responsável por exibir a página de listagem de dados:
        $pessoaDAO = new PessoaDAO(); //Criamos uma instância do PessoaDAO para conectar ao Banco de Dados.

        self::setViewParam('listaPessoas', $pessoaDAO->consultar()); //O método setViewParam envia uma lista de pessoas selecionados no BD para ser utilizada na view. Essas informações são solicitadas através do consultar.

        $this->render('/pessoa/pg_consultar'); //Renderiza a view pg_consultar do controller pessoa.

        Sessao::limpaMensagem(); //Limpamos os dados da sessão para evitar manter erros que já foram exibidos em tela.
    }

    public function insercao() {
        $estadoDAO = new EstadoDAO();
        self::setViewParam('listaEstados',$estadoDAO->consultar());
        
        $cidadeDAO = new CidadeDAO();        
        self::setViewParam('listaCidades',$cidadeDAO->consultar());       
        $this->render('/pessoa/pg_inserir'); //Chamamos o método da classe pai para renderizar e passamos como parâmetro a view que queremos renderizar.

        Sessao::limpaFormulario(); //Caso exista algum formulário em sessão usamos a método da classe Sessao para poder limpar o formulário.
        Sessao::limpaMensagem(); //Caso exista alguma mensagem em sessão usamos a método da classe Sessao para limpar a mensagem gravada.
        Sessao::limpaErro();
    }

    public function inserir() { //O método inserir é responsável por armazenar, através da classe PessoaDAO no banco de dados, as informações enviadas para ele.
        //Instanciamos o objeto Pessoa e o alimentamos com as informações recebidas do formulário através dos métodos setters.
        $Pessoa = new Pessoa();
        $Pessoa->setNome($_GET['nome']);
        $Pessoa->setUsuario($_GET['usuario']);
        $Pessoa->setSenha($_GET['senha']);
        $Pessoa->setEmail($_GET['email']);
        $Pessoa->getIdcid()->setIdcid($_GET['idcid']);
        Sessao::gravaFormulario($_GET); //Salvaremos as informações na sessão. Serão gravadas todas as informações do formulário antes de gravar no banco de dados, caso precise recuperar o formulário na view.

        $pessoaValidador = new PessoaValidador(); //Instanciamos a nossa classe responsável pela validação da Pessoa (PessoaValidador).
        $resultadoValidacao = $pessoaValidador->validar($Pessoa); //Criamos uma variável para receber o resultado da validação com o objeto contendo a lista de erros.

        if ($resultadoValidacao->getErros()) { //Verificamos se existe uma lista de erros.
            Sessao::gravaErro($resultadoValidacao->getErros()); //Gravamos os erros através do método da lib Sessao utilizando o método gravaErro para armazenar todos os erros retornados.
            $this->redirect('/pessoa/pg_inserir'); //Redirecionamos para página de cadastro de pessoa.
        }

        $pessoaDAO = new PessoaDAO(); //Instanciamos a classe PessoaDao, responsável por efetuar a persistência das informações no banco de dados.

        $pessoaDAO->inserir($Pessoa); //Utilizamos para isso o método inserir passando o objeto do model.
        //Efetua a limpeza das informações na sessão.
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Pessoa inserida com sucesso!");

        $this->redirect('/pessoa/consulta'); //Redireciona para a lista de pessoas na action index.
    }

    public function edicao($params) { //Este método recebe uma lista de parâmetros, mas neste caso utilizamos apenas um para poder representar o id.
        $id = $params[0]; //Pegamos a posição zero do array que contém a lista de parâmetros, pois este será o nosso id.

        $pessoaDAO = new PessoaDAO(); //Instanciamos o objeto PessoaDAO.

        $pessoa = $pessoaDAO->consultar($id); //Chamamos o método consultar, passando como parâmetro o $id para retornar apenas um pessoa selecionada.

        //Verifica se retorna uma pessoa, caso contrário grava uma mensagem na sessão e redireciona para lista de pessoas.
        if (!$pessoa) {
            Sessao::gravaMensagem("Pessoa inexistente");
            $this->redirect('/pessoa/consulta');
        }
        $cidadeDAO = new CidadeDAO();
        self::setViewParam('listaCidades', $cidadeDAO->consultar());
        
        $estadoDAO = new EstadoDAO();
        self::setViewParam('listaEstados', $cidadeDAO->consultar());
        
        self::setViewParam('pessoa', $pessoa); //Envia as informações da pessoa para a view.

        $this->render('/pessoa/pg_editar'); //Renderiza a view pessoa/pg_editar.php.

        Sessao::limpaMensagem();
    }

    public function editar() { //O método editar é responsável por receber as informações do formulário e persistir em banco de dados utilizando o objeto PessoaDAO. 

        //Vamos instanciar o nosso objeto Pessoa e passar as informações recebidas do formulário.
        $Pessoa = new Pessoa();
        $Pessoa->setId($_GET['id']);
        $Pessoa->setNome($_GET['nome']);
        $Pessoa->setUsuario($_GET['usuario']);
        $Pessoa->setSenha($_GET['senha']);
        $Pessoa->setEmail($_GET['email']);
        $Pessoa->getIdcid()->setIdcid($_GET['idcid']);
        Sessao::gravaFormulario($_GET); //Salva as informações do formulário na sessão.

        $pessoaValidador = new PessoaValidador(); //Instanciamos o objeto para validar as informações recebidas do formulário.
        $resultadoValidacao = $pessoaValidador->validar($Pessoa); //Executamos o método para validar as informações.

        //Verificamos se algum erro existe: caso sim, grava mensagem e redireciona para o view de edição de pessoa. Caso contrário, atualiza as informações da pessoa.
        if ($resultadoValidacao->getErros()) {
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/pessoa/edicao/' . $_GET['id']);
        }

        $pessoaDAO = new PessoaDAO(); //Instancia o objeto PessoaDAO.

        $pessoaDAO->editar($Pessoa); //O método atualizar recebe o objeto Pessoa e persiste no banco de dados.

        //Limpa as informações da sessão.
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaErro();

        Sessao::gravaMensagem("Pessoa alterada com sucesso!");

        $this->redirect('/pessoa/consulta'); //Redireciona para lista de pessoas caso não exista nenhum problema.
    }

    public function exclusao($params) { //Este método é responsável por renderizar uma view para confirmar a exclusão de uma pessoa.
        $id = $params[0]; //A variável $params contém uma lista de parâmetros que são passados através da URL. O primeiro parâmetro está na posição “0” do array, que é o id da pessoa.

        //Após instanciar PessoaDAO utilizamos o método consultar, passando o id da pessoa. Será retornado um único registro contendo a pessoa selecionado.
        $pessoaDAO = new PessoaDAO(); 
        $pessoa = $pessoaDAO->consultar($id);

        //Verificamos se a pessoa existe: caso sim, renderiza a página de confirmação de exclusão. Caso contrário, grava uma mensagem de erro e redireciona para lista de pessoas.
        if (!$pessoa) {
            Sessao::gravaMensagem("Pessoa inexistente");
            $this->redirect('/pessoa/consulta');
        }

        self::setViewParam('pessoa', $pessoa); //Registra as informações da pessoa para que a view possa utilizar.

        $this->render('/pessoa/pg_excluir'); //Renderiza a view.

        Sessao::limpaMensagem(); //Limpa as mensagens de sessão.
    }

    public function excluir() { //Este método é responsável por realizar a exclusão da pessoa no banco de dados.
        
        //Instanciamos o objeto Pessoa e passamos a informação do id da pessoa que queremos excluir.
        $Pessoa = new Pessoa();
        $Pessoa->setId($_GET['id']);

        $pessoaDAO = new PessoaDAO();

        //Utilizamos o objeto pessoaDAO para excluir, executando uma instrução SQL no banco de dados. Caso não identifique a pessoa, será redirecionado para a lista de pessoas, exibindo uma mensagem de erro.
        if (!$pessoaDAO->excluir($Pessoa)) {
            Sessao::gravaMensagem("Pessoa inexistente"); //Caso ocorra tudo certo, gravamos uma mensagem de erro.
            $this->redirect('/pessoa/consulta');
        }

        ////Redireciona para página com a lista de pessoas informando que foi excluída com sucesso.
        Sessao::gravaMensagem("Pessoa excluída com sucesso!"); 
        $this->redirect('/pessoa/consulta');
    }

}
