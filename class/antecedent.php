<?php


class antecedent
{
	private $codeantecedent;
	private $refpatiente;
	private $htarterielle;
	private $dbt;
	private $cardiopat;
	private $istvih;
	private $autres;
	private $cesriene;
	private $cerclage;
	private $fibrome;
	private $fractbassin;
	private $gpu;
	private  $ddr;
	private $parite;
	private $grossesse;
	private $enfantvie;
	private $avortement;
	private $avortfirsttrim;
	private $trimpart15;
	private $trimpart30plus;
	private $lastaccouch;
	private $interval2ans;
	private $dystocie;
	private $eudocie;
	private $bigpoids;
	private $poidssup4;
	private $lastbornprema;
	private $postmat;
	private $mortne;
	private $mortavsept;
	private $compsterilite;
	private $compostpat;
	private $comppostpatoui;
	private $DDATE;
	private $auteur;
	protected $con;

	public function getCodeantecedent()
	{
		return $this->codeantecedent;
	}

	public function setCodeantecedent($value)
	{
		$this->codeantecedent = $value;
	}


	public function getRefpatiente()
	{
		return $this->refpatiente;
	}

	public function setRefpatiente($value)
	{
		$this->refpatiente = $value;
	}

	public function getHtarterielle()
	{
		return $this->htarterielle;
	}

	public function setHtarterielle($value)
	{
		$this->htarterielle = $value;
	}

	public function getDbt()
	{
		return $this->dbt;
	}

	public function setDbt($value)
	{
		$this->dbt = $value;
	}

	public function getCardiopat()
	{
		return $this->cardiopat;
	}

	public function setCardiopat($value)
	{
		$this->cardiopat = $value;
	}

	public function getIstvih()
	{
		return $this->istvih;
	}

	public function setIstvih($value)
	{
		$this->istvih = $value;
	}

	public function getAutres()
	{
		return $this->autres;
	}

	public function setAutres($value)
	{
		$this->autres = $value;
	}

	public function getCesriene()
	{
		return $this->cesriene;
	}

	public function setCesriene($value)
	{
		$this->cesriene = $value;
	}

	public function getCerclage()
	{
		return $this->cerclage;
	}

	public function setCerclage($value)
	{
		$this->cerclage = $value;
	}

	public function getFibrome()
	{
		return $this->fibrome;
	}

	public function setFibrome($value)
	{
		$this->fibrome = $value;
	}

	public function getFractbassin()
	{
		return $this->fractbassin;
	}

	public function setFractbassin($value)
	{
		$this->fractbassin = $value;
	}

	public function getGpu()
	{
		return $this->gpu;
	}

	public function setGpu($value)
	{
		$this->gpu = $value;
	}

	public function getDdr()
	{
		return $this->ddr;
	}

	public function setDdr($value)
	{
		$this->ddr = $value;
	}

	public function getParite()
	{
		return $this->parite;
	}

	public function setParite($value)
	{
		$this->parite = $value;
	}

	public function getGrossesse()
	{
		return $this->grossesse;
	}

	public function setGrossesse($value)
	{
		$this->grossesse = $value;
	}

	public function getEnfantvie()
	{
		return $this->enfantvie;
	}

	public function setEnfantvie($value)
	{
		$this->enfantvie = $value;
	}

	public function getAvortfirsttrim()
	{
		return $this->avortfirsttrim;
	}

	public function setAvortfirsttrim($value)
	{
		$this->avortfirsttrim = $value;
	}

	public function getTrimpart15()
	{
		return $this->trimpart15;
	}

	public function setTrimpart15($value)
	{
		$this->trimpart15 = $value;
	}

	public function getTrimpart30plus()
	{
		return $this->trimpart30plus;
	}

	public function setTrimpart30plus($value)
	{
		$this->trimpart30plus = $value;
	}

	public function getLastaccouch()
	{
		return $this->lastaccouch;
	}

	public function setLastaccouch($value)
	{
		$this->lastaccouch = $value;
	}

	public function getInterval2ans()
	{
		return $this->interval2ans;
	}

	public function setInterval2ans($value)
	{
		$this->interval2ans = $value;
	}

	public function getDystocie()
	{
		return $this->dystocie;
	}

	public function setDystocie($value)
	{
		$this->dystocie = $value;
	}

	public function getEudocie()
	{
		return $this->eudocie;
	}

	public function setEudocie($value)
	{
		$this->eudocie = $value;
	}

	public function getBigpoids()
	{
		return $this->bigpoids;
	}

	public function setBigpoids($value)
	{
		$this->bigpoids = $value;
	}

	public function getPoidssup4()
	{
		return $this->poidssup4;
	}

	public function setPoidssup4($value)
	{
		$this->poidssup4 = $value;
	}

	public function getLastbornprema()
	{
		return $this->lastbornprema;
	}

	public function setLastbornprema($value)
	{
		$this->lastbornprema = $value;
	}

	public function getPostmat()
	{
		return $this->postmat;
	}

	public function setPostmat($value)
	{
		$this->postmat = $value;
	}

	public function getMortne()
	{
		return $this->mortne;
	}

	public function setMortne($value)
	{
		$this->mortne = $value;
	}

	public function getMortavsept()
	{
		return $this->mortavsept;
	}

	public function setMortavsept($value)
	{
		$this->mortavsept = $value;
	}

	public function getCompsterilite()
	{
		return $this->compsterilite;
	}

	public function setCompsterilite($value)
	{
		$this->compsterilite = $value;
	}

	public function getCompostpat()
	{
		return $this->compostpat;
	}

	public function setCompostpat($value)
	{
		$this->compostpat = $value;
	}

	public function getComppostpatoui()
	{
		return $this->comppostpatoui;
	}

	public function setComppostpatoui($value)
	{
		$this->comppostpatoui = $value;
	}

	public function getAuteur()
	{
		return $this->auteur;
	}

	public function setAuteur($value)
	{
		$this->auteur = $value;
	}
	public function getAvortement()
	{
		return $this->avortement;
	}

	public function setAvortement($value)
	{
		$this->avortement = $value;
	}

	public function inserer()
	{
		$con = new Database();
		$connect = $con->open();
		try {
			$stmt = $connect->prepare("INSERT INTO `tantecedent`(`refpatiente`, 
            `htarterielle`, `dbt`, `cardiopat`, `istvih`, `autres`, `cesriene`, `cerclage`, 
            `fibrome`, `fractbassin`, `gpu`, `ddr`, `parite`, `grossesse`,`avortement`, `enfantvie`, `avortfirsttrim`, 
            `trimpart15`, `trimpart30plus`, `lastaccouch`, `interval2ans`, `dystocie`, `eudocie`, 
            `bigpoids`, `poidssup4`, `lastbornprema`, `postmat`, `mortne`, `mortavsept`, `compsterilite`, 
            `compostpat`, `comppostpatoui`, `ddate`,`auteur`) VALUES (?,?,?,
            ?,?,?,?,?,?,?,
            ?,?,?,?,?,?,
            ?,?,?,?,?,?,
            ?,?,?,?,?,?,
            ?,?,?,?,?,?)");
			$stmt->execute([
				$this->refpatiente, $this->htarterielle, $this->dbt, $this->cardiopat,
				$this->istvih, $this->autres, $this->cesriene, $this->cerclage, $this->fibrome,
				$this->fractbassin, $this->gpu, $this->ddr, $this->parite, $this->grossesse, $this->avortement,
				$this->enfantvie, $this->avortfirsttrim, $this->trimpart15, $this->trimpart30plus,
				$this->lastaccouch, $this->interval2ans, $this->dystocie, $this->eudocie,
				$this->bigpoids, $this->poidssup4, $this->lastbornprema, $this->postmat,
				$this->mortne, $this->mortavsept, $this->compsterilite, $this->compostpat,
				$this->comppostpatoui, $this->DDATE, $this->auteur
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
			$stmt = $connect->prepare("SELECT * FROM `tantecedent`");
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
			$stmt = $connect->prepare("SELECT * FROM `tantecedent` WHERE `codeantecedent`=?");
			$stmt->execute([$this->codeantecedent]);
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
			$stmt = $connect->prepare("SELECT * FROM `tantecedent` WHERE `refpatiente`=? ");
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
			$stmt = $connect->prepare("SELECT * FROM `tantecedent` WHERE `refpatiente`=? ORDER BY DDATE DESC LIMIT 1 ");
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
			$stmt = $connect->prepare("UPDATE `tantecedent` SET
            `htarterielle`=?,`dbt`=?,`cardiopat`=?,`istvih`=?,
            `autres`=?,`cesriene`=?,`cerclage`=?,`fibrome`=?,
            `fractbassin`=?,`gpu`=?,`ddr`=?,`parite`=?,
            `grossesse`=?,`enfantvie`=?,`avortfirsttrim`=?,
            `trimpart15`=?,`trimpart30plus`=?,`lastaccouch`=?,
            `interval2ans`=?,`dystocie`=?,`eudocie`=?,
            `bigpoids`=?,`poidssup4`=?,`lastbornprema`=?,
            `postmat`=?,`mortne`=?,`mortavsept`=?,
            `compsterilite`=?,`compostpat`=?,`comppostpatoui`=?,
            `auteur`=? WHERE `codeantecedent`=?");
			$stmt->execute([
				$this->htarterielle, $this->dbt, $this->cardiopat,
				$this->istvih, $this->autres, $this->cesriene, $this->cerclage, $this->fibrome,
				$this->fractbassin, $this->gpu, $this->ddr, $this->parite, $this->grossesse,
				$this->enfantvie, $this->avortfirsttrim, $this->trimpart15, $this->trimpart30plus,
				$this->lastaccouch, $this->interval2ans, $this->dystocie, $this->eudocie,
				$this->bigpoids, $this->poidssup4, $this->lastbornprema, $this->postmat,
				$this->mortne, $this->mortavsept, $this->compsterilite, $this->compostpat,
				$this->comppostpatoui, $this->auteur, $this->codeantecedent
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
			$stmt = $connect->prepare("DELETE FROM `tantecedent` WHERE `codeantecedent`=?");
			$stmt->execute([$this->codeantecedent]);
			return $stmt->fetchAll();
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}


	public function getDDATE()
	{
		return $this->DDATE;
	}

	public function setDDATE($value)
	{
		$this->DDATE = $value;
	}
}
