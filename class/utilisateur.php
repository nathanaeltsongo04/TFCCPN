<?php

class utilisateur
{
    private $CODEUTILISATEUR;
    private $NOM;
    private $POSTNOM;
    private $PRENOM;
    private $ADRESSE;
    private $REFFONCTION;
    private $AUTEUR;
    private $DDATE;

    public function getCODEUTILISATEUR()
    {
        return $this->CODEUTILISATEUR;
    }

    public function setCODEUTILISATEUR($value)
    {
        $this->CODEUTILISATEUR = $value;
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

    public function getADRESSE()
    {
        return $this->ADRESSE;
    }

    public function setADRESSE($value)
    {
        $this->ADRESSE = $value;
    }

    public function getREFFONCTION()
    {
        return $this->REFFONCTION;
    }

    public function setREFFONCTION($value)
    {
        $this->REFFONCTION = $value;
    }
    public function getAUTEUR()
    {
        return $this->AUTEUR;
    }

    public function setAUTEUR($value)
    {
        $this->AUTEUR = $value;
    }
    public function getDDATE()
    {
        return $this->DDATE;
    }

    public function setDDATE($value)
    {
        $this->DDATE = $value;
    }

    public function inserer()
    {

        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("INSERT INTO tutilisateur (NOM,POSTNOM, PRENOM, ADRESSE,DDATE ,REFFONCTION,AUTEUR) VALUES (?,?,?,?,?,?,?)");
            $stmt->execute([$this->NOM, $this->POSTNOM, $this->PRENOM, $this->ADRESSE, $this->DDATE, $this->REFFONCTION, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }
    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select CODEUTILISATEUR,NOM,POSTNOM,PRENOM,ADRESSE, tfonction.DESIGNATION as fonction from tutilisateur
            inner join tfonction on tutilisateur.REFFONCTION=tfonction.CODEFONCTION");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function affichercode()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select CODEUTILISATEUR from tutilisateur where CODEUTILISATEUR=?");
            $stmt->execute([$this->CODEUTILISATEUR]);
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
            $stmt = $connect->prepare("select CODEUTILISATEUR,NOM,POSTNOM,PRENOM,ADRESSE, REFFONCTION,tfonction.DESIGNATION as fonction from tutilisateur
            inner join tfonction on tutilisateur.REFFONCTION=tfonction.CODEFONCTION where codeutilisateur=?");
            $stmt->execute([$this->CODEUTILISATEUR]);
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
            $stmt = $connect->prepare("delete form tutilisateur where codeutilisateur=?");
            $stmt->execute([$this->CODEUTILISATEUR]);
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
            $stmt = $connect->prepare("UPDATE tutilisateur SET NOM =?,POSTNOM = ?, PRENOM = ?, ADRESSE = ?, REFFONCTION = ? WHERE codeutilisateur=?");
            $stmt->execute([$this->NOM, $this->POSTNOM, $this->PRENOM, $this->ADRESSE, $this->REFFONCTION, $this->CODEUTILISATEUR]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
