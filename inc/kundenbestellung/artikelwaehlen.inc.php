<?php
if($_POST['kid']){
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    $_SESSION['kid']=$_POST['kid'];   
    $_SESSION['vorname']=$_POST['vorname'];  
    $_SESSION['nachname']=$_POST['nachname'];  
    $_SESSION['strasse']=$_POST['strasse'];  
    $_SESSION['hausnummer']=$_POST['hausnummer'];  
    $_SESSION['ort']=$_POST['ort'];  
}
?>
<form action="index.php?section=bestellunganlegen&step=checkpage" method="post">
<table id="artikels" class="table table-hover">
    <th>ArtikelID</th>
    <th>Artikelname</th>
    <th>Verkaufspreis</th>
    <th>Lagerbestand</th>
    <th>Hinzufügen</th>
    <th>Anzahl</th>
</table>
    <img src onerror='allartikel()'>
    <button class="btn btn-default" >Weiter</button>
</form>  
<button class="btn btn-default" onclick="history.back();">Zurück</button>