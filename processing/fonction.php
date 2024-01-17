<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/fonction.php");
    $data = new fonction();
    try {
        $data->setDESIGNATION($_POST['fonction']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAuteur($auteur);
        $data->inserer();
        header('location:../fonction.php');
    } catch (Exception $e) {
        return $e;
    }
}
