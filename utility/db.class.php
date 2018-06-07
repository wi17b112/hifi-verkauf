<?php
mysqli_report(MYSQLI_REPORT_ALL);

class DB{

	private $user = "root";
	private $pwd = "";
	private $host = "localhost";
        private $dbname= "hifi";
	private $conn = null;
	private $kundenArray = array();
	
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
                                                OrtID as oid,
						from kunde
						where KundeID = :id";
			$statement = oci_parse($this->conn,$query);
			oci_bind_by_name($statement,":id",$id);
			$success = oci_execute($statement);
		
			while($eintrag = oci_fetch_object($statement)){
				$kunde = new Kunde($eintrag->kid,$eintrag->vname,$eintrag->nname,$eintrag->mail,$eintrag->telefon,$eintrag->strasse,$eintrag->hausnummer,$eintrag->ort,$eintrag->ksid,$eintrag->mid);
				array_push($this->kundenArray,$kunde);
			}			
			return $this->kundenArray;
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
}
?>