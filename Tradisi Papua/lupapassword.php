<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('phpmailer/Exception.php');
include('phpmailer/PHPMailer.php');
include('phpmailer/SMTP.php');
?>
<?php
include 'koneksi.php';
?>
<?php include 'header.php'; ?>
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
        <h2>Lupa Password</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Lupa Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>


<section class="contact-area">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-6 col-lg-5">
                <div class="section-heading text-center">
                    <h2>Masukkan Email Anda</h2>
                </div>
                <div class="contact-form-area mb-100">
                    <form method="post">
                        <div class="form-group mb-3">
                            <label>Email *</label>
                            <input type="text" class="form-control p_input" placeholder="Email" name="email" required>
                        </div>
                        <center>
                            <button type="submit" name="resetsandi" value="resetsandi" class="btn oneMusic-btn mt-30 mb-4">Reset Password</button>
                        </center>
                    </form>
                    <center>
                        <a class="text-primary" href="login.php">Sudah punya akun ? silahkan login</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_POST["resetsandi"])) {
    $email = $_POST["email"];
    $ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE email='$email'");
    $akunyangcocok = $ambil->num_rows;
    if ($akunyangcocok >= 1) {
        $akun = $ambil->fetch_assoc();
        // kirimemail
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'imartiraha03@gmail.com';
        $mail->Password = 'yycqdzzqesydemrt';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('imartiraha03@gmail.com', 'PAPUA Good Guide');  //'Informasi PAPUA Good Guide'
        $mail->addAddress($email);
        $mail->addReplyTo('no-reply@gmail.com', 'Np-reply');
        $mail->isHTML(true);
        $mail->Subject = 'Ganti Password Akun PAPUA Good Guide - ' . $email;
        // $mail->Body    = "Silahkan ganti password anda";
        $mail->Body    = 'Silahkan klik link ini untuk mengganti password baru akun anda<br><br><a href="http://localhost/informasi/gantipassword.php?id=' . $akun['id'] . '" target="_blank" style="background-color: #1ba4e3;
        color: white;
        padding: 14px 25px;
        text-align: center;
        text-decoration: none;
        display: inline-block;">Ganti Password</a>';
        $mail->AltBody = '';
        if (!$mail->send()) {
            echo 'Gagal';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        // 
        echo "<script>alert('Link ganti password berhasil dikirim silahkan cek email anda untuk mengganti password');</script>";
        echo "<script>location='login.php';</script>";
    } else {
        echo "<script>alert('Email anda tidak terdaftar dalam sistem kami');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>
<?php
include 'footer.php';
?>