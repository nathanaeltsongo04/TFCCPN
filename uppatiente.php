<?php
require('./class/link_db.php');
require_once("./class/patiente.php");
$data = new patiente();
$id = $_GET['id'];
$data->setCODEPATIENTE($id);
$all = $data->afficherid();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Hôpital Des Grands Lacs</title>
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="assets/img/logon.png" rel="icon">
        <link href="assets/img/logon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.gstatic.com" rel="preconnect">
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
            rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>

        <!-- ======= Header ======= -->
        <?php
    include('./includes/navbar.php');
    ?>
        <!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <?php
    include('includes/sidebar.php');
    $pagename = basename($_SERVER['PHP_SELF'], '.php');
    ?>
        <!-- End Sidebar-->

        <main id="main" class="main">

            <div class="pagetitle">
                <h2>Tableau de Bord </h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Acceuil</a></li>
                        <li class="breadcrumb-item active">Overview</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-header fw-bold border-bottom-0 mb-1 ">
                                    <i class="fa-solid fa-users me-1"></i>
                                    Modification <span>| Patiente</span>

                                </div>

                                <div class="card-body ms-3">
                                    <?php
                                foreach ($all as $key => $val) {
                                ?>
                                    <form class="row g-3 form-horizontal mt-3" method="POST"
                                        action="./processing/uppatiente.php?id=<?php echo $id ?>">
                                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                                        <div class="row mb-3">
                                            <label for="inputText" class="col-sm-3 col-form-label fw-bold ">Nom</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="<?= $val['NOM'] ?>" class="form-control"
                                                    name="nom" required="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class=" col-sm-3 col-form-label fw-bold">Post
                                                Nom</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="<?= $val['POSTNOM'] ?>" class="form-control"
                                                    name="postnom" required="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText"
                                                class="col-sm-3 col-form-label fw-bold">Prénom</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="<?= $val['PRENOM'] ?>" class="form-control"
                                                    name="prenom" required="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputDate" class="col-sm-3 col-form-label fw-bold ">Date de
                                                Naissance</label>
                                            <div class="col-sm-6">
                                                <input type="date" value="<?= $val['DATENAISS'] ?>" class="form-control"
                                                    name="datenaiss">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText" class=" col-sm-3 col-form-label fw-bold">Etat
                                                Civil</label>
                                            <div class="col-sm-6">
                                                <select name="etat" id="inputState" class="form-select">
                                                    <option value="<?= $val['ETATCIVIL'] ?>" selected>
                                                        <?= $val['ETATCIVIL'] ?></option>
                                                    <option value="Célibataire">Célibataire</option>
                                                    <option value="Divorcé(e)">Divorcé(e)</option>
                                                    <option value="Marié(e)">Marié(e)</option>
                                                    <option value="Veuf(ve)">Veuf(ve)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText"
                                                class=" col-sm-3 col-form-label fw-bold">Partenaire</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="<?= $val['PARTENAIRE'] ?>"
                                                    class="form-control" name="partenaire">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="inputText"
                                                class="col-sm-3 col-form-label fw-bold">Adresse</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="<?= $val['ADRESSE'] ?>" class="form-control"
                                                    name="adresse" required="">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="inputText"
                                                class=" col-sm-3 col-form-label fw-bold">Occupation</label>
                                            <div class="col-sm-6">
                                                <input type="text" value="<?= $val['OCCUPATION'] ?>"
                                                    class="form-control" name="occupation" required="">
                                            </div>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="submit" name="update"
                                                class="btn btn-success fw-bold text-white"><i
                                                    class="fa-solid fa-pen-to-square"></i></button>
                                        </div>

                                    </form>

                                    <?php
                                }
                                ?>
                                </div>

                            </div>
                        </div>
            </section>

        </main><!-- End #main -->

        <!-- ======= Footer ======= -->
        <?php
    include('./includes/footer.php');
    ?>
        <!-- End Footer -->

        <a href="#" class="back-to-top d-flex bg-info align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.min.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

    </body>

</html>