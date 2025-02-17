<?php
include 'koneksi.php';
session_start();
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
  $datakategori[] = $tiap;
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
// error_reporting(0);
// ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Informasi PAPUA </title>

  <!-- Favicon -->
  <link rel="icon" href="foto/logo.png">

  <!-- Core Stylesheet -->
  <link rel="stylesheet" href="assets_home/style.css">
  <script src="admin/assets/ckeditor/ckeditor.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
  <style>
    /* Add this CSS to your stylesheet or <style> tag */
    .thumbs-icon {
      /* Initial color */
      color: black;
      transition: color 0.3s;
      /* Smooth transition when color changes */
    }

    .thumbs-icon:hover {
      color: #1da2ef;
      /* Change to blue on hover */
    }

    .sharing {
      transition: color 0.3s;
      color: black;
      /* Change to blue on hover */
    }

    .sharing:hover {
      color: #1da2ef;
      /* Change to blue on hover */
    }

    .aktif {
      color: #1da2ef;
    }

    .fa-6x {
      font-size: 20pt
    }

    .social .fbtn {
      width: 50px;
      color: #fff;
      text-align: center;
      line-height: 18px;
      float: left;
    }

    .social .fa {
      padding: 15px 0px
    }

    .facebook {
      background-color: #3b5998;
    }

    .gplus {
      background-color: #dd4b39;
    }

    .twitter {
      background-color: #55acee;
    }

    .stumbleupon {
      background-color: #eb4924;
    }

    .pinterest {
      background-color: #cc2127;
    }

    .linkedin {
      background-color: #0077b5;
    }

    .buffer {
      background-color: #323b43;
    }

    .whatsapp {
      background-color: #00b075;
    }

    .share-button.sharer {
      height: 20px;
    }

    .share-button.sharer .social.active.top {
      transform: scale(1) translateY(-10px);
    }

    .share-button.sharer .social.active {
      opacity: 1;
      transition: all 0.4s ease 0s;
      visibility: visible;
    }

    .share-button.sharer .social.networks-5 {}

    .share-button.sharer .social.top {
      margin-top: -80px;
      transform-origin: 0 0 0;
    }

    .share-button.sharer .social {
      margin-left: -65px;
      opacity: 0;
      transition: all 0.4s ease 0s;
      visibility: hidden;
    }
  </style>
</head>

<body>
  <!-- Preloader -->
  <!-- <div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-circle"></div>
    <div class="preloader-img">
      <img src="foto/logo.png" alt="">
    </div>
  </div> -->

  <header class="header-area">

    <div class="top-header-area">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="top-header-content d-flex align-items-center justify-content-between">
              <div class="top-header-meta">
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="papuagoodguide@gmail.com"><i class="fa fa-envelope-o" aria-hidden="true"></i> <span>Email : informasipapua@gmail.com</span></a>
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="085694643807"><i class="fa fa-phone" aria-hidden="true"></i> <span>No. HP : 0813-4465-4648</span></a>
              </div>

              <div class="top-header-meta d-flex">
                <div class="login">
                  <?php
                  if (!isset($_SESSION["pengguna"])) { ?>
                    <a href="#" data-toggle="modal" data-target="#daftar"><i class="fa fa-users" aria-hidden="true"></i></a>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="alazea-main-menu">
      <div class="classy-nav-container breakpoint-off">
        <div class="container">
          <nav class="classy-navbar justify-content-between" id="alazeaNav">

            <a href="index.php" class="nav-brand"><img style="height:60px;" src="foto/logo.png"></a>

            <div class="classy-navbar-toggler">
              <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>

            <div class="classy-menu">

              <div class="classycloseIcon">
                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
              </div>

              <!-- Navbar Start -->
              <div class="classynav">
                <ul>
                  <li><a href="index.php">Home</a></li>
                  <li><a href="posting.php">Konten</a></li>
                  <li><a href="galeri.php">Galeri</a></li>
                  <li><a href="#">Kategori</a>
                    <ul class="dropdown">
                      <?php $ambil = $koneksi->query("SELECT * FROM kategori"); ?>
                      <?php while ($data = $ambil->fetch_assoc()) { ?>
                        <li><a href="informasi.php?id=<?= $data['idkategori'] ?>"><?= $data['namakategori'] ?></a></li>
                      <?php } ?>
                    </ul>
                  </li>
                  <?php
                  if (isset($_SESSION["pengguna"])) { ?>
                    <?php
                    $id = $_SESSION["pengguna"]['id'];
                    $ambil = $koneksi->query("SELECT *FROM pengguna WHERE id='$id'");
                    $row = $ambil->fetch_assoc(); ?>
                    <li><a href="#">Akun</a>
                      <ul class="dropdown">
                        <li><a href="akun.php">Profil Akun</a></li>
                        <li><a href="postingriwayat.php">Riwayat Postingan Anda</a></li>
                        <li><a href="logout.php">Logout</a></li>
                      </ul>
                    </li>
                  <?php } else { ?>
                    <li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
                  <?php } ?>
                  <?php
                  if (!isset($_SESSION["pengguna"])) { ?>
                    <li><a href="#" data-toggle="modal" data-target="#daftar"> <span>Daftar</span></a></li>
                  <?php } ?>
                </ul>
              </div>
              <!-- Navbar End -->
            </div>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- modal -->
  <div class="modal fade modaldaftar" id="daftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 50px;border:3px solid transparant">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-">
          <div class="row align-items-end">
            <div class="col-md-12">
              <div class="mt-5 ml-5 mr-5 mb-3">
                <h3 class="mb-3 text-center text-warning">Silahkan Daftar</h3>
                <form method="post">
                  <div class="row">
                    <div class="col-6 col-md-12">
                      <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                      </div>
                    </div>
                    <div class="col-12 col-md-12">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan Email">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label>No. HP</label>
                        <input type="number" class="form-control" name="nohp" placeholder="Masukkan No.No. HP">
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" required cols="30" rows="3" placeholder="Alamat"></textarea>
                      </div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn alazea-btn mt-15 float-right" name="daftar">Daftar</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade modallogin" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" style="width:100% !important">
      <div class="modal-content" style="border-radius: 50px;border:3px solid transparant">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-">
          <div class="row">
            <div class="col-md-12">
              <div class="m-5">
                <h3 class="mb-3 text-center text-warning">Silahkan Login</h3>
                <form method="post" class="form" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="" class="form-control" placeholder="Email" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" value="" class="form-control" placeholder="Password" required>
                  </div>
                  <center>
                    <div class="form-group">
                      <button class="btn btn-outline-primary btn-sm" name="login" value="login" type="submit">Masuk</button>
                    </div>
                  </center>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  <?php
  if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = md5($_POST["password"]);
    $ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE email='$email' AND password='$password' limit 1");
    $akunyangcocok = $ambil->num_rows;
    if ($akunyangcocok == 1) {
      $akun = $ambil->fetch_assoc();
      if ($akun['level'] == "User") {
        $_SESSION["pengguna"] = $akun;
        echo "<script> alert('Login Berhasil');</script>";
        echo "<script> location ='index.php';</script>";
      } elseif ($akun['level'] == "Admin") {
        $_SESSION['admin'] = $akun;
        echo "<script> alert('Login Berhasil');</script>";
        echo "<script> location ='admin/index.php';</script>";
      }
    } else {
      echo "<script> alert('Email atau password salah');</script>";
    }
  }
  if (isset($_POST["daftar"])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5($_POST["password"]);
    $alamat = $_POST['alamat'];
    $nohp = $_POST['nohp'];
    $ambil = $koneksi->query("SELECT*FROM pengguna 
                WHERE email='$email'");
    $yangcocok = $ambil->num_rows;
    if ($yangcocok == 1) {
      echo "<script>alert('Pendaftaran Gagal, email sudah ada')</script>";
    } else {
      $koneksi->query("INSERT INTO pengguna	(nama, email,  password, alamat, nohp, fotoprofil, level)
                  VALUES('$nama','$email','$password','$alamat','$nohp','user.png','User')");
      echo "<script>alert('Pendaftaran Berhasil')</script>";
      echo "<script>location='index.php';</script>";
    }
  }
  ?>