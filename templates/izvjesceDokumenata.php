<?php 
 session_start();
 ?>
 <div ng-controller="artikli" class="prikaz" id="wrapper-izvjesceDok">
	<div ng-controller="izvjesceDokumenata">
		<div id="wrapper-izvjesce">
			<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" ng-click="closeNav()">&times;</a>
			<a href="#!/pocetna">Stanje Skladišta</a>
			<a href="#!/izvjesce">Izvješće Artikala</a>
			<a href="#!/izvjesceDok" class="active">Izvješće Dokumenata</a>
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
			<div id="pretrage">
				<div id="pretragaDok">
					<form>
						<h4>Odaberite Dokument</h4>
				      	<select name="cars" ng-model="unos">
						  <option value="" >---Odaberi---</option>
						  <option value="ps" >Početno Stanje</option>
						  <option value="pr">Primka</option>
						  <option value="izd">Izdatnica</option>
						</select>
				    </form>
				</div>
				<div id="vremenskaPretraga">
					<h4>Odaberite Datume</h4>
			      	<input type="date" name="lol" id="datumOd" class="form-control" style="width: 190px;" ng-model="startDate">
			      	<input type="date"  id="datumDo" class="form-control" style="width: 190px;" ng-model="endDate">
				</div>
			</div>
			<div id="tablicaIzvjesceDok"  style="overflow-y:auto;">
				<table >
					<thead>
						<tr>
							<th>Tip dokumenta</th>
							<th>Datum dokumenta</th>
							<th>Pregled</th>
						</tr>
					</thead>
					<tbody>
						<tr id="row" ng-repeat="dokument in lIzvjesceDok | myFilter: startDate | myFilter2:endDate | filter:unos | orderBy:'dokument_datum'">
							<td>{{dokument.dokument_tip}}</td>
							<td>{{dokument.dokument_datum}}</td>
							<td>{{dokument.dokument_zaposlenik}}</td>
							<td><a href="" ng-click="IspisArtikalaDokumenta(dokument.dokument_id)"><span class="glyphicon glyphicon-search"></span></a></td>
						</tr>
					</tbody>
				</table>
				</div>
			<div class="modal" id="modals" tabindex="-1" role="dialog" aria-labelledby="" aria-hiddeen="true">
			<div class="modal-dialog">
				<div class="modal-content">
					
				</div>
			</div>
		</div>
		<div>
		<div>
			<div class="modal fade" id="artikliDok" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background-color:#8f8f8f">
							<h1 id="tip"></h1>
						</div>
							<div id="tablicaArtikliDok">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Šifra artikla</th>
											<th>Naziv</th>
											<th>JMJ</th>
											<th>Cijena</th>
											<th>Količina</th>
											<th>Ukupna Cijena</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="dokument in lArtikliDokumenta">
											<td>{{dokument.artikl_id}}</td>
											<td>{{dokument.artikl_naziv}}</td>
											<td>{{dokument.artikl_jmj}}</td>
											<td>{{dokument.artikl_cijena}}</td>
											<td>{{dokument.artikl_kolicina}}</td>
											<td>{{dokument.artikl_ukupnaCijena}}</td>
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
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="js/artikl.js"></script>