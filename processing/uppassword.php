<?php
require('../class/link_db.php');
if (isset($_POST['update'])) {
    require_once("../class/createaccount.php");
    $data = new register();
    $id = $_POST['id'];

    if ($_SESSION['motdepass'] === $_POST['password']) {
        if ($_POST['newpassword'] === $_POST['renewpassword']) {
            try {
                $data->setMatricule($_POST['id']);
                $data->setUsername($_POST['username']);
                $data->setMotdepasse($_POST['newpassword']);
                $data->modifier();
                header("location:../users-profile.php?id=$id &msg=True&info=Successful&action=info");
            } catch (Exception $e) {
                return $e;
            }
        } else {
            header("location: ../users-profile.php?id=$id &msg=False&action=info&info=Retapez convenablement le nouveau mot de passe");
        }
    } else {
        header("location: ../includes/sessiondown.php?msg=False&info=Vous êtes un espion");
    }
}
