<?php
mysqli_report(MYSQLI_REPORT_OFF);

class DB{

	private $user = "root";
	private $pwd = "";
	private $host = "localhost";
        private $dbname= "hifi";
	private $conn = null;
	private $kundenArray = array();
        private $artikelArray= array();
	
	function doConnect(){
		//$this->conn = new mysqli($this->host,$this->user,$this->pwd); 
                $this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->dbname); 
            if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                exit();
                }
	}	
	
	function getKunden($id){
		$this->doConnect();
		if($this->conn){
			$query = "select KundeID as kid, 
						vorname as vname,
						nachname as nname, 
						Mail as mail,						
						Telefon as telefon,
						Strasse as strasse,
                                                Hausnummer as hausnummer,
                                                KundenstatusID as ksid,
                                                MitarbeiterID as mid,
                                                OrtID as oid
						from kunde
						where KundeID ='$id'";
			//$query->bind_param('i',$id);
                        //$query->execute();
			$result = $this->conn->query($query);
			if ($result->num_rows > 0) {
                            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            echo json_encode(['rows' => $data, 'response' => true]);
                        }else {
                            echo json_encode(['response' => false]);
                        }
                        //$result->close();
                        $this->conn->close();
		}	
	}
        
        function addKunden($vorname,$nachname,$mail,$tel,$strasse,$hnr,$ort,$mid){
            $this->doConnect();
		if($this->conn){
                        //var_dump($this->conn);
                        if($query = $this->conn->prepare("insert into kunde(Vorname,Mail,Telefon,Strasse,Hausnummer,MitarbeiterID,OrtID,Nachname) values (?,?,?,?,?,?,?,?)")){
                            $query->bind_param('ssssiiis',$vorname,$mail,$tel,$strasse,$hnr,$mid,$ort,$nachname);
                            $query->execute();
                            printf("%d Row inserted.\n", $query->affected_rows);
                            $query->close();
                        }
			$this->conn->close();                      
        }
	
}
function changeKunden($kid,$vorname,$nachname,$mail,$tel,$strasse,$hnr,$ort,$mid){
            $this->doConnect();
		if($this->conn){
                        //var_dump($this->conn);
                        if($query = $this->conn->prepare("update kunde set Vorname=?,Mail=?,Telefon=?,Strasse=?,Hausnummer=?,MitarbeiterID=?,OrtID=?,Nachname=? where KundeID=?")){
                            $query->bind_param('ssssiiisi',$vorname,$mail,$tel,$strasse,$hnr,$mid,$ort,$nachname,$kid);
                            $query->execute();
                            printf("%d Row updated.\n", $query->affected_rows);
                            $query->close();
                        }
			$this->conn->close();                      
        }
	
}
function getArtikel($aid){
    $this->doConnect();
		if($this->conn){
                        //var_dump($this->conn);
                            $query = "select artikelid,artikelname,verkaufspreis,lagerstand,aktiv from artikel where ArtikelID='$aid' or Artikelname like '%$aid%'";
                            //$query->bind_param('i',$aid);
                            $result = $this->conn->query($query);
                            //$result;
                            if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $artikel= new artikel($obj->artikelid, $obj->artikelname, $obj->verkaufspreis, $obj->lagerstand, $obj->aktiv);
                                array_push($this->artikelArray,$artikel);
                            }
                            }
                            
                            $this->conn->close();
                            return $this->artikelArray;
                        }
			
}

function allArtikels(){
    $this->doConnect();
		if($this->conn){
                            $query = "select artikelid,artikelname,verkaufspreis,lagerstand,aktiv from artikel where aktiv=1";
                            $result = $this->conn->query($query);
                            if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $artikel= new artikel($obj->artikelid, $obj->artikelname, $obj->verkaufspreis, $obj->lagerstand, $obj->aktiv);
                                array_push($this->artikelArray,$artikel);
                            }
                            }
                            
                            $this->conn->close();
                            return $this->artikelArray;
                        }
}

function kundenbewertungDurchfuehren($mid){
    $this->doConnect();
		if($this->conn){
                            $query = "select kundeid from kunde where mitarbeiterid='$mid'";
                            /*select kundeid, sum(verkaufspreis) from kunde
join kundenbestellung using(kundeid)
join auftragsposition using(kundenbestellungsid)
join artikel using(artikelid);*/

                            $result = $this->conn->query($query);
                            if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $artikel= new artikel($obj->artikelid, $obj->artikelname, $obj->verkaufspreis, $obj->lagerstand, $obj->aktiv);
                                array_push($this->artikelArray,$artikel);
                            }
                            }
                            
                            $this->conn->close();
                            return $this->artikelArray;
                        }
}
}

?>