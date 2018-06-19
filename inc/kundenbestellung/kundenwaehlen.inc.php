<h1>Kunde wählen</h1>
<div>
<label for="kundenid">KundenID</label>
<input type="text" name="kundenid" id="kundenid" placeholder="KundenID">
<button onclick="kundesuchen()">Kunde suchen</button>
</div>
<br>

<h1>Kunden anlegen</h1>
<form action="index.php?section=bestellunganlegen&step=artikel" method="post">
  <div>
  <label for="kid">KundenID</label>
  <input type="number" class="form-control" name="kid" id="kid" placeholder="KundenID" readonly>
  </div>
    <div>
    <div>
  <label for="vorname">Vorname</label>
    <input type="text" class="form-control" name="vorname" id="vorname" placeholder="Vorname" readonly>
  </div>
    <div>
  <label for="nachname">Nachname</label>
    <input type="text" class="form-control" name="nachname" id="nachname" placeholder="Nachname" readonly>
  </div>
  <div class="form-group">
    <label for="email">Email Adresse</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" readonly>
  </div>
  <div>
  <label for="telefon">Telefon</label>
    <input type="tel" class="form-control" name="telefon" id="telefon" placeholder="+43699 123 456 78  "readonly>
  </div>
    <div>
  <label for="strasse">Straße</label>
  <input type="text" class="form-control" name="strasse" id="strasse" placeholder="Straße" readonly>
  <div>
  <label for="Hausnummer">Hausnummer</label>
    <input type="text" class="form-control" name="hausnummer" id="hausnummer" placeholder="Hausnummer"readonly>
  </div>
  <div>
  <label for="ort">Ort</label>
  <input type="text" class="form-control" name="ort" id="ort" readonly placeholder="Ortsname">
  </div>
  <label for="mitarbeiter">Mitarbeiter</label>
    <input type="text" class="form-control" name="mitarbeiter" id="mitarbeiter" placeholder="Mitarbeiter" readonly>
  </div>
  </div>
  <br>
    <button type="submit" class="btn btn-default">Weiter</button>
    
</form>

<button class="btn btn-default" onclick="history.back();">Zurück</button>