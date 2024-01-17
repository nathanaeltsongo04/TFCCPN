<?php

class evolution
{
	private $codeevolution;
	private $refpatiente;
	private $ddr;
	private $conjonctivite;
	private $dateconsult;
	private $htuterine;
	private $mvtfeotal;
	private $bcf;
	private $presentation;
	private $pertliqui;
	private $eodem;
	private $albumin;
	private $glycemie;
	private $tarterielle;
	private $contraction;
	private $baspromo;
	private $poids;
	private $taille;
	private $taillesup;
	private $DDATE;
	private $auteur;
	protected $con;

	public function getCodeevolution()
	{
		return $this->codeevolution;
	}

	public function setCodeevolution($value)
	{
		$this->codeevolution = $value;
	}

	public function getRefpatiente()
	{
		return $this->refpatiente;
	}

	public function setRefpatiente($value)
	{
		$this->refpatiente = $value;
	}

	public function getDdr()
	{
		return $this->ddr;
	}

	public function setDdr($value)
	{
		$this->ddr = $value;
	}

	public function getConjonctivite()
	{
		return $this->conjonctivite;
	}

	public function setConjonctivite($value)
	{
		$this->conjonctivite = $value;
	}

	public function getDateconsult()
	{
		return $this->dateconsult;
	}

	public function setDateconsult($value)
	{
		$this->dateconsult = $value;
	}

	public function getHtuterine()
	{
		return $this->htuterine;
	}

	public function setHtuterine($value)
	{
		$this->htuterine = $value;
	}

	public function getMvtfeotal()
	{
		return $this->mvtfeotal;
	}

	public function setMvtfeotal($value)
	{
		$this->mvtfeotal = $value;
	}

	public function getBcf()
	{
		return $this->bcf;
	}

	public function setBcf($value)
	{
		$this->bcf = $value;
	}

	public function getPresentation()
	{
		return $this->presentation;
	}

	public function setPresentation($value)
	{
		$this->presentation = $value;
	}

	public function getPertliqui()
	{
		return $this->pertliqui;
	}

	public function setPertliqui($value)
	{
		$this->pertliqui = $value;
	}

	public function getEodem()
	{
		return $this->eodem;
	}

	public function setEodem($value)
	{
		$this->eodem = $value;
	}

	public function getAlbumin()
	{
		return $this->albumin;
	}

	public function setAlbumin($value)
	{
		$this->albumin = $value;
	}

	public function getGlycemie()
	{
		return $this->glycemie;
	}

	public function setGlycemie($value)
	{
		$this->glycemie = $value;
	}

	public function getTarterielle()
	{
		return $this->tarterielle;
	}

	public function setTarterielle($value)
	{
		$this->tarterielle = $value;
	}

	public function getContraction()
	{
		return $this->contraction;
	}

	public function setContraction($value)
	{
		$this->contraction = $value;
	}

	public function getBaspromo()
	{
		return $this->baspromo;
	}

	public function setBaspromo($value)
	{
		$this->baspromo = $value;
	}

	public function getPoids()
	{
		return $this->poids;
	}

	public function setPoids($value)
	{
		$this->poids = $value;
	}

	public function getTaille()
	{
		return $this->taille;
	}

	public function setTaille($value)
	{
		$this->taille = $value;
	}

	public function getTaillesup()
	{
		return $this->taillesup;
	}

	public function setTaillesup($value)
	{
		$this->taillesup = $value;
	}
	public function getDDATE()
	{
		return $this->DDATE;
	}

	public function setDDATE($value)
	{
		$this->DDATE = $value;
	}

	public function getAuteur()
	{
		return $this->auteur;
	}

	public function setAuteur($value)
	{
		$this->auteur = $value;
	}

	public function inserer()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("INSERT INTO `tevolution`( `refpatiente`, `ddr`, 
            `conjonctivite`, `dateconsult`, `htuterine`, `mvtfeotal`, `bcf`, `presentation`, `pertliqui`, 
            `eodem`, `albumin`, `glycemie`, `tarterielle`, `contraction`, `baspromo`, `poids`, `taille`, 
            `taillesup`,`ddate`, `auteur`) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
			$stmt->execute([
				$this->refpatiente, $this->ddr, $this->conjonctivite, $this->dateconsult,
				$this->htuterine, $this->mvtfeotal, $this->bcf, $this->presentation, $this->pertliqui,
				$this->eodem, $this->albumin, $this->glycemie, $this->tarterielle, $this->contraction,
				$this->baspromo, $this->poids, $this->taille, $this->taillesup, $this->DDATE,
				$this->auteur
			]);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function afficher()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("SELECT * FROM `tevolution`");
			$stmt->execute();
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function afficherById()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("SELECT * FROM `tevolution` WHERE `codeevolution`=?");
			$stmt->execute([$this->codeevolution]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function afficherByrefpatiente()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("SELECT * FROM `tevolution` WHERE `refpatiente`=?");
			$stmt->execute([$this->refpatiente]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function afficherByrefpatientelast()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("SELECT * FROM `tevolution` WHERE `refpatiente`=? ORDER BY DDATE DESC LIMIT 1");
			$stmt->execute([$this->refpatiente]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function modifier()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("UPDATE `tevolution` SET 
            `ddr`=?,`conjonctivite`=?,
            `dateconsult`=?,`htuterine`=?,`mvtfeotal`=?,
            `bcf`=?,`presentation`=?,`pertliqui`=?,
            `eodem`=?,`albumin`=?,`glycemie`=?,
            `tarterielle`=?,`contraction`=?,`baspromo`=?,
            `poids`=?,`taille`=?,`taillesup`=?,
            `auteur`=? WHERE `codeevolution`=?");
			$stmt->execute([
				$this->ddr, $this->conjonctivite, $this->dateconsult,
				$this->htuterine, $this->mvtfeotal, $this->bcf, $this->presentation, $this->pertliqui,
				$this->eodem, $this->albumin, $this->glycemie, $this->tarterielle, $this->contraction,
				$this->baspromo, $this->poids, $this->taille, $this->taillesup,
				$this->auteur, $this->codeevolution
			]);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function supprimer()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("DELETE FROM `tevolution`nt` WHERE `codeevolution`=?");
			$stmt->execute([$this->codeevolution]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
