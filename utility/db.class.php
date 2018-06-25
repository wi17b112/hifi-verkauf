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
        private $zahlungsartarray= array();
        private $umsatzarray= array();
        private $bestellungsartikel= array();
        private $ortarray= array();
        private $kundenbarray= array();
	
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

function getZahlungsmittel(){
    $this->doConnect();
   $query = "select ZahlungsbedingungKundeID,Zahlungsart,Zahllungsfrist from zahlungsbedingungkunde";
 $result = $this->conn->query($query);
                            if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $zart= new zahlungsart($obj->ZahlungsbedingungKundeID, $obj->Zahlungsart, $obj->Zahllungsfrist);
                                array_push($this->zahlungsartarray,$zart);
                            }
                            }
                            
                            $this->conn->close();
                            return $this->zahlungsartarray;
}

function bestellungAnlegen($kid,$zid,$teillieferung,$artikelid,$anzahl){
                    $this->doConnect();
                        //var_dump($this->conn);
                    $now= "".date('Y-m-d H:i:s');  
                    //$now= date_create()->format('YYYY-MM-DD HH:MM:SS');
                    //var_dump($now);
                    if(isset($teillieferung)){
                    $query = "insert into kundenbestellung (KundeID, Status, ZahlungsbedingungKundeID, Bezahlt,Teillieferung, ErstellDatum, Gemahnt) values ($kid, 0, $zid, 0, $teillieferung, '$now' , 0)";
                    }else{$query = "insert into kundenbestellung (KundeID, Status, ZahlungsbedingungKundeID, Bezahlt,Teillieferung, ErstellDatum, Gemahnt) values ($kid, 0, $zid, 0, 0, '$now' , 0)";}
                    $this->conn->query($query);
                    $query= "select max(kundenbestellungsid) from kundenbestellung";
                    $result= $this->conn->query($query);
                    $kb= $result->fetch_assoc();
                    $kbid= $kb["max(kundenbestellungsid)"];               
                    for($i=0 ; $i<sizeof($artikelid, 0);$i++){
                        $ianz=(int)$anzahl[$i];
                        $iart=(int)$artikelid[$i];
                        $ikbid=(int)$kbid;
                        $query= "insert into auftragsposition (Anzahl,ArtikelID,IstAbgezogen,KundenbestellungsID) values ($ianz,$iart,0,$kbid);";
                        $this->conn->query($query);
                    }
                    
                    mysqli_error($this->conn);
                    $this->conn->close();  
}

function getUmsatze($kid){
    $this->doConnect();
    $query= "select kundeid,vorname,nachname,kundenbestellungsid,umsatz from bestellungsumsatz_view where kundeid=$kid";
    $result=$this->conn->query($query);
    
    if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $umsatz= new umsatz($obj->kundeid,$obj->vorname,$obj->nachname,$obj->kundenbestellungsid,$obj->umsatz);
                                array_push($this->umsatzarray,$umsatz);
                            }
                            }
                            $this->conn->close();  
                            return $this->umsatzarray;
}  

   function getBestellung($bid){
       $this->doConnect();
       $query ="select kundeid,kundenbestellungsid,status,ZahlungsbedingungKundeID,bezahlt,teillieferung,erstelldatum,gemahnt from kundenbestellung where kundenbestellungsid=$bid";
       $result= $this->conn->query($query);
       
      if ($result->num_rows > 0) {
                            $obj=$result->fetch_object();
                            $bestellung= new kundenbestellung($obj->kundeid, $obj->kundenbestellungsid, $obj->status, $obj->ZahlungsbedingungKundeID, $obj->bezahlt,$obj->teillieferung, $obj->erstelldatum, $obj->gemahnt);
                            
                            
      }
                            $this->conn->close();  
                            return $bestellung;
   }
   
   function getKunde($kid){
       $this->doConnect();
		if($this->conn){
			$query = "select kundeid, 
						vorname,
						nachname, 
						mail,						
						telefon,
						strasse,
                                                hausnummer,
                                                kundenstatusid,
                                                mitarbeiterid,
                                                ortid
						from kunde
						where kundeid ='$kid'";
			//$query->bind_param('i',$id);
                        //$query->execute();
			$result = $this->conn->query($query);
			if ($result->num_rows > 0) {
                            $obj = $result->fetch_object();
                            $kunde= new kunde($obj->kundeid, $obj->vorname, $obj->nachname, $obj->mail,$obj->telefon,$obj->strasse, $obj->hausnummer, $obj->ortid, $obj->kundenstatusid, $obj->mitarbeiterid);
                        }
                        //$result->close();
                        $this->conn->close();
                        return $kunde;
		}	
   }
   function getBestellungsArtikeln($bid){
       $this->doConnect();
       $query= "select kundenbestellungsid,artikelid,artikelname,verkaufspreis,anzahl,gesamt from auftragsposition_view where kundenbestellungsid=$bid";
       $result = $this->conn->query($query);
       
       if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $artikel= new bestellungsartikel($obj->Kundenbestellungsid, $obj->artikelid, $obj->artikelname, $obj->verkaufspreis, $obj->anzahl, $obj->gesamt);
                                array_push($this->bestellungsartikel,$artikel);
                            }
                            }
                            $this->conn->close();  
                            return $this->bestellungsartikel;
   }
   function getOrte(){
       $this->doConnect();
       $query="select ortid,plz,bezeichnung,landid from ort";
       $result = $this->conn->query($query);
       
       if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $ort= new ort($obj->ortid,$obj->plz,$obj->bezeichnung,$obj->landid);
                                array_push($this->ortarray,$ort);
                            }
                            }
                            $this->conn->close();  
                            return $this->ortarray;
   }
   function getKundenUmsatz($from,$until,$mid){
       $this->doConnect();
       $query="select kundeid,sum(umsatz)as umsatzg,sum(gemahnt)as gemahntg,kundenstatusid from bestellungsumsatz_view where (erstelldatum between '$from' and '$until')&& mitarbeiterid=$mid group by kundeid";
       $result = $this->conn->query($query);
       
       
       if ($result->num_rows > 0) {
                            while($obj = $result->fetch_object()){
                                $kb= new kundenbewertung($obj->kundeid,$obj->umsatzg,$obj->gemahntg,$obj->kundenstatusid);
                                array_push($this->kundenbarray,$kb);
                            }
                            }
                            $this->conn->close();  
                            return $this->kundenbarray;
   }
   
   function kundenstatusUpdate($kid,$kundenstatusnew){
       $this->doConnect();
       $query="update kunde set kundenstatusid= $kundenstatusnew where kundeid=$kid";
       $result = $this->conn->query($query);
       $this->conn->close(); 
   }
}
?>