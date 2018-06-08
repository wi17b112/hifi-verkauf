<?php

include("../utility/db.class.php");
include("../model/kunde.class.php");

if(isset($_POST['kundenid'])){
$db = new DB();
$kid= $_POST['kundenid'];
$db->getKunden($kid);
}

?>