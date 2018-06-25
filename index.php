<?php
session_start();
include './utility/db.class.php';
include './model/kunde.class.php';
include './model/zahlungsart.class.php';
include './model/ort.class.php';
$section=null;
if(isset($_POST['role'])){$_SESSION['role']= $_POST['role'];}
if(!isset($_SESSION['role'])){
    header("Location: role.php"); /* Redirect browser */
    exit();
}
if(isset($_GET['section'])){$section= $_GET['section'];}

if(isset($_POST['kidbw'])){
    $kidbw= $_POST['kidbw'];
    $kundenstatusbw= $_POST['kundenstatusbw'];
    $db= new DB();
    
    for($i=0; $i<sizeof($kidbw,0);$i++){
        $kid=(int)$kidbw[$i];
        $kundenstatusnew= (int)$kundenstatusbw[$i];
        $db->kundenstatusUpdate($kid, $kundenstatusnew);
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hifi-Verkauf</title>
         
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Custom CSS -->
        <link rel="stylesheet" href="res/css/verkauf.css">
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script> function popitup() {
       //auftragnummerx= document.getElementByID("auftragnummer").value;
       //echo auftragnummer;
        //var url2= String.concat(url,"?auftragnummer=",auftragnummerx);
        //newwindow=window.open('./inc/rechnungpopup.php?auftragnummer='+document.getElementById('auftragnummer').value,'width=400,height=400','Rechnung legen');
        newwindow=window.open("./inc/rechnungpopup.php?auftragnummer="+document.getElementById("auftragnummer").value,"Rechnung legen","width=700, height=800");
        newwindow.moveTo(700,150);
       // newwindow.resizeTo(400,400);
       if (window.focus) {newwindow.focus()}
       return false;
        }
        </script>
        <script>
        function kundesuchen(){ 
            console.log($("#kundenid").val());
            $.post("ajax/kunde.php",{'kundenid' : $("#kundenid").val()}).done(function(response){
                    var result= JSON.parse(response);
                    console.log(result);
                    if(result.response==true){
                        var data = result.rows;
                        $("#kid").val(data[0].kid);
                        $("#vorname").val(data[0].vname);
                        $("#nachname").val(data[0].nname);
                        $("#email").val(data[0].mail);
                        $("#telefon").val(data[0].telefon);
                        $("#strasse").val(data[0].strasse);
                        $("#hausnummer").val(data[0].hausnummer);
                        $("#ort").val(data[0].oid);
                        $("#mitarbeiter").val(data[0].mid);
                    }else if (result.response == false) {
                $('#kundenid').append('<option>Kein Kunde wurde gefunden!</option>');
            }
                });
        }
        </script>
        <script>
            function artikelsuchen(){
                console.log($("#artikelsuche").val());
                $.post("ajax/artikelsuchen.php",{'aid':$("#artikelsuche").val()})
                        .done(function(data){
                            $("#artikels").append(data);
                        });
            }
        </script>
        <script>
            function allartikel(){
                $.post("ajax/allartikel.php").done(function(data){
                            $("#artikels").append(data);
                        });
            }
        </script>
        <script>
            function kundenbewertung(){
                $.post("ajax/kundenbewertung.php",{'mid':$("#mid").val(),'startdate':$("#startdate").val(),'enddate':$("#enddate").val()}).done(function(data){ $("#bewertungslist").append(data)});
                document.getElementById("speichern").disabled=false;
            }
        </script>
        <script>
            function umsatzanzeigen(){
                $.post("ajax/kundenumsatz.php",{'kid':$("#kundenid").val()}).done(function(data){ $("#umsatztable").append(data)});
            }
        </script>
        <script>
            function enable(fieldid){
                console.log(fieldid.id);
                var checked= fieldid.checked;
                console.log(checked);
                if(checked){
                    document.getElementById(fieldid.id+"x").disabled=false;
                }else{
                    document.getElementById(fieldid.id+"x").disabled=true;
                }
    }
        </script>
        <script>
            function getartikel(artikel,anzahl){
                $.post("ajax/artikelinfo.php",{'aid':artikel,'anz':anzahl})
                        .done(function(data){
                            $("#artikeln").append(data);
                        });
            }
        </script>
        <script>
            function saveKundenbewertung(){
                
            }
        </script>
    </head>
    <body>
        <div class="container">
            <header class="page-header">
			<h1>Verkauf-HIFI</h1>
		</header>
            
            <div class="col-md-3">
			<nav>
				<?php
                                include './inc/navi.inc.php';
                                ?>
                        </nav>
            
            <?php
        
        ?>
        </div>
            <div class="col-md-9">
			<main>
                            <?php 
                                /*switch ($section){
                                    case 'kundenverwaltung':
                                        include './inc/kundenverwaltung.inc.php';
                                }*/
                            if($section!=null){
                            include './inc/'.$section.'.inc.php';}
                            ?>
			</main>
		</div>		
    </body>
</html>
