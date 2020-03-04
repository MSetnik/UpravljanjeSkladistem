<?php 
include "connections.php";

$sPostData = file_get_contents("php://input");
$oPostData = json_decode($sPostData);

$sId = $oPostData->id; //šaljem id od odabranog artikla u tablici
$sZaposlenik = $oPostData->zaposlenik;


$oJson = array();
$sQuery="SELECT * FROM login";
$oRecord=$oConnection->query($sQuery);

while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
{
	$oLogin=new Login(
			$oRow['korisnickoIme'],
			$oRow['lozinka'],
			$oRow['ime'],
			$oRow['prezime'],
			$oRow['admin']
		);
	array_push($oJson,$oLogin);
}

$length = count($oJson);


for($i=0;$i<$length;$i++)
{
	$zaposlenik =  $oJson[$i]->ime . " ".  $oJson[$i]->prezime;
	if( $sZaposlenik == $zaposlenik && $oJson[$i]->admin == 1 )
	{
		$sQuery = "DELETE FROM artikl where sifraArtikla = :id";
		$oStatement = $oConnection->prepare($sQuery);
		$oData  = array(
			'id' => $sId
		);
		try 
		{
			$oStatement->execute($oData);
			echo 1;
			
		} catch (PDOexception $error) {
			echo $error;
			
		}
	}

}



 ?>