oModul.controller("artikli", function($scope, $http, $route, $window) {
	$scope.lPrikaz = [];

		var config={
		url:'json.php?json_id=dohvati_artikle',
		method:'GET'
	};

	var request = $http(config)
	.then(function (response) 
		{
			$scope.artikli = response.data;

	    },
	    function (e) 
	    {
	    	console.log('error');
	 	}
	);
//IspisiArtikle();

		var config2={
		url:'json.php?json_id=dohvati_dokumente',
		method:'GET'
	};

	var request = $http(config2)
	.then(function (response) 
		{
			$scope.dokumenti = response.data;

			//$scope.PocetnaIspis();

	    },
	    function (e) 
	    {
	    	console.log('error');
	 	}
	);

	var config3={
		url:'json.php?json_id=dohvati_stavke',
		method:'GET'
	};

	var request = $http(config3)
	.then(function (response) 
		{
			$scope.stavke = response.data;
			$scope.DohvatiDokumente();
			$scope.DohvatiArtikle();
			$scope.PocetnaIspis();

	    },
	    function (e) 
	    {
	    	console.log('error');
	 	}
	);


	$scope.DohvatiDokumente = function()
	{
		$scope.lDokumenti = [];

		angular.forEach($scope.stavke, function(stavka)
		{
			angular.forEach($scope.dokumenti, function(dokument)
			{
				if(dokument.id == stavka.dokument_id)
				{
					$scope.object1 = {
						stavka_id : stavka.id,
						stavka_dokumentID : dokument.id,
						stavka_dokumentTip : dokument.tip,
						stavka_datum : dokument.datum,
						stavka_artikl : stavka.sifraArtikla,
						stavka_kolicina : stavka.kolicina,
						stavka_dokumentZap : dokument.zaposlenik
						//stavka_JMJ : artikl.JMJ

					};
					$scope.lDokumenti.push($scope.object1);
				}
			});

		});
	}
	
	$scope.DohvatiStavke = function()
	{
		$scope.lStavke = [];
		angular.forEach($scope.stavke, function(stavka)
		{
			$scope.object = {
						stavka_id : stavka.id,
						stavka_dokument : stavka.dokument_id,
						stavka_artiklID : stavka.sifraArtikla,
						stavka_artiklNaziv : stavka.nazivArtikla,
						stavka_kolicina : stavka.kolicina,
						stavka_JMJ : stavka.JMJ,
						stavka_cijena : parseFloat(stavka.cijenaArtikla)
					}
					$scope.lStavke.push($scope.object);
		});
		

	}

	$scope.DohvatiArtikle =function()
	{
		$scope.lArtikli = [];
		angular.forEach($scope.stavke, function(stavka)
		{
	
			angular.forEach($scope.artikli,function(artikl)
			{
				if(artikl.sifraArtikla == stavka.sifraArtikla)
				{
					$scope.object = {
						stavka_id : stavka.id,
						stavka_dokument : stavka.dokument_id,
						stavka_artiklID : artikl.sifraArtikla,
						stavka_artiklNaziv : artikl.nazivArtikla,
						stavka_kolicina : stavka.kolicina,
						stavka_JMJ : artikl.JMJ,
						stavka_cijena : artikl.cijenaArtikla

					};
					$scope.lArtikli.push($scope.object);
				}
				/*if(dokument.tipDokumenta=="PS" && artikl.sifraArtikla==dokument.sifraArtikla)
				{
					psKolicina=dokument.kolicina;
					psIznos=dokument.kolicina*artikl.cijenaArtikla;
				}
				
				if(dokument.tipDokumenta =="PR" && artikl.sifraArtikla==dokument.sifraArtikla)
				{
					kolicinaUlaz= kolicinaUlaz + parseInt(dokument.kolicina);
					iznosUlaz+=dokument.kolicina*artikl.cijenaArtikla;
				}
	
				if(dokument.tipDokumenta=="IZD" && artikl.sifraArtikla==dokument.sifraArtikla)
				{
					kolicinaIzlaz+=parseInt(dokument.kolicina);
					iznosIzlaz+=dokument.kolicina*artikl.cijenaArtikla;
				}*/
				
			});

		});
	}

    $scope.PocetnaIspis = function()
    {
    		$scope.artikli;
    		console.log($scope.artikli);
    		$scope.lPrikaz = [];
    		angular.forEach($scope.artikli, function(artikl)
			{
			var psKolicina=0;
			var psIznos=0;
			var kolicinaUlaz=0;
			var iznosUlaz=0;
			var kolicinaIzlaz=0;
			var iznosIzlaz=0;
			var DokTip = "";
			var SumaIzlazKol = 0;
			var SumaUlazKol = 0;
			console.log(artikl.sifraArtikla);
			angular.forEach($scope.lDokumenti,function(dokument)
			{
				
				if(dokument.stavka_dokumentTip == 'PS' && artikl.sifraArtikla == dokument.stavka_artikl)
				{
					psKolicina=dokument.stavka_kolicina;
					psIznos=dokument.stavka_kolicina*artikl.cijenaArtikla;
				}
				
				if(dokument.stavka_dokumentTip =='PR' && artikl.sifraArtikla == dokument.stavka_artikl)
				{
					psKolicina = psKolicina;
					kolicinaUlaz= kolicinaUlaz + parseInt(dokument.stavka_kolicina);
					iznosUlaz+=dokument.stavka_kolicina*artikl.cijenaArtikla;
					DokTip = dokument.stavka_dokumentTip;
					SumaUlazKol += kolicinaUlaz;
				}
	
				if(dokument.stavka_dokumentTip == 'IZD' && artikl.sifraArtikla == dokument.stavka_artikl)
				{
					psKolicina = psKolicina;
					kolicinaIzlaz=kolicinaIzlaz + parseInt(dokument.stavka_kolicina);
					iznosIzlaz+=dokument.stavka_kolicina*artikl.cijenaArtikla;
					DokTip = dokument.stavka_dokumentTip;
					SumaIzlazKol += kolicinaIzlaz;
				}
			});
				$scope.object = {
					artikl_id: artikl.sifraArtikla,
					artikl_naziv: artikl.nazivArtikla,
					artikl_jmj:artikl.JMJ,
					artikl_cijena:artikl.cijenaArtikla,
					ps_kolicina:psKolicina,
					ps_iznos:parseFloat(psIznos).toFixed(2),
					ukupan_ulaz_kolicina:parseInt(kolicinaUlaz),
					ukupan_ulaz_iznos:parseFloat(iznosUlaz).toFixed(2),
					ukupan_izlaz_kolicina:parseInt(kolicinaIzlaz),
					ukupan_izlaz_iznos:parseFloat(iznosIzlaz).toFixed(2),
					trenutno_stanje_kolicina: ((parseInt(psKolicina) + parseInt(kolicinaUlaz))-parseInt(kolicinaIzlaz)),
					trenutno_stanje_iznos:parseFloat((psIznos + iznosUlaz - iznosIzlaz)).toFixed(2)
				};
				
			$scope.lPrikaz.push($scope.object);
		});
    	$scope.lPrikaz.sort(function(obj1,obj2){
    	//anonimna funkcija
		// Ascending: first id less than the previous
		return obj1.artikl_id - obj2.artikl_id;
		});
    }

     $scope.Delete= function (id) 
     {
     	var oZaposlenik=document.getElementById("zaposlenik").innerHTML;
       var config = {       	
       	method:'POST',
       	url:'brisanjeArtikla.php',
   		data: {
   			'id':id,
   			'zaposlenik':oZaposlenik
   		}
       };
       var request = $http(config);
       request.then(function(response)
       {
       		if (response.data !=1)
       		{
   				bootbox.alert({
				    message: "Ne možete izvršiti ovu radnju jer niste admin.",
				});
       		}
       		else 
       		{
       			bootbox.confirm({
				    message: "Jeste li sigurni da želite obrisati artikl?",
				    buttons: {
				        confirm: {
				            label: 'Da',
				            className: 'btn-success'
				        },
				        cancel: {
				            label: 'Ne',
				            className: 'btn-danger'
				        }
				    },
				    callback: function (result) {
				    	if(result== true)
				    	{
				    		console.log(response);
			       			$scope.reloadRoute();
				    	}
				       
				    }
				});
       			
       		}
       		
	       	console.log(response);
       },
       function(error)
       {
       		console.log(error);
       });
   };

   $scope.reloadRoute = function() {
	   $route.reload();
	}
/*
   // When the user scrolls the page, execute myFunction
	window.onscroll = function() {myFunction()};

	// Get the navbar
	var header = document.getElementById("scroll");

	// Get the offset position of the navbar
	var sticky = header.offsetTop;

	// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
	function myFunction() {
	  if (window.pageYOffset > sticky) {
	    header.classList.add("sticky");
	  } else {
	    header.classList.remove("sticky");
	  }
}
*/



	$scope.openNav = function() {
	  document.getElementById("mySidenav").style.width = "250px";
	  document.getElementById("main").style.marginLeft = "250px";
	}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
	$scope.closeNav = function() {
	  document.getElementById("mySidenav").style.width = "0";
	  document.getElementById("main").style.marginLeft = "0";
	}
});