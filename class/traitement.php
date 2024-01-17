<?php

class traitement
{
    private $CODETRAITEMENT;
    private $REFPATIENTE;
    private $MILDA;
    private $SIMILDA;
    private $SPFER;
    private $VERMIFUGE;
    private $DDATE;
    private $AUTEUR;
    protected $con;

    public function getCODETRAITEMENT()
    {
        return $this->CODETRAITEMENT;
    }

    public function setCODETRAITEMENT($value)
    {
        $this->CODETRAITEMENT = $value;
    }

    public function getREFPATIENTE()
    {
        return $this->REFPATIENTE;
    }

    public function setREFPATIENTE($value)
    {
        $this->REFPATIENTE = $value;
    }

    public function getMILDA()
    {
        return $this->MILDA;
    }

    public function setMILDA($value)
    {
        $this->MILDA  = $value;
    }

    public function getSIMILDA()
    {
        return $this->SIMILDA;
    }

    public function setSIMILDA($value)
    {
        $this->SIMILDA = $value;
    }

    public function getSPFER()
    {
        return $this->SPFER;
    }

    public function setSPFER($value)
    {
        $this->SPFER = $value;
    }

    public function getVERMIFUGE()
    {
        return $this->VERMIFUGE;
    }

    public function setVERMIFUGE($value)
    {
        $this->VERMIFUGE = $value;
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
            $stmt = $connect->prepare("INSERT INTO `ttraitement`(`REFPATIENTE`, `MILDA`, `SIMILDA`, `SPFER`, `VERMIFUGE`, `DDATE`,`AUTEUR`) VALUES (?,?,?,?,?,?,?)");
            $stmt->execute([$this->REFPATIENTE, $this->MILDA, $this->SIMILDA, $this->SPFER, $this->VERMIFUGE, $this->DDATE, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }

    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `ttraitement` ");
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
            $stmt = $connect->prepare("SELECT * FROM `ttraitement` WHERE codetraitement=?");
            $stmt->execute([$this->CODETRAITEMENT]);
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
            $stmt = $connect->prepare("SELECT * FROM `ttraitement` WHERE REFPATIENTE=?");
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
            $stmt = $connect->prepare("SELECT * FROM `ttraitement` WHERE REFPATIENTE=? ORDER BY DDATE DESC LIMIT 1");
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
            $stmt = $connect->prepare("DELETE FROM `ttraitement` WHERE codetraitement=?");
            $stmt->execute([$this->CODETRAITEMENT]);
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
            $stmt = $connect->prepare("UPDATE `ttraitement` SET `REFPATIENTE`=?,`MILDA`=?,`SIMILDA`=?,`SPFER`=?,`VERMIFUGE`=?,`AUTEUR`=? WHERE codetraitement=?");
            $stmt->execute([$this->REFPATIENTE, $this->MILDA, $this->SIMILDA, $this->SPFER, $this->VERMIFUGE, $this->AUTEUR, $this->CODETRAITEMENT]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
