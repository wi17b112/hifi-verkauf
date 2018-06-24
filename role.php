<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Custom CSS -->
        <link rel="stylesheet" href="res/css/verkauf.css">
        <title>Rolle wählen</title>
    </head>
    <body>
        <h1>Bitte wählen Sie eine Rolle aus!</h1>
        <div class="col-md-3">
        <form action="index.php" method="post">
            <select class="form-control" id="role" name="role">
                <option value="1">Mitarbeiter</option>
                <option value="2">Kunde</option>
            </select>
            <button type="submit" class="btn btn-default">Fortfahren</button>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
