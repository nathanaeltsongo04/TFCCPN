<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/maternite.php");
    $data = new maternite();
    $id = $_POST['id'];
    try {
        $data->setCODEMAT($_POST['code']);
        $data->setEXAPHYSIQUE($_POST['exaphysi']);
        $data->setEXAPARACLINIQUE($_POST['exapara']);
        $data->setAUTROBS($_POST["autrobs"]);
        $data->setCONCLUSION($_POST['conclusion']);
        $data->setDECISION($_POST["decision"]);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->modifier();

        header("location: ../vsuivimaternite.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
