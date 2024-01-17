<?php
require('../class/link_db.php');
if (isset($_POST['update'])) {
    require_once("../class/fonction.php");
    $data = new fonction();
    try {
        $data->setCODEFONCTION($_POST['id']);
        $data->setDESIGNATION($_POST['fonction']);
        $data->setDDATE(date('Y-m-d'));
        $data->modifier();
        header('location:../fonction.php');
    } catch (Exception $e) {
        return $e;
    }
}
