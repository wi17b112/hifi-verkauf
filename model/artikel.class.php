<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of artikel
 *
 * @author Raphael
 */
class artikel {
    //put your code here
    private $artikelid=null;
    private $artikelname=null;
    private $verkaufspreis=null;
    private $lagerstand=null;
    private $aktiv=null;
    
    function __construct($artikelid, $artikelname, $verkaufspreis, $lagerbestand, $aktiv) {
        $this->artikelid = $artikelid;
        $this->artikelname = $artikelname;
        $this->verkaufspreis = $verkaufspreis;
        $this->lagerstand = $lagerbestand;
        $this->aktiv = $aktiv;
    }

    
    function getArtikelid() {
        return $this->artikelid;
    }

    function getArtikelname() {
        return $this->artikelname;
    }

    function getVerkaufspreis() {
        return $this->verkaufspreis;
    }

    function getLagerstand() {
        return $this->lagerstand;
    }

    function getAktiv() {
        return $this->aktiv;
    }

    function setArtikelid($artikelid) {
        $this->artikelid = $artikelid;
    }

    function setArtikelname($artikelname) {
        $this->artikelname = $artikelname;
    }

    function setVerkaufspreis($verkaufspreis) {
        $this->verkaufspreis = $verkaufspreis;
    }

    function setLagerstand($lagerbestand) {
        $this->lagerstand = $lagerbestand;
    }

    function setAktiv($aktiv) {
        $this->aktiv = $aktiv;
    }


}
