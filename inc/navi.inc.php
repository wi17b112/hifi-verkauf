<ul class="nav nav-pills nav-stacked">
        <?php
        // put your code here
        
        $menupunkte= simplexml_load_file("config/navigation.xml");
        
        foreach ($menupunkte->menuepunkt as $m ){
            $class='';
            if(isset($_GET['section'])&&$_GET['section']== $m->section){
                $class='active';
            }
                
            echo"<li role='presentation' class='$class'>";
            echo "<a href='index.php?section=$m->section'>$m->bezeichnung</a>";
            echo "</li>";
            
        }
        
        ?>
</ul>

