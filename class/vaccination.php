<?php

class vaccination
{
    private $CODEVACCINATION;
    private $REFPATIENTE;
    private $REFVACCIN;
    private $DATEVACCIN;
    private $DDATE;
    private $AUTEUR;

    protected $con;



    public function getCODEVACCINATION()
    {
        return $this->CODEVACCINATION;
    }

    public function setCODEVACCINATION($value)
    {
        $this->CODEVACCINATION = $value;
    }

    public function getREFPATIENTE()
    {
        return $this->REFPATIENTE;
    }

    public function setREFPATIENTE($value)
    {
        $this->REFPATIENTE = $value;
    }

    public function getREFVACCIN()
    {
        return $this->REFVACCIN;
    }

    public function setREFVACCIN($value)
    {
        $this->REFVACCIN = $value;
    }

    public function getDATEVACCIN()
    {
        return $this->DATEVACCIN;
    }

    public function setDATEVACCIN($value)
    {
        $this->DATEVACCIN = $value;
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
            $stmt = $connect->prepare("INSERT INTO `tvaccination`(`REFPATIENTE`, `REFVACCIN`, `DATEVACCIN`, `DDATE`,`AUTEUR`) VALUES (?,?,?,?,?)");
            $stmt->execute([$this->REFPATIENTE, $this->REFVACCIN, $this->DATEVACCIN, $this->DDATE, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }

    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `tvaccination`");
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
            $stmt = $connect->prepare("SELECT * FROM `tvaccination` WHERE codevaccination=? ");
            $stmt->execute([$this->CODEVACCINATION]);
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
            $stmt = $connect->prepare("SELECT tvaccination.codevaccination,tvaccination.DDATE,DATEVACCIN,tvaccin.designation as vaccin FROM `tvaccination` inner join tvaccin on tvaccination.refvaccin=tvaccin.codevaccin WHERE refpatiente=?");
            $stmt->execute([$this->REFPATIENTE]);
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
            $stmt = $connect->prepare("SELECT tvaccination.codevaccination,tvaccination.DDATE as ladate,DATEVACCIN,tvaccin.designation as vaccin FROM `tvaccination` inner join tvaccin on tvaccination.refvaccin=tvaccin.codevaccin WHERE refpatiente=? ORDER BY DDATE DESC LIMIT 1");
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
            $stmt = $connect->prepare("DELETE FROM `tvaccination` WHERE codevaccination=?");
            $stmt->execute([$this->CODEVACCINATION]);
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
            $stmt = $connect->prepare("UPDATE `tvaccination` SET `REFPATIENTE`=?,`REFVACCIN`=?,`DATEVACCIN`=?,`AUTEUR`=? WHERE codevaccination=?");
            $stmt->execute([$this->REFPATIENTE, $this->REFVACCIN, $this->DATEVACCIN, $this->AUTEUR, $this->CODEVACCINATION]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
