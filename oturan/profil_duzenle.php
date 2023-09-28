<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_id={$_GET['oturan_id']}");
$veri->execute();
$oturanlar = $veri->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['oturan_id'] != $_GET['oturan_id']) {
    header("location:profil.php");
}


if (isset($_POST['bilgileriguncelle'])) {


    //Kullanıcının genel bilgilerini güncelleme
    $oturan_isim        =   htmlspecialchars(strip_tags(trim($_POST['oturan_isim'])));
    $oturan_soyisim     =   htmlspecialchars(strip_tags(trim($_POST['oturan_soyisim'])));
    $oturan_tc          =   htmlspecialchars(strip_tags(trim($_POST['oturan_tc'])));
    $oturan_telefon     =   htmlspecialchars(strip_tags(trim($_POST['oturan_telefon'])));
    $oturan_mail        =   htmlspecialchars(strip_tags(trim($_POST['oturan_mail'])));
    $oturan_id          =   htmlspecialchars(strip_tags(trim($_POST['oturan_id'])));
    $sifre              =   htmlspecialchars(strip_tags(trim(sha1(md5($_POST['oturan_sifre'])))));
    $oturan_sifre       =   mb_substr($sifre, 0, 32);

    $guncelle = $db->prepare("UPDATE oturanlar SET
    oturan_isim         =:oturan_isim,
    oturan_soyisim      =:oturan_soyisim,
    oturan_tc           =:oturan_tc,
    oturan_telefon      =:oturan_telefon,
    oturan_mail         =:oturan_mail WHERE oturan_id=:oturan_id
    ");

    $guncelle->execute([
        'oturan_id'           =>    $oturan_id,
        'oturan_isim'         =>    $oturan_isim,
        'oturan_soyisim'      =>    $oturan_soyisim,
        'oturan_tc'           =>    $oturan_tc,
        'oturan_telefon'      =>    $oturan_telefon,
        'oturan_mail'         =>    $oturan_mail,

    ]);

    //kullanıcının şifresini değiştirme(şifre girmediğinde eski şifresi aynı kalacak)
    if ($_POST['oturan_sifre'] == "") {
    } else {
        $guncelle  = $db->prepare("UPDATE oturanlar SET
        oturan_sifre         =:oturan_sifre WHERE oturan_id=:oturan_id
    ");
        $guncelle->execute([
            'oturan_id'           =>    $_POST['oturan_id'],
            'oturan_sifre'         =>    $oturan_sifre,
        ]);
    }

    //kullanıcının resmini değiştirme
    if ($_FILES['oturan_resim']['error'] == 0) {
        $izinli_uzanti  =   ['jpg', 'jpeg', 'png', 'svg'];
        $dosya_uzantisi =   pathinfo($_FILES['oturan_resim']['name'], PATHINFO_EXTENSION);
        $izinli_boyut   =   2 * 1024 * 1024;

        if (!in_array($dosya_uzantisi, $izinli_uzanti)) {
            echo "Hata: Dosya uzantısı izin verilenlerden farklı.";
            header("refresh:2");
            exit;
        } elseif ($_FILES['oturan_resim']['size'] > $izinli_boyut) {
            header("refresh:2");
            echo "Hata: Dosya boyutu izin verilenden yüksek.";
            exit;
        } else {
            $gecici_isim    =   $_FILES['oturan_resim']['tmp_name'];
            $resim_isim     =   $_FILES['oturan_resim']['name'];
            $rastgele_sayi  =   rand(1000, 9999);
            $isim           =   $rastgele_sayi . $resim_isim;

            move_uploaded_file($gecici_isim, "../img/$isim");

            $guncelle =   $db->prepare("UPDATE oturanlar SET
                oturan_resim =:oturan_resim WHERE oturan_id=:oturan_id
            ");
            $guncelle->execute([
                'oturan_id'           =>    $_POST['oturan_id'],
                'oturan_resim' => $isim,
            ]);
        }
    }

    //işlemler başarılı bir şekilde yapıldığında gerçekleşen işlemler
    if ($guncelle) {
        header("location:profil.php?guncelleme=basarili");
    } else {
        header("location:profil.php?guncelleme=basarisiz");
    }
}



?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-8 mb-4 p-3 mx-auto">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="card p-5 shadow-lg">
                    <img class="rounded-circle shadow mx-auto" style="border:3px solid black; max-width: 300px;" src="../img/<?= $oturanlar['oturan_resim'] ?>" alt="oturan_profil_resmi">
                    <div class="mb-3">
                        <label for="" class="form-label float-left">Resim Yükle</label>
                        <input type="file" class="form-control" name="oturan_resim">
                    </div>

                    <div class="card-body text-left">
                        <div class="row">
                            <input class="form-control" type="hidden" value="<?= $_GET['oturan_id']; ?> " name="oturan_id">
                            <p class="card-text">Adı: <input class="form-control" name="oturan_isim" type="text" value="<?= $oturanlar['oturan_isim']; ?>"></p>
                            <p class="ml-3 card-text">Soyadı: <input class="form-control" name="oturan_soyisim" type="text" value="<?= $oturanlar['oturan_soyisim']; ?>"></p>
                        </div>
                        <p class="card-text">TC Kimlik Numarası: <input class="form-control" name="oturan_tc" type="text" value="<?= $oturanlar['oturan_tc']; ?>"></p>
                        <p class="card-text">Telefon Numarası: <input class="form-control" name="oturan_telefon" type="text" value="<?= $oturanlar['oturan_telefon']; ?>"></p>
                        <p class="card-text">E-Mail: <input class="form-control" name="oturan_mail" type="text" value="<?= $oturanlar['oturan_mail']; ?>"></p>
                        <p class="card-text">Yeni Şifrenizi Giriniz: <input class="form-control" name="oturan_sifre" type="text"><small>Not: Hiçbir şey girmezseniz şifreniz değişmez, aynı kalır.</small></p>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-block" name="bilgileriguncelle">Bilgileri Güncelle</button>
                    </div>
                </div>
            </form>


        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>