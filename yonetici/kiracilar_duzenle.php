<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
$veri->execute();
$oturan = $veri->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['kiraci_guncelle'])) {
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

    if (!is_numeric($oturan_tc) || strlen($oturan_tc) > 11) {
        echo "Lütfen geçerli bir TC Kimlik numarası giriniz.";
    } elseif (!is_numeric($oturan_telefon) || strlen($oturan_telefon) > 11) {
        echo "Lütfen geçerli bir Telefon numarası giriniz.";
    } elseif (!filter_var($oturan_mail, FILTER_VALIDATE_EMAIL)) {
        echo "Lütfen geçerli bir Email adresi giriniz.";
    } else {
        $guncelle = $db->prepare("UPDATE oturanlar SET
        oturan_isim             =:oturan_isim,
        oturan_soyisim          =:oturan_soyisim,
        oturan_telefon          =:oturan_telefon,
        oturan_mail             =:oturan_mail, 
        oturan_daire_adi        =:oturan_daire_adi, 
        oturan_daire_no         =:oturan_daire_no, 
        oturan_daire_adresi     =:oturan_daire_adresi WHERE oturan_tc=:oturan_tc
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
            header("location:kiracilar.php");
        } else {
            echo "Güncellenirken bir hata oluştu.";
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
                <img src="../img/<?= $oturan['oturan_resim'] ?>" class="rounded-circle shadow mx-auto" style="border:3px solid black; max-width: 300px;" alt="">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Kiracı TC</label>
                        <input type="number" class="form-control" name="oturan_tc" value="<?= $oturan['oturan_tc'] ?>">
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Adı: </label>
                            <input type="text" class="form-control" name="oturan_isim" value="<?= $oturan['oturan_isim'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Soyadı: </label>
                            <input type="text" class="form-control" name="oturan_soyisim" value="<?= $oturan['oturan_soyisim'] ?>">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Telefonu</label>
                            <input type="number" class="form-control" name="oturan_telefon" value="<?= $oturan['oturan_telefon'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Kiracı Maili</label>
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
                    <div class="col mb-3">
                        <label class="form-label">Açık Ev Adresi</label>
                        <input type="text" class="form-control" name="oturan_daire_adresi" value="<?= $oturan['oturan_daire_adresi'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="kiraci_guncelle">Kiracıyı Güncelle</button>

                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>