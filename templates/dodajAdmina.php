<?php 
	session_start();
 ?>
 <div ng-controller="artikli">
	<div ng-controller="admin" class="prikaz" id="wrapper-admin">
		<div>
			<div id="mySidenav" class="sidenav">
				<a href="javascript:void(0)" class="closebtn" ng-click="closeNav()">&times;</a>
				<a href="#!/pocetna">Stanje Skladišta</a>
				<a href="#!/izvjesce">Izvješće Artikala</a>
				<a href="#!/izvjesceDok">Izvješće Dokumenata</a>
				<a href="#!/izdatnica">Nova Izdatnica</a>
				<a href="#!/primka">Nova Primka</a>
				<a href="#!/admin" class="active">Administracija</a>
			</div>
			<div id="main">
				<div id="navbar">
					<ul>
						<button id="menu" class="btn btn-info glyphicon glyphicon-menu-hamburger" ng-click="openNav()"></button>
						<li style="float:right;"><a href="" id="Odjava" ng-click="Odjava()">Odjava</a></li>
						<li style="float:right;"><a href="" id="zaposlenik"><?php echo $_SESSION["user"];?></a></li>
					</ul>
				</div>
				<div>
					<div id="DodajKorsnikaGumb">
						<input id="btnDodajArtikl" type="button" class="btn btn-success" onclick="location.href='#!/dodajKorisnika';" value="Dodaj Korisnika" />
					</div>
					<div id="tablica-korisnik">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>ime</th>
									<th>prezime</th>
									<th>admin</th>
									<th>korisnicko ime</th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="korisnik in sviKorisnici">
									<td>{{korisnik.sIme}}</td>
									<td>{{korisnik.sPrezime}}</td>
									<td>{{korisnik.sAdmin}}</td>
									<td id="korisnickoIme">{{korisnik.sKorisnicko_ime}}</td>
									<td><button class="btn btn-info" ng-click="dajAdmina(korisnik.sKorisnicko_ime, korisnik.sAdmin)">Dodaj Administratora</button></td>
									<td><button class="btn btn-danger" ng-click="ukloniAdmina(korisnik.sKorisnicko_ime, korisnik.sAdmin)">Ukloni Administratora</button></td>
									<td><button class="btn btn-danger glyphicon glyphicon-trash" ng-click="obrisiKorisnika(korisnik.sKorisnicko_ime, korisnik.sAdmin)"></button></td>
									
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>