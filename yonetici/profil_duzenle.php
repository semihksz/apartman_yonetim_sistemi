<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM yoneticiler WHERE yonetici_id={$_GET['yonetici_id']}");
$veri->execute();
$yonetici = $veri->fetch(PDO::FETCH_ASSOC);

if ($_SESSION['yonetici_id'] != $_GET['yonetici_id']) {
    header("location:profil.php");
}


if (isset($_POST['bilgileriguncelle'])) {


    //Kullanıcının genel bilgilerini güncelleme
    $yonetici_isim        =   filtrele($_POST['yonetici_isim']);
    $yonetici_soyisim     =   filtrele($_POST['yonetici_soyisim']);
    $yonetici_tc          =   filtrele($_POST['yonetici_tc']);
    $yonetici_telefon     =   filtrele($_POST['yonetici_telefon']);
    $yonetici_mail        =   filtrele($_POST['yonetici_mail']);
    $yonetici_id          =   filtrele($_POST['yonetici_id']);
    $sifre                =   filtrele(sha1(md5($_POST['yonetici_sifre'])));
    $yonetici_sifre       =   mb_substr($sifre, 0, 32);

    $guncelle = $db->prepare("UPDATE yoneticiler SET
    yonetici_isim         =:yonetici_isim,
    yonetici_soyisim      =:yonetici_soyisim,
    yonetici_tc           =:yonetici_tc,
    yonetici_telefon      =:yonetici_telefon,
    yonetici_mail         =:yonetici_mail WHERE yonetici_id=:yonetici_id
    ");

    $guncelle->execute([
        'yonetici_id'           =>    $yonetici_id,
        'yonetici_isim'         =>    $yonetici_isim,
        'yonetici_soyisim'      =>    $yonetici_soyisim,
        'yonetici_tc'           =>    $yonetici_tc,
        'yonetici_telefon'      =>    $yonetici_telefon,
        'yonetici_mail'         =>    $yonetici_mail,

    ]);

    //kullanıcının şifresini değiştirme(şifre girmediğinde eski şifresi aynı kalacak)
    if ($_POST['yonetici_sifre'] == "") {
    } else {
        $guncelle  = $db->prepare("UPDATE yoneticiler SET
        yonetici_sifre         =:yonetici_sifre WHERE yonetici_id=:yonetici_id
    ");
        $guncelle->execute([
            'yonetici_id'           =>    $_POST['yonetici_id'],
            'yonetici_sifre'         =>    $yonetici_sifre,
        ]);
    }

    //kullanıcının resmini değiştirme
    if ($_FILES['yonetici_resim']['error'] == 0) {
        $izinli_uzanti  =   ['jpg', 'jpeg', 'png', 'svg'];
        $dosya_uzantisi =   pathinfo($_FILES['yonetici_resim']['name'], PATHINFO_EXTENSION);
        $izinli_boyut   =   2 * 1024 * 1024;

        if (!in_array($dosya_uzantisi, $izinli_uzanti)) {
            echo "Hata: Dosya uzantısı izin verilenlerden farklı.";
            header("refresh:2");
            exit;
        } elseif ($_FILES['yonetici_resim']['size'] > $izinli_boyut) {
            header("refresh:2");
            echo "Hata: Dosya boyutu izin verilenden yüksek.";
            exit;
        } else {
            $gecici_isim    =   $_FILES['yonetici_resim']['tmp_name'];
            $resim_isim     =   $_FILES['yonetici_resim']['name'];
            $rastgele_sayi  =   rand(1000, 9999);
            $isim           =   $rastgele_sayi . $resim_isim;

            move_uploaded_file($gecici_isim, "../img/yoneticiler/$isim");

            $guncelle =   $db->prepare("UPDATE yoneticiler SET
                yonetici_resim =:yonetici_resim WHERE yonetici_id=:yonetici_id
            ");
            $guncelle->execute([
                'yonetici_id'           =>    $_POST['yonetici_id'],
                'yonetici_resim' => $isim,
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
                    <img class="rounded-circle shadow mx-auto" style="border:3px solid black; max-width: 300px;" src="../img/yoneticiler/<?= $yonetici['yonetici_resim'] ?>" alt="yonetici_profil_resmi">
                    <div class="mb-3">
                        <label for="" class="form-label float-left">Resim Yükle</label>
                        <input type="file" class="form-control" name="yonetici_resim">
                    </div>

                    <div class="card-body text-left">
                        <div class="row">
                            <input class="form-control" type="hidden" value="<?= $_GET['yonetici_id']; ?> " name="yonetici_id">
                            <p class="card-text">Adı: <input class="form-control" name="yonetici_isim" type="text" value="<?= $yonetici['yonetici_isim']; ?>"></p>
                            <p class="ml-3 card-text">Soyadı: <input class="form-control" name="yonetici_soyisim" type="text" value="<?= $yonetici['yonetici_soyisim']; ?>"></p>
                        </div>
                        <p class="card-text">TC Kimlik Numarası: <input class="form-control" name="yonetici_tc" type="text" value="<?= $yonetici['yonetici_tc']; ?>"></p>
                        <p class="card-text">Telefon Numarası: <input class="form-control" name="yonetici_telefon" type="text" value="<?= $yonetici['yonetici_telefon']; ?>"></p>
                        <p class="card-text">E-Mail: <input class="form-control" name="yonetici_mail" type="text" value="<?= $yonetici['yonetici_mail']; ?>"></p>
                        <p class="card-text">Yeni Şifrenizi Giriniz: <input class="form-control" name="yonetici_sifre" type="text"><small>Not: Hiçbir şey girmezseniz şifreniz değişmez, aynı kalır.</small></p>

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