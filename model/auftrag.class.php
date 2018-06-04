<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auftrag
 *
 * @author Raphael
 */
class auftrag {
    private $auftragid=null;
    private $kunde=null;
    private $artikel=null;
    
    function __construct($auftragid, $kunde, $artikel) {
        $this->auftragid = $auftragid;
        $this->kunde = $kunde;
        $this->artikel = $artikel;
    }

    
    function getAuftragid() {
        return $this->auftragid;
    }

    function getKunde() {
        return $this->kunde;
    }

    function getArtikel() {
        return $this->artikel;
    }

    function setAuftragid($auftragid) {
        $this->auftragid = $auftragid;
    }

    function setKunde($kunde) {
        $this->kunde = $kunde;
    }

    function setArtikel($artikel) {
        $this->artikel = $artikel;
    }


}
