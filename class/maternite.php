<?php

class maternite
{
    private $CODEMAT;
    private $REFPATIENTE;
    private $EXAPHYSIQUE;
    private $EXAPARACLINIQUE;
    private $AUTROBS;
    private $CONCLUSION;
    private $DECISION;
    private $DDATE;
    private $AUTEUR;
    protected $con;

    public function getCODEMAT()
    {
        return $this->CODEMAT;
    }

    public function setCODEMAT($value)
    {
        $this->CODEMAT = $value;
    }

    public function getREFPATIENTE()
    {
        return $this->REFPATIENTE;
    }

    public function setREFPATIENTE($value)
    {
        $this->REFPATIENTE = $value;
    }

    public function getEXAPHYSIQUE()
    {
        return $this->EXAPHYSIQUE;
    }

    public function setEXAPHYSIQUE($value)
    {
        $this->EXAPHYSIQUE = $value;
    }

    public function getEXAPARACLINIQUE()
    {
        return $this->EXAPARACLINIQUE;
    }

    public function setEXAPARACLINIQUE($value)
    {
        $this->EXAPARACLINIQUE = $value;
    }

    public function getAUTROBS()
    {
        return $this->AUTROBS;
    }

    public function setAUTROBS($value)
    {
        $this->AUTROBS = $value;
    }

    public function getCONCLUSION()
    {
        return $this->CONCLUSION;
    }

    public function setCONCLUSION($value)
    {
        $this->CONCLUSION = $value;
    }

    public function getDECISION()
    {
        return $this->DECISION;
    }

    public function setDECISION($value)
    {
        $this->DECISION = $value;
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
            $stmt = $connect->prepare("INSERT INTO tmaternite( REFPATIENTE, EXAPHYSIQUE, EXAPARACLINIQUE, AUTROBS, CONCLUSION, DECISION,DDATE ,AUTEUR) VALUES (?,?,?,?,?,?,?,?)");
            $stmt->execute([$this->REFPATIENTE, $this->EXAPHYSIQUE, $this->EXAPARACLINIQUE, $this->AUTROBS, $this->CONCLUSION, $this->DECISION, $this->DDATE, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }
    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `tmaternite`");
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
            $stmt = $connect->prepare("SELECT * FROM `tmaternite` WHERE codemat=? ");
            $stmt->execute([$this->CODEMAT]);
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
            $stmt = $connect->prepare("SELECT * FROM `tmaternite` WHERE REFPATIENTE=?");
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
            $stmt = $connect->prepare("SELECT * FROM `tmaternite` WHERE REFPATIENTE=? ORDER BY DDATE DESC LIMIT 1");
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
            $stmt = $connect->prepare("DELETE FROM `tmaternite` WHERE codemat=?");
            $stmt->execute([$this->CODEMAT]);
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
            $stmt = $connect->prepare("UPDATE `tmaternite` SET `EXAPHYSIQUE`=?,`EXAPARACLINIQUE`=?,`AUTROBS`=?,`CONCLUSION`=?,`DECISION`=?,`AUTEUR`=? WHERE codemat=?");
            $stmt->execute([$this->EXAPHYSIQUE, $this->EXAPARACLINIQUE, $this->AUTROBS, $this->CONCLUSION, $this->DECISION, $this->AUTEUR, $this->CODEMAT]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}