<?php

/* Na classe PessoaDAO e quem tem toda a regra de negócio de persistência com o banco de dados na parte da pessoa. 
 * Esta classe estende a classe BaseDAO, herdando todos os seus métodos de persistência.
 */

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;

class CidadeDAO extends BaseDAO {

    public function consultar($idcid = null) {
        if ($idcid) {
            $resultado = $this->select(
                    "SELECT * FROM cidade c inner join estado e on c.idestado = e.idestado where idcid = $idcid ORDER BY c.idcid"
            );
            $dataSetCidades = $resultado->fetch();
            if ($dataSetCidades) {
                $cidade = new Cidade();
                $cidade->setIdcid($dataSetCidades['idcid']);
                $cidade->setNomecid($dataSetCidades['nomecid']);
                $cidade->getIdestado()->setIdestado($dataSetCidades['idestado']);
                $cidade->getIdestado()->setNomestado($dataSetCidades['nomeestado']);
            }
            return $cidade;
        } else {
            $resultado = $this->select(
                    "SELECT * FROM cidade c inner join estado e on c.idestado = e.idestado ORDER BY c.idcid"
            );
            $dataSetCidades = $resultado->fetchAll();

            if ($dataSetCidades) {
                $listaCidades = [];
                foreach ($dataSetCidades as $dataSetCidade) {
                    $cidade = new Cidade();
                    $cidade->setIdcid($dataSetCidade['idcid']);
                    $cidade->setNomecid($dataSetCidade['nomecid']);
                    $cidade->getIdestado()->setNomestado($dataSetCidade['nomeestado']);
                    $listaCidades[] = $cidade;
                }
                return $listaCidades;
            }
        }
        return false;
    }

    public function inserir(Cidade $cidade) { //Método inserir que recebe como parâmetro o “Model” da pessoa. Este é utilizado no controller pessoa.
        try {
            $idcid = $cidade->getIdcid(); //Variável nome que recebe as informações do “Model” da pessoa.
            $nomecid = $cidade->getNomecid(); //Variável usario que recebe as informações do “Model” da pessoa.
            $idestado = $cidade->getIdestado();
//Método insert herdado da classe BaseDAO. Este método recebe como parâmetro o nome da tabela, o nome das colunas precedido com dois pontos “:”, o array associativo contendo como chave os nomes das colunas, e os valores com as informações a serem incluídas no banco de dados.
            return $this->insert('cidade', ":nomecid", ":idestado", [
                        ':nomecid' => $nomecid,
                        ':idestado' => $idestado
                            ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500); //Lança uma exceção na aplicação em caso de erro.
        }
    }

    public function editar(Cidade $cidade) {
        try {
            $idcid = $cidade->getIdcid();
            $nomecid = $cidade->getNomecid();
            $idestado = $cidade->getIdestado();


            return $this->update('cidade', "nomecid = :nomecid", "idestado = :idestado", [
                        ':idcid' => $idcid,
                        ':nomecid' => $nomecid,
                        ':idestado' => $idestado
                            ], "idcid = :idcid"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Cidade $cidade) {
        try {
            $idcid = $cidade->getIdcid();

            return $this->delete('cidade', "idcid = $idcid");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

    public function QuantidadePessoas($idCid) {
        if ($idCid) {
            $resultado = $this->select("SELECT count(*) as total FROM pessoa where idcid = $idCid");

            return $resultado->fetch()['total'];
        }
        return false;
    }

}
