<?php
include("./class/link_db.php");
require_once("./class/vaccin.php");
$data = new vaccin();
$all = $data->afficher();
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
    include('./includes/sidebar.php');
    $pagename = basename($_SERVER['PHP_SELF'], '.php');

    ?>

        <!-- End Sidebar-->

        <main id="main" class="main">

            <div class="pagetitle">
                <h2>Tableau de Bord </h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"></a>Acceuil</li>
                        <li class="breadcrumb-item active"><?php echo ucfirst($pagename); ?></li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section">

                <div class="iconslist">

                    <div class="icon">
                        <a href="./rendez-vousliste.php">
                            <i class="bi bi-calendar-event text-secondary"></i>
                            <div class="label fw-bold mt-2"><a href="./rendez-vousliste.php">Les Rendez-Vous</a>
                            </div>
                        </a>
                    </div>
                    <div class="icon">
                        <a href="./rendez-voustoday.php">
                            <i class="bi bi-calendar-event text-secondary"></i>
                            <div class="label fw-bold mt-2"><a href="./rendez-voustoday.php">Aujourd'hui</a>
                            </div>
                        </a>
                    </div>
                    <div class="icon">
                        <a href="./newrendez-vous.php">
                            <i class="bi bi-people-fill  text-secondary"></i>
                            <div class="label fw-bold mt-2"><a href="./newrendez-vous.php"><span>Nouveau
                                        Rendez-Vous</span></a></div>
                        </a>
                    </div>


                </div>

            </section>

        </main><!-- End #main -->
        <?php
    include('./includes/footer.php');
    ?>

        <a href="#" class="back-to-top text-info d-flex align-items-center justify-content-center"><i
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