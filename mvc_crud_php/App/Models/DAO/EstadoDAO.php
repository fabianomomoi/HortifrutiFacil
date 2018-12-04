<?php

/* Na classe PessoaDAO e quem tem toda a regra de negócio de persistência com o banco de dados na parte da pessoa. 
 * Esta classe estende a classe BaseDAO, herdando todos os seus métodos de persistência.
 */

namespace App\Models\DAO;

use App\Models\Entidades\Estado;

class EstadoDAO extends BaseDAO {

    public function consultar($idestado = null) {
        if ($idestado) {
            $resultado = $this->select(
                    "SELECT * FROM estado WHERE idestado = $idestado"
            );

            $dataSetEstados = $resultado->fetch();
            if ($dataSetEstados) {
                $estado = new Estado();
                $estado->setIdestado($dataSetEstados['idestado']);
                $estado->setNomestado($dataSetEstados['nomeestado']);
            }
            return $estado;
        } else {
            $resultado = $this->select(
                    'select * from estado'
            );
            $dataSetEstados = $resultado->fetchAll();

            if ($dataSetEstados) {
                $listaEstados = [];
                foreach ($dataSetEstados as $dataSetEstado) {
                    $estado = new Estado();
                    $estado->setIdestado($dataSetEstado['idestado']);
                    $estado->setNomestado($dataSetEstado['nomeestado']);
                    $listaEstados[] = $estado;
                }
                return $listaEstados;
            }
        }
        return false;
    }

    public function inserir(Estado $estado) { //Método inserir que recebe como parâmetro o “Model” da pessoa. Este é utilizado no controller pessoa.
        try {
            $idestado = $estado->getIdestado(); //Variável nome que recebe as informações do “Model” da pessoa.
            $nomestado = $estado->getNomestado(); //Variável usario que recebe as informações do “Model” da pessoa.
            //Método insert herdado da classe BaseDAO. Este método recebe como parâmetro o nome da tabela, o nome das colunas precedido com dois pontos “:”, o array associativo contendo como chave os nomes das colunas, e os valores com as informações a serem incluídas no banco de dados.
            return $this->insert('estado', ":nomeestado", [
                        ':nomeestado' => $nomestado
                            ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500); //Lança uma exceção na aplicação em caso de erro.
        }
    }

    public function editar(Estado $estado) {
        try {

            $idestado = $estado->getIdestado();
            $nomestado = $estado->getNomestado();


            return $this->update('estado', "nomeestado = :nomeestado", [
                        ':idestado' => $idestado,
                        ':nomeestado' => $nomestado
                            ], "idestado = :idestado"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Estado $estado) {
        try {
            $idestado = $estado->getIdestado();

            return $this->delete('estado', "idestado = $idestado");
        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }

}
