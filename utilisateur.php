<?php
require('./class/link_db.php');
require_once("./class/utilisateur.php");
require_once("./class/fonction.php");
$data = new utilisateur();
$all = $data->afficher();
$dataf = new fonction();
$allf = $dataf->afficher();
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
                                    <?php echo ucfirst($pagename); ?> <span>| H.G.L</span>
                                    <a href="#exampleModal" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="m-auto text-info float-end fw-bold"><i
                                            class="fa-solid fa-plus-circle fa-xl"></i></a>
                                </div>

                                <div class="card-body">


                                    <!-- Table with stripped rows -->
                                    <table class="table datatable ">
                                        <thead>
                                            <tr>
                                                <th scope="col">Code</th>
                                                <th scope="col">NOMS</th>
                                                <th scope="col">FONCTION</th>
                                                <th scope="col">ADDRESSE</th>
                                                <th scope="col">ACTION</th>

                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php
                                        foreach ($all as $key => $val) {
                                        ?>

                                            <tr>
                                                <th scope="row fw bold"><?= $val['CODEUTILISATEUR'] ?></th>
                                                <td class="fw bold">
                                                    <?= $val['NOM'] . " " . $val['POSTNOM'] . " " . $val['PRENOM'] ?>
                                                </td>
                                                <td class="fw bold"><?= $val['fonction'] ?></td>
                                                <td class="fw bold"><?= $val['ADRESSE'] ?></td>
                                                <td class="fw bold text-center p-md-2">
                                                    <a class="text-info mx-auto "
                                                        href="./uputilisateur.php?id=<?= $val['CODEUTILISATEUR'] ?>">
                                                        <i class="fa-solid fa-pen-to-square fa-xl"></i>
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
            </section>

        </main><!-- End #main -->
        <!-- Modal -->
        <div class="modal fade border-bottom-secondary" id="exampleModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  ">
                <div class="modal-content border-bottom-dark">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title fw-bold " id="exampleModalLabel">Ajouter Un Utilisateur</h5>
                        <button type="button" class="btn-close fw-bold text-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3 form-horizontal mt-3" method="POST" action="./processing/utilisateur.php">
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-3 col-form-label fw-bold text-info">Nom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="nom" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="text-info col-sm-3 col-form-label fw-bold">Post
                                    Nom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="postnom" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="text-info col-sm-3 col-form-label fw-bold">Prénom</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="prenom" required="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="text-info col-sm-3 col-form-label fw-bold">Adresse</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="adresse" required="">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="text-info col-sm-3 col-form-label fw-bold">Fonction</label>
                                <div class="col-sm-9">
                                    <select name="fonction" required="" class=" form-select "
                                        aria-label="Default select example">
                                        <option selected>Selectionner</option>
                                        <?php
                                    foreach ($allf as $cle => $valeur) { ?>
                                        <option value="<?= $valeur['CODEFONCTION'] ?>">
                                            <?= $valeur['DESIGNATION'] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-12 text-center ">
                                <button class="btn btn-info w-20 fw-bold text-white" name="save"
                                    type="submit">Enregistrer</button>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer border-top-0">

                    </div>
                </div>
            </div>
        </div>


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