<?php
class examen
{
    private $CODEEXAMEN;
    private $DESIGNATION;
    private $DDATE;
    private $AUTEUR;

    protected $con;

    public function getCODEEXAMEN()
    {
        return $this->CODEEXAMEN;
    }

    public function setCODEEXAMEN($value)
    {
        $this->CODEEXAMEN  = $value;
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
            $stmt = $connect->prepare("INSERT INTO `texamen`(`DESIGNATION`, `AUTEUR`, `DDATE`) VALUES (?,?,?)");
            $stmt->execute([$this->DESIGNATION, $this->AUTEUR, $this->DDATE]);
        } catch (Exception $e) {
            return $this->$e;
        }
    }
    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select * from texamen");
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
            $stmt = $connect->prepare("select * from texamen where codeexamen=?");
            $stmt->execute([$this->CODEEXAMEN]);
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
            $stmt = $connect->prepare("delete form texamen where codeexamen=?");
            $stmt->execute([$this->CODEEXAMEN]);
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
            $stmt = $connect->prepare("UPDATE texamen SET DESIGNATION = ?, AUTEUR = ? WHERE codeexamen= ?");
            $stmt->execute([$this->DESIGNATION, $this->AUTEUR, $this->CODEEXAMEN]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
