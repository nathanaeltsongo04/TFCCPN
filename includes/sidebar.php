<?php
if ($_SESSION['fonction'] == 'Administrateur') {
?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav " id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="./statistique.php">
                <i class="bi bi-grid"></i>
                <span>Tableau de Bord</span>
            </a>
        </li><!-- End Tableau de Bord Nav -->
        <li class="nav-heading">MAIN MENU</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="./patiente.php">
                <i class="bi bi-people-fill"></i>
                <span>Patientes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./rendez-vous.php">
                <i class="bi bi-calendar-event"></i>
                <span>Rendez-vous</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-virus"></i><span>Vaccins</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="./vaccin.php">
                        <i class="bi bi-circle"></i><span>Liste</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Vaccin Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-eyedropper"></i><span>Examens</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="./examen.php">
                        <i class="bi bi-circle"></i><span>Liste</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-heading">CONSULTATION</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./overview.php">
                <i class="bi bi-eye-fill"></i>
                <span>View</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./rapport.php">
                <i class="bi bi-file-earmark-text"></i>
                <span>Rapport</span>
            </a>
        </li>
        <!-- End Examen Nav -->

        <li class="nav-heading">OTHER MENU</li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav2" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Paramètres</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav2" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="./entreprise.php">
                        <i class="bi bi-circle"></i><span>Entreprise</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./utilisateur.php">
                <i class="bi bi-person-circle"></i>
                <span>Utilisateurs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./fonction.php">
                <i class="bi bi-person-workspace"></i>
                <span>Fonction</span>
            </a>
        </li>

        <!-- End Examen Nav -->
    </ul>

</aside><!-- End Sidebar-->
<?php
} else if ($_SESSION['fonction'] == 'Réceptionniste') {
?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav " id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="./statistique.php">
                <i class="bi bi-grid"></i>
                <span>Tableau de Bord</span>
            </a>
        </li><!-- End Tableau de Bord Nav -->
        <li class="nav-heading">MAIN MENU</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="./patiente.php">
                <i class="bi bi-people-fill"></i>
                <span>Patientes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./rendez-vous.php">
                <i class="bi bi-calendar-event"></i>
                <span>Rendez-vous</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
<?php
} else if ($_SESSION['fonction'] == 'Médecin' || $_SESSION['fonction'] == 'Femme Sage') {
?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav " id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="./statistique.php">
                <i class="bi bi-grid"></i>
                <span>Tableau de Bord</span>
            </a>
        </li><!-- End Tableau de Bord Nav -->
        <li class="nav-heading">MAIN MENU</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="./patiente.php">
                <i class="bi bi-people-fill"></i>
                <span>Patientes</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./rendez-vous.php">
                <i class="bi bi-calendar-event"></i>
                <span>Rendez-vous</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-virus"></i><span>Vaccins</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="./vaccin.php">
                        <i class="bi bi-circle"></i><span>Liste</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Vaccin Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-eyedropper"></i><span>Examens</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="./examen.php">
                        <i class="bi bi-circle"></i><span>Liste</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">CONSULTATION</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./overview.php">
                <i class="bi bi-eye-fill"></i>
                <span>View</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
<?php } elseif ($_SESSION['fonction'] == 'Laborantin') { ?>
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav " id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="#">
                <i class="bi bi-grid"></i>
                <span>Tableau de Bord</span>
            </a>
        </li><!-- End Tableau de Bord Nav -->
        <li class="nav-heading">MAIN MENU</li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-virus"></i><span>Vaccins</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="./vaccin.php">
                        <i class="bi bi-circle"></i><span>Liste</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Vaccin Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav1" data-bs-toggle="collapse" href="#">
                <i class="bi bi-eyedropper"></i><span>Examens</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav1" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="./examen.php">
                        <i class="bi bi-circle"></i><span>Liste</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">CONSULTATION</li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="./overview.php">
                <i class="bi bi-eye-fill"></i>
                <span>View</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->

<?php } else {
    header('location:../index.php');
} ?>