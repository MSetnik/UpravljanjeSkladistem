<?php
//PDO - PHP Data Object
include "connections.php";



//POST sluzi za slanje podataka na server
$sActionID="";
if(isset($_POST['action_id']))
{
	$sActionID=$_POST['action_id'];
}
switch($sActionID)
{


	case 'dodaj_artikl':
	$datum = date("Y-m-d");
	$sQuery = "INSERT INTO artikl (sifraArtikla, nazivArtikla, JMJ, cijenaArtikla) VALUES (:sifraArtikla, :nazivArtikla, :JMJ, :cijenaArtikla)";
	$oStatement = $oConnection->prepare($sQuery);
	$oData = array(
		'sifraArtikla' => $_POST['sifraArtikla'],
		'nazivArtikla' => $_POST['nazivArtikla'],
		'JMJ' => $_POST['JMJ'],
		'cijenaArtikla' => $_POST['cijenaArtikla']
	);
	try
	{

		$oStatement->execute($oData);
		header("Location: index.php#!/pocetna");

	}
	catch(PDOException $error)
	{
		echo $error;
		echo 0;
	}
	break;

	case 'dodaj_korisnika':
	$admin = 0;
	$sQuery = "INSERT INTO login (korisnickoIme, lozinka, admin, ime, prezime) VALUES (:korisnickoIme, :lozinka, :admin, :ime, :prezime)";
	$oStatement = $oConnection->prepare($sQuery);
	$oData = array(
		'korisnickoIme' => $_POST['korisnickoIme'],
		'lozinka' => $_POST['lozinka'],
		'admin' => $_POST['admin'],
		'ime' => $_POST['ime'],
		'prezime' => $_POST['prezime']
	);
	try
	{

		$oStatement->execute($oData);
		header("Location: index.php#!/admin");

	}
	catch(PDOException $error)
	{
		echo $error;
		echo 0;
	}
	break;
	
}
?>