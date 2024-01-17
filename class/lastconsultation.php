<?php

class lastconsultation
{
	private $codelastconsult;
	private $refpatiente;
	private $conj;
	private $hb7et50;
	private $htuterine;
	private $plusde36;
	private $btf;
	private $sibtf;
	private $presentation;
	private $oedem;
	private $albumine;
	private $ta;
	private $tamotif;
	private $pertliqui;
	private $autreprecision;
	private $contraction;
	private $DDATE;
	private $auteur;
	protected $con;

	public function getCodelastconsult()
	{
		return $this->codelastconsult;
	}

	public function setCodelastconsult($value)
	{
		$this->codelastconsult = $value;
	}

	public function getRefpatiente()
	{
		return $this->refpatiente;
	}

	public function setRefpatiente($value)
	{
		$this->refpatiente = $value;
	}

	public function getConj()
	{
		return $this->conj;
	}

	public function setConj($value)
	{
		$this->conj = $value;
	}

	public function getHb7et50()
	{
		return $this->hb7et50;
	}

	public function setHb7et50($value)
	{
		$this->hb7et50 = $value;
	}

	public function getHtuterine()
	{
		return $this->htuterine;
	}

	public function setHtuterine($value)
	{
		$this->htuterine = $value;
	}

	public function getPlusde36()
	{
		return $this->plusde36;
	}

	public function setPlusde36($value)
	{
		$this->plusde36 = $value;
	}

	public function getBtf()
	{
		return $this->btf;
	}

	public function setBtf($value)
	{
		$this->btf = $value;
	}

	public function getSibtf()
	{
		return $this->sibtf;
	}

	public function setSibtf($value)
	{
		$this->sibtf = $value;
	}

	public function getPresentation()
	{
		return $this->presentation;
	}

	public function setPresentation($value)
	{
		$this->presentation = $value;
	}

	public function getOedem()
	{
		return $this->oedem;
	}

	public function setOedem($value)
	{
		$this->oedem = $value;
	}

	public function getAlbumine()
	{
		return $this->albumine;
	}

	public function setAlbumine($value)
	{
		$this->albumine = $value;
	}

	public function getTa()
	{
		return $this->ta;
	}

	public function setTa($value)
	{
		$this->ta = $value;
	}

	public function getTamotif()
	{
		return $this->tamotif;
	}

	public function setTamotif($value)
	{
		$this->tamotif = $value;
	}

	public function getPertliqui()
	{
		return $this->pertliqui;
	}

	public function setPertliqui($value)
	{
		$this->pertliqui = $value;
	}

	public function getAutreprecision()
	{
		return $this->autreprecision;
	}

	public function setAutreprecision($value)
	{
		$this->autreprecision = $value;
	}

	public function getContraction()
	{
		return $this->contraction;
	}

	public function setContraction($value)
	{
		$this->contraction = $value;
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
			$stmt = $connect->prepare("INSERT INTO `tlastconsultation`( `refpatiente`, `conj`, 
            `hb7et50`, `htuterine`, `plusde36`, `btf`, `sibtf`, `presentation`, `oedem`, 
            `albumine`, `ta`, `tamotif`, `pertliqui`, `autreprecision`, `contraction`,`ddate` ,`auteur`) 
            VALUES (?,?,?,?,?,?,?,?,
            ?,?,?,?,?,?,?,?,?)");
			$stmt->execute([
				$this->refpatiente, $this->conj, $this->hb7et50, $this->htuterine,
				$this->plusde36, $this->btf, $this->sibtf, $this->presentation, $this->oedem,
				$this->albumine, $this->ta, $this->tamotif, $this->pertliqui, $this->autreprecision,
				$this->contraction, $this->DDATE,
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
			$stmt = $connect->prepare("SELECT * FROM `tlastconsultation`");
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
			$stmt = $connect->prepare("SELECT * FROM `tlastconsultation` WHERE `codelastconsult`=?");
			$stmt->execute([$this->codelastconsult]);
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
			$stmt = $connect->prepare("SELECT * FROM `tlastconsultation` WHERE `refpatiente`=?");
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
			$stmt = $connect->prepare("SELECT * FROM `tlastconsultation` WHERE `refpatiente`=? ORDER BY DDATE DESC LIMIT 1");
			$stmt->execute([$this->refpatiente]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function afficherByrefpatientelastdecision()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("SELECT tlastconsultation.CODELASTCONSULT ,REFPATIENTE ,tdecision.REFCONSULATION as refconsultation, tdecision.CPNNORMAL as cpnnormal,tdecision.RDVMAT as rdvmat,tdecision.RAISON as raison FROM `tlastconsultation` inner join tdecision on tlastconsultation.CODELASTCONSULT =tdecision.REFCONSULATION WHERE `refpatiente`=? ");
			$stmt->execute([$this->refpatiente]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	public function afficherByrefpatientelastdecisionlast()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("SELECT tlastconsultation.CODELASTCONSULT ,REFPATIENTE ,tdecision.REFCONSULATION as refconsultation, tdecision.CPNNORMAL as cpnnormal,tdecision.RDVMAT as rdvmat,tdecision.RAISON as raison FROM `tlastconsultation` inner join tdecision on tlastconsultation.CODELASTCONSULT =tdecision.REFCONSULATION WHERE `refpatiente`=? ORDER BY tdecision.DDATE DESC LIMIT 1");
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
			$stmt = $connect->prepare("UPDATE `tlastconsultation` SET `conj`=?,`hb7et50`=?,
            `htuterine`=?,`plusde36`=?,`btf`=?,`sibtf`=?,
            `presentation`=?,`oedem`=?,`albumine`=?,
            `ta`=?,`tamotif`=?,`pertliqui`=?,
            `autreprecision`=?,`contraction`=?,`auteur`=?
             WHERE `codelastconsult`=?");
			$stmt->execute([
				$this->conj, $this->hb7et50, $this->htuterine,
				$this->plusde36, $this->btf, $this->sibtf, $this->presentation, $this->oedem,
				$this->albumine, $this->ta, $this->tamotif, $this->pertliqui, $this->autreprecision,
				$this->contraction,
				$this->auteur, $this->codelastconsult
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
			$stmt = $connect->prepare("DELETE FROM `tlastconsultation` WHERE `codelastconsult`=?");
			$stmt->execute([$this->codelastconsult]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
