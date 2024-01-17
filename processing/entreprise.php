<?php
require('../class/link_db.php');
if (isset($_POST['update'])) {
    require_once("../class/entreprise.php");
    $data = new entreprise();
    $id = $_POST['id'];
    try {
        $data->setCODECOMPANY($_POST['id']);
        $data->setCOUNTRY($_POST['pays']);
        $data->setMINISTRY($_POST['ministere']);
        $data->setPROVINCE($_POST['province']);
        $data->setDISTRICT($_POST["district"]);
        $data->setZONE($_POST['zone']);
        $data->setASFORMATION($_POST["asformation"]);
        $data->setAV($_POST["avenue"]);
        $data->setQUARTIER($_POST["quartier"]);
        $data->setCOMMUNE($_POST['commune']);
        $data->setTEL($_POST['telephone']);
        $data->setEMAIL($_POST['email']);
        $data->setLOGO($_POST["logo"]);
        $data->modifier();

        header("location: ../entreprise.php?msg='true'");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
