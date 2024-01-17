<?php
include('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/vaccin.php");
    $data = new vaccin();
    try {
        $data->setDESIGNATION($_POST['vaccin']);
        $data->setAUTEUR($auteur);
        $data->setDDATE(date('Y-m-d'));
        $data->inserer();


        header("location:../vaccin.php?msg=true");
    } catch (Exception $e) {
        return $e;
    }
}
