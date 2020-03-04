<?php
    session_unset();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Gradnja d.o.o.</title>
    <link rel="stylesheet" href="assets/plugins/bootstrap-3.3.7-dist/css/bootstrap.css">
    <link rel="stylesheet" type="" href="css/formaLogin.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="css/pocetna.css">
    <link rel="stylesheet" type="text/css" href="css/izvješće.css">
    <link rel="stylesheet" type="text/css" href="css/dokumenti.css">
    <link rel="stylesheet" type="text/css" href="css/dodajAdmina.css">
    <link rel="stylesheet" type="text/css" href="css/dodajArtikl.css">
    <link rel="stylesheet" type="text/css" href="css/dodajKorisnika.css">
    <link rel="stylesheet" type="text/css" href="css/izvjesceDok.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/plugins/AngularJS/angular.min.js"></script>
    <script src="assets/plugins/AngularJS/angular-route.min.js"></script>
    <script src="assets/plugins/AngularJS/angular-cookies.min.js"></script>
    
</head>
<body ng-app="app">

	<div class="prikaz">
		
		<div ng-view class="prikaz" id="ngview"></div>

	</div>
<script src="assets/plugins/jquery/jquery-3.2.1.min.js"></script>
<script src="https://unpkg.com/popper.js"></script>
<script src="assets/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="assets/plugins/bootbox/bootbox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript" src="js/artikl.js"></script>
<script type="text/javascript" src="js/izvjesce.js"></script>
<script type="text/javascript" src="js/izdatnica.js"></script>
<script type="text/javascript" src="js/primka.js"></script>
<script type="text/javascript" src="js/admin.js"></script>
<script type="text/javascript" src="js/izvjesceDok.js"></script>



</body>
</html>
