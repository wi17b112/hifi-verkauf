<?php
    include '../utility/db.class.php';
    include '../model/kundenbewertung.class.php';
    if(isset($_POST['mid'])){
        $mid= $_POST['mid'];
        $from= $_POST['startdate'];
        $until= $_POST['enddate'];
        
        $db= new DB();
        $kbs=$db->getKundenUmsatz($from, $until, $mid);
        $kundenstatusto=null;

        
        foreach ($kbs as $kb){
            $kundenstatusto=$kb->getKundenstatusid();
            if($kb->getGemahntg()>0){
                $kundenstatusto--;
            }elseif($kb->getUmsatzg()>=2000){
                $kundenstatusto++;
            }
            
            if($kundenstatusto<1){$kundenstatusto=1;}
            if($kundenstatusto>4){$kundenstatusto=4;}
            
            echo"<tr>";
            echo"<td>".$kb->getKid()."</td>";
            echo"<td>".$kb->getUmsatzg()."</td>";
            echo"<td>".$kb->getGemahntg()."</td>";
            echo"<td>".$kb->getKundenstatusid()."</td>";
            echo"<td>".$kundenstatusto."</td>";
            echo"<td><input type=hidden value=".$kb->getKid()." name=kidbw[] /></td>";
            echo"<td><input type=hidden value=".$kundenstatusto." name=kundenstatusbw[] /></td>";
            echo"</tr>";
        }
    }
?>