<?php
require('./class/link_db.php');
require_once("./class/patiente.php");
require_once("./class/planning.php");
$membre = new patiente();
$summ = $membre->sum();
$cons = new planning();
$sumcons = $cons->sum();
$sumlast = $cons->sumlastmonth();
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
                        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                        <li class="breadcrumb-item active"><?= ucfirst($pagename) ?></li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section dashboard">
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">
                        <div class="row">

                            <!-- Sales Card -->
                            <div class="col-xxl-4 col-md-4">
                                <div class="card info-card sales-card">

                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Patiente <span>| Enregistrée</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-people-fill"></i>
                                            </div>
                                            <div class="ps-3">
                                                <?php
                                            foreach ($summ as $key => $val) {
                                            ?>
                                                <h6><?= $val['totalpatiente'] ?></h6>
                                                <?php
                                            } ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Sales Card -->

                            <!-- Revenue Card -->
                            <div class="col-xxl-4 col-md-4">
                                <div class="card info-card revenue-card">

                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">Consultation <span>| Journalière</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-eyedropper"></i>
                                            </div>
                                            <div class="ps-3">
                                                <?php
                                            foreach ($sumcons as $key => $val) {
                                            ?>
                                                <h6><?= $val['totalconsultation'] ?></h6>
                                                <span
                                                    class="text-success small pt-1 fw-bold"><?= strtoupper($val['jour']) ?></span>
                                                <span class="text-muted small pt-2 ps-1"></span>
                                                <?php
                                            } ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div><!-- End Revenue Card -->

                            <!-- Customers Card -->
                            <div class="col-xxl-4 col-xl-4">

                                <div class="card info-card customers-card">

                                    <div class="card-body">
                                        <h5 class="card-title fw-bold ">Consultation <span>| Mensuelle</span></h5>

                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="bi bi-eyedropper"></i>
                                            </div>
                                            <div class="ps-3">
                                                <?php
                                            foreach ($sumlast as $key => $val) {
                                            ?>
                                                <h6><?= $val['totallast'] ?></h6>
                                                <span
                                                    class="text-danger small pt-1 fw-bold"><?= strtoupper($val['mois']) ?></span>
                                                <span class="text-muted small pt-2 ps-1"></span>
                                                <?php
                                            } ?>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div><!-- End Customers Card -->
                        </div>
                    </div><!-- End Left side columns -->

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