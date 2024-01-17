<?php
require('./class/link_db.php');
require_once("./class/patiente.php");
$data = new patiente();
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
        <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
        <script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
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
        <?php if (isset($_GET['msg']) == 'true') { ?>

        <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Successful',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            location.replace('patiente.php');
        });
        </script>

        <?php
    } ?>
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
                                    Patiente <span>| Liste</span>

                                </div>

                                <div class="card-body">


                                    <!-- Table with stripped rows -->
                                    <table class="table datatable ">
                                        <thead>
                                            <tr>
                                                <th scope="col">Code</th>
                                                <th scope="col">Noms</th>
                                                <th scope="col">Occupation</th>
                                                <th scope="col">Adresse</th>
                                                <th scope="col">Date De Naissance</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-center mx-auto">
                                            <?php
                                        foreach ($all as $key => $val) {
                                        ?>

                                            <tr>
                                                <th scope="row fw bold"><?= $val['CODEPATIENTE'] ?></th>
                                                <td class="fw bold">
                                                    <?= $val['NOM'] . " " . $val['POSTNOM'] . " " . $val['PRENOM'] ?>
                                                </td>
                                                <td class="fw bold"><?= $val['OCCUPATION'] ?></td>
                                                <td class="fw bold"><?= $val['ADRESSE'] ?></td>
                                                <td class="fw bold"><?= $val['DATENAISS'] ?></td>
                                                <td class="fw bold"><?= $val['DDATE'] ?></td>
                                                <td class="fw bold text-center mx-auto mx-2 ">

                                                    <a class="text-info "
                                                        href="./fixerendez-vous.php?id=<?= $val['CODEPATIENTE'] ?>">
                                                        <i class="fa-solid fa-plus-circle fa-xl"></i>
                                                    </a>


                                                </td>

                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->

                                </div>

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