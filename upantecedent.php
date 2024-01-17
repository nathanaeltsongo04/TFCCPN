<?php
require('./class/link_db.php');
require_once("./class/antecedent.php");
require('./class/patiente.php');

$data = new patiente();
$id = $_GET['id'];
$code = $_GET['code'];
$data->setCODEPATIENTE($id);
$all = $data->afficherid();

$antedata = new antecedent();
$antedata->setCodeantecedent($code);
$rs = $antedata->afficherById();
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
                location.replace('vantecedent.php?id=<?php echo $id ?>');

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
                    <li class="breadcrumb-item active">Formulaire de Modification</li>
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
                                    Antécedents/Renseignement Généraux <span>| Patiente</span>
                                </div>

                                <div class="card-body ">
                                    <div class="row mb-3 fw-bold ">
                                        <div class="col-sm-12 mb-1">
                                            <!-- ANTECEDENT Form -->
                                            <form method="POST" action="./processing/upantecedent.php?code=<?= $vals['CODEANTECEDENT'] ?>&id=<?php echo $id ?>">
                                                <input type="hidden" name="code" value="<?= $vals['CODEANTECEDENT'] ?>" />
                                                <input type="hidden" name="id" value="<?php echo $id ?>" />


                                                <div class="row mb-2">
                                                    <h6 class="fw bold"><b>Antécédents Médicaux</b></h6>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">HTA
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="hta" id="inputState" class="form-select">
                                                            <option selected><?= $vals['HTARTERIELLE'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">DBT
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="dbt" id="inputState" class="form-select">
                                                            <option selected><?= $vals['DBT'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Cardio
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="cardio" id="inputState" class="form-select">
                                                            <option selected><?= $vals['CARDIOPAT'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row mb-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">IST->VIH/Sida
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="vih" id="inputState" class="form-select">
                                                            <option selected><?= $vals['ISTVIH'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Autres
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="autre" type="text" class="form-control" id="Country" value="<?= $vals['AUTRES'] ?>">

                                                    </div>
                                                </div>
                                                <!--Chirugicaux-->
                                                <div class="row mb-2 mt-4">
                                                    <h6 class="fw bold"><b>Antécédents Chirurgicaux</b></h6>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Césarienne
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="cesarienne" id="inputState" class="form-select">
                                                            <option selected><?= $vals['CESRIENE'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Cerclage
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="cerclage" id="inputState" class="form-select">
                                                            <option selected><?= $vals['CERCLAGE'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Fibronne Utérine
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="fibronne" id="inputState" class="form-select">
                                                            <option selected><?= $vals['FIBROME'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>

                                                </div>
                                                <div class="row mb-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Fracture du bassin
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="fracture" id="inputState" class="form-select">
                                                            <option selected><?= $vals['FRACTBASSIN'] ?></option>
                                                            <option value="Positif">Positif</option>
                                                            <option value="Négatif">Négatif</option>
                                                        </select>

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">GPU
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <select name="gpu" id="inputState" class="form-select">
                                                            <option selected><?= $vals['GPU'] ?></option>
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
                                                        <input name="ddr" type="date" class="form-control" value="<?= $vals['DDR'] ?>">

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Parié
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="parite" type="number" class="form-control" id="Country" value="<?= $vals['PARITE'] ?>">

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Grossesse
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="ngrossesse" type="number" class="form-control" id="Country" value="<?= $vals['GROSSESSE'] ?>">

                                                    </div>

                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Enfant
                                                        en vie
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="enfantvie" type="number" class="form-control" id="Country" value="<?= $vals['ENFANTVIE'] ?>">

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Avortements
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="avortement" type="number" class="form-control" id="Country" value="<?= $vals['AVORTEMENT'] ?>">

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Avortements du
                                                        1<sup>er</sup>Trimestre
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="autre" type="text" class="form-control border-0 bg-white" id="Country" value="<?= $vals['AVORTFIRSTTRIM'] ?>" disabled>
                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Trimpare de 15ans ou
                                                        moins
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="trimpamoins" id="inputState" class="form-select" required>
                                                            <option value="<?= $vals['TRIMPART15'] ?>" selected>
                                                                <?= $vals['TRIMPART15'] ?></option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>

                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">30 ans
                                                        ou plus
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="30ans" id="inputState" class="form-select" required>
                                                            <option value="<?= $vals['TRIMPART30PLUS'] ?>" selected>
                                                                <?= $vals['TRIMPART30PLUS'] ?></option>
                                                            <option value=" Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Dernier Accouchement
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="dernieraccouch" type="date" class="form-control" value="<?= $vals['LASTACCOUCH'] ?>">

                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Intervalle< 2 ans :</label>
                                                            <div class="col-md-2 col-lg-2">
                                                                <input name="interval" type="number" class="form-control" id="Country" value="<?= $vals['INTERVAL2ANS'] ?>">

                                                            </div>
                                                            <label for="Country" class="col-md-2 col-lg-2 col-form-label">Dystocie
                                                                :</label>
                                                            <div class="col-md-2 col-lg-2">
                                                                <select name="dystocie" id="inputState" class="form-select">
                                                                    <option value="<?= $vals['DYSTOCIE'] ?>" selected>
                                                                        <?= $vals['DYSTOCIE'] ?></option>
                                                                    <option value="Rien">Rien</option>
                                                                    <option value="Positif">Positif</option>
                                                                    <option value="Négatif">Négatif</option>
                                                                </select>
                                                            </div>
                                                            <label for="Country" class="col-md-2 col-lg-2 col-form-label">Eutocie
                                                                :</label>
                                                            <div class="col-md-2 col-lg-2">

                                                                <select name="eudocie" id="inputState" class="form-select" required>
                                                                    <option value="<?= $vals['EUDOCIE'] ?>" selected>
                                                                        <?= $vals['EUDOCIE'] ?></option>
                                                                    <option value="Rien">Rien</option>
                                                                    <option value="Positif">Positif</option>
                                                                    <option value="Négatif">Négatif</option>
                                                                </select>
                                                            </div>

                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Post-Mature :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="postmat" id="inputState" class="form-select" required>
                                                            <option value="<?= $vals['POSTMAT'] ?>" selected>
                                                                <?= $vals['POSTMAT'] ?></option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Mort-Né
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="mortne" id="inputState" class="form-select" required>
                                                            <option value="<?= $vals['MORTNE'] ?>" selected>
                                                                <?= $vals['MORTNE'] ?></option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Mort
                                                        avant 7jours
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="mort7" id="inputState" class="form-select" required>
                                                            <option value="<?= $vals['MORTAVSEPT'] ?>" selected>
                                                                <?= $vals['MORTAVSEPT'] ?></option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Plus
                                                        Gros Poids de Naissance :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="plusgros" type="number" class="form-control" id="Country" value="<?= $vals['BIGPOIDS'] ?>">

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Plus
                                                        de 4kg
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">
                                                        <input name="4kg" type="number" class="form-control" id="Country" value="<?= $vals['POIDSSUP4'] ?>">

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Dernier Enfant
                                                        Prématuré
                                                        :</label>
                                                    <div class="col-md-2 col-lg-2">

                                                        <select name="enfantprema" id="inputState" class="form-select" required>
                                                            <option value="<?= $vals['LASTBORNPREMA'] ?>" selected>
                                                                <?= $vals['LASTBORNPREMA'] ?></option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Complication pour
                                                        Stérilité
                                                        :</label>
                                                    <div class="col-md-4 col-lg-4">
                                                        <input name="compsterilite" type="text" class="form-control" id="Country" value="<?= $vals['COMPSTERILITE'] ?>">

                                                    </div>
                                                </div>
                                                <div class="row mb-2 mt-2">
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Complication Post
                                                        Partum :</label>
                                                    <div class="col-md-4 col-lg-4">
                                                        <select name="postpat" id="inputState" class="form-select">
                                                            <option selected><?= $vals['COMPOSTPAT'] ?></option>
                                                            <option value="Oui">Oui</option>
                                                            <option value="Non">Non</option>
                                                        </select>

                                                    </div>
                                                    <label for="Country" class="col-md-2 col-lg-2 col-form-label">Si Oui
                                                        lesquelles
                                                        :</label>
                                                    <div class="col-md-4 col-lg-4 ">
                                                        <input name="sioui" type="text" class="form-control" id="Country" value="<?= $vals['COMPPOSTPATOUI'] ?>">

                                                    </div>

                                                </div>



                                                <div class="text-center mt-3">
                                                    <button type="submit" name="update" class="btn btn-success fw-bold text-white"><i class="fa-solid fa-pen-to-square"></i></button>
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
    <?php
    include('./includes/footer.php');
    ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex bg-info align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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