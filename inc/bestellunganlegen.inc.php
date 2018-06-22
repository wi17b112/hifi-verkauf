<h1>Neue Bestellung anlegen</h1>
<?php
       if(!isset($_GET['step'])){
    include './inc/kundenbestellung/kundenwaehlen.inc.php';
    }
    else{
        if($_GET['step']=="artikel"){
            include './inc/kundenbestellung/artikelwaehlen.inc.php';
        }
        if($_GET['step']=="checkpage"){
            include './inc/kundenbestellung/checkpage.inc.php';
        }
        if($_GET['step']=="finish"){
            include './inc/kundenbestellung/finish.inc.php';
        }
    }
?>
