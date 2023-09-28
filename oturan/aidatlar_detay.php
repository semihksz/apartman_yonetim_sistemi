<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri   =   $db->prepare("SELECT * FROM aidatlar WHERE aidat_id={$_GET['aidat_id']}");
$veri->execute();
$aidatlar =   $veri->fetch(PDO::FETCH_ASSOC);
//gelen borçtan ödenen borcu çıkardıktan sonra bulunan kalan borçtur
$odenen_aidat = $aidatlar['aidat_tutar'] - $aidatlar['aidat_odenen_tutar'];



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
                    <label for="" class="form-label">Toplam Aidatınız</label>
                    <input type="text" disabled class="form-control" value="<?= $aidatlar['aidat_tutar'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Ödediğiniz Toplam Tutar</label>
                    <input class="form-control" disabled value="<?= $aidatlar['aidat_odenen_tutar'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kalan Aidatınız</label>
                    <input class="form-control" disabled value="<?= $odenen_aidat ?>">
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>