<?php
session_start();
include "connections.php";

$sPostData = file_get_contents("php://input");
$oPostData = json_decode($sPostData);

$sAction = $oPostData->action_id;

switch($sAction)
{
	case 'login':
		
		$korisnik;
		$sUserName = $oPostData->user_name;
		$sPassword = $oPostData->password;
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
			if( $sUserName == $oJson[$i]->korisnickoIme && $sPassword == $oJson[$i]->lozinka )
			{
				//$_SESSION['user'] = $oJson[$i]->ime;
				$_SESSION["user"] = $oJson[$i]->ime . " " . $oJson[$i]->prezime;
				$korisnik = $_SESSION["user"];
				echo 1;
			}
		}

	break;

	case 'logout':
			session_unset();
		    session_destroy(); 
		    echo 1;
	break;

}

?>