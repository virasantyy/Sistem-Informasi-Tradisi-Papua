<footer class="footer-area bg-img" style="background-image: url(assets_home/img/bg-img/3.jpg);">
    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row">

                <!-- Single Footer Widget -->
                <div class="col-6 col-sm-6 col-lg-4">
                    <div class="single-footer-widget">
                        <div class="footer-logo mb-30">
                            <a href="#"><img src="img/core-img/logo.png" alt=""></a>
                        </div>
                        <p>PAPUA Good Guide merupakan website informasi informasi Sejarah Kota PAPUA</p>
                        <div class="social-info">
                            <a href="https://wa.me/6281344654648" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                            <a href="mailto:informasipapua@gmail.com" target="_blank"><i class="fa fa-envelope-open" aria-hidden="true"></i></a>
                            <a href="https://www.instagram.com/informasipapua/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Single Footer Widget -->

                <div class="col-12 col-sm-6 col-lg-4"></div>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-footer-widget">
                        <div class="widget-title">
                            <h5>Kontak</h5>
                        </div>

                        <div class="contact-information">

                            <p><span>No. HP:</span> 0813-4465-4648</p>
                            <p><span>Email:</span> informasipapua@gmail.com</p>
                            <p><span>Instagram:</span> informasipapua</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom Area -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="border-line"></div>
                </div>
                <!-- Copywrite Text -->
                <div class="col-12 col-md-6">
                    <div class="copywrite-text">
                        <p>Informasi Informasi Sejarah Kota PAPUA</p>
                        <p>&copy;
                            Dibuat Oleh : papuagoodguide&copy;
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery-2.2.4 js -->
<script src="assets_home/js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="assets_home/js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="assets_home/js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="assets_home/js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="assets_home/js/active.js"></script>
<script>
    $(document).ready(function() {
        //custom button for homepage
        $(".share-btn").click(function(e) {
            $('.networks-5').not($(this).next(".networks-5")).each(function() {
                $(this).removeClass("active");
            });

            $(this).next(".networks-5").toggleClass("active");
        });
    });
    feather.replace({
        'aria-hidden': 'true'
    });
    $(".togglePassword").click(function(e) {
        e.preventDefault();
        var type = $(this).parent().parent().find(".password").attr("type");
        console.log(type);
        if (type == "password") {
            // $("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
            $(this).parent().parent().find("svg.feather.feather-eye").replaceWith(feather.icons["eye-off"].toSvg());
            $(this).parent().parent().find(".password").attr("type", "text");
        } else if (type == "text") {
            // $("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
            $(this).parent().parent().find("svg.feather.feather-eye-off").replaceWith(feather.icons["eye"].toSvg());
            $(this).parent().parent().find(".password").attr("type", "password");
        }
    });
    $(function() {
        $(".modalloginbuka").on('click', function() {
            $('.modaldaftar').modal('hide');
            $('.modallogin').modal('show');
        });
    });
    $(function() {
        $(".modaldaftarbuka").on('click', function() {
            $('.modallogin').modal('hide');
            $('.modaldaftar').modal('show');
        });
    });
    var shareLinks = document.querySelectorAll('.share-link');

    shareLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            var url = this.getAttribute('data-url');

            var tempInput = document.createElement('input');
            tempInput.style = 'position: absolute; left: -1000px; top: -1000px';
            tempInput.value = url;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);

            alert('Tautan berhasil disalin');
        });
    });
</script>
</body>

</html>