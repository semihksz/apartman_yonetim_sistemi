<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';



$veri   =   $db->prepare("SELECT * FROM sikayetler WHERE sikayet_id={$_GET['sikayet_id']}");
$veri->execute();
$sikayetler =   $veri->fetch(PDO::FETCH_ASSOC);



?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-8 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="card-title">Şikayet Sayfası</h3>
                <div class="mb-3">
                    <label for="" class="form-label">Şikayet Başlığı</label>
                    <input type="text" disabled class="form-control" value="<?= $sikayetler['sikayet_baslik'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Şikayet Detayı</label>
                    <textarea class="form-control" disabled rows="4"><?= $sikayetler['sikayet_detay'] ?></textarea>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>