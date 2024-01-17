<?php
require('../class/link_db.php');
if (isset($_POST['update'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/vaccin.php");
    $data = new vaccin();
    try {
        $data->setCODEVACCIN($_POST['id']);
        $data->setDESIGNATION($_POST['vaccin']);
        $data->setAUTEUR($auteur);
        $data->setDDATE(date('Y-m-d'));
        $data->modifier();
        header('location:../vaccin.php');
    } catch (Exception $e) {
        return $e;
    }
}
