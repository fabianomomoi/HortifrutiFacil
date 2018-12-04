<?php

/* A model Pessoa, possui os atributos que espelham a estrutura do nosso banco de dados. */

namespace App\Models\Entidades;

class Usuario {

    //Os atributos da model Pessa têm os mesmos nomes utilizados na tabela pessoa do banco de dados.
    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $cpf;
    private $usuario;
    private $senha;

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

    public function getSobrenome() {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome) {
        $this->sobrenome = $sobrenome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
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

    

}
