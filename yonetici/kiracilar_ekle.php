<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';


if (isset($_POST['kiraci_ekle'])) {
    $oturan_tc              =  filtrele($_POST['oturan_tc']);
    $oturan_isim            =  filtrele($_POST['oturan_isim']);
    $oturan_soyisim         =  filtrele($_POST['oturan_soyisim']);
    $oturan_telefon         =  filtrele($_POST['oturan_telefon']);
    $oturan_mail            =  filtrele($_POST['oturan_mail']);
    $oturan_sifre           =  filtrele(sha1(md5("gecicisifre")));
    $oturan_sifre_kisalt    =  mb_substr($oturan_sifre, 0, 32);
    $oturan_daire_adi       =  filtrele($_POST['oturan_daire_adi']);
    $oturan_daire_no        =  filtrele($_POST['oturan_daire_no']);
    $oturan_daire_adresi    =  filtrele($_POST['oturan_daire_adresi']);
    $oturan_durum           =  "Kiracı";

    $veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc=?");
    $veri->execute([$oturan_tc]);
    $veri->fetchAll(PDO::FETCH_ASSOC);

    if (empty($oturan_tc) || empty($oturan_isim) || empty($oturan_soyisim) || empty($oturan_telefon) || empty($oturan_mail) || empty($oturan_sifre) || empty($oturan_daire_adi) || empty($oturan_daire_no) || empty($oturan_daire_adresi)) {
        echo "Lütfen boş alan bırakmayınız..";
    } elseif (!is_numeric($oturan_tc) || strlen($oturan_tc) > 11) {
        echo "Lütfen geçerli bir TC Kimlik numarası ekleyiniz.";
    } elseif (!is_numeric($oturan_telefon) || strlen($oturan_telefon) > 11) {
        echo "Lütfen geçerli bir telefon numarası ekleyiniz.";
    } elseif (!filter_var($oturan_mail, FILTER_VALIDATE_EMAIL)) {
        echo "Lütfen geçerli bir Mail adresi ekleyiniz.";
    } elseif ($veri->rowCount()) {
        echo "Bu bilgilere ait bir kullanıcı bulunmaktadır.";
    } else {
        $oturan_kayit = $db->prepare("INSERT INTO oturanlar SET oturan_tc=?,oturan_isim=?,oturan_soyisim=?,oturan_telefon=?,oturan_mail=?,oturan_sifre=?,oturan_durum=?, oturan_daire_adi=?, oturan_daire_no=?, oturan_daire_adresi=?");
        $oturan_kayit->execute([
            $oturan_tc,
            $oturan_isim,
            $oturan_soyisim,
            $oturan_telefon,
            $oturan_mail,
            $oturan_sifre_kisalt,
            $oturan_durum,
            $oturan_daire_adi,
            $oturan_daire_no,
            $oturan_daire_adresi,
        ]);
        if ($oturan_kayit) {
            header("location:kiracilar.php");
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
                <h3 class="mb-5 text-center">Kiracı Detayı</h3>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Kiracı TC</label>
                        <input type="number" class="form-control" name="oturan_tc" required>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Adı: </label>
                            <input type="text" class="form-control" name="oturan_isim" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Soyadı: </label>
                            <input type="text" class="form-control" name="oturan_soyisim" required>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Telefonu</label>
                            <input type="number" class="form-control" name="oturan_telefon" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Maili</label>
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
                    <button type="submit" class="btn btn-primary btn-block" name="kiraci_ekle">Kiracı Ekle</button>

                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>