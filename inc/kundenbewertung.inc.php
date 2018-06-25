<?php

?>

<h1>Kundenbewertung durchführen</h1>
<label for="startdate">Von</label>
<input type="date" name="startdate" id="startdate">
<label for="enddate">Bis</label>
<input type="date" name="enddate" id="enddate">
<input type="text" name="mid" id="mid" placeholder="MitarbeiterID">
<button class="btn btn-default" name="anzeigen" id="anzeigen" onclick="kundenbewertung()">Anzeigen</button>
<form action="index.php" method="post">
    <table id="bewertungslist" name="bewertungslist" class="table table-hover">
        <th>KundenID</th>
        <th>Umsatz</th>
        <th>Mahnung</th>
        <th>Von</th>
        <th>Zu</th>
    </table>
    <button class="btn btn-default" name="speichern" id="speichern" disabled="True">Speichern</button>
</form>
