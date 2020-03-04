oModul.controller("primka", function($scope, $http,$route) {
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

		var config2={
		url:'json.php?json_id=dohvati_dokumente',
		method:'GET'
	};

	var request = $http(config2)
	.then(function (response) 
		{
			$scope.dokumenti = response.data;
			$scope.IspisiArtikle();
	    },
	    function (e) 
	    {
	    	console.log('error');
	 	}
	);


	$scope.DajDanasnjiDatum = function()
	{
	    var tdate = new Date();
	    var dd = tdate.getDate();
	    var MM = tdate.getMonth(); 
	    var yyyy = tdate.getFullYear(); 
	    var sDatum = yyyy + "-" + (MM + 1) + "-" + dd;

	    return sDatum;
	}

	$scope.IspisiArtikle=function()
	{
		$scope.artikli;
		$scope.ArtikliSvi = [];
		$scope.DohvatiArtikle();
		$scope.PocetnaIspis();
		var stanjeArtikla;
		angular.forEach($scope.artikli,function(artikl)
		{
			angular.forEach($scope.lPrikaz,function(prikaz)
			{
				if(artikl.sifraArtikla == prikaz.artikl_id)
				{
					stanjeArtikla = prikaz.trenutno_stanje_kolicina;
				}
			});

			var object = {
				artikl_id: artikl.sifraArtikla,
				artikl_naziv: artikl.nazivArtikla,
				artikl_jmj:artikl.JMJ,
				artikl_cijena:parseFloat(artikl.cijenaArtikla).toFixed(2),
				artikl_stanje:stanjeArtikla
				};
			$scope.ArtikliSvi.push(object);
		});
		console.log($scope.ArtikliSvi);
	}
	$scope.total=0;
	$scope.artikliOdabrani=[];
	$scope.GetDetails = function (artiklID,index) {

		$scope.total;
		$scope.PocetnaIspis();
		var nazivArtikla="";
		var sifra = "";
        var naziv ="";
        var jmj="";
	    var cijena ="";
		var kolicinaa = document.getElementsByClassName("kolicina");
		var kolicina =0;
		var stanje=0;
		var ukupnaCijenaArtikla=0;
		
		angular.forEach($scope.lPrikaz,function(artikl)
		{
			if(artikl.artikl_id == artiklID)
			{
				nazivArtikla = artikl.artikl_naziv;
				sifra = artikl.artikl_id;
				jmj = artikl.artikl_jmj;
				cijena = artikl.artikl_cijena;
				for(var i=0;i<kolicinaa.length;i++)
				{
					if(kolicinaa[index] == kolicinaa[i])
					{
						kolicina =kolicinaa[i].value;
					}
				}
			}
			
		});
		ukupnaCijenaArtikla= ukupnaCijenaArtikla+(cijena*kolicina);
		
	   	
	       var oData = {
			'sifraArtikla': sifra,
			'nazivArtikla': nazivArtikla,
			'jmj': jmj,
			'cijena' : cijena,
			'kolicina': kolicina,
			'ukupnaCijena': ukupnaCijenaArtikla
		};
		$scope.total= parseInt($scope.total)+(cijena*kolicina);

		$scope.artikliOdabrani.push(oData);
        console.log($scope.artikliOdabrani);
        console.log($scope.total);
    };

    $scope.empty =function(artiklID,index)
    {
      var x = index;
		var kolicinaa = document.getElementsByClassName("kolicina");
		var kolicina =0;
		for (var i = 0; i< kolicinaa.length; i++) 
		{
			if(kolicinaa[index] == kolicinaa[i])
			{
				kolicina =kolicinaa[i].value;
				console.log(kolicina);
			}
		}
		if (kolicina =="") 
		{ 
			  bootbox.alert({
				    message: "Unesite količinu",
				});
		}
		else
		{
			$scope.GetDetails(artiklID,index);
		}
    }

    $scope.Total = function($total)
    {
    	$total= $scope.total;
    }

    $scope.DeleteArtikl = function($index, $ukupnaCijena, $kolicina)
    {
		$scope.index = $index;
    	$scope.artikliOdabrani.splice($scope.index,1);
    	$scope.total= $scope.total - ($ukupnaCijena);
    	console.log($scope.total);
    }

		

	$scope.getData = function()
	{
		$scope.PocetnaIspis();
		var artikli = $scope.artikliOdabrani;
		console.log($scope.artikliOdabrani);
		var oZaposlenik=document.getElementById("zaposlenik").innerHTML;	

		var oJsonArtikli = JSON.stringify(artikli);
			$.ajax({
				url: 'DodajPrimku.php',
				type: 'POST',
				dataType: "html",
				data:
				{
					cmd: "dodaj_primku",
					artikli:oJsonArtikli,
					zaposlenik:oZaposlenik
				},
				success: function (oData)
				{      

					console.log("Artikli: ");
					console.log(oData);

				},
				error: function(XMLHttpRequest, textStatus, exception)
				{
				console.log("Ajax failure\n" + error);
				},
				async: true
			});				
		
		bootbox.alert({
		    message: "Primka dodana",
		});
		$scope.reloadRoute();
	}

	$scope.reloadRoute = function() {
	   $route.reload();
	}
});