<?php
include('../class/link_db.php');

if (isset($_POST['update'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/exapasse.php");
    $id = $_GET['code'];
    $data = new exapasse();
    try {
        $data->setCODEEXAMPASS($_GET['code']);
        $data->setRESUTLTAT($_POST['resultat']);
        $data->setAUTEUR($auteur);
        $data->resultat();


        header("location:../vexamen.php?msg=true&id=$id");
    } catch (Exception $e) {
        return $e;
    }
}
