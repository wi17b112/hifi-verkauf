<?php

if(isset($_POST['zahlungsmittel'])){
    
    $db= new DB();
    $db->bestellungAnlegen($_SESSION['kid'], $_POST['zahlungsmittel'], $_POST['teillieferung'], $_SESSION['artikel'], $_SESSION['anzahlartikel']);
    
    echo "<h1>Vielen Dank für Ihren Einkauf!</h1>";
}
?>
