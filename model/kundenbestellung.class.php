<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Raphael
 */
class kundenbestellung {
    //put your code here
    private $kid=null;
    private $bid=null;
    private $status=null;
    private $zbid=null;
    private $bezahlt=null;
    private $teillieferung=null;
    private $erstelldatum=null;
    private $gemahnt=null;
    
    function __construct($kid, $bid, $status, $zbid, $bezahlt, $teillieferung, $erstelldatum, $gemahnt) {
        $this->kid = $kid;
        $this->bid = $bid;
        $this->status = $status;
        $this->zbid = $zbid;
        $this->bezahlt = $bezahlt;
        $this->teillieferung = $teillieferung;
        $this->erstelldatum = $erstelldatum;
        $this->gemahnt = $gemahnt;
    }

    function getKid() {
        return $this->kid;
    }

    function getBid() {
        return $this->bid;
    }

    function getStatus() {
        return $this->status;
    }

    function getZbid() {
        return $this->zbid;
    }

    function getBezahlt() {
        return $this->bezahlt;
    }

    function getTeillieferung() {
        return $this->teillieferung;
    }

    function getErstelldatum() {
        return $this->erstelldatum;
    }

    function getGemahnt() {
        return $this->gemahnt;
    }

    function setKid($kid) {
        $this->kid = $kid;
    }

    function setBid($bid) {
        $this->bid = $bid;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setZbid($zbid) {
        $this->zbid = $zbid;
    }

    function setBezahlt($bezahlt) {
        $this->bezahlt = $bezahlt;
    }

    function setTeillieferung($teillieferung) {
        $this->teillieferung = $teillieferung;
    }

    function setErstelldatum($erstelldatum) {
        $this->erstelldatum = $erstelldatum;
    }

    function setGemahnt($gemahnt) {
        $this->gemahnt = $gemahnt;
    }


}
