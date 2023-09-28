<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

if (isset($_POST['ev_sahibi_ekle'])) {

    $oturan_tc           =   filtrele($_POST['oturan_tc']);
    $oturan_isim         =   filtrele($_POST['oturan_isim']);
    $oturan_soyisim      =   filtrele($_POST['oturan_soyisim']);
    $oturan_telefon      =   filtrele($_POST['oturan_telefon']);
    $oturan_mail         =   filtrele($_POST['oturan_mail']);
    $oturan_sifre        =   sha1(md5(filtrele('gecicisifre')));
    $oturan_sifreli      =   mb_substr($oturan_sifre, 0, 32);
    $oturan_daire_adi    =   filtrele($_POST['oturan_daire_adi']);
    $oturan_daire_no     =   filtrele($_POST['oturan_daire_no']);
    $oturan_daire_adresi =   filtrele($_POST['oturan_daire_adresi']);
    $oturan_durum        =   "Ev Sahibi";

    $veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc=?");
    $veri->execute([$oturan_tc]);
    $veri->fetchAll(PDO::FETCH_ASSOC);

    if (empty($oturan_tc) || empty($oturan_isim) || empty($oturan_soyisim) || empty($oturan_telefon)) {
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
    } elseif (!is_numeric($oturan_tc) || strlen($oturan_tc) > 11) {
        echo '<div class="col-lg-10 mx-auto">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <b>TC Sayısal Değer Olmak ve 11 Karakterden Az Olmak Zorundadır!</b>
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
    } elseif ($veri->rowCount()) {
        echo '<div class="col-lg-10 mx-auto">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <b>Bu Bilgilere Ait Bir Ev Sahibi Bulunmaktadır!</b>
                    </div>
                </div>
            </div>';
    } else {
        $oturan_ekle = $db->prepare("INSERT INTO oturanlar SET oturan_tc=?, oturan_isim=?, oturan_soyisim=?, oturan_telefon=?, oturan_mail=?, oturan_sifre=?, oturan_daire_adi=?, oturan_daire_no=?, oturan_daire_adresi=?, oturan_durum=?");
        $oturan_ekle->execute([
            $oturan_tc,
            $oturan_isim,
            $oturan_soyisim,
            $oturan_telefon,
            $oturan_mail,
            $oturan_sifreli,
            $oturan_daire_adi,
            $oturan_daire_no,
            $oturan_daire_adresi,
            $oturan_durum,
        ]);

        if ($oturan_ekle) {
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
                <h3 class="mb-5 text-center">Ev Sahibi Detayı</h3>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Ev Sahibi TC</label>
                        <input type="number" class="form-control" name="oturan_tc" required>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Adı: </label>
                            <input type="text" class="form-control" name="oturan_isim" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Soyadı: </label>
                            <input type="text" class="form-control" name="oturan_soyisim" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Telefonu</label>
                            <input type="number" class="form-control" name="oturan_telefon" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Maili</label>
                            <input type="email" class="form-control" name="oturan_mail" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Apartman Adı</label>
                            <input type="text" class="form-control" name="oturan_daire_adi" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Daire Numarası</label>
                            <input type="text" class="form-control" name="oturan_daire_no" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Açık Ev Adresi</label>
                        <input type="text" class="form-control" name="oturan_daire_adresi" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="ev_sahibi_ekle">Ev Sahibi Ekle</button>

                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>