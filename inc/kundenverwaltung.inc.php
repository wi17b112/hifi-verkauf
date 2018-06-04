<h1>Kundenverwatlung</h1>
<div>
<label for="email">KundenID</label>
<input type="text" name="kundenid" id="kundenid" placeholder="KundenID">
<button onclick="kundesuchen">Kunde suchen</button>
</div>
<br>

<form>
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
    <input type="email" class="form-control" id="email" placeholder="Email">
  </div>
  <div>
  <label for="telefon">Telefon</label>
    <input type="tel" class="form-control" name="telefon" id="telefon" placeholder="+43699 123 456 78 ">
  </div>
    <div>
  <label for="strasse">Straße</label>
  <input type="text" class="form-control" name="strasse" id="strasse" placeholder="Straße">
  <div>
  <label for="Hausenummer">Hausnummer</label>
    <input type="text" class="form-control" name="hausnummer" id="hausnummer" placeholder="Hausnummer">
  </div>
  <div>
  <label for="plz">PLZ</label>
  <input type="number" class="form-control" name="plz" id="plz" placeholder="PLZ">
  </div>
  <br>
  <button type="submit" class="btn btn-default">Änderungen speichern</button>
</form>