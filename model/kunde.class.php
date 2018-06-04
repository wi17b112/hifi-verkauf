<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of kunde
 *
 * @author Raphael
 */
class kunde {
    private $id=null;
    private $vorname=null;
    private $nachname=null;
    private $mail=null;
    private $telefon=null;
    private $strasse=null;
    private $ort=null;
    private $kundenstatus=null;
    private $kundenbewertung=null;
    private $mitarbeiter=null;
    
    function __construct($id, $vorname, $nachname, $mail, $telefon, $strasse, $ort, $kundenstatus, $kundenbewertung, $mitarbeiter) {
        $this->id = $id;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->mail = $mail;
        $this->telefon = $telefon;
        $this->strasse = $strasse;
        $this->ort = $ort;
        $this->kundenstatus = $kundenstatus;
        $this->kundenbewertung = $kundenbewertung;
        $this->mitarbeiter = $mitarbeiter;
    }

    
    function getId() {
        return $this->id;
    }

    function getVorname() {
        return $this->vorname;
    }

    function getNachname() {
        return $this->nachname;
    }

    function getMail() {
        return $this->mail;
    }

    function getTelefon() {
        return $this->telefon;
    }

    function getStrasse() {
        return $this->strasse;
    }

    function getOrt() {
        return $this->ort;
    }

    function getKundenstatus() {
        return $this->kundenstatus;
    }

    function getKundenbewertung() {
        return $this->kundenbewertung;
    }

    function getMitarbeiter() {
        return $this->mitarbeiter;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setVorname($vorname) {
        $this->vorname = $vorname;
    }

    function setNachname($nachname) {
        $this->nachname = $nachname;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setTelefon($telefon) {
        $this->telefon = $telefon;
    }

    function setStrasse($strasse) {
        $this->strasse = $strasse;
    }

    function setOrt($ort) {
        $this->ort = $ort;
    }

    function setKundenstatus($kundenstatus) {
        $this->kundenstatus = $kundenstatus;
    }

    function setKundenbewertung($kundenbewertung) {
        $this->kundenbewertung = $kundenbewertung;
    }

    function setMitarbeiter($mitarbeiter) {
        $this->mitarbeiter = $mitarbeiter;
    }


}
