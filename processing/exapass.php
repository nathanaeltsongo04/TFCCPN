<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    require_once("../class/exapasse.php");
    $data = new exapasse();
    $id = $_POST['id'];
    try {
        $data->setREFPATIENTE($_POST['id']);
        $data->setREFEXAM($_POST['examen']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->inserer();

        header("location: ../exapass.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e;
    }
}
