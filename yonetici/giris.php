<?php
require_once '../islemler/baglanti.php';
if (isset($_POST['giris'])) {

    $tc         =   htmlspecialchars(strip_tags(trim($_POST['tc'])));
    $sifrele    =   strip_tags(trim(sha1(md5($_POST['sifre']))));
    $sifre      =   mb_substr($sifrele, 0, 32);

    if (empty($_POST['tc'])) {
        echo "Lütfen TC Kimlik Numaranızı Giriniz.";
    } elseif (strlen($tc) > 11) {
        echo "Lütfen TC Kimlik Numaranızı Düzgün Giriniz.";
    } elseif (empty($sifre)) {
        echo "Lütfen Şifrenizi Giriniz.";
    } else {
        $veri = $db->prepare("SELECT * FROM yoneticiler WHERE yonetici_tc=? and yonetici_sifre=?");
        $veri->execute([$tc, $sifre]);
        $giris = $veri->fetch(PDO::FETCH_ASSOC);
        $giriskontrol = $veri->rowCount();
        if ($giriskontrol > 0) {
            foreach ($giris as $key => $value) {
                $_SESSION[$key] = $value;
            }
            header("location:index.php");
        } else {
            echo "Giriş Bilgileri Hatalı";
        }
    }
}


if (isset($_SESSION['yonetici_tc']) && isset($_SESSION['yonetici_sifre'])) {
    header("location:index.php");
} else { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $site['site_baslik']; ?></title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    </head>

    <body class="bg-primary" style="background-image: url(../img/apartman4.png);">

        <div class="container">

            <!-- Outer Row -->
            <div class="row justify-content-center">

                <div class="col-xl-6 col-lg-12 col-md-9">

                    <div class="card o-hidden border-0 shadow-lg mt-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="col-lg-12 p-5">
                                <div class="text-center">
                                    <h1 class="text-gray-900 mb-4">Apartman Yönetim Sistemine Hoşgeldiniz </h1>
                                </div>
                                <form class="user" method="POST">
                                    <div class="form-group">
                                        <input type="text" name="tc" class="form-control form-control-user" id="exampleInputEmail" placeholder="Tc Kimlik Numaranızı Giriniz." value="<?= isset($_POST['tc']) ? $_POST['tc'] : null; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="sifre" class="form-control form-control-user" id="exampleInputPassword" placeholder="Şifrenizi Giriniz.">
                                    </div>
                                    <button type="submit" name="giris" class="btn btn-primary btn-user btn-block">
                                        Giriş Yap
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="large" href="forgot-password.html">Şifremi Unuttum</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

    </body>

    </html>
<?php }


?>