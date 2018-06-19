<?php
if($_POST['kid']){
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $_SESSION['kid']=$_POST['kid'];    
}
?>
<form action="index.php?section=bestellunganlegen&step=lieferung" method="post">
<table id="artikels" class="table table-hover">
    <th>ArtikelID</th>
    <th>Artikelname</th>
    <th>Verkaufspreis</th>
    <th>Lagerbestand</th>
    <th>Hinzufügen</th>
</table>
    <img src onerror='allartikel()'>
    <button class="btn btn-default" >Weiter</button>
</form>  
<button class="btn btn-default" onclick="history.back();">Zurück</button>