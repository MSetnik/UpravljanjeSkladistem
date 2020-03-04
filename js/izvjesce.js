oModul.controller("izvjesce", function($scope, $http) {
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
			$scope.SelectArtikli();
			$scope.DohvatiDokumente();
			$scope.DohvatiArtikle();


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
		$('#artikliOdabir').on('select2:select', function (e) {
		data = e.params.data;
		$scope.lIzvjesce = [];
			angular.forEach($scope.lDokumenti,function(dokument)
			{
				if(data.id==dokument.stavka_artikl )
				{
					var date = dokument.stavka_datum;
					date = date.split(" ");
					var datum = date[0];

					var datumNovi = datum.split("-").reverse().join(".")
					var newDate = datumNovi + " " + date[1];


						var object = {
						dokument_id : dokument.stavka_dokumentID,
						dokument_tip: dokument.stavka_dokumentTip,
						dokument_datum: dokument.stavka_datum,
						dokument_zaposlenik : dokument.stavka_dokumentZap
					};
					$scope.lIzvjesce.push(object);
		  		}
			});
			
		});	

	}

	$scope.PrikaziPretragu = function()
	{
		var oElement=document.getElementById("pretragaDokumenta");
		oElement.style.display = 'block';

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

	$scope.SelectArtikli= function()
	{
		angular.forEach($scope.artikli, function(artikl)
		{
			var data = {
			    id: artikl.sifraArtikla,
			    text: artikl.sifraArtikla + " - " +  artikl.nazivArtikla
			};
			var newOption = new Option(data.text, data.id, false, false);
			$('#artikliOdabir').append(newOption).trigger('change');
		});	
		$('#artikliOdabir').select2({placeholder: {id: '-1', text:'-- Odaberite artikl --'}});
	}


	$scope.IspisArtikalaDokumenta = function(DokId)
	{
		$scope.DohvatiDokumente();
		$scope.DohvatiArtikle();
		$scope.lArtikliDokumenta = [];
		var artiklCijena = 0;
		var cijenaUkupno =0;
		angular.forEach($scope.lArtikli,function(dokument)
		{
				if( DokId ==dokument.stavka_dokument)
				{
					var object = {
						artikl_id: dokument.stavka_artiklID,
						artikl_naziv: dokument.stavka_artiklNaziv,
						artikl_jmj:dokument.stavka_JMJ,
						artikl_cijena:parseFloat(dokument.stavka_cijena).toFixed(2),
						artikl_kolicina:dokument.stavka_kolicina,
						artikl_ukupnaCijena:(dokument.stavka_cijena* parseFloat(dokument.stavka_kolicina)).toFixed(2)
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
		angular.forEach($scope.lArtikliDokumenta,function(artikl)
		{
			artiklCijena += parseFloat(artikl.artikl_ukupnaCijena);
			console.log(artiklCijena);
		})
		$scope.total=parseFloat(artiklCijena).toFixed(2);
		console.log($scope.lArtikliDokumenta);
		$scope.prikazi(DokId);
		//$('#artikliDok').modal();
		
	}

});

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
		console.log(startDate);
		angular.forEach(lista,function(item)
		{
			var Datum = item.dokument_datum;
	      	dDatum = new Date(Datum);
	      	 if (startDate > dDatum) 
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