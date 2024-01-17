<?php


class fonction
{
    private $CODEFONCTION;
    private $DESIGNATION;
    private $DDATE;
    private $auteur;
    protected $con;

    public function getCODEFONCTION()
    {
        return $this->CODEFONCTION;
    }

    public function setCODEFONCTION($value)
    {
        $this->CODEFONCTION = $value;
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

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function setAuteur($value)
    {
        $this->auteur = $value;
    }

    public function inserer()
    {

        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("INSERT INTO `tfonction`(`DESIGNATION`, `AUTEUR`, `DDATE`) VALUES (?,?,?)");
            $stmt->execute([$this->DESIGNATION, $this->auteur, $this->DDATE]);
            $con->close();
        } catch (Exception $e) {
            return $this->$e;
        }
    }

    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select * from tfonction");
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
            $stmt = $connect->prepare("SELECT * from tfonction where codefonction=?");
            $stmt->execute([$this->CODEFONCTION]);
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
            $stmt = $connect->prepare("delete form tfonction where codefonction=?");
            $stmt->execute([$this->CODEFONCTION]);
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
            $stmt = $connect->prepare("UPDATE tfonction SET DESIGNATION =?, auteur =? WHERE codefonction = ?");
            $stmt->execute([$this->DESIGNATION, $this->auteur, $this->CODEFONCTION]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
