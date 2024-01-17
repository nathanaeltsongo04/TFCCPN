<?php
require('../class/link_db.php');
require_once("../class/utilisateur.php");
$data = new utilisateur();
if (isset($_POST['update'])) {

    try {
        $data->setCODEUTILISATEUR($_POST['id']);
        $data->setNOM($_POST['nom']);
        $data->setPOSTNOM($_POST['postnom']);
        $data->setPRENOM($_POST["prenom"]);
        $data->setADRESSE($_POST["adresse"]);
        $data->setDDATE(date('Y-m-d'));
        $data->setREFFONCTION($_POST["fonction"]);
        $data->update();

        header("location:../utilisateur.php");
    } catch (Exception $e) {
        return $e;
    }
} else if (isset($_POST['user'])) {
    $id = $_POST['id'];
    try {
        $data->setCODEUTILISATEUR($_POST['id']);
        $data->setNOM($_POST['nom']);
        $data->setPOSTNOM($_POST['postnom']);
        $data->setPRENOM($_POST["prenom"]);
        $data->setADRESSE($_POST["adresse"]);
        $data->setDDATE(date('Y-m-d'));
        $data->setREFFONCTION($_POST["fonction"]);
        $data->update();

        header("location:../users-profile.php?id=$id");
    } catch (Exception $e) {
        return $e;
    }
}
