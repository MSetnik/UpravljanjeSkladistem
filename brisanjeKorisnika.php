<?php 
include "connections.php";

header('Content-type: text/json');
header('Content-type: application/json');

$sKorisnickoIme =$_POST["korisnicko_ime"]; //šaljem id od odabranog artikla u tablici
$sZaposlenik = $_POST["zaposlenik"];


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
	if($sZaposlenik == $zaposlenik && $oJson[$i]->admin == 1 )
	{
		$sQuery = "DELETE FROM login where korisnickoIme = :korisnickoIme";
		$oStatement = $oConnection->prepare($sQuery);
		$oData  = array(
			'korisnickoIme' => $sKorisnickoIme
		);
		try 
		{
			$oStatement->execute($oData);
			
		} catch (PDOexception $error) {
			echo $error;
			
		}
	}

}



 ?>