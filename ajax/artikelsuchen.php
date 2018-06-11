<?php
include("../utility/db.class.php");
include("../model/artikel.class.php");

$db = new DB();

if(isset($_POST['aid'])){
$artikeln = $db->getArtikel($_POST['aid']);
}

foreach($artikeln as $artikel){
    if($artikel->getAktiv()){
	echo "<tr>";
		echo "<td>".$artikel->getArtikelID()."</td>";
		echo "<td>".$artikel->getArtikelname()."</td>";
		echo "<td>".$artikel->getVerkaufspreis()."</td>";			
		echo "<td>".$artikel->getLagerstand()."</td>";	
        echo "</tr>";
    }
}
?>