<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/evolution.php");
    $data = new evolution();
    $id = $_POST['id'];
    try {
        $data->setCodeevolution($_POST['code']);
        $data->setDdr($_POST['ddr']);
        $data->setDateconsult($_POST['datecons']);
        $data->setConjonctivite($_POST['conjoc']);
        $data->setHtuterine($_POST['htuterine']);
        $data->setMvtfeotal($_POST['mvtfeotal']);
        $data->setBcf($_POST['bcf']);
        $data->setPresentation($_POST['presentation']);
        $data->setPertliqui($_POST['perteliqui']);
        $data->setEodem($_POST['preseodem']);
        $data->setAlbumin($_POST['albimin']);
        $data->setGlycemie($_POST['glycemie']);
        $data->setTarterielle($_POST['tarte']);
        $data->setContraction($_POST['contraction']);
        $data->setBaspromo($_POST['baspromo']);
        $data->setPoids($_POST['poids']);
        $data->setTaille($_POST['taille']);
        $data->setTaillesup($_POST['taillesup']);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->modifier();

        header("location: ../vevolution.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
} else {
    header("location: ../evolution.php?msg='false'&id=$id");
    exit();
}
