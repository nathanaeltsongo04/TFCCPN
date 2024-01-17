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
            location.replace('antecedent.php?id=<?php echo $id ?>');

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
                                                        <td class="">Nom</td>
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
                                    Antécedents/Renseignement Généraux <span>| Patiente</span>
                                </div>

                                <div class="card-body ">
                                    <div class="row mb-3 fw-bold ">
                                        <div class="col-sm-12 mb-1">
                                            <!-- ANTECEDENT Form -->
                                            <form method="POST" action="./processing/addantecedent.php?">
                                                <input type="hidden" name="id" value="<?php echo $id ?>" />
                                                <div class="row mb-2">
                                                    <h6 class="fw bold"><b>Antécédents Médicaux</b></h6>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">HTA
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="hta" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">DBT
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="dbt" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Cardio
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="cardio" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="row mb-2">
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">IST->VIH/Sida
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="vih" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Autres
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="autre" type="text" class="form-control"
                                                            id="Country" value="">

                                                    </div>
                                                </div>
                                                <!--Chirugicaux-->
                                                <div class="row mb-2 mt-4">
                                                    <h6 class="fw bold"><b>Antécédents Chirurgicaux</b></h6>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Césarienne
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="cesarienne" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Cerclage
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="cerclage" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Fibronne Utérine
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="fibronne" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="row mb-2">
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Fracture du bassin
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="fracture" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">GPU
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="gpu" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <!--ANTECEDENT OBSTETRICAUX-->
                                                <div class="row mb-2 mt-4">
                                                    <h6 class="fw bold"><b>Antécédents Ostétricaux</b></h6>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">DDR
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="ddr" type="date" class="form-control">
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Parité
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input min="0" name="parite" type="number" class="form-control"
                                                            id="Country" value="">
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Grossesse
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input min="0" name="ngrossesse" type="number"
                                                            class="form-control" id="Country" value="">
                                                    </div>

                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Enfant
                                                        en vie
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input min="0" name="enfantvie" type="number"
                                                            class="form-control" id="Country" value="">
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Avortements
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input min="0" name="avortement" type="number"
                                                            class="form-control" id="Country" value="">
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Avortements du
                                                        1<sup>er</sup>Trimestre
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input min="0" name="avortementtrim" type="number"
                                                            class="form-control" id="Country" value="">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Trimpare de 15ans ou
                                                        moins
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="trimpamoins" id="inputState" class="form-select"
                                                            required>
                                                            <option selected>Choose...</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">30 ans
                                                        ou plus
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="30ans" id="inputState" class="form-select"
                                                            required>
                                                            <option selected>Choose...</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Dernier Accouchement
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="dernieraccouch" type="date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Intervalle< 2 ans
                                                            :</label>
                                                            <div class="col-md-2 col-lg-2">
                                                                <input min="0" name="interval" type="number"
                                                                    class="form-control" id="Country" value="">
                                                            </div>
                                                            <label for="Country"
                                                                class="col-md-2 col-lg-2 col-form-label">Dystocie
                                                                :</label>
                                                            <div class="col-md-2 col-lg-2">
                                                                <select name="dystocie" id="inputState"
                                                                    class="form-select">
                                                                    <option selected>Choose...</option>
                                                                    <option value="Rien">Rien</option>
                                                                    <option value="Positif">Positif</option>
                                                                    <option value="Négatif">Négatif</option>
                                                                </select>
                                                            </div>
                                                            <label for="Country"
                                                                class="col-md-2 col-lg-2 col-form-label">Eutocie
                                                                :</label>
                                                            <div class="col-md-2 col-lg-2">

                                                                <select name="eudocie" id="inputState"
                                                                    class="form-select" required>
                                                                    <option selected>Choose...</option>
                                                                    <option value="Rien">Rien</option>
                                                                    <option value="Positif">Positif</option>
                                                                    <option value="Négatif">Négatif</option>
                                                                </select>
                                                            </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Post-Mature :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="postmat" id="inputState" class="form-select"
                                                            required>
                                                            <option selected>Choose...</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Mort-Né
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="mortne" id="inputState" class="form-select"
                                                            required>
                                                            <option selected>Choose...</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Mort
                                                        avant 7jours
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="mort7" id="inputState" class="form-select"
                                                            required>
                                                            <option selected>Choose...</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Plus
                                                        Gros Poids de Naissance :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input min="0" name="plusgros" type="number" step="0.01"
                                                            class="form-control" id="Country" value="">
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Plus
                                                        de 4kg
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="4kg" type="number" step="0.01" min="0"
                                                            class="form-control" id="Country" value="">
                                                    </div>
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Dernier Enfant
                                                        Prématuré
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="enfantprema" id="inputState" class="form-select"
                                                            required>
                                                            <option selected>Choose...</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Complication pour
                                                        Stérilité
                                                        :</label>
                                                    <div class="col-md-4 col-lg-4">
                                                        <input name="compsterilite" type="text" class="form-control"
                                                            id="Country" value="">
                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country"
                                                        class="col-md-2 col-lg-2 col-form-label">Complication Post
                                                        Partum :</label>
                                                    <div class="col-md-4 col-lg-4">
                                                        <select name="postpat" id="inputState" class="form-select">
                                                            <option selected>Choose...</option>
                                                            <option value="Rien">Rien</option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Si Oui
                                                        lesquelles
                                                        :</label>
                                                    <div class="col-md-4 col-lg-4">
                                                        <input name="sioui" type="text" class="form-control"
                                                            id="Country" value="">
                                                    </div>

                                                </div>


                                                <div class="text-center mt-3">
                                                    <button type="submit" name="save"
                                                        class="btn btn-info fw-bold text-white">Enregistrer</button>
                                                </div>
                                            </form><!-- End settings Form -->

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