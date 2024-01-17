<?php
class exapasse
{
    private $CODEEXAMPASS;
    private $REFEXAM;
    private $REFPATIENTE;
    private $RESUTLTAT;
    private $TRAITEMENT;
    private $DDATE;
    private $AUTEUR;
    protected $con;

    public function getCODEEXAMPASS()
    {
        return $this->CODEEXAMPASS;
    }

    public function setCODEEXAMPASS($value)
    {
        $this->CODEEXAMPASS = $value;
    }

    public function getREFEXAM()
    {
        return $this->REFEXAM;
    }

    public function setREFEXAM($value)
    {
        $this->REFEXAM = $value;
    }

    public function getREFPATIENTE()
    {
        return $this->REFPATIENTE;
    }

    public function setREFPATIENTE($value)
    {
        $this->REFPATIENTE = $value;
    }

    public function getRESUTLTAT()
    {
        return $this->RESUTLTAT;
    }

    public function setRESUTLTAT($value)
    {
        $this->RESUTLTAT = $value;
    }

    public function getTRAITEMENT()
    {
        return $this->TRAITEMENT;
    }

    public function setTRAITEMENT($value)
    {
        $this->TRAITEMENT = $value;
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
            $stmt = $connect->prepare("INSERT INTO `texapasse`(`REFEXAM`, `REFPATIENTE`, `RESUTLTAT`, `TRAITEMENT`,`DDATE` ,`AUTEUR`) VALUES (?,?,?,?,?,?)");
            $stmt->execute([$this->REFEXAM, $this->REFPATIENTE, $this->RESUTLTAT, $this->TRAITEMENT, $this->DDATE, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }

    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `texapasse`");
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
            $stmt = $connect->prepare("SELECT * FROM `texapasse` WHERE codeexapasse");
            $stmt->execute([$this->CODEEXAMPASS]);
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
            $stmt = $connect->prepare("SELECT texapasse.CODEEXAMPASS as codeexa,texamen.designation as examen,texapasse.resutltat as resultat,texapasse.traitement as trait,texapasse.auteur as auteur,texapasse.ddate as ddate FROM `texapasse`
            inner join texamen on texapasse.refexam=texamen.codeexamen WHERE REFPATIENTE=?");
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
            $stmt = $connect->prepare("SELECT texapasse.CODEEXAMPASS as codeexa,texamen.designation as examen,texapasse.resutltat as resultat,texapasse.traitement as trait,texapasse.auteur as auteur,texapasse.ddate as ddate FROM `texapasse`
            inner join texamen on texapasse.refexam=texamen.codeexamen WHERE REFPATIENTE=? ORDER BY DDATE DESC LIMIT 2");
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
            $stmt = $connect->prepare("SELECT * FROM `texapasse` WHERE codeexapass=?");
            $stmt->execute([$this->CODEEXAMPASS]);
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
            $stmt = $connect->prepare("UPDATE `texapasse` SET `REFEXAM`=?,`REFPATIENTE`=?,`RESUTLTAT`=?,`TRAITEMENT`=?,`AUTEUR`=? WHERE CODEEXAMPASS=?");
            $stmt->execute([$this->REFEXAM, $this->REFPATIENTE, $this->RESUTLTAT, $this->TRAITEMENT, $this->AUTEUR, $this->CODEEXAMPASS]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function traitement()
    {
        try {
            $con = new Database();
            $connect = $con->open();
            $stmt = $connect->prepare("UPDATE `texapasse` SET `TRAITEMENT`=?,`AUTEUR`=? WHERE CODEEXAMPASS=?");
            $stmt->execute([$this->TRAITEMENT, $this->AUTEUR, $this->CODEEXAMPASS]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function resultat()
    {
        try {
            $con = new Database();
            $connect = $con->open();
            $stmt = $connect->prepare("UPDATE `texapasse` SET `RESUTLTAT`=?,`AUTEUR`=? WHERE CODEEXAMPASS=?");
            $stmt->execute([$this->RESUTLTAT, $this->AUTEUR, $this->CODEEXAMPASS]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}