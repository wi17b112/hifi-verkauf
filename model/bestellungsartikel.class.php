<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bestellungsartikel
 *
 * @author Raphael
 */
class bestellungsartikel {
    //put your code here
    private $bid= null;
    private $aid= null;
    private $artikelname= null;
    private $verkaufspreis= null;
    private $anzahl= null;
    private $gesamt= null;
    
    function __construct($bid, $aid, $artikelname, $verkaufspreis, $anzahl, $gesamt) {
        $this->bid = $bid;
        $this->aid = $aid;
        $this->artikelname = $artikelname;
        $this->verkaufspreis = $verkaufspreis;
        $this->anzahl = $anzahl;
        $this->gesamt = $gesamt;
    }

    function getBid() {
        return $this->bid;
    }

    function getAid() {
        return $this->aid;
    }

    function getArtikelname() {
        return $this->artikelname;
    }

    function getVerkaufspreis() {
        return $this->verkaufspreis;
    }

    function getAnzahl() {
        return $this->anzahl;
    }

    function getGesamt() {
        return $this->gesamt;
    }

    function setBid($bid) {
        $this->bid = $bid;
    }

    function setAid($aid) {
        $this->aid = $aid;
    }

    function setArtikelname($artikelname) {
        $this->artikelname = $artikelname;
    }

    function setVerkaufspreis($verkaufspreis) {
        $this->verkaufspreis = $verkaufspreis;
    }

    function setAnzahl($anzahl) {
        $this->anzahl = $anzahl;
    }

    function setGesamt($gesamt) {
        $this->gesamt = $gesamt;
    }


}
