<?php
require('../class/link_db.php');
if (isset($_POST['save'])) {
    $auteur = $_SESSION['postnom'] . " " . $_SESSION['prenom'];
    require_once("../class/patiente.php");
    $data = new patiente();
    try {
        $data->setNOM($_POST['nom']);
        $data->setPOSTNOM($_POST['postnom']);
        $data->setPRENOM($_POST["prenom"]);
        $data->setDATENAISS($_POST['datenaiss']);
        $data->setADRESSE($_POST["adresse"]);
        $data->setETATCIVIL($_POST['etat']);
        $data->setPARTENAIRE($_POST['partenaire']);
        $data->setOCCUPATION($_POST["occupation"]);
        $data->setDDATE(date('Y-m-d'));
        $data->setAUTEUR($auteur);
        $data->inserer();

        header("location: ../patiente.php?msg=true");
        exit();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}
