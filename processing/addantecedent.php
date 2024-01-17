<?php
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require('../class/link_db.php');
    require_once("../class/antecedent.php");
    $data = new antecedent();
    $id = $_POST['id'];
    try {
        $data->setREFPATIENTE($_POST['id']);
        $data->setHtarterielle($_POST['hta']);
        $data->setDbt($_POST['dbt']);
        $data->setCardiopat($_POST['cardio']);
        $data->setIstvih($_POST['vih']);
        $data->setAutres($_POST['autre']);
        $data->setCesriene($_POST['cesarienne']);
        $data->setFibrome($_POST['fibronne']);
        $data->setFractbassin($_POST['fracture']);
        $data->setGpu($_POST['gpu']);
        $data->setCerclage($_POST['cerclage']);
        $data->setDdr($_POST['ddr']);
        $data->setParite($_POST['parite']);
        $data->setGrossesse($_POST['ngrossesse']);
        $data->setEnfantvie($_POST['enfantvie']);
        $data->setAvortement($_POST['avortement']);
        $data->setAvortfirsttrim($_POST['avortementtrim']);
        $data->setTrimpart15($_POST['trimpamoins']);
        $data->setTrimpart30plus($_POST['30ans']);
        $data->setLastaccouch($_POST['dernieraccouch']);
        $data->setInterval2ans($_POST['interval']);
        $data->setDystocie($_POST['dystocie']);
        $data->setEudocie($_POST['eudocie']);
        $data->setBigpoids($_POST['plusgros']);
        $data->setPoidssup4($_POST['4kg']);
        $data->setLastbornprema($_POST['enfantprema']);
        $data->setPostmat($_POST['postmat']);
        $data->setMortne($_POST['mortne']);
        $data->setMortavsept($_POST['mort7']);
        $data->setCompsterilite($_POST['compsterilite']);
        $data->setCompostpat($_POST['postpat']);
        $data->setComppostpatoui($_POST['sioui']);
        $data->setAuteur($auteur);
        $data->setDDATE(date('Y-m-d'));
        $data->inserer();

        header("location: ../antecedent.php?msg='true'&id=$id");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
} else {
    header("location: ../antecedent.php?msg='false'&id=$id");
    exit();
}
