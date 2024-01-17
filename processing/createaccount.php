<?php
require("../class/link_db.php");
require("../class/createaccount.php");
require("../class/utilisateur.php");
$data = new utilisateur();
$data->setCODEUTILISATEUR($_POST['matricule']);
$user = $data->affichercode();
$datar = new register();
$datar->setMatricule($_POST['matricule']);
$account = $datar->afficher();

foreach ($user as $key => $val) {
    if ($val['CODEUTILISATEUR'] == $_POST['matricule']) {
        $userid = $val['CODEUTILISATEUR'];
    }
}
foreach ($account as $keys => $vals) {
    if ($vals['REFUTILISATEUR'] == $userid) {
        $accountid = $vals['REFUTILISATEUR'];
    }
}

if (isset($_POST['newaccount'])) {
    if ($_POST['password'] === $_POST['confpassword']) {
        if (isset($_POST['matricule']) == $userid) {
            if ($userid == $accountid) {
                header("location: ../index.php?msg=existe&info=Ce Matricule a déjà un compte!");
            } else {
                try {
                    $data = new register();


                    $data->setMatricule($_POST['matricule']);
                    $data->setUsername($_POST['username']);
                    $data->setMotdepasse($_POST['password']);
                    $data->setDDATE(date('Y-m-d'));

                    $data->create();
                    header("location: ../index.php?msg=True&info=Successful");
                    exit();
                } catch (Exception $e) {
                    return $e->getMessage();
                }
            }
        } else {
            header("location: ../index.php?msg=pas&info=Ce Matricule n existe pas!");
        }
    } else {
        header("location: ../pages-register.php?msg=password&info=Saissiser convenablement votre mot de passe");
    }
}
