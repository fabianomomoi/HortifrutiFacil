<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models\Entidades;

/**
 * Description of Cidade
 *
 * @author PC 05
 */
class Cidade {

    private $idcid;
    private $nomecid;
    private $idestado;

    function __construct() {
        $this->idestado = new Estado();
    }

    function getIdestado() {
        return $this->idestado;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }

    function getIdcid() {
        return $this->idcid;
    }

    function getNomecid() {
        return $this->nomecid;
    }

    function setIdcid($idcid) {
        $this->idcid = $idcid;
    }

    function setNomecid($nomecid) {
        $this->nomecid = $nomecid;
    }

}
