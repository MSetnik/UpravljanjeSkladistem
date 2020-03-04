<?php
//PDO - PHP Data Object
header('Content-type: text/json');
header('Content-type: application/json');
include "connections.php";
//include "login.php";
session_start();

$sCmd = $_POST['cmd'];



//POST sluzi za slanje podataka na server

switch($sCmd)
{
	case 'dodaj_izdatnicu':
	$oJson=array();
	date_default_timezone_set("Europe/Zagreb");
	$datum = date("Y-m-d H:i:s");
	$sQuery1 = "INSERT INTO dokument (tip,datum, zaposlenik) VALUES (:tip,:datum, :zaposlenik)";
	$oStatement = $oConnection->prepare($sQuery1);
	$oDataDokument = array(
		'tip' => 'IZD',
		'datum'=> $datum,
		'zaposlenik' => $_SESSION["user"]
	);
	try
	{
		
		$oStatement->execute($oDataDokument);
	}
	catch(PDOException $error)
	{
		echo $error;
		echo 0;
	}

	$sQuery4="SELECT * FROM dokument";
	$oRecord=$oConnection->query($sQuery4);
	
	while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
	{
		$oDokument=new Dokument(
				$oRow['id'],
				$oRow['tip'],
				$oRow['datum']
			);
		array_push($oJson,$oDokument);
	}
	json_encode($oJson);

	$DokID="";
	for ($i=0; $i < count($oJson) ; $i++) { 
		if($oJson[$i]->tip == "IZD" && $oJson[$i]->datum == $datum)
		$DokID = $oJson[$i]->id;
	}
	echo $DokID;
	
	
	$sQuery = "INSERT INTO stavke (dokument_id, sifraArtikla, kolicina, JMJ,nazivArtikla, cijenaArtikla) VALUES (:dokument_id, :sifraArtikla, :kolicina, :JMJ, :nazivArtikla, :cijenaArtikla)";
	$oArtikli = json_decode($_POST['artikli']);
		foreach($oArtikli as $nKey => $oArtikl)
		{	
			$oStatement = $oConnection->prepare($sQuery);			
				$oData = array(
					'dokument_id' => $DokID,
					'sifraArtikla' => $oArtikl ->sifraArtikla,
					'kolicina' => $oArtikl ->kolicina,
					'JMJ' => $oArtikl ->jmj,
					'nazivArtikla' => $oArtikl ->nazivArtikla,
					'cijenaArtikla' => $oArtikl ->cijena
				);
			try
			{
				
				$oStatement->execute($oData);
				//header("Location: index.php#!/izdatnica");
				//$oConnection->query($sQuery);
			}
			catch(PDOException $error)
			{
				echo $error;
				echo 0;
			}
		}	
	
	break;


	case 'dodaj_primku':
	$oZaposlenik = $_POST['zaposlenik'];
	$oJson=array();
	date_default_timezone_set("Europe/Zagreb");
	$datum = date("Y-m-d H:i:s");
	$sQuery1 = "INSERT INTO dokument (tip,datum, zaposlenik) VALUES (:tip,:datum, :zaposlenik)";
	$oStatement = $oConnection->prepare($sQuery1);
	$oDataDokument = array(
		'tip' => 'PR',
		'datum'=> $datum,
		'zaposlenik' => $oZaposlenik
	);
	try
	{
		
		$oStatement->execute($oDataDokument);
		//header("Location: index.php#!/pocetna");
		//$oConnection->query($sQuery);
	}
	catch(PDOException $error)
	{
		echo $error;
		echo 0;
	}

	$sQuery4="SELECT * FROM dokument";
	$oRecord=$oConnection->query($sQuery4);
	
	while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
	{
		$oDokument=new Dokument(
				$oRow['id'],
				$oRow['tip'],
				$oRow['datum']
			);
		array_push($oJson,$oDokument);
	}
	json_encode($oJson);

	$DokID="";
	for ($i=0; $i < count($oJson) ; $i++) { 
		if($oJson[$i]->tip == "PR" && $oJson[$i]->datum == $datum)
		$DokID = $oJson[$i]->id;
	}
	echo $DokID;
	
	
	$sQuery = "INSERT INTO stavke (dokument_id, sifraArtikla, kolicina, JMJ,nazivArtikla, cijenaArtikla) VALUES (:dokument_id, :sifraArtikla, :kolicina, :JMJ, :nazivArtikla, :cijenaArtikla)";
	$oArtikli = json_decode($_POST['artikli']);
		foreach($oArtikli as $nKey => $oArtikl)
		{	
			$oStatement = $oConnection->prepare($sQuery);			
				$oData = array(
					'dokument_id' => $DokID,
					'sifraArtikla' => $oArtikl ->sifraArtikla,
					'kolicina' => $oArtikl ->kolicina,
					'JMJ' => $oArtikl ->jmj,
					'nazivArtikla' => $oArtikl ->nazivArtikla,
					'cijenaArtikla' => $oArtikl ->cijena
				);
			try
			{
				
				$oStatement->execute($oData);
				//header("Location: index.php#!/pocetna");
				//$oConnection->query($sQuery);
			}
			catch(PDOException $error)
			{
				echo $error;
				echo 0;
			}
		}	
	
	break;


	case 'admin':
	$korisnik = $_POST["korisnicko_ime"];
	$oJson = array();
	$sQuery4="SELECT * FROM login";
	$oRecord=$oConnection->query($sQuery4);
	
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
	json_encode($oJson);

	$sQuery1 = "UPDATE login SET admin = (:admin) where korisnickoIme = (:sKorisnickoIme)";
	$oStatement = $oConnection->prepare($sQuery1);
	$oDataLogin = array(
		'admin' => 1,
		'sKorisnickoIme' => $korisnik
	);
	try
	{
		for ($i=0; $i < count($oJson) ; $i++) { 
		if($oJson[$i]->korisnickoIme == $korisnik)
		{
			$oStatement->execute($oDataLogin);
		}
	}
	
	}
	catch(PDOException $error)
	{
		echo $error;
		echo 0;
	}
	break;


	case 'ukloniAdmina':
	$korisnik = $_POST["korisnicko_ime"];
	$oJson = array();
	$sQuery4="SELECT * FROM login";
	$oRecord=$oConnection->query($sQuery4);
	
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
	json_encode($oJson);

	$sQuery1 = "UPDATE login SET admin = (:admin) where korisnickoIme = (:sKorisnickoIme)";
	$oStatement = $oConnection->prepare($sQuery1);
	$oDataLogin = array(
		'admin' => 0,
		'sKorisnickoIme' => $korisnik
	);
	try
	{
		for ($i=0; $i < count($oJson) ; $i++) { 
		if($oJson[$i]->korisnickoIme == $korisnik)
		{
			$oStatement->execute($oDataLogin);
		}
	}
	
	}
	catch(PDOException $error)
	{
		echo $error;
		echo 0;
	}
	break;

}
?>