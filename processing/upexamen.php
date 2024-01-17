<?php
require('../class/link_db.php');
if (isset($_POST['update'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/examen.php");
    $data = new examen();
    try {
        $data->setCODEEXAMEN($_POST['id']);
        $data->setDESIGNATION($_POST['examen']);
        $data->setAUTEUR($auteur);
        $data->setDDATE(date('Y-m-d'));
        $data->modifier();
        header('location:../examen.php');
    } catch (Exception $e) {
        return $e;
    }
}
