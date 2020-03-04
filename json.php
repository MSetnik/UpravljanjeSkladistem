<?php
//PDO - PHP Data Object
ini_set('memory_limit', '2048M');
header('Content-type: text/json');
header('Content-type: application/json; charset=utf-8');
include "connections.php";


$artikl_id ="";
//GET sluzi za dohvacanje podataka sa servera
if(isset($_GET['json_id']))
{
	$artikl_id=$_GET['json_id'];
}

$oJson=array();
switch($artikl_id)//BITNOOOOOOOOOOOOO
{
	case 'dohvati_artikle'://BITNOOOO!!!!
	$sQuery="SELECT * FROM artikl ";
	$oRecord=$oConnection->query($sQuery);
	
	while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
	{
		$oArtikl=new Artikl(
				$oRow['sifraArtikla'],
				$oRow['nazivArtikla'],
				$oRow['JMJ'],
				$oRow['cijenaArtikla']
			);

		array_push($oJson,$oArtikl);
	}
	break;


	case 'dohvati_dokumente':
	$sQuery="SELECT * FROM dokument";
	$oRecord=$oConnection->query($sQuery);
	
	while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
	{
		$oDokument=new Dokument(
				$oRow['id'],
				$oRow['tip'],
				$oRow['datum'],
				$oRow['zaposlenik']
			);
		array_push($oJson,$oDokument);
	}
	break;

	case 'dohvati_stavke':
	$sQuery = "SELECT * from stavke";
	$oRecord=$oConnection->query($sQuery);
	while ( $oRow=$oRecord->fetch(PDO::FETCH_BOTH)) 
	{
		
		$oStavke = new Stavke(
			$oRow['id'],
			$oRow['dokument_id'],
			$oRow['sifraArtikla'],
			$oRow['kolicina'],
			$oRow['JMJ'],
			$oRow['nazivArtikla'],
			$oRow['cijenaArtikla']
		);
		array_push($oJson,$oStavke);
	
	}
	break;

	case 'dohvati_korisnike':
	
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

}
echo json_encode($oJson);




?>