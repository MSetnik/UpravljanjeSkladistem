<?php 
session_start();
 ?>
<div ng-controller="artikli" >
	<div>
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" ng-click="closeNav()">&times;</a>
			<a href="#!/pocetna">Stanje Skladišta</a>
			<a href="#!/izvjesce">Izvješće Artikala</a>
			<a href="#!/izvjesceDok">Izvješće Dokumenata</a>
			<a href="#!/izdatnica">Nova Izdatnica</a>
			<a href="#!/primka">Nova Primka</a>
			<a href="#!/admin">Administracija</a>
		</div>
		<div id="main">
			<div id="navbar">
				<ul>
					<button id="menu" class="btn btn-info glyphicon glyphicon-menu-hamburger" ng-click="openNav()"></button>
					<li style="float:right;"><a href="" id="Odjava" ng-click="Odjava()">Odjava</a></li>
					<li style="float:right;"><a href="" id="zaposlenik"><?php echo $_SESSION["user"];?></a></li>
				</ul>
			</div>
			<div id="formaKorisnik">
				<form id="forma" action="izvjesce.php" method="POST">
				  <input type="hidden" name="action_id" value="dodaj_korisnika">
				  <input type="hidden" name="admin" value="0" required><br>
				  Ime:<br>
				  <input type="text" name="ime" value="" required><br>
				  Prezime:<br>
				  <input type="text" name="prezime" value="" required><br>
				  Korisničko Ime<br>
				  <input type="text" name="korisnickoIme" value="" required><br>
				   Lozinka<br>
				  <input type="Password" name="lozinka" value="" required><br>
				  <input id="btn" class="btn btn-success" type="submit" value="Submit">
				</form>
			</div>
		</div>
	<div>
</div>