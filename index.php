<?php
$section=null;
if(isset($_GET['section'])){$section= $_GET['section'];}
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
