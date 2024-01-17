<?php
require('./class/link_db.php');
require_once("./class/patiente.php");
require('./class/evolution.php');

$data = new patiente();
$id = $_GET['id'];
$data->setCODEPATIENTE($id);
$all = $data->afficherid();

$antedata = new evolution();
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
            location.replace('vevolution.php?id=<?= $id ?>');
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

                                                ?>

                                                    <tr>
                                                        <td class="">Nom</td>
                                                        <td><?= $val['NOM']  ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Post->Nom</td>
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
                <?php
            foreach ($rs as $keys => $vals) {

            ?>
                <div class="row">

                    <!-- Left side columns -->
                    <div class="col-lg-12">

                        <!-- Recent Sales -->
                        <div class="col-12">
                            <div class="card recent-sales overflow-auto">

                                <div class="card-header fw-bold border-bottom-0 mb-1 ">
                                    <i class="fa-solid fa-users me-1"></i>
                                    Evolution de la grossesse <span>| Patiente</span>
                                    <a href="" class="m-auto text-info float-end fw-bold">Date :
                                        <?= $vals['DDATE'] ?></a>
                                </div>

                                <div class="card-body ">
                                    <div class="row mb-3 fw-bold ">
                                        <div class="col-sm-12 mb-1">
                                            <!-- Suivi Maternite Form -->
                                            <form method="POST"
                                                action="./upevolution.php?code=<?= $vals['CODEEVOLUTION'] ?>&id=<?php echo $id ?>">

                                                <input type="hidden" name="id" value="<?php echo $id ?>" />

                                                <table class="table table-borderless ">
                                                    <tbody>
                                                        <tr>
                                                            <td class="">DDR</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['DDR'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="">Date 1<sup>ère</sup>Cons</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['DATECONSULT'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Conjoctivité</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country"
                                                                        value="<?= $vals['CONJONCTIVITE'] ?>" disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Hauteur Uterine</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['HTUTERINE'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Mouvement Foetal</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['MVTFEOTAL'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>BCF</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['BCF'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Présentation</td>
                                                            <td>
                                                                <div class="col-md-6 col-lg-7">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country"
                                                                        value="<?= $vals['PRESENTATION'] ?>" disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Perte Liquidienne</td>
                                                            <td>
                                                                <div class="col-md-6 col-lg-7">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['PERTLIQUI'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Présence Eoden</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['EODEM'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Albuminurie</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['ALBUMIN'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Glucémie</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['GLYCEMIE'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tension Arterielle</td>
                                                            <td>
                                                                <div class="col-md-6 col-lg-7">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['TARTERIELLE'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contraction</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['CONTRACTION'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bassin ou Promoutoire</td>
                                                            <td>
                                                                <div class="col-md-6 col-lg-7">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['BASPROMO'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Poids</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['POIDS'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taille</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['TAILLE'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Taille Sup à 1,50</td>
                                                            <td>
                                                                <div class="col-md-4 col-lg-5">
                                                                    <input name="autre" type="text"
                                                                        class="form-control border-0 bg-white"
                                                                        id="Country" value="<?= $vals['TAILLESUP'] ?>"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>

                                                </table>


                                                <div class="text-center mt-3">
                                                    <button type="submit" name="save"
                                                        class="btn btn-info fw-bold text-white">Modifier</button>
                                                </div>
                                            </form><!-- End settings Form -->

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            </section>

        </main><!-- End #main -->


        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer">
            <div class="copyright">
                &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </footer><!-- End Footer -->

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