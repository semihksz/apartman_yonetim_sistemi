<?php
define("giriskontrol", true);
require_once 'header.php';

$veri   =   $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
$veri->execute();
$oturan =   $veri->fetch(PDO::FETCH_ASSOC);


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
                <div class="mb-3">
                    <label class="form-label">Kiracı TC</label>
                    <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_tc'] ?>">
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Kiracı Adı: </label>
                        <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_isim'] ?>">
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Kiracı Soyadı: </label>
                        <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_soyisim'] ?>">
                    </div>

                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Kiracı Telefonu</label>
                        <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_telefon'] ?>">
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Kiracı Maili</label>
                        <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_mail'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Apartman Adı</label>
                        <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_daire_adi'] ?>">
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Daire Numarası</label>
                        <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_daire_no'] ?>">
                    </div>
                </div>
                <div class="col mb-3">
                    <label class="form-label">Açık Ev Adresi</label>
                    <input type="text" class="form-control" name="" disabled value="<?= $oturan['oturan_daire_adresi'] ?>">
                </div>
                <a href="kiracilar_duzenle.php?oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-primary btn-block">Bilgileri Düzenle</a>
            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>