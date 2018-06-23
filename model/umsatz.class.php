<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of umsatz
 *
 * @author Raphael
 */
class umsatz {
    //put your code here
    private $kid=null;
    private $vorname=null;
    private $nachname=null;
    private $bid=null;
    private $umsatz;
    
    function __construct($kid, $vorname, $nachname, $bid, $umsatz) {
        $this->kid = $kid;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->bid = $bid;
        $this->umsatz = $umsatz;
    }

    function getKid() {
        return $this->kid;
    }

    function getVorname() {
        return $this->vorname;
    }

    function getNachname() {
        return $this->nachname;
    }

    function getBid() {
        return $this->bid;
    }

    function getUmsatz() {
        return $this->umsatz;
    }

    function setKid($kid) {
        $this->kid = $kid;
    }

    function setVorname($vorname) {
        $this->vorname = $vorname;
    }

    function setNachname($nachname) {
        $this->nachname = $nachname;
    }

    function setBid($bid) {
        $this->bid = $bid;
    }

    function setUmsatz($umsatz) {
        $this->umsatz = $umsatz;
    }


            
}
