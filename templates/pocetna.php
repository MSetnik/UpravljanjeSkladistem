<?php
	session_start();
?>
<div ng-controller="artikli" >
	<div ng-controller="admin">
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" ng-click="closeNav()">&times;</a>
			<a href="#!/pocetna" class="active">Stanje Skladišta</a>
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
			<div id="pretraga">
				<form>
			      	<input type="text" id="artikli" class="form-control" style="width: 450px;" ng-model="unos" placeholder="Pretraga">
			    </form>
			</div>
			<div id="DodajArtikl">
				<input id="btnDodajArtikl" type="button" class="btn btn-success" onclick="location.href='#!/dodajArtikl';" value="Dodaj Artikl" />
			</div>
			<div id="tablicaPocetna">
				<table class="table table-hover">
					<thead id="scroll">
						<tr>
							<th>Šifra artikla</th>
							<th>Naziv</th>
							<th>JMJ</th>
							<th>Cijena</th>
							<th>PS Količina</th>
							<th>PS Iznos</th>
							<th>Količina U</th>	
							<th>Iznos U</th>
							<th>Količina I</th>
							<th>Iznos I</th>
							<th>Stanje Količina</th>
							<th>Stanje Cijena</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="content">
						<tr ng-repeat="artikl in lPrikaz |filter:unos">
							<td>{{artikl.artikl_id}}</td>
							<td>{{artikl.artikl_naziv}}</td>
							<td>{{artikl.artikl_jmj}}</td>
							<td>{{artikl.artikl_cijena}}</td>
							<td>{{artikl.ps_kolicina}}</td>
							<td>{{artikl.ps_iznos}}</td>
							<td>{{artikl.ukupan_ulaz_kolicina}}</td>
							<td>{{artikl.ukupan_ulaz_iznos}}</td>
							<td>{{artikl.ukupan_izlaz_kolicina}}</td>
							<td>{{artikl.ukupan_izlaz_iznos}}</td>
							<td>{{artikl.trenutno_stanje_kolicina}}</td>
							<td>{{artikl.trenutno_stanje_iznos}}</td>
							<td><button id="btnDeleteArtikl" class="btn btn-danger" ng-click="Delete(artikl.artikl_id)">Obrisi</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<div>
</div>