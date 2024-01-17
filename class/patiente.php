<?php

class patiente
{
    private $CODEPATIENTE;
    private $NOM;
    private $POSTNOM;
    private $PRENOM;
    private $DATENAISS;
    private $PARTENAIRE;
    private $ETATCIVIL;
    private $ADRESSE;
    private $OCCUPATION;
    private $DDATE;
    private $AUTEUR;
    protected $con;

    public function getCODEPATIENTE()
    {
        return $this->CODEPATIENTE;
    }

    public function setCODEPATIENTE($value)
    {
        $this->CODEPATIENTE = $value;
    }

    public function getNOM()
    {
        return $this->NOM;
    }

    public function setNOM($value)
    {
        $this->NOM = $value;
    }

    public function getPOSTNOM()
    {
        return $this->POSTNOM;
    }

    public function setPOSTNOM($value)
    {
        $this->POSTNOM = $value;
    }

    public function getPRENOM()
    {
        return $this->PRENOM;
    }

    public function setPRENOM($value)
    {
        $this->PRENOM = $value;
    }

    public function getDATENAISS()
    {
        return $this->DATENAISS;
    }

    public function setDATENAISS($value)
    {
        $this->DATENAISS = $value;
    }

    public function getPARTENAIRE()
    {
        return $this->PARTENAIRE;
    }

    public function setPARTENAIRE($value)
    {
        $this->PARTENAIRE = $value;
    }

    public function getETATCIVIL()
    {
        return $this->ETATCIVIL;
    }

    public function setETATCIVIL($value)
    {
        $this->ETATCIVIL = $value;
    }

    public function getADRESSE()
    {
        return $this->ADRESSE;
    }

    public function setADRESSE($value)
    {
        $this->ADRESSE = $value;
    }

    public function getOCCUPATION()
    {
        return $this->OCCUPATION;
    }

    public function setOCCUPATION($value)
    {
        $this->OCCUPATION = $value;
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
            $stmt = $connect->prepare("INSERT INTO tpatiente(NOM,POSTNOM,PRENOM,DATENAISS,PARTENAIRE,ETATCIVIL,ADRESSE,OCCUPATION,DDATE,AUTEUR) VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->execute([$this->NOM, $this->POSTNOM, $this->PRENOM, $this->DATENAISS, $this->PARTENAIRE, $this->ETATCIVIL, $this->ADRESSE, $this->OCCUPATION, $this->DDATE, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }
    public function sum()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT count(*) as totalpatiente FROM tpatiente ");
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
            $stmt = $connect->prepare("select * from tpatiente");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function afficheralpha()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select * from tpatiente");
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
            $stmt = $connect->prepare("select *,DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),`DATENAISS`)),'%Y')+0 as age from tpatiente where codepatiente=?");
            $stmt->execute([$this->CODEPATIENTE]);
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
            $stmt = $connect->prepare("UPDATE tpatiente SET NOM=?,POSTNOM=?,PRENOM=?,DATENAISS=?,PARTENAIRE=?,ETATCIVIL=?,ADRESSE=?,OCCUPATION=?,AUTEUR=? WHERE codepatiente=?");
            $stmt->execute([$this->NOM, $this->POSTNOM, $this->PRENOM, $this->DATENAISS, $this->PARTENAIRE, $this->ETATCIVIL, $this->ADRESSE, $this->OCCUPATION, $this->AUTEUR, $this->CODEPATIENTE]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function supprimer()
    {
        try {
            $con = new Database();
            $connect = $con->open();
            $stmt = $connect->prepare("delete form tpatiente where codepatiente=?");
            $stmt->execute([$this->CODEPATIENTE]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
