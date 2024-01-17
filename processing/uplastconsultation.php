<?php
require('../class/link_db.php');
if (isset($_POST['update'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/lastconsultation.php");
    $data = new lastconsultation();
    $id = $_POST['id'];
    try {
        $data->setCodelastconsult($_POST['code']);
        $data->setConj($_POST['conj']);
        $data->setHb7et50($_POST['sihb']);
        $data->setHtuterine($_POST["huterine"]);
        $data->setPlusde36($_POST['siplus']);
        $data->setBtf($_POST["btf"]);
        $data->setSibtf($_POST["sibtf"]);
        $data->setPresentation($_POST["presentation"]);
        $data->setOedem($_POST["eodem"]);
        $data->setAlbumine($_POST["albuminurie"]);
        $data->setTa($_POST["ta"]);
        $data->setPertliqui($_POST["perteliqui"]);
        $data->setAutreprecision($_POST["autreapreciser"]);
        $data->setContraction($_POST["concentraction"]);
        $data->setDDATE(date('Y-m-d'));
        $data->setAuteur($auteur);
        $data->modifier();

        header("location: ../vlastconsultation.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
