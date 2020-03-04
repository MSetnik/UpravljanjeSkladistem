<?php
	session_start();
?>
<div ng-controller="artikli">
	<div ng-controller="izdatnica">
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" ng-click="closeNav()">&times;</a>
			<a href="#!/pocetna">Stanje Skladišta</a>
			<a href="#!/izvjesce">Izvješće Artikala</a>
			<a href="#!/izvjesceDok">Izvješće Dokumenata</a>
			<a href="#!/izdatnica" class="active">Nova Izdatnica</a>
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
			<div class="pretragaDok">
				<form>
			      	<input type="text" id="artikli" class="form-control" style="width: 450px;" ng-model="unos" placeholder="Pretraga">
			    </form>
			</div>
			<div class="containerDok">
				<table id ="tablicaArtikli" class="table table-hover">
					<thead>
						<tr>
							<th>Šifra artikla</th>
							<th>Naziv</th>
							<th>JMJ</th>
							<th>Cijena</th>
							<th>Stanje</th>
							<th class="dokInpt">Količina</th>
							<th> odaberi</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="artikl in ArtikliSvi |filter:unos">
							<td id="sifraArtikla">{{artikl.artikl_id}}</td>
							<td>{{artikl.artikl_naziv}}</td>
							<td>{{artikl.artikl_jmj}}</td>
							<td>{{artikl.artikl_cijena}}</td>
							<td>{{artikl.artikl_stanje}}</td>
							<td class="dokInpt"><input class="kolicina" type="number" name="kolicina" placeholder="Unesite Količinu"></td>
							<td><button id="select" class="btn btn-basic" ng-click="empty(artikl.artikl_id, $index)"><span class="glyphicon glyphicon-plus-sign"></span></button></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div id="naruci">
				<div id="BtnDodaj">
					<button class="btn btn-success" type="submit" value="Submit" ng-click="getData()">Dodaj Izdatnicu</button>
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Šifra artikla</th>
							<th>Naziv</th>
							<th>JMJ</th>
							<th>Cijena</th>
							<th class="dokInpt">Količina</th>
							<th>Obrisi</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-repeat="artikl in artikliOdabrani">
							<td>{{artikl.sifraArtikla}}</td>
							<td>{{artikl.nazivArtikla}}</td>
							<td>{{artikl.jmj}}</td>
							<td>{{artikl.cijena}}</td>
							<td>{{artikl.kolicina}}</td>
							<td><button id="delete" class="btn btn-danger" ng-click="DeleteArtikl($index, artikl.ukupnaCijena, artikl.kolicina)"><span class="glyphicon glyphicon-trash"></span></button></td>
							<!--<td class="dokCheck"><input type="checkbox" name="artikl[]"></td>-->
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Ukupan Iznos:</td>
							<td id="ukupno">{{total}}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>