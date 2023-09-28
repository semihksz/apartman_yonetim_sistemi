<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri   =   $db->prepare("SELECT * FROM aidatlar WHERE aidat_id={$_GET['aidat_id']}");
$veri->execute();
$aidatlar =   $veri->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['aidat_duzenle'])) {
    $aidat_id          = $_POST['aidat_id'];
    $aidat_tutarı       = $_POST['aidat_tutar'];
    $aidat_odenen_tutar = filtrele($_POST['aidat_odenen_tutar']);
    $aidat_kalan        = floatval($_POST['aidat_tutar']) - floatval($_POST['aidat_odenen_tutar']);
    $aidat_durum = $_POST['aidat_durum'];


    if ($aidat_kalan == 0) {
        $aidat_durum = "Aidatınız Ödendi.";
    } elseif ($aidat_kalan != 0) {
        $aidat_durum = "Aidatınız Ödenmedi.";
    }
    if (empty($aidat_tutarı) || empty($aidat_odenen_tutar)) {
        echo "Lütfen ödenen aidat tutarı bölümünü boş bırakmayınız.";
    } elseif (!is_numeric($aidat_odenen_tutar)) {
        echo "Lütfen sayısal veriler giriniz.";
    } else {
        $guncelle = $db->prepare("UPDATE aidatlar SET
        aidat_tutar         =:aidat_tutar,
        aidat_odenen_tutar  =:aidat_odenen_tutar,
        aidat_kalan         =:aidat_kalan, 
        aidat_durum         =:aidat_durum WHERE aidat_id=:aidat_id
        ");
        $guncelle->execute([
            'aidat_id' => $aidat_id,
            'aidat_tutar'           => $aidat_tutarı,
            'aidat_odenen_tutar'    => $aidat_odenen_tutar,
            'aidat_kalan'           => $aidat_kalan,
            'aidat_durum'           => $aidat_durum,
        ]);
        if ($guncelle) {
            header("location:aidatlar.php");
        }
    }
}


?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-8 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="card-title">Aidat Ödendi Sayfası</h3>
                <form method="post">
                    <input type="hidden" name="aidat_id" value="<?= $aidatlar['aidat_id'] ?>">
                    <input type="hidden" name="aidat_durum" value="<?= $aidatlar['aidat_durum'] ?>">
                    <div class="mb-3">
                        <label for="" class="form-label">Toplam Aidat</label>
                        <input type="text" class="form-control" name="aidat_tutar" value="<?= $aidatlar['aidat_tutar'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Ödenen Aidat Tutarını Giriniz</label>
                        <input type="number" class="form-control" name="aidat_odenen_tutar">
                    </div>
                    <button type="submit" name="aidat_duzenle" class="btn btn-primary w-100">Güncelle</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>