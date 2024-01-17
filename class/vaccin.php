<?php

class vaccin
{
    private $CODEVACCIN;
    private $DESIGNATION;
    private $DDATE;
    private $AUTEUR;

    protected $con;

    public function getCODEVACCIN()
    {
        return $this->CODEVACCIN;
    }

    public function setCODEVACCIN($value)
    {
        $this->CODEVACCIN = $value;
    }

    public function getDESIGNATION()
    {
        return $this->DESIGNATION;
    }

    public function setDESIGNATION($value)
    {
        $this->DESIGNATION = $value;
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
            $stmt = $connect->prepare("INSERT INTO tvaccin(DESIGNATION,DDATE,AUTEUR) VALUES (?,?,?)");
            $stmt->execute([$this->DESIGNATION, $this->DDATE, $this->AUTEUR]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }
    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select * from tvaccin");
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
            $stmt = $connect->prepare("select * from tvaccin where codevaccin=?");
            $stmt->execute([$this->CODEVACCIN]);
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
            $stmt = $connect->prepare("delete form tvaccin where codepatiente=?");
            $stmt->execute([$this->CODEVACCIN]);
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
            $stmt = $connect->prepare("UPDATE tvaccin SET DESIGNATION=?,AUTEUR=? WHERE CODEVACCIN=?");
            $stmt->execute([$this->DESIGNATION, $this->AUTEUR, $this->CODEVACCIN]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
