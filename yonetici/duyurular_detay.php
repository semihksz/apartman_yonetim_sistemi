<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';
// tek sorgu ile tabloları birleştirip verileri getirdim
$veri = $db->prepare("SELECT * FROM oturanlar INNER JOIN duyurular ON oturanlar.oturan_tc = duyurular.oturan_tc WHERE duyuru_id={$_GET['duyuru_id']}");
$veri->execute();
$oturan = $veri->fetch(PDO::FETCH_ASSOC);

?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row">
        <!-- İçerik Sütunu -->
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5 text-center">Duyuru Ekle</h3>
                <form method="post">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Daire Adı</label>
                            <input type="text" disabled class="form-control" value="<?= $oturan['oturan_daire_adi'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Daire No</label>
                            <input type="text" disabled class="form-control" value="<?= $oturan['oturan_daire_no'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Açık Ev Adresi</label>
                        <input type="text" disabled class="form-control" value="<?= $oturan['oturan_daire_adresi'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duyuru Başlığı</label>
                        <input type="text" disabled class="form-control" value="<?= $oturan['duyuru_baslik'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duyuru Detayı</label>
                        <textarea class="form-control" rows="4"><?= $oturan['duyuru_detay'] ?></textarea>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>