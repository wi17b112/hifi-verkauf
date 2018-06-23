<?php
include("../utility/db.class.php");
include("../model/umsatz.class.php");

    

    if(isset($_POST['kid'])){
    $kid= $_POST['kid'];
    
    $db = new DB();
    $umsatze = $db->getUmsatze($kid);
    
    foreach ($umsatze as $umsatz){
        echo "<tr>";
        echo "<td>".$umsatz->getKid()."</td>";
        echo "<td>".$umsatz->getVorname()."</td>";
        echo "<td>".$umsatz->getNachname()."</td>";
        echo "<td>".$umsatz->getBid()."</td>";
        echo "<td>".$umsatz->getUmsatz()." Euro</td>";
        echo "</tr>";
    }
}   
?>

