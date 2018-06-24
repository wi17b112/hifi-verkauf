<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ort
 *
 * @author Raphael
 */
class ort {
   private $id=null;
   private $plz=null;
   private $bez=null;
   private $landid=null;
   
   function __construct($id, $plz, $bez, $landid) {
       $this->id = $id;
       $this->plz = $plz;
       $this->bez = $bez;
       $this->landid = $landid;
   }
   
   function getId() {
       return $this->id;
   }

   function getPlz() {
       return $this->plz;
   }

   function getBez() {
       return $this->bez;
   }

   function getLandid() {
       return $this->landid;
   }

   function setId($id) {
       $this->id = $id;
   }

   function setPlz($plz) {
       $this->plz = $plz;
   }

   function setBez($bez) {
       $this->bez = $bez;
   }

   function setLandid($landid) {
       $this->landid = $landid;
   }



}
