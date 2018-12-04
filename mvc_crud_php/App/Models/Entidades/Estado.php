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
 */class Estado {
    private $idestado;
    private $nomestado;
        
    function getIdestado() {
        return $this->idestado;
    }

    function getNomestado() {
        return $this->nomestado;
    }

    function setIdestado($idestado) {
        $this->idestado = $idestado;
    }

    function setNomestado($nomestado) {
        $this->nomestado = $nomestado;
    }




}

