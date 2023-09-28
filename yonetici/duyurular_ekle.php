<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM oturanlar");
$veri->execute();
$oturanlar = $veri->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['duyuru_gonder'])) {
    $oturan_tc              =   $_POST['oturan_tc'];
    $duyuru_baslik          =   filtrele($_POST['duyuru_baslik']);
    $duyuru_detay           =   filtrele($_POST['duyuru_detay']);

    if ($oturan_tc != 1) {
        $ekle = $db->prepare("INSERT INTO duyurular SET oturan_tc=?, duyuru_baslik=?, duyuru_detay=?");
        $ekle->execute([
            $oturan_tc,
            $duyuru_baslik,
            $duyuru_detay,
        ]);
    } elseif ($oturan_tc == 1) {
        foreach ($oturanlar as $key => $oturan) {
            $ekle = $db->prepare("INSERT INTO duyurular SET oturan_tc=?, duyuru_baslik=?, duyuru_detay=?");
            $ekle->execute([
                $oturan['oturan_tc'],
                $duyuru_baslik,
                $duyuru_detay,
            ]);
        }
    }

    if ($ekle) {
        header("location:duyurular.php");
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
                <h3 class="mb-5 text-center">Duyuru Ekle</h3>
                <form method="post">
                    <div class="mb-3">
                        <label for="" class="form-label">Duyuru Göndermek İstediğiniz Kişiyi Seçiniz</label>
                        <select class="form-control" name="oturan_tc" id="">
                            <option value="1">Ortak Duyuru Gönder</option>
                            <?php
                            foreach ($oturanlar as $key => $oturan) { ?>
                                <option value="<?= $oturan['oturan_tc'] ?>"><?= $oturan['oturan_isim'] . " " . $oturan['oturan_soyisim'] . " / " . $oturan['oturan_daire_adi'] . " - " . $oturan['oturan_daire_no'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Duyuru Başlığı</label>
                        <input type="text" class="form-control" name="duyuru_baslik">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duyuru Detayı</label>
                        <textarea class="form-control" name="duyuru_detay" id="editor" rows="4"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="duyuru_gonder">Duyuru Gönder</button>

                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>