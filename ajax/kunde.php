<?php

include("../utility/db.class.php");
include("../model/kunde.class.php");

$db = new DB();

$personal = $db->getKunden($_POST['kid']);

foreach($kunde as $k){
echo "<form>";
echo  "<div>";
echo  "<label for='vorname'>Vorname</label>";
echo   "<input type='text' class='form-control' name='vorname' id='vorname'>";
echo  "</div>";
echo   "<div>";
echo  "<label for='nachname'>Nachname</label>";
echo   " <input type='text' class='form-control' name='nachname' id='nachname'>";
echo  "</div>";
echo  "<div class='form-group'>";
echo    "<label for='email'>Email Adresse</label>";
echo    "<input type='email' class='form-control' id='email'>";
echo  "</div>";
echo  "<div>";
echo  "<label for='telefon'>Telefon</label>";
echo    "<input type='tel' class='form-control' name='telefon' id='telefon'>";
echo  "</div>";
echo    "<div>";
echo  "<label for='strasse'>Straße</label>";
echo  "<input type='text' class='form-control' name='strasse' id='strasse'>";
echo  "<div>";
echo  "<label for='Hausenummer'>Hausnummer</label>";
echo    "<input type='text' class='form-control' name='hausnummer' id='hausnummer' >";
echo  "</div>";
echo  "<div>";
echo  "<label for='ort'>Ort</label>";
echo  "<select class='form-control' id='ort'>";
echo    "<option>1</option>";
echo    "<option>2</option>";
echo    "<option>3</option>";
echo    "<option>4</option>";
echo  "</select>";
echo  "</div>";
echo  "<br>";
echo  "<button type='submit' class='btn btn-default'>Änderungen speichern</button>";
echo "</form>";
}


?>