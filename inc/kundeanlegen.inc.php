<?php
    if(isset($_POST['vorname'])){
         $db= new DB();
         $db->addKunden($_POST['vorname'], $_POST['nachname'], $_POST['email'], $_POST['telefon'], $_POST['strasse'], $_POST['hausnummer'], $_POST['ort'], $_POST['mitarbeiter']);
    }
?>
<h1>Kunden anlegen</h1>
<form action="index.php?section=kundeanlegen" method="post">
  <div>
  <label for="vorname">Vorname</label>
    <input type="text" class="form-control" name="vorname" id="vorname" placeholder="Vorname">
  </div>
    <div>
  <label for="nachname">Nachname</label>
    <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname">
  </div>
  <div class="form-group">
    <label for="email">Email Adresse</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
  </div>
  <div>
  <label for="telefon">Telefon</label>
    <input type="tel" class="form-control" name="telefon" id="telefon" placeholder="+43699 123 456 78 ">
  </div>
    <div>
  <label for="strasse">Straße</label>
  <input type="text" class="form-control" name="strasse" id="strasse" placeholder="Straße">
  <div>
  <label for="Hausnummer">Hausnummer</label>
    <input type="text" class="form-control" name="hausnummer" id="hausnummer" placeholder="Hausnummer">
  </div>
  <div>
  <label for="ort">Ort</label>
  <select class="form-control" id="ort" name="ort">
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
  </select>
  <label for="mitarbeiter">Mitarbeiter</label>
    <input type="text" class="form-control" name="mitarbeiter" id="mitarbeiter" placeholder="Mitarbeiter">
  </div>
  </div>
  <br>
  <button type="submit" class="btn btn-default">Änderungen speichern</button>
</form>
