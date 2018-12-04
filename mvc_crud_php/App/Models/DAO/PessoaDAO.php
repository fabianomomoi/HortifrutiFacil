<?php

/* Na classe PessoaDAO e quem tem toda a regra de negócio de persistência com o banco de dados na parte da pessoa. 
 * Esta classe estende a classe BaseDAO, herdando todos os seus métodos de persistência.
 */

namespace App\Models\DAO;

use App\Models\Entidades\Pessoa;

class PessoaDAO extends BaseDAO {

    public function consultar($id = null) {
        if ($id) {
            $resultado = $this->select(
                    "    SELECT * FROM pessoa p inner join cidade c on p.idcid = c.idcid inner join estado e on c.idestado = e.idestado where id = $id ORDER BY p.id"
            );
            $dataSetPessoas = $resultado->fetch();
            if ($dataSetPessoas) {
                $pessoa = new Pessoa();
                $pessoa->setId($dataSetPessoas['id']);
                $pessoa->setNome($dataSetPessoas['nome']);
                $pessoa->setUsuario($dataSetPessoas['usuario']);
                $pessoa->setSenha($dataSetPessoas['senha']);
                $pessoa->setEmail($dataSetPessoas['email']);
                $pessoa->getIdcid()->setIdcid($dataSetPessoas['idcid']);
                $pessoa->getIdcid()->setNomecid($dataSetPessoas['nomecid']);

            }
            return $pessoa;
        } else {
            $resultado = $this->select(
                 "    SELECT * FROM pessoa p inner join cidade c on p.idcid = c.idcid inner join estado e on c.idestado = e.idestado ORDER BY p.id"

            );
            $dataSetPessoas = $resultado->fetchAll();

            if ($dataSetPessoas) {
                $listaPessoas = [];
                foreach ($dataSetPessoas as $dataSetPessoa) {
                    $pessoa = new Pessoa();
                    $pessoa->setId($dataSetPessoa['id']);
                    $pessoa->setNome($dataSetPessoa['nome']);
                    $pessoa->setUsuario($dataSetPessoa['usuario']);
                    $pessoa->setSenha($dataSetPessoa['senha']);
                    $pessoa->setEmail($dataSetPessoa['email']);
                    $pessoa->getIdcid()->setNomecid($dataSetPessoa['nomecid']);
                    $pessoa->getIdcid()->getIdestado()->setNomestado($dataSetPessoa['nomeestado']);
                    $listaPessoas[] = $pessoa;
                }
                return $listaPessoas;
            }
        }
        return false;
    }

    public function inserir(Pessoa $pessoa) { //Método inserir que recebe como parâmetro o “Model” da pessoa. Este é utilizado no controller pessoa.
        try {
            $nome = $pessoa->getNome(); //Variável nome que recebe as informações do “Model” da pessoa.
            $usuario = $pessoa->getUsuario(); //Variável usario que recebe as informações do “Model” da pessoa.
            $senha = $pessoa->getSenha(); //Variável senha que recebe as informações do “Model” da pessoa.
            $email = $pessoa->getEmail(); //Variável senha que recebe as informações do “Model” da pessoa.
            $idcid = $pessoa->getIdcid()->getIdcid();
            //Método insert herdado da classe BaseDAO. Este método recebe como parâmetro o nome da tabela, o nome das colunas precedido com dois pontos “:”, o array associativo contendo como chave os nomes das colunas, e os valores com as informações a serem incluídas no banco de dados.
            return $this->insert('pessoa', ":nome, :usuario, :senha, :email, :idcid", [
                        ':nome' => $nome,
                        ':usuario' => $usuario,
                        ':senha' => $senha,
                        ':email' => $email,
                        ':idcid' => $idcid
                            ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500); //Lança uma exceção na aplicação em caso de erro.
        }
    }

    public function editar(Pessoa $pessoa) {
        try {

            $id = $pessoa->getId();
            $nome = $pessoa->getNome();
            $usuario = $pessoa->getUsuario();
            $senha = $pessoa->getSenha();
            $email = $pessoa->getEmail();
            $idcid = $pessoa->getIdcid()->getIdcid();

            return $this->update('pessoa', "nome = :nome, usuario = :usuario, senha = :senha, email = :email, idcid = :idcid", [
                        ':id' => $id,
                        ':nome' => $nome,
                        ':usuario' => $usuario,
                        ':senha' => $senha,
                        ':email' => $email,
                        ':idcid' => $idcid
                            ], "id = :id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Pessoa $pessoa) {
        try {
            $id = $pessoa->getId();

            return $this->delete('pessoa', "id = $id");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

}
