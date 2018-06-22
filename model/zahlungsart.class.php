<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of zahlungsart
 *
 * @author Raphael
 */
class zahlungsart {
    private $id=null;
    private $art=null;
    private $frist=null;
    
    function __construct($id, $art, $frist) {
        $this->id = $id;
        $this->art = $art;
        $this->frist = $frist;
    }

    
    function getId() {
        return $this->id;
    }

    function getArt() {
        return $this->art;
    }

    function getFrist() {
        return $this->frist;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setArt($art) {
        $this->art = $art;
    }

    function setFrist($frist) {
        $this->frist = $frist;
    }


}
