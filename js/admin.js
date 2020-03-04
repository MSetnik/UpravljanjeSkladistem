oModul.controller("admin", function($scope, $http, $route) {
	var config3={
		url:'json.php?json_id=dohvati_korisnike',
		method:'GET'
	};

	var request = $http(config3)
	.then(function (response) 
		{
			$scope.korisnici = response.data;
			$scope.IspisKorisnika();
	    },
	    function (e) 
	    {
	    	console.log('error');
	 	}
	);

	$scope.IspisKorisnika = function()
	{
		$scope.sviKorisnici = [];
		angular.forEach($scope.korisnici,function(korisnik)
		{

			var object = {
				sKorisnicko_ime: korisnik.korisnickoIme,
				sLozinka: korisnik.lozinka,
				sAdmin:korisnik.admin,
				sIme:korisnik.ime,
				sPrezime:korisnik.prezime
				};
			$scope.sviKorisnici.push(object);
		});
		console.log($scope.sviKorisnici);
	}

	$scope.dajAdmina = function(korisnickoIme, admin)
	{
		$scope.IspisKorisnika();
		var KorisnickoIme=korisnickoIme;

		var KorisnickoImeTrenutnogKorisnika=document.getElementById("zaposlenik").innerHTML;
		var i;
		angular.forEach($scope.korisnici, function(korisnik)
		{
			var korisnici = korisnik.ime + " " + korisnik.prezime;
			console.log(korisnici);
			if(KorisnickoImeTrenutnogKorisnika == korisnici && korisnik.admin == 1)
			{
				
				i = true;
			}
			
		});
	
		if(i==true)
		{
			if(admin == 1)
			{
				bootbox.alert({
				    message: "Korisnik je već admin",
				});
			}
			else
			{
				$.ajax({
					url: 'DodajPrimku.php',
					type: 'POST',
					dataType: "html",
					data:
					{
						cmd: "admin",
						korisnicko_ime:KorisnickoIme
					},
					success: function (oData)
					{      
						console.log(oData);
						console.log("uspjeh");
					},
					error: function(XMLHttpRequest, textStatus, exception)
					{
						console.log("Ajax failure\n" + error);
					},
					async: true
				});
				 $scope.reloadRoute();
			}
		}
		else
		{
			bootbox.alert({
				    message: "Nemate pravo koristiti ovu funkciju jer niste admin",
				});

		}


		console.log(KorisnickoImeTrenutnogKorisnika);
	}

	$scope.ukloniAdmina = function(korisnickoIme, admin)
	{
		$scope.IspisKorisnika();
		var KorisnickoIme=korisnickoIme;

		var KorisnickoImeTrenutnogKorisnika=document.getElementById("zaposlenik").innerHTML;
		var i;
		angular.forEach($scope.korisnici, function(korisnik)
		{
			var korisnici = korisnik.ime + " " + korisnik.prezime;
			console.log(korisnici);
			if(KorisnickoImeTrenutnogKorisnika == korisnici && korisnik.admin == 1)
			{
				
				i = true;
			}
			
		});
	
		if(i==true)
		{
			if(admin == null)
			{
				bootbox.alert({
				    message: "Korisnik nije admin",
				});	
			}
			else
			{
				$.ajax({
					url: 'DodajPrimku.php',
					type: 'POST',
					dataType: "html",
					data:
					{
						cmd: "ukloniAdmina",
						korisnicko_ime:KorisnickoIme
					},
					success: function (oData)
					{      
						console.log(oData);
						console.log("uspjeh");
					},
					error: function(XMLHttpRequest, textStatus, exception)
					{
						console.log("Ajax failure\n" + error);
					},
					async: true
				});
				 $scope.reloadRoute();

			}
		}
		else
		{
			bootbox.alert({
				    message: "Nemate pravo koristiti ovu funkciju jer niste admin",
				});		
		}
		console.log(KorisnickoImeTrenutnogKorisnika);
	}


	 $scope.obrisiKorisnika= function (korisnickoIme, Admin) 
     {
     	$scope.IspisKorisnika();
     	var i;
     	var oZaposlenik=document.getElementById("zaposlenik").innerHTML;
     	angular.forEach($scope.korisnici, function(korisnik)
		{
			var korisnici = korisnik.ime + " " + korisnik.prezime;
			if(oZaposlenik == korisnici && korisnik.admin == 1)
			{
				
				i = true;
			}
			
		});
	
		if(i==true)
		{
			$.ajax({
				url: 'brisanjeKorisnika.php',
				type: 'POST',
				dataType: "html",
				data:
				{
					zaposlenik :oZaposlenik,
					korisnicko_ime:korisnickoIme
				},
				success: function (oData)
				{      
					console.log(oData);
					console.log("uspjeh");
				},
				error: function(XMLHttpRequest, textStatus, exception)
				{
					console.log("Ajax failure\n" + error);
				},
				async: true
			});
			 $scope.reloadRoute();

		}
		else
		{
			bootbox.alert({
				    message: "Nemate pravo koristiti ovu funkciju jer niste admin",
				});	
		}
		console.log(oZaposlenik);
   };

   $scope.reloadRoute = function() {
	   $route.reload();
	}
});