<?php 
class Configuration
{
	public $host="127.0.0.1";
	public $dbname = "skladiste";
	public $username = "root";
	public $password = "";
}

class Artikl
{
	public $sifraArtikla;
	public $nazivArtikla;
	public $JMJ;
	public $cijenaArtikla;

	public function __construct($sifraArtikla=null,$nazivArtikla=null, $JMJ=null, $cijenaArtikla=null)
	{
		if($sifraArtikla) $this->sifraArtikla=$sifraArtikla;
		if($nazivArtikla) $this->nazivArtikla=$nazivArtikla;
		if($JMJ) $this->JMJ=$JMJ;
		if($cijenaArtikla) $this->cijenaArtikla=$cijenaArtikla;
	}	
}

class Dokument
{
	public $id;
	public $tip;
	public $datum;
	public $zaposlenik = "N/A";

	public function __construct($id=null,$tip=null, $datum=null, $zaposlenik=null)
	{
		if($id) $this->id=$id;
		if($tip) $this->tip=$tip;
		if($datum) $this->datum=$datum;
		if($zaposlenik) $this->zaposlenik=$zaposlenik;
	}
}

class Login
{
	public $korisnickoIme;
	public $lozinka;
	public $ime;
	public $prezime;
	public $admin;

	public function __construct($korisnickoIme=null,$lozinka=null,$ime=null,$prezime=null,$admin=null)
	{
		if($korisnickoIme) $this->korisnickoIme=$korisnickoIme;
		if($lozinka) $this->lozinka=$lozinka;
		if($ime) $this->ime=$ime;
		if($prezime) $this->prezime=$prezime;
		if($admin) $this->admin=$admin;
	}	
}

class StanjeSkladista
{
	public $sifraArtikla;
	public $nazivArtikla;
	public $JMJ;
	public $cijenaArtikla;
	public $tipDokumenta;
	public $datumDokumenta;
	public $kolicina;

	public function __construct($sifraArtikla=null,$nazivArtikla=null, $JMJ=null, $cijenaArtikla=null, $tipDokumenta=null, $datumDokumenta=null, $kolicina=null)
	{
		if($sifraArtikla) $this->sifraArtikla=$sifraArtikla;
		if($nazivArtikla) $this->nazivArtikla=$nazivArtikla;
		if($JMJ) $this->JMJ=$JMJ;
		if($cijenaArtikla) $this->cijenaArtikla=$cijenaArtikla;
		if($tipDokumenta) $this->tipDokumenta=$tipDokumenta;
		if($datumDokumenta) $this->datumDokumenta=$datumDokumenta;
		if($kolicina) $this->kolicina=$kolicina;
	}
}


class Stavke
{
	public $id;
	public $dokument_id;
	public $sifraArtikla;
	public $kolicina;
	public $JMJ = "N/A";
	public $nazivArtikla;
	public $cijenaArtikla;
	

	public function __construct($id=null,$dokument_id=null, $sifraArtikla=null, $kolicina=null, $JMJ=null, $nazivArtikla=null, $cijenaArtikla=null)
	{
		if($id) $this->id=$id;
		if($dokument_id) $this->dokument_id=$dokument_id;
		if($sifraArtikla) $this->sifraArtikla=$sifraArtikla;
		if($kolicina) $this->kolicina=$kolicina;
		if($JMJ) $this->JMJ=$JMJ;
		if($nazivArtikla) $this->nazivArtikla=$nazivArtikla;
		if($cijenaArtikla) $this->cijenaArtikla=$cijenaArtikla;
	}

}

class StavkeIspis
{
	public $id;
	public $tip;
	public $sifraArtikla;
	public $nazivArtikla;
	public $JMJ;
	public $cijena;

	public function __construct($id=null,$tip=null, $sifraArtikla=null,$nazivArtikla=null, $JMJ=null, $cijena=null)
	{
		if($id) $this->id=$id;
		if($tip) $this->tip=$tip;
		if($nazivArtikla) $this->nazivArtikla=$nazivArtikla;
		if($JMJ) $this->JMJ=$JMJ;
		if($cijena) $this->cijena=$cijena;
	}
}

 ?>