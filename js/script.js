var oModul = angular.module('app', ['ngRoute', 'ngCookies']); //Glavni Modul
//Definiranje ruta
oModul.config(function($routeProvider){
	$routeProvider.when('/', {
		templateUrl: 'templates/login.html',
		controller: 'glavniController'
	});

	$routeProvider.when('/pocetna' ,{
		templateUrl:'templates/pocetna.php',
		controller:'glavniController'
	});

	$routeProvider.when('/izvjesce' ,{
		templateUrl:'templates/izvjesceArtikala.php',
		controller:'glavniController'
	});

	$routeProvider.when('/izdatnica' ,{
		templateUrl:'templates/izdatnica.php',
		controller:'glavniController'
	});

	$routeProvider.when('/primka' ,{
		templateUrl:'templates/primka.php',
		controller:'glavniController'
	});

		$routeProvider.when('/dodajArtikl' ,{
		templateUrl:'templates/dodajArtikl.php',
		controller:'glavniController'
	});

		$routeProvider.when('/izvjesceDok' ,{
		templateUrl:'templates/izvjesceDokumenata.php',
		controller:'glavniController'
	});

		$routeProvider.when('/admin' ,{
		templateUrl:'templates/dodajAdmina.php',
		controller:'glavniController'
	});

		$routeProvider.when('/dodajKorisnika' ,{
		templateUrl:'templates/DodajKorisnika.php',
		controller:'glavniController'
	});


	$routeProvider.otherwise({
		template:'Došlo je do pogreške'
	});
});

oModul.factory('Authentication', function( $cookies ){
	//Postavljanje cookija - ne koristim
	var oAutentication = {};
	oAutentication.GetLoginStatus = function()
	{
		if( $cookies.get('logged_user') )
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	oAutentication.SetLoggedUser = function( sLoggedUser)
	{
		$cookies.put('logged_user', sLoggedUser)
	}

	oAutentication.Logout = function()
	{
		$cookies.remove('logged_user')
	}

	return oAutentication;
});

oModul.controller("glavniController", function($scope, $http, $location, Authentication) {

	//ukoliko korisnik nije prijavljen, uvijek ga preusmjeri na formu za login
	if( Authentication.GetLoginStatus() == false )
	{
		$location.path('/');
	}

	$scope.Prijava = function()
	{
		var oData = {
			'action_id': 'login',
			'user_name': $scope.user,
			'password': $scope.pass
		};

	    $http.post('login.php', oData)
	    .then
	    (
	    	function (response) 
	    	{
		    	if( response.data == 1 )
		    	{
		    		// za ulogiranog usera se obično postavlja username ili id kao cookie
		    		Authentication.SetLoggedUser('user_name');
		    		$location.path('/pocetna');

		    	}
		    	else
		    	{
		    		bootbox.alert({
					    message: "Netočni podatci. Pokušajte ponovo",
					});
		    	}
		        console.log(response);
		    },
		    function (e) 
		    {
		    	console.log('error');
		 	}
		);
	};

	$scope.Odjava = function()
	{
		var oData = {
			'action_id': 'logout'
		};
		$http.post('login.php', oData)
		    .then
		    (
		    	function (response) 
		    	{
		    		Authentication.Logout();
		    		//$location.path('/');
		    		document.location = 'index.php';
			    },
			    function (e) 
			    {
			    	console.log('error');
			 	}
		);
	}

$ ('#username').keypress(function (event)
{
	if(event.which==13)
	{
		$('#Login').click();
	}
});

$ ('#password').keypress(function (event)
{
	if(event.which==13)
	{
		$('#Login').click();
	}
});

});


