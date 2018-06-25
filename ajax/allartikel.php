<?php

include("../utility/db.class.php");
include("../model/artikel.class.php");

$db = new DB();

$artikeln = $db->allArtikels();


foreach($artikeln as $artikel){
	echo "<tr>";
		echo "<td>".$artikel->getArtikelID()."</td>";
		echo "<td>".$artikel->getArtikelname()."</td>";
		echo "<td>".$artikel->getVerkaufspreis()."</td>";			
		echo "<td>".$artikel->getLagerstand()."</td>";	
                echo "<td><input type='checkbox' id=".$artikel->getArtikelname()." name='artikel[]' value=".$artikel->getArtikelID()." onclick='enable(field".$artikel->getArtikelID().")'></td>";
                echo "<td><input type='number' name='anzahlartikel[]' id='field".$artikel->getArtikelID()."'  min='1' placeholder='Anzahl' disabled='true'></td";
        echo "</tr>";
    }
?>