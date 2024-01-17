<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/examen.php");
    $data = new examen();
    try {
        $data->setDESIGNATION($_POST['examen']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->inserer();

        header('location:../examen.php');
    } catch (Exception $e) {
        return $e;
    }
}