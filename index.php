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

        <!-- Template Main CSS File -->
        <link href="assets/css/style.css" rel="stylesheet">
        <script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>


        <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body class="bg-light">
        <?php
    if (isset($_GET['msg']) == 'False') {
    ?>
        <script>
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: '<?php echo $_GET['info'] ?>',
            showConfirmButton: false,
            timer: 2800
        }).then(function() {
            location.replace('index.php');
        });
        </script>
        <?php } elseif (isset($_GET['msg']) == 'True') { ?>
        <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '<?php echo $_GET['info'] ?>',
            showConfirmButton: false,
            timer: 2800
        }).then(function() {
            location.replace('index.php');
        });
        </script>

        <?php } elseif (isset($_GET['msg']) == 'existe') { ?>
        <script>
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: '<?php echo $_GET['info'] ?>',
            showConfirmButton: false,
            timer: 2800
        }).then(function() {
            location.replace('index.php');
        });
        </script>

        <?php } elseif (isset($_GET['msg']) == 'pas') { ?>

        <script>
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: '<?php echo $_GET['info'] ?>',
            showConfirmButton: false,
            timer: 2800
        }).then(function() {
            location.replace('index.php');
        });
        </script>

        <?php
    } elseif (isset($_GET['msg']) == 'password') {
    ?>
        <script>
        Swal.fire({
            position: 'center',
            icon: 'info',
            title: '<?php echo $_GET['info'] ?>',
            showConfirmButton: false,
            timer: 2800
        }).then(function() {
            location.replace('index.php');
        });
        </script>
        <?php } ?>

        <main>
            <div class="container">

                <section
                    class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                                <div class="d-flex justify-content-center py-4">
                                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/logon.png" alt="">
                                        <span class="d-none d-lg-block fs-5">Hôpital des Grands Lacs</span>
                                    </a>
                                </div><!-- End Logo -->

                                <div class="card mb-3 px-2">

                                    <div class="card-body">

                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center pb-0 fs-4 fw-bold">CONNEXION AGENTS</h5>

                                        </div>

                                        <form class="row g-3 form-horizontal mt-3" method="POST"
                                            action="./processing/login.php">

                                            <div class="col-12 mt-2 mb-3">
                                                <input class="form-control" type="text" required="" name="username"
                                                    placeholder="Nom d'utilisateur" autocomplete="off">
                                            </div>

                                            <div class="col-12 mb-2">

                                                <input class="form-control" type="password" name="password" required=""
                                                    placeholder="Mot de passe" autocomplete="off">

                                            </div>

                                            <div class="col-12 mb-2">

                                            </div>
                                            <div class="col-12">
                                                <button name="connecter" class="btn btn-primary w-100"
                                                    type="submit">Connexion</button>
                                            </div>
                                            <div class="col-12 text-center">
                                                <p class="small mb-0">Je n'ai pas de compte? <a
                                                        href="pages-register.php">Créez un compte</a></p>
                                            </div>
                                        </form>

                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>

                </section>

            </div>
        </main><!-- End #main -->

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
        <script src="assets/js/sweetalert.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

    </body>

</html>