<?php

include '../class/link_db.php';
$con = new Database();
$connect = $con->open();

if (isset($_POST['connecter'])) {
    $username = $_POST['username'];
    $password = htmlspecialchars($_POST['password']);
    try {
        $stmt = $connect->prepare("SELECT `CODECOMPTE`,tcompte.REFUTILISATEUR as user , tutilisateur.nom as nom, tutilisateur.POSTNOM as postnom, tutilisateur.PRENOM as prenom , `USERNAME`, `MOTDEPASS`, tfonction.DESIGNATION as fonction FROM `tcompte`
inner join tutilisateur on tcompte.REFUTILISATEUR=tutilisateur.CODEUTILISATEUR
inner join tfonction on tutilisateur.REFFONCTION=tfonction.CODEFONCTION where USERNAME=? AND MOTDEPASS=?  ");
        $stmt->execute(array($username, $password));
        $nbre = $stmt->rowCount();

        if ($nbre == 1) {
            $row = $stmt->fetch();

            $_SESSION['CODE'] = (string)$row['CODECOMPTE'];
            $_SESSION["user"] = (string)$row['user'];
            $_SESSION["nom"] = $row['nom'];
            $_SESSION["postnom"] = $row['postnom'];
            $_SESSION["prenom"] = $row['prenom'];
            $_SESSION["fonction"] = $row['fonction'];
            header("Location:../patiente.php");
        } else {
            header("location: ../index.php?msg=False&info=Verifier votre username ou mot de passe");
        }
    } catch (PDOException $e) {
        $erreur = $e->getMessage();
        header("location: ../index.php?msg=False&info= $erreur");
    }
} else {
    header("location: ../index.php?msg=False&info=Verifier votre username ou mot de passe");
}
