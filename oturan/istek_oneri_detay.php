<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri   =   $db->prepare("SELECT * FROM istek_oneri WHERE istek_id={$_GET['istek_id']}");
$veri->execute();
$istek_oneri =   $veri->fetch(PDO::FETCH_ASSOC);



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
                    <label for="" class="form-label">İstek ve Öneri Başlığı</label>
                    <input type="text" disabled class="form-control" value="<?= $istek_oneri['istek_baslik'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">İstek ve Öneri Detayı</label>
                    <textarea class="form-control" disabled rows="4"><?= $istek_oneri['istek_detay'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>