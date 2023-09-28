<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri   =   $db->prepare("SELECT * FROM borclar WHERE borc_id={$_GET['borc_id']}");
$veri->execute();
$borclar =   $veri->fetch(PDO::FETCH_ASSOC);
//gelen borçtan ödenen borcu çıkardıktan sonra bulunan kalan borçtur
$odenen_borc = $borclar['borc_tutar'] - $borclar['borc_odenen_tutar'];



?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-8 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="card-title">İstek ve Öneri Sayfası</h3>
                <div class="mb-3">
                    <label for="" class="form-label">Toplam Borcunuz</label>
                    <input type="text" disabled class="form-control" value="<?= $borclar['borc_tutar'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Ödediğiniz Toplam Tutar</label>
                    <input class="form-control" disabled value="<?= $borclar['borc_odenen_tutar'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kalan Borcunuz</label>
                    <input class="form-control" disabled value="<?= $odenen_borc ?>">
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>