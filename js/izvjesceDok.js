oModul.controller("izvjesceDokumenata", function($scope, $http, $route) {
//$scope.lIzvjesce = [];
$scope.artiklInput = [];
var config={
		url:'json.php?json_id=dohvati_artikle',
		method:'GET'
	};

	var request = $http(config)
	.then(function (response) 
		{
			$scope.artikli = response.data;
			$scope.ispisDok();

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
			console.log($scope.dokumenti);


	    },
	    function (e) 
	    {
	    	console.log('error');
	 	}
	);

	
	$scope.IzvjesceIspis2 = function()
	{	
		$scope.DohvatiDokumente();
		$scope.DohvatiArtikle();
		$scope.lIzvjesce = [];
		angular.forEach($scope.lDokumenti,function(dokument)
		{
			if(data.id==dokument.stavka_artikl)
			{
					var object = {
					dokument_id : dokument.stavka_dokumentID,
					dokument_tip: dokument.stavka_dokumentTip,
					dokument_datum: dokument.stavka_datum,
					dokument_zaposlenik : dokument.stavka_dokumentZap
				};
				$scope.lIzvjesce.push(object);
	  		}
		});
		//$scope.PrikaziRacunarstvo();	

	}

	$scope.ispisDok = function()
	{	
		//$scope.DohvatiDokumente();
		var date;
		$scope.lIzvjesceDok = [];
		angular.forEach($scope.dokumenti,function(dokument)
		{			
			date = dokument.datum; 
			var datum1 = new Date(date);
			date = date.split(" ");
			var datum = date[0];

			var datumNovi = datum.split("-").reverse().join(".")
			var newDate = datumNovi + " " + date[1];

				var object = {
				dokument_id : dokument.id,
				dokument_tip: dokument.tip,
				dokument_datum: dokument.datum,
				dokument_zaposlenik : dokument.zaposlenik
			};
			$scope.lIzvjesceDok.push(object);
		});
	}
	
	$scope.prikazi = function(id)
	{
		var config ={
			method:'POST',
			url:'json.php',
			data:{
				'dokumentID' : id
			}
		};
		var request = $http(config);
		request.then(function(response){
			$scope.odgovor = response.data;
		}, function(error)
		{
			$scope.odgovor = error.data;
		});
		$('#artikliDok').modal();
	}

	$scope.DohvatiTipDok = function(dokId)
	{
		$scope.ispisDok();
		$scope.IspisArtikalaDokumenta();
		angular.forEach($scope.lIzvjesceDok, function(dok)
		{
			angular.forEach($scope.lArtikliDokumenta, function(artDok)
			{
				if(dok.dokument_id == dokId && artDok.stavka_dokument== dokId)
				{
					document.getElementById("tip").innerHTML = dok.dokument_tip;
				}
			});
		});
	}
	
	$scope.IspisArtikalaDokumenta = function(DokId)
	{
		$scope.DohvatiDokumente();
		var id = DokId;
		$scope.ispisDok();
		$scope.DohvatiStavke();
		$scope.lArtikliDokumenta = [];
		console.log($scope.lStavke);
		var artiklCijena = 0;
		var cijenaUkupno =0;
		angular.forEach($scope.lStavke,function(stavka)
		{

			if( DokId ==stavka.stavka_dokument)
			{
				var object = {
					artikl_id: stavka.stavka_artiklID,
					artikl_naziv: stavka.stavka_artiklNaziv,
					artikl_jmj:stavka.stavka_JMJ,
					artikl_cijena:parseFloat(stavka.stavka_cijena).toFixed(2),
					artikl_kolicina:stavka.stavka_kolicina,
					artikl_ukupnaCijena:(stavka.stavka_cijena* parseFloat(stavka.stavka_kolicina)).toFixed(2)
					};
				$scope.lArtikliDokumenta.push(object);
	  		}
		});
		angular.forEach($scope.lDokumenti,function(dok)
		{
			if( DokId ==dok.stavka_dokumentID)
			{
				document.getElementById("tip").innerHTML = dok.stavka_dokumentTip;
			}
		});
		console.log($scope.lArtikliDokumenta);
		angular.forEach($scope.lArtikliDokumenta,function(artikl)
		{
			artiklCijena += parseFloat(artikl.artikl_ukupnaCijena);
			console.log(artiklCijena);
		})
		$scope.total=parseFloat(artiklCijena).toFixed(2);
		$scope.prikazi(DokId);
	}

	/*$scope.IspisTipaDok = function()
	{
		var id = $scope.IspisArtikalaDokumenta(dokId);
		console.log(id)
	}*/
 function compare_dates (date1, date2)
	    {
	     if (date1>date2) return ("Date1 > Date2");
	   else if (date1<date2) return ("Date2 > Date1");
	   else return ("Date1 = Date2"); 
	}
	$scope.weDontLike = function(lista) {

		startDate2 = document.getElementById("datumOd").value;
		console.log(startDate2);
		var startDate = new Date(startDate2);
		//console.log(startDate);
        for (var i=0; i<lista.length;i++) 
	    {
	       	var Datum = lista[i].dokument_datum;
	      	dDatum = new Date(Datum);
	      	 if (startDate > dDatum) {
	            console.log(startDate+ "is the recent date." + dDatum);
	         } else {
	            console.log("<br>Date 2 is the recent date.");
	         }
	    } 


	  
		/*console.log(lista);
		startDate = document.getElementById("datumOd").value;
        endDate = document.getElementById("datumDo").value;
        result = [];

        var date =startDate;
        var date2 = endDate;
			date = date.split(" ");
			date2 = date2.split(" ");
			var datum = date[0];
			var datum1 = date2[0];

			var datumStart = datum.split("-").reverse().join(".");
			var datumPocetak = datumStart;
			var datumEnd = datum1.split("-").reverse().join(".");
			var datumKraj = datumEnd;
		   for (var i=0; i<lista.length;i++) 
		    {
		       	var Datum = lista[i].dokument_datum.split(" "); 
		        var DokDatum =Datum[0]; 
		        if (process(datumPocetak) <= process(DokDatum) && process(datumEnd) >= process(DokDatum)) {
		           result.push(lista[i]);
		        }
		    } 
		  
		    lista = result;
		    console.log(lista); 
		    return lista;*/

	};

	function process(date){
	    var parts = date.split(".");
   		return new Date(parts[2], parts[1] - 1, parts[0]);
	}

	$scope.reloadRoute = function() {
	   $route.reload();
	}




});

function parseDate(input) {
  var parts = input.split('-');
  return new Date(parts[2], parts[1]-1, parts[0]); 
}

oModul.filter("myFilter", function() {
  return function(lista, from) {
        var result = [];  
        startDate2 = from; //document.getElementById("datumOd").value;
		var startDate = new Date(startDate2);
		//console.log(startDate);
		angular.forEach(lista,function(item)
		{
			var Datum = item.dokument_datum;
	      	dDatum = new Date(Datum);
	      	 if (startDate <= dDatum) 
	      	 {
	            result.push(item);
	         } 
	        
		});      
   		if(startDate2 == null)
        {
        	return lista;
        }  
        else
        {
        	return result;
        }
  };
});

oModul.filter("myFilter2", function() {
  return function(lista,to) {


        var result = [];  
        startDate2 = to; //document.getElementById("datumOd").value;
		var startDate = new Date(startDate2);
		//console.log(startDate);
		angular.forEach(lista,function(item)
		{
			var Datum = item.dokument_datum;
	      	dDatum = new Date(Datum);
	      	 if (startDate >= dDatum) 
	      	 {
	            result.push(item);
	         } 
	        
		});    
		if(startDate2 == null)
        {
        	return lista;
        }  
        else{
        	return result;
        }
        
 	};
});