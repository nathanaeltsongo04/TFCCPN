<?php
include('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/utilisateur.php");
    $data = new utilisateur();
    try {
        $data->setNOM($_POST['nom']);
        $data->setPOSTNOM($_POST['postnom']);
        $data->setPRENOM($_POST["prenom"]);
        $data->setADRESSE($_POST["adresse"]);
        $data->setDDATE(date('Y-m-d'));
        $data->setREFFONCTION($_POST["fonction"]);
        $data->setAUTEUR($auteur);
        $data->inserer();

        header('location:../utilisateur.php');
    } catch (Exception $e) {
        return $e;
    }
}
