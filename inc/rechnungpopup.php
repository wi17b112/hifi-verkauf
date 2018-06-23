<script>
function closeWindow(){
    this.window.close();
}
</script>
<?php
include '../utility/db.class.php';
include '../model/bestellungsartikel.class.php';
include '../model/kundenbestellung.class.php';
include '../model/kunde.class.php';
include '../model/umsatz.class.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rechnung</title>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    <body>
        <h1>Ihre Rechnung</h1>
        <?php
        if(isset($_GET['auftragnummer'])){
        $auftragnummer=$_GET['auftragnummer'];
            $db= new DB();
            $bestellung= $db->getBestellung($auftragnummer);
            $kid= $bestellung->getKid();
            $kunde= $db->getKunde($kid);
            $artikelnbest= $db->getBestellungsArtikeln($auftragnummer);
            $kundenbestellungen= $db->getUmsatze($kid);
            $kundenbestellungdetails=null;
            foreach ($kundenbestellungen as $k){
                if($k->getBid()==$auftragnummer){
                    $kundenbestellungdetails=$k;
                }
            }
            
            
            echo"<p> <b>Name:</b> ".$kunde->getVorname()." ".$kunde->getNachname()."</p>";
            echo "<br>";
            echo"<p><b>Adresse:</b> ".$kunde->getStrasse()." ".$kunde->getHausnummer()."</p>";
            echo "<br>";
            echo"<p><b>Datum:</b> ".$bestellung->getErstelldatum()."</p>";
            echo "<br>";
            echo "<table class='table table-bordered'>";
            echo "<th>Artikelname</th>";
            echo "<th>Preis</th>";
            echo "<th>Anzahl</th>";
            echo "<th>Gesamt</th>";
            $gesamtpreis=0;
            foreach($artikelnbest as $a){
                $gesamtpreis+= $a->getGesamt();
                echo"<tr>";
                echo"<td>".$a->getArtikelname()."</td>";
                echo"<td>".$a->getVerkaufspreis()." Euro</td>";
                echo"<td>".$a->getAnzahl()." Stück</td>";
                echo"<td>".$a->getGesamt()." Euro</td>";
                echo"</tr>";
            }
            echo"<tr>";
                echo"<td>Gesamtpreis</td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td>".$gesamtpreis." Euro</td>";
                echo"</tr>";
            echo"</table>";
            
            $rabatt= (1-($kundenbestellungdetails->getUmsatz()/$gesamtpreis))*100;
            
            echo "<p><b> Ihr Rabatt: ".$rabatt."%</b></p>";
            echo "<p><b> Endpreis: ".$kundenbestellungdetails->getUmsatz()." Euro</b></p>";
        }
        ?>
        
        <button class="btn btn-primary" onclick="closeWindow()">Schließen</button>
    </body>
</html>
