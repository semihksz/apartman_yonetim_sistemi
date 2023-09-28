<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri   =   $db->prepare("SELECT * FROM kiralar WHERE kira_id={$_GET['kira_id']}");
$veri->execute();
$kiralar =   $veri->fetch(PDO::FETCH_ASSOC);
//gelen borçtan ödenen borcu çıkardıktan sonra bulunan kalan borçtur
$odenen_kira = $kiralar['kira_tutar'] - $kiralar['kira_odenen_tutar'];



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
                    <label for="" class="form-label">Toplam Kiranız</label>
                    <input type="text" disabled class="form-control" value="<?= $kiralar['kira_tutar'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Ödediğiniz Toplam Tutar</label>
                    <input class="form-control" disabled value="<?= $kiralar['kira_odenen_tutar'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Kalan kiranız</label>
                    <input class="form-control" disabled value="<?= $odenen_kira ?>">
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>