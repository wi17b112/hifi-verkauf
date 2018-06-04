<script>
function closeWindow(){
    this.window.close();
}
function savebill(){
    //Rechnung speichern
    this.window.close();
}
</script>
<?php
if(isset($_GET['auftragnummer'])){
    $auftragnummer=$_GET['auftragnummer'];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo $auftragnummer;
        ?>
        
        <button>Speichern</button>
        <button onclick="closeWindow()">Abbrechen</button>
    </body>
</html>
