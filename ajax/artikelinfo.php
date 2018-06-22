<?php

include("../utility/db.class.php");
include("../model/artikel.class.php");

$db = new DB();

/*if(isset($_SESSION['gesamt'])){
   $_SESSION['gesamt']=0; 
}*/

if(isset($_POST['aid'])){
$artikeln = $db->getArtikel($_POST['aid']);
}

foreach($artikeln as $artikel){
    if($artikel->getAktiv()){
        //$_SESSION['gesamt']+=$artikel->getVerkaufspreis()*$_POST['anz'];
	echo "<tr>";
		echo "<td>".$artikel->getArtikelname()."</td>";
		echo "<td>".$artikel->getVerkaufspreis()."</td>";			
                echo "<td>".$_POST['anz']."</td>";	
                echo "<td>".$artikel->getVerkaufspreis()*$_POST['anz']."</td>";
        echo "</tr>";
    }
}
?>
