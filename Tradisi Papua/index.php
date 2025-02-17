<?php
session_start();
include '../koneksi.php';
function rupiah($angka)
{
    $hasilrupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasilrupiah;
}
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='../login.php';</script>";
    header('location:login.php');
    exit();
}
function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ADMIN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <link rel="icon" href="../foto/logo.png">
    <link rel="stylesheet" href="assets_admin/dist/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="assets/ckeditor/ckeditor.js"></script>
</head>

<body class="">
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <nav class="pcoded-navbar  ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="assets_admin/dist/assets/images/user/user.png" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details">ADMIN<i class="fa fa-chevron-down m-l-5"></i></div>
                        </div>
                    </div>
                    <div class="collapse" id="nav-user-link">
                        <ul class="list-unstyled">
                            <li class="list-group-item"><a href="index.php?halaman=logout" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">
                    <li class="nav-item pcoded-menu-caption">
                        <label>Halaman</label>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?halaman=beranda" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="index.php?halaman=kategoridaftar" class="nav-link "><span class="pcoded-micon"><i class="feather icon-file-text"></i></span><span class="pcoded-mtext">Data Kategori</span></a>
                    </li> -->
                    <li class="nav-item">
                        <a href="index.php?halaman=informasidaftar" class="nav-link "><span class="pcoded-micon"><i class="feather icon-align-justify"></i></span><span class="pcoded-mtext">Data Informasi</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="index.php?halaman=postingdaftar" class="nav-link "><span class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span class="pcoded-mtext">Data Posting</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?halaman=galeridaftar" class="nav-link "><span class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span class="pcoded-mtext">Data Galeri</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?halaman=userdaftar" class="nav-link "><span class="pcoded-micon"><i class="feather icon-user"></i></span><span class="pcoded-mtext">Data User</span></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">


        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
            <a href="index.php?halaman=beranda" class="b-brand">
                <h4 class="text-white"><span>Admin Panel</span></h4>
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="assets_admin/dist/assets/images/user/user.png" class="img-radius" alt="User-Profile-Image">
                                <a href="index.php?halaman=logout" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')">
                                    <span class="text-white">Logout</span>
                                </a>
                                <a href="index.php?halaman=logout" onclick="return confirm('Apakah Anda Yakin Ingin Keluar ?')" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


    </header>
    <!-- [ Header ] end -->
    <div id="layoutSidenav_content">
        <main>
            <?php
            if (isset($_GET['halaman'])) {
                if ($_GET['halaman'] == "informasidaftar") {
                    include 'informasidaftar.php';
                } elseif ($_GET['halaman'] == "informasitambah") {
                    include 'informasitambah.php';
                } elseif ($_GET['halaman'] == "informasihapus") {
                    include 'informasihapus.php';
                } elseif ($_GET['halaman'] == "informasiedit") {
                    include 'informasiedit.php';
                } elseif ($_GET['halaman'] == "logout") {
                    include 'logout.php';
                } elseif ($_GET['halaman'] == "beranda") {
                    include 'beranda.php';
                } elseif ($_GET['halaman'] == "kategoridaftar") {
                    include 'kategoridaftar.php';
                } elseif ($_GET['halaman'] == "kategoriedit") {
                    include 'kategoriedit.php';
                } elseif ($_GET['halaman'] == "hapusfoto") {
                    include 'hapusfoto.php';
                } elseif ($_GET['halaman'] == "kategoritambah") {
                    include 'kategoritambah.php';
                } elseif ($_GET['halaman'] == "kategorihapus") {
                    include 'kategorihapus.php';
                } elseif ($_GET['halaman'] == "usertambah") {
                    include 'usertambah.php';
                } elseif ($_GET['halaman'] == "useredit") {
                    include 'useredit.php';
                } elseif ($_GET['halaman'] == "userhapus") {
                    include 'userhapus.php';
                } elseif ($_GET['halaman'] == "userdaftar") {
                    include 'userdaftar.php';
                } elseif ($_GET['halaman'] == "galeritambah") {
                    include 'galeritambah.php';
                } elseif ($_GET['halaman'] == "galeriedit") {
                    include 'galeriedit.php';
                } elseif ($_GET['halaman'] == "galerihapus") {
                    include 'galerihapus.php';
                } elseif ($_GET['halaman'] == "galeridaftar") {
                    include 'galeridaftar.php';
                } elseif ($_GET['halaman'] == "postingdaftar") {
                    include 'postingdaftar.php';
                } elseif ($_GET['halaman'] == "postinghapus") {
                    include 'postinghapus.php';
                } elseif ($_GET['halaman'] == "postingverifikasi") {
                    include 'postingverifikasi.php';
                }
            } else {
                include 'beranda.php';
            }
            ?>
        </main>
    </div>
    <script src="assets_admin/dist/assets/js/vendor-all.min.js"></script>
    <script src="assets_admin/dist/assets/js/plugins/bootstrap.min.js"></script>
    <script src="assets_admin/dist/assets/js/pcoded.min.js"></script>

    <!-- Apex Chart -->
    <script src="assets_admin/dist/assets/js/plugins/apexcharts.min.js"></script>


    <!-- custom-chart js -->
    <script src="assets_admin/dist/assets/js/pages/dashboard-main.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tabel').DataTable();
        });
    </script>
</body>

</html>