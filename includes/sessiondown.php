<?php
session_start();

if (isset($_SESSION['nom'])) {
    if (isset($_SESSION['fonction'])) {
        header("location: ../index.php?");
        session_destroy();
    }
}
