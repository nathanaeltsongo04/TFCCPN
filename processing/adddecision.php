<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/decision.php");
    $data = new decision();
    $id = $_POST['id'];
    try {
        $data->setREFCONSULATION($_POST['code']);
        $data->setCPNNORMAL($_POST['cpnnormal']);
        $data->setRAISON($_POST['raison']);
        $data->setRDVMAT($_POST['rdvdate']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->inserer();

        header("location: ../decisioncentre.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
