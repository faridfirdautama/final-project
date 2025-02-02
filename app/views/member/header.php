<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base_url" content="<?= BASEURL ?>">
    <title><?= APP_NAME ?> - <?= $data['title'] ?></title>

    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/feather.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/select2.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/dropzone.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/uppy.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/jquery.steps.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/jquery.timepicker.css">
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="<?= BASEURL ?>/light/css/app-dark.css" id="darkTheme" disabled>
</head>

<body class="vertical  light  ">

    <!-- Memanggil sideba-->
    <div class="wrapper">
        <nav class="topnav navbar navbar-light">
            <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
                <i class="fe fe-menu navbar-toggler-icon"></i>
            </button>
            <form class="form-inline mr-auto searchform text-muted">
                <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
            </form>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
                        <i class="fe fe-sun fe-16"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
                        <span class="fe fe-grid fe-16"></span>
                    </a>
                </li>
                <li class="nav-item nav-notif">
                    <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                        <span class="fe fe-bell fe-16"></span>
                        <span class="dot dot-md bg-success"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="avatar avatar-sm mt-2">
                            <img src="<?= BASEURL ?>/light/assets/avatars/profile.png" alt="..." class="avatar-img rounded-circle">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= BASEURL ?>/member/logout" onclick="return confirm('Apakah anda yakin ingin keluar?')">
                            <i class="fas fa-sign-out-alt fa-sm mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>


        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
                <i class="fe fe-x"><span class="sr-only"></span></i>
            </a>
            <nav class="vertnav navbar navbar-light">
                <!-- nav bar -->
                <div class="w-100 mb-4 d-flex">
                    <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= BASEURL ?>/member">

                        <img src="<?= BASEURL ?>/light/assets/avatars/logo.png" alt="logo" width="70%">
                    </a>
                </div>

                <!-- Memanggil sidebar member -->

                <ul class="navbar-nav flex-fill w-100 mb-2">

                    <li class="nav-item w-100">
                        <a class="nav-link" href="<?= BASEURL ?>/member">
                            <i class="fe fe-home fe-16"></i>
                            <span class="ml-3 item-text">Dashboard</span>
                        </a>
                    </li>

                </ul>


                <p class="text-muted nav-heading mt-4 mb-1">
                    <span>Apps</span>
                </p>
                <ul class="navbar-nav flex-fill w-100 mb-2">

                    <li class="nav-item w-100">
                        <a class="nav-link" href="<?= BASEURL ?>/member/daftar-pinjaman">
                            <i class="fe fe-grid fe-16"></i>
                            <span class="ml-3 item-text">Daftar Pinjaman</span>
                        </a>
                    </li>


                    <li class="nav-item w-100">
                        <a class="nav-link" href="<?= BASEURL ?>/member/input-peminjaman">
                            <i class="fe fe-credit-card fe-16"></i>
                            <span class="ml-3 item-text">Input Peminjaman</span>
                        </a>
                    </li>


                    <li class="nav-item w-100">
                        <a class="nav-link" href="<?= BASEURL ?>/member/kontak">
                            <i class="fe fe-help-circle fe-16"></i>
                            <span class="ml-3 item-text">Customer Service</span>
                        </a>
                    </li>





            </nav>
        </aside>




        <main role="main" class="main-content">