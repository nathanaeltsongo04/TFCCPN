<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/planning.php");
    $data = new planning();
    $id = $_POST['id'];
    try {
        $data->setREFPATIENTE($_POST['id']);
        $data->setDATERDV($_POST['rdvdate']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->inserer();

        header("location: ../rendez-vousliste.php");
        exit();
    } catch (Exception $e) {
        return $e;
    }
}
