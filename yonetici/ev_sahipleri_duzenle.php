<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$ev_sahibi_veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
$ev_sahibi_veri->execute();
$oturan = $ev_sahibi_veri->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['ev_sahibi_duzenle'])) {

    $oturan_tc              =   filtrele($_GET['oturan_tc']);
    $oturan_isim            =   filtrele($_POST['oturan_isim']);
    $oturan_soyisim         =   filtrele($_POST['oturan_soyisim']);
    $oturan_telefon         =   filtrele($_POST['oturan_telefon']);
    $oturan_mail            =   filtrele($_POST['oturan_mail']);
    $oturan_daire_adi       =   filtrele($_POST['oturan_daire_adi']);
    $oturan_daire_no        =   filtrele($_POST['oturan_daire_no']);
    $oturan_daire_adresi    =   filtrele($_POST['oturan_daire_adresi']);



    if (empty($oturan_isim) || empty($oturan_soyisim) || empty($oturan_telefon)) {
        echo '<div class="col-lg-10 mx-auto">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <b>Lütfen Boş Alan Bırakmayınız!</b>
                    </div>
                </div>
            </div>';
    } elseif (empty($oturan_mail) || empty($oturan_daire_adi) || empty($oturan_daire_no) || empty($oturan_daire_adresi)) {
        echo '<div class="col-lg-10 mx-auto">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <b>Lütfen Boş Alan Bırakmayınız!</b>
                    </div>
                </div>
            </div>';
    } elseif (!filter_var($oturan_mail, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="col-lg-10 mx-auto">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <b>Lütfen Geçerli Bir Mail Adresi Ekleyiniz!</b>
                    </div>
                </div>
            </div>';
    } elseif (!is_numeric($oturan_telefon) || strlen($oturan_telefon) > 11) {
        echo '<div class="col-lg-10 mx-auto">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <b>Telefon Numarası Sayısal Değer Olmak ve 11 Karakterden Az Olmak Zorundadır!</b>
                    </div>
                </div>
            </div>';
    } else {

        $guncelle = $db->prepare("UPDATE oturanlar SET
        oturan_isim         =:oturan_isim,
        oturan_soyisim      =:oturan_soyisim,
        oturan_telefon      =:oturan_telefon,
        oturan_mail         =:oturan_mail,
        oturan_daire_adi    =:oturan_daire_adi,
        oturan_daire_no     =:oturan_daire_no,
        oturan_daire_adresi =:oturan_daire_adresi WHERE oturan_tc =:oturan_tc
        ");
        $guncelle->execute([
            'oturan_tc'             => $oturan_tc,
            'oturan_isim'           => $oturan_isim,
            'oturan_soyisim'        => $oturan_soyisim,
            'oturan_telefon'        => $oturan_telefon,
            'oturan_mail'           => $oturan_mail,
            'oturan_daire_adi'      => $oturan_daire_adi,
            'oturan_daire_no'       => $oturan_daire_no,
            'oturan_daire_adresi'   => $oturan_daire_adresi,
        ]);

        if ($guncelle) {
            header("location:ev_sahipleri.php");
        }
    }
}



?>


<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row">
        <!-- İçerik Sütunu -->
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5 text-center">Ev Sahibi Düzenle</h3>

                <img src="../img/" class="rounded-circle shadow mx-auto" style="border:3px solid black; max-width: 300px;" alt="Ev Sahibi Resmi">

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Ev Sahibi TC</label>
                        <input type="number" class="form-control" disabled name="oturan_tc" value="<?= $oturan['oturan_tc'] ?>">
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Adı: </label>
                            <input type="text" class="form-control" name="oturan_isim" value="<?= $oturan['oturan_isim'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Soyadı: </label>
                            <input type="text" class="form-control" name="oturan_soyisim" value="<?= $oturan['oturan_soyisim'] ?>">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Telefonu</label>
                            <input type="number" class="form-control" name="oturan_telefon" value="<?= $oturan['oturan_telefon'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Maili</label>
                            <input type="email" class="form-control" name="oturan_mail" value="<?= $oturan['oturan_mail'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Apartman Adı</label>
                            <input type="text" class="form-control" name="oturan_daire_adi" value="<?= $oturan['oturan_daire_adi'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Daire Numarası</label>
                            <input type="text" class="form-control" name="oturan_daire_no" value="<?= $oturan['oturan_daire_no'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Açık Ev Adresi</label>
                        <input type="text" class="form-control" name="oturan_daire_adresi" value="<?= $oturan['oturan_daire_adresi'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="ev_sahibi_duzenle">Ev Sahibi Bilgilerini Düzenle</button>

                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>