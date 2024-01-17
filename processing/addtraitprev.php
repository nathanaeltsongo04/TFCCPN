<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/traitement.php");
    $data = new traitement();
    $id = $_POST['id'];
    try {
        $data->setREFPATIENTE($_POST['id']);
        $data->setMILDA($_POST['sousmoust']);
        $data->setSIMILDA($_POST['similda']);
        $data->setSPFER($_POST['supfer']);
        $data->setVERMIFUGE($_POST['vermi']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->inserer();

        header("location: ../traitpreventif.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
} else {
    header("location: ../traitpreventif.php?msg='false'&id=$id");
    exit();
}
