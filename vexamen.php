<?php
require('./class/link_db.php');
require_once("./class/patiente.php");
require("./class/exapasse.php");
$data = new patiente();
$id = $_GET['id'];
$data->setCODEPATIENTE($id);
$all = $data->afficherid();

$antedata = new exapasse();
$antedata->setRefpatiente($id);
$rs = $antedata->afficherByrefpatiente();
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
        <link href="assets/img/favicon.png" rel="icon">
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
            location.replace('vexamen.php?id=<?= $id ?>');

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
                        <li class="breadcrumb-item active">Formulaire</li>
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
                                    Identité <span>| Patiente</span>
                                </div>

                                <div class="card-body ">
                                    <div class="row mb-3 fw-bold ">
                                        <div class="col-sm-6 mb-1">
                                            <table class="table table-borderless ">
                                                <tbody>
                                                    <?php
                                                foreach ($all as $key => $val) {
                                                    $id = $val['CODEPATIENTE'];
                                                ?>

                                                    <tr>
                                                        <td>Nom</td>
                                                        <td><?= $val['NOM'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Post-Nom</td>
                                                        <td><?= $val['POSTNOM'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Prénom</td>
                                                        <td><?= $val['PRENOM'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Partenaire</td>
                                                        <td><?= $val['PARTENAIRE'] ?></td>
                                                    </tr>

                                                </tbody>
                                                <?php
                                                }

                                        ?>
                                            </table>

                                        </div>
                                        <div class="col-sm-6 mb-1">
                                            <table class="table table-borderless ">
                                                <tbody>
                                                    <?php
                                                foreach ($all as $key => $val) {
                                                ?>
                                                    <tr>
                                                        <td>Date de Naissance</td>
                                                        <td><?= $val['DATENAISS'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Adresse</td>
                                                        <td><?= $val['ADRESSE'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Etat Civil</td>
                                                        <td><?= $val['ETATCIVIL'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Occupation</td>
                                                        <td><?= $val['OCCUPATION'] ?></td>
                                                    </tr>

                                                    <?php
                                                }
                                                ?>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-header fw-bold border-bottom-0 mb-1 ">
                                    <i class="fa-solid fa-users me-1"></i>
                                    Examen <span>| Patiente</span>
                                </div>

                                <div class="card-body ">
                                    <div class="row mb-3 fw-bold ">
                                        <div class="col-sm-12 mb-1">
                                            <table class="table datatable ">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Code</th>
                                                        <th scope="col">Examen</th>
                                                        <th scope="col">Résultat</th>
                                                        <th scope="col">Traitement</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>

                                                    </tr>
                                                </thead>
                                                <?php
                                            foreach ($rs as $keys => $vals) {

                                            ?>
                                                <tbody class="text-center mx-auto">


                                                    <tr>
                                                        <th scope="row fw bold"><?= $vals['codeexa'] ?></th>
                                                        <td class="fw bold"><?= $vals['examen'] ?></td>
                                                        <td class="fw bold"><?= $vals['resultat'] ?></td>
                                                        <td class="fw bold"><?= $vals['trait'] ?></td>
                                                        <td class="fw bold"><?= $vals['ddate'] ?></td>
                                                        <td class="fw bold text-center mx-auto mx-2 ">
                                                            <?php
                                                            if ($_SESSION['fonction'] == 'Laborantin') {
                                                            ?>
                                                            <a class="text-secondary ms-2"
                                                                href="./resultat.php?id=<?= $vals['codeexa'] ?>&code=<?= $val['CODEPATIENTE'] ?>">
                                                                <i class="fa-solid fa-vial-virus fa-xl"></i>
                                                            </a>
                                                            <?php
                                                            } elseif ($_SESSION['fonction'] == 'Médecin' || $_SESSION['fonction'] == 'Femme Sage') { ?>
                                                            <a class="text-info "
                                                                href="./traitement.php?id=<?= $vals['codeexa'] ?>&code=<?= $val['CODEPATIENTE'] ?>"><i
                                                                    class="fa-solid fa-pills fa-xl"></i></a>

                                                            <?php
                                                            } elseif ($_SESSION['fonction'] == 'Administrateur') {
                                                            ?>
                                                            <a class="text-info "
                                                                href="./traitement.php?id=<?= $vals['codeexa'] ?>&code=<?= $val['CODEPATIENTE'] ?>"><i
                                                                    class="fa-solid fa-pills fa-xl"></i></a>
                                                            <a class="text-secondary ms-2"
                                                                href="./resultat.php?id=<?= $vals['codeexa'] ?>&code=<?= $val['CODEPATIENTE'] ?>">
                                                                <i class="fa-solid fa-vial-virus fa-xl"></i>
                                                            </a>

                                                            <?php
                                                            }
                                                            ?>

                                                        </td>

                                                    </tr>


                                                </tbody>
                                                <?php
                                            }
                                            ?>
                                            </table>

                                        </div>

                                    </div>

                                </div>

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