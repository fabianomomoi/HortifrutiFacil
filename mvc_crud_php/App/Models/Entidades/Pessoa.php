<?php

/* A model Pessoa, possui os atributos que espelham a estrutura do nosso banco de dados. */

namespace App\Models\Entidades;

class Pessoa {

    //Os atributos da model Pessa têm os mesmos nomes utilizados na tabela pessoa do banco de dados.
    private $id;
    private $nome;
    private $usuario;
    private $senha;
    private $email;
    private $idcid;
    private $idestado;

    function __construct() {
        $this->idcid = new Cidade();
    }

        function getIdcid() {
        return $this->idcid;
    }

    function setIdcid($idcid) {
        $this->idcid = $idcid;
    }

    //Gets e Setters do model.
    public function getId() {
        return $this->id;
    }
    

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    function getEmail() {
        return $this->email;
    }

    function setEmail($email) {
        $this->email = $email;
    }

}
