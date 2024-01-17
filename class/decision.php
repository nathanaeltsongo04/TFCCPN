<?php


class decision
{
    private $CODEDECISION;
    private $REFCONSULATION;
    private $CPNNORMAL;
    private $RDVMAT;
    private $RAISON;
    private $AUTEUR;
    private $DDATE;
    protected $con;

    public function getCODEDECISION()
    {
        return $this->CODEDECISION;
    }

    public function setCODEDECISION($value)
    {
        $this->CODEDECISION  = $value;
    }

    public function getREFCONSULATION()
    {
        return $this->REFCONSULATION;
    }

    public function setREFCONSULATION($value)
    {
        $this->REFCONSULATION  = $value;
    }

    public function getCPNNORMAL()
    {
        return $this->CPNNORMAL;
    }

    public function setCPNNORMAL($value)
    {
        $this->CPNNORMAL = $value;
    }

    public function getRDVMAT()
    {
        return $this->RDVMAT;
    }

    public function setRDVMAT($value)
    {
        $this->RDVMAT = $value;
    }

    public function getRAISON()
    {
        return $this->RAISON;
    }

    public function setRAISON($value)
    {
        $this->RAISON  = $value;
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
            $stmt = $connect->prepare("INSERT INTO `tdecision`(`REFCONSULATION`, `CPNNORMAL`, `RDVMAT`, `RAISON`, `AUTEUR`, `DDATE`) VALUES (?,?,?,?,?,?)");
            $stmt->execute([$this->REFCONSULATION, $this->CPNNORMAL, $this->RDVMAT, $this->RAISON, $this->AUTEUR, $this->DDATE]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }

    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `tdecision`");
            $stmt->execute();
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
            $stmt = $connect->prepare("SELECT * FROM `tdecision` WHERE codedecision=? ");
            $stmt->execute([$this->CODEDECISION]);
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
            $stmt = $connect->prepare("DELETE FROM `tdecision` WHERE codedecision=?");
            $stmt->execute([$this->CODEDECISION]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function modifier()
    {
        try {
            $con = new Database();
            $connect = $con->open();
            $stmt = $connect->prepare("UPDATE `tdecision` SET `REFCONSULATION`=?,`CPNNORMAL`=?,`RDVMAT`=?,`RAISON`=?,`AUTEUR`=? WHERE codedecision=?");
            $stmt->execute([$this->REFCONSULATION, $this->CPNNORMAL, $this->RDVMAT, $this->RAISON, $this->AUTEUR, $this->CODEDECISION]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
