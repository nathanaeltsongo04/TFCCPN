<?php
require('./class/link_db.php');
require('./class/entreprise.php');
$data = new entreprise();
$all = $data->afficher();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <title>Hôpital des Grands Lacs</title>
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
        <script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">

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
        <!-- End Header -->
        <?php
    include('./includes/navbar.php');
    ?>
        <!-- ======= Sidebar ======= -->
        <?php
    include('./includes/sidebar.php');
    ?>
        <!-- End Sidebar-->
        <?php
    if (isset($_GET['msg']) == 'True') {
    ?>
        <script>
        Swal.fire({
            position: 'center',
            icon: '<?php echo $_GET['action'] ?>',
            title: '<?php echo $_GET['info'] ?>',
            showConfirmButton: false,
            timer: 2800
        }).then(function() {
            location.replace('users-profile.php?id=<?php echo $id ?>');
        });
        </script>
        <?php } elseif (isset($_GET['msg']) == 'False') {
    ?>
        <script>
        Swal.fire({
            position: 'center',
            icon: '<?php echo $_GET['action'] ?>',
            title: '<?php echo $_GET['info'] ?>',
            showConfirmButton: false,
            timer: 1500
        }).then(function() {
            location.replace('users-profile.php?id=<?php echo $id ?>');
        });
        </script>
        <?php } ?>

        <main id="main" class="main">

            <div class="pagetitle">
                <h2>Tableau de Bord</h2>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Accueil</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <section class="section profile">
                <div class="row">
                    <div class="col-xl-4">

                        <div class="card">
                            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                <img src="./assets/img/profile-img.png" alt="Profile" class="rounded-circle">
                                <h2>Kevin Anderson</h2>
                                <h3>Web Designer</h3>
                                <div class="social-links mt-2">
                                    <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                    <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                    <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                    <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-xl-8">

                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">Edit Profile</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Change Password</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                        <h5 class="card-title">Profile Details</h5>
                                        <?php
                                    foreach ($all as $key => $val) {
                                    ?>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Pays</div>
                                            <div class="col-lg-9 col-md-8">
                                                <?= $val['COUNTRY'] ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Ministère</div>
                                            <div class="col-lg-9 col-md-8"><?= $val['MINISTRY'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Province</div>
                                            <div class="col-lg-9 col-md-8"><?= $val['PROVINCE'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">District</div>
                                            <div class="col-lg-9 col-md-8"><?= $val['DISTRICT'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Zone de Santé</div>
                                            <div class="col-lg-9 col-md-8"><?= $val['ZONE'] ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-5 label fw-bold text-black">As/Formation
                                                Sanitaire</div>
                                            <div class="col-lg-8 col-md-7"><?= $val['ASFORMATION'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Adresse</div>
                                            <div class="col-lg-9 col-md-8">
                                                <?= $val['AV'] . " " . $val['QUARTIER'] . " " . $val['COMMUNE'] ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Téléphone</div>
                                            <div class="col-lg-9 col-md-8"><?= $val['TEL'] ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Email</div>
                                            <div class="col-lg-9 col-md-8"><?= $val['EMAIL'] ?></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label fw-bold text-black">Adresse</div>
                                            <div class="col-lg-9 col-md-8"><?= $val['AV'] ?></div>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    </div>

                                    <div class="tab-pane fade pt-3" id="profile-edit">

                                        <div class="card-body">
                                            <?php
                                        foreach ($all as $key => $val) {
                                        ?>
                                            <form class="row g-3 form-horizontal mt-3" method="POST"
                                                action="./processing/entreprise.php?id=<?= $val['CODECOMPANY'] ?>">
                                                <input type="hidden" name="id" value="<?= $val['CODECOMPANY'] ?>" />

                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class="col-md-4 col-lg-3 col-form-label fw-bold ">Pays</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['COUNTRY'] ?>"
                                                            class="form-control" name="pays" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Ministère</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['MINISTRY'] ?>"
                                                            class="form-control" name="ministere" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Province</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['PROVINCE'] ?>"
                                                            class="form-control" name="province" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">District
                                                        Sanitaire</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['DISTRICT'] ?>"
                                                            class="form-control" name="district" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Zone de
                                                        Santé</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['ZONE'] ?>"
                                                            class="form-control" name="zone" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">As/Formation
                                                        Sanitaire</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['ASFORMATION'] ?>"
                                                            class="form-control" name="asformation" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Avenue</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['AV'] ?>"
                                                            class="form-control" name="avenue" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Quartier</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['QUARTIER'] ?>"
                                                            class="form-control" name="quartier" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Commune</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['COMMUNE'] ?>"
                                                            class="form-control" name="commune" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Téléphone</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['TEL'] ?>"
                                                            class="form-control" name="telephone" required="">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputText"
                                                        class=" col-md-4 col-lg-3 col-form-label fw-bold">Email</label>
                                                    <div class="col-md-8 col-lg-9">
                                                        <input type="text" value="<?= $val['EMAIL'] ?>"
                                                            class="form-control" name="email" required="">
                                                    </div>
                                                </div>


                                                <div class="text-center">
                                                    <button type="submit" name="update"
                                                        class="btn btn-success">Modifier</button>
                                                </div>


                                            </form>

                                            <?php
                                        }
                                        ?>
                                        </div>

                                    </div>

                                </div><!-- End Bordered Tabs -->

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

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
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