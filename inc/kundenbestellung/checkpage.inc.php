
<?php
if(isset($_POST['artikel'])){
    $_SESSION['artikel']=$_POST['artikel'];
    $_SESSION['anzahlartikel']=$_POST['anzahlartikel'];
    
    echo "<h1>Bitte überprüfen Sie Ihre Daten</h1>";
    echo "<form action='index.php?section=bestellunganlegen&step=finish' method='post'>";
    
    echo"<div>";
   echo"<label for='vorname'>Vorname</label>";
   echo"<input type='text' class='form-control' name='vorname' id='vorname' placeholder='Vorname' value=".$_SESSION['vorname']." readonly>";
  echo"</div>";
    echo"<div>";
  echo"<label for='nachname'>Nachname</label>";
   echo" <input type='text' class='form-control' name='nachname' id='nachname' placeholder='Nachname' value=".$_SESSION['nachname']." readonly>";
  echo"</div>";
  echo"<label for='strasse'>Straße</label>";
  echo"<input type='text' class='form-control' name='strasse' id='strasse' placeholder='Straße' value=".$_SESSION['strasse']." readonly>";
  echo"<div>";
  echo"<label for='Hausnummer'>Hausnummer</label>";
  echo"  <input type='text' class='form-control' name='hausnummer' id='hausnummer' placeholder='Hausnummer' value=".$_SESSION['hausnummer']." readonly>";
  echo"</div>";
  echo"<div>";
  echo"<label for='ort'>Ort</label>";
  echo"<input type='text' class='form-control' name='ort' id='ort' readonly placeholder='Ortsname' value=".$_SESSION['ort'].">";
  echo"</div>";
    
  echo "<table id='artikeln' class='table table-hover'>";
    echo"<th>Artikelname</th>";
    echo"<th>Verkaufspreis</th>";
    echo"<th>Anzahl</th>";
    echo"<th>Preis</th>";

    for ($i = 0; $i < sizeof($_SESSION['artikel'], 0); $i++) {
    echo"<img src onerror='getartikel(".$_SESSION['artikel'][$i].",".$_SESSION['anzahlartikel'][$i].")'>";
} 

   /* echo "<tr>";
		echo "<td></td>";
		echo "<td></td>";			
                echo "<td></td>";	
                echo "<td>".$_SESSION['gesamt']."</td>";
        echo "</tr>";
   */
   echo"</table>";
   echo"</form>"; 
   
   echo"<div>";
   echo"<label for='zahlung'>Zahlungsart</label>";
   echo"<select class='form-control' id='ort' name='ort'>";
   $db = new DB();
   $zmitteln= $db->getZahlungsmittel();
   foreach ($zmittel as $zmittel){
       echo"<option value='".$zmittel->getID()."'>".$zmittel->getArt()."</option>";
   }
  echo"</select>";
}
?>
<option value=""></option>