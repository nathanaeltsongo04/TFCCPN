<?php

class register
{
    private $matricule;
    private $username;
    private $motdepasse;
    private $DDATE;
    protected $con;

    // public function __construct($matricule, $username, $motdepasse)
    // {
    //     $this->matricule = $matricule;
    //     $this->username = $username;
    //     $this->motdepasse = $motdepasse;
    //     $con = new Database();
    // }



    public function getMatricule()
    {
        return $this->matricule;
    }

    public function setMatricule($value)
    {
        $this->matricule = $value;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($value)
    {
        $this->username = $value;
    }

    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    public function setMotdepasse($value)
    {
        $this->motdepasse = $value;
    }
    public function getDDATE()
    {
        return $this->DDATE;
    }

    public function setDDATE($value)
    {
        $this->DDATE = $value;
    }
    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select * from tcompte");
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
            $stmt = $connect->prepare("select REFUTILISATEUR from tcompte where REFUTILISATEUR=?");
            $stmt->execute([$this->matricule]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function afficherBycompte()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("select * from tcompte where REFUTILISATEUR=?");
            $stmt->execute([$this->matricule]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function create()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("INSERT INTO `tcompte`(`REFUTILISATEUR`, `USERNAME`, `MOTDEPASS`, `DDATE`) VALUES (?,?,?,?)");
            $stmt->execute([$this->matricule, $this->username, $this->motdepasse, $this->DDATE]);
        } catch (Exception $e) {
            return $this->$e->getMessage();
        }
    }
    public function modifier()
    {
        try {
            $con = new Database();
            $connect = $con->open();
            $stmt = $connect->prepare("UPDATE `tcompte` SET `USERNAME`=?,`MOTDEPASS`=? WHERE REFUTILISATEUR=?");
            $stmt->execute([$this->username, $this->motdepasse, $this->matricule]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
