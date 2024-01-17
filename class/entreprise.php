<?php
class entreprise
{
    private $CODECOMPANY;
    private $COUNTRY;
    private $MINISTRY;
    private $PROVINCE;
    private $DISTRICT;
    private $ASFORMATION;
    private $AV;
    private $QUARTIER;
    private $COMMUNE;
    private $TEL;
    private $ZONE;
    private $EMAIL;
    private $LOGO;



    protected $con;

    public function getCODECOMPANY()
    {
        return $this->CODECOMPANY;
    }

    public function setCODECOMPANY($value)
    {
        $this->CODECOMPANY = $value;
    }

    public function getCOUNTRY()
    {
        return $this->COUNTRY;
    }

    public function setCOUNTRY($value)
    {
        $this->COUNTRY = $value;
    }

    public function getMINISTRY()
    {
        return $this->MINISTRY;
    }

    public function setMINISTRY($value)
    {
        $this->MINISTRY = $value;
    }

    public function getPROVINCE()
    {
        return $this->PROVINCE;
    }

    public function setPROVINCE($value)
    {
        $this->PROVINCE = $value;
    }

    public function getDISTRICT()
    {
        return $this->DISTRICT;
    }

    public function setDISTRICT($value)
    {
        $this->DISTRICT = $value;
    }

    public function getASFORMATION()
    {
        return $this->ASFORMATION;
    }

    public function setASFORMATION($value)
    {
        $this->ASFORMATION = $value;
    }

    public function getAV()
    {
        return $this->AV;
    }

    public function setAV($value)
    {
        $this->AV = $value;
    }

    public function getQUARTIER()
    {
        return $this->QUARTIER;
    }

    public function setQUARTIER($value)
    {
        $this->QUARTIER = $value;
    }

    public function getCOMMUNE()
    {
        return $this->COMMUNE;
    }

    public function setCOMMUNE($value)
    {
        $this->COMMUNE = $value;
    }

    public function getTEL()
    {
        return $this->TEL;
    }

    public function setTEL($value)
    {
        $this->TEL = $value;
    }

    public function getEMAIL()
    {
        return $this->EMAIL;
    }

    public function setEMAIL($value)
    {
        $this->EMAIL = $value;
    }
    public function getZONE()
    {
        return $this->ZONE;
    }

    public function setZONE($value)
    {
        $this->ZONE = $value;
    }

    public function getLOGO()
    {
        return $this->LOGO;
    }

    public function setLOGO($value)
    {
        $this->LOGO = $value;
    }
    public function afficher()
    {
        $con = new Database();
        $connect = $con->open();
        try {
            $stmt = $connect->prepare("SELECT * FROM `company` ");
            $stmt->execute();
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
            $stmt = $connect->prepare("UPDATE `company` SET `COUNTRY`=?,`MINISTRY`=?,`PROVINCE`=?,`ASFORMATION`=?,`AV`=?,`QUARTIER`=?,`COMMUNE`=?,`TEL`=?,`EMAIL`=?,`LOGO`=?,`ZONE`=?,`DISTRICT`=? WHERE CODECOMPANY=?");
            $stmt->execute([$this->COUNTRY, $this->MINISTRY, $this->PROVINCE, $this->ASFORMATION, $this->AV, $this->QUARTIER, $this->COMMUNE, $this->TEL, $this->EMAIL, $this->LOGO, $this->ZONE, $this->DISTRICT, $this->CODECOMPANY]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
