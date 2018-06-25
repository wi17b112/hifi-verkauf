<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kundenbewertung
 *
 * @author Raphael
 */
class kundenbewertung {
    //put your code here
    private $kid=null;
    private $umsatzg=null;
    private $gemahntg=null;
    private $kundenstatusid=null;
    
    function __construct($kid, $umsatzg, $gemahntg, $kundenstatusid) {
        $this->kid = $kid;
        $this->umsatzg = $umsatzg;
        $this->gemahntg = $gemahntg;
        $this->kundenstatusid = $kundenstatusid;
    }
    
    function getKid() {
        return $this->kid;
    }

    function getUmsatzg() {
        return $this->umsatzg;
    }

    function getGemahntg() {
        return $this->gemahntg;
    }

    function getKundenstatusid() {
        return $this->kundenstatusid;
    }

    function setKid($kid) {
        $this->kid = $kid;
    }

    function setUmsatzg($umsatzg) {
        $this->umsatzg = $umsatzg;
    }

    function setGemahntg($gemahntg) {
        $this->gemahntg = $gemahntg;
    }

    function setKundenstatusid($kundenstatusid) {
        $this->kundenstatusid = $kundenstatusid;
    }



}
