<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db
 *
 * @author Raphael
 */
class db {
        private $user = "";
	private $pwd = "";
	private $host = "";
	private $conn = null;
	
	function doConnect(){
		$this->conn = oci_connect($this->user,$this->pwd,$this->host);
	}	
}
