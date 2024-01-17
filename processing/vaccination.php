<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/vaccination.php");
    $data = new vaccination();
    $id = $_POST['id'];
    try {
        $data->setREFPATIENTE($_POST['id']);
        $data->setREFVACCIN($_POST['vaccin']);
        $data->setDATEVACCIN($_POST['datevaccina']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->inserer();

        header("location: ../vaccina.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e;
    }
}
