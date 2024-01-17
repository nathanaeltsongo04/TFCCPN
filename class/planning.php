<?php
class planning
{
    private $CODEPLANNING;
    private $REFPATIENTE;
    private $DATERDV;
    private $DDATE;
    private $AUTEUR;
    protected $con;


    public function getCODEPLANNING()
    {
        return $this->CODEPLANNING;
    }

    public function setCODEPLANNING($value)
    {
        $this->CODEPLANNING = $value;
    }

    public function getREFPATIENTE()
    {
        return $this->REFPATIENTE;
    }

    public function setREFPATIENTE($value)
    {
        $this->REFPATIENTE = $value;
    }

    public function getDATERDV()
    {
        return $this->DATERDV;
    }

    public function setDATERDV($value)
    {
        $this->DATERDV = $value;
    }

    public function getDDATE()
    {
        return $this->DDATE;
    }

    public function setDDATE($value)
    {
        $this->DDATE = $value;
    }

    public function getAUTEUR()
    {
        return $this->AUTEUR;
    }

    public function setAUTEUR($value)
    {
        $this->AUTEUR = $value;
    }
    public function inserer()
    {

        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("INSERT INTO `planning`( `REFPATIENTE`, `DATERDV`, `DDATE`, `AUTEUR`) VALUES (?,?,?,?)");
            $stmt->execute([$this->REFPATIENTE, $this->DATERDV, $this->DDATE, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }
    public function sum()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT count(*) as totalconsultation,DAYNAME(CURRENT_DATE()-INTERVAL 1 DAY) as jour FROM planning WHERE DATERDV=CURRENT_DATE()- INTERVAL 1 DAY");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function sumlastmonth()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT count(*) as totallast,MONTHNAME(CURRENT_DATE()-INTERVAL 1 MONTH) as mois FROM planning WHERE DATERDV=MONTH(CURRENT_DATE())-INTERVAL 1 MONTH");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT planning.REFPATIENTE as codepatiente,planning.CODEPLANNING as code,tpatiente.NOM as nom,tpatiente.POSTNOM as postnom,tpatiente.PRENOM as prenom,planning.DATERDV as rdvdate,planning.DDATE as ddate FROM `planning`
inner join tpatiente on planning.REFPATIENTE=tpatiente.CODEPATIENTE ");
            $stmt->execute();
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
            $stmt = $connect->prepare("SELECT planning.REFPATIENTE as codepatiente,planning.CODEPLANNING as code,tpatiente.NOM as nom,tpatiente.POSTNOM as postnom,tpatiente.PRENOM as prenom,planning.DATERDV as rdvdate,planning.DDATE as ddate FROM `planning`
inner join tpatiente on planning.REFPATIENTE=tpatiente.CODEPATIENTE where planning.DATERDV=? ");
            $stmt->execute([$this->DATERDV]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function afficherid()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `planning` WHERE REFPATIENTE=?");
            $stmt->execute([$this->REFPATIENTE]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function afficheridlast()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `planning` WHERE REFPATIENTE=? ORDER BY DATERDV DESC LIMIT 1");
            $stmt->execute([$this->REFPATIENTE]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function supprimer()
    {
        try {
            $con = new Database();
            $connect = $con->open();
            $stmt = $connect->prepare("DELETE FROM `planning` WHERE CODEPLANNING=?");
            $stmt->execute([$this->CODEPLANNING]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function update()
    {
        try {
            $con = new Database();
            $connect = $con->open();
            $stmt = $connect->prepare("UPDATE `planning` SET `REFPATIENTE`=?,`DATERDV`=?,`DDATE`=?,`AUTEUR`=? WHERE CODEPATIENTE=?");
            $stmt->execute([$this->REFPATIENTE, $this->DATERDV, $this->DDATE, $this->AUTEUR, $this->CODEPLANNING]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}