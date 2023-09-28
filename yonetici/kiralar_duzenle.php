<?php
define("giriskontrol", true);
require_once 'header.php';

$veri   =   $db->prepare("SELECT * FROM kiralar WHERE kira_id={$_GET['kira_id']}");
$veri->execute();
$kiralar =   $veri->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['kira_duzenle'])) {
    $kira_id           = $_POST['kira_id'];
    $kira_tutarı       = $_POST['kira_tutar'];
    $kira_odenen_tutar = filtrele($_POST['kira_odenen_tutar']);
    $kira_kalan        = floatval($kira_tutarı) - floatval($kira_odenen_tutar);
    $kira_durum = $_POST['kira_durum'];

    if ($kira_kalan == 0) {
        $kira_durum = "Kiranız Ödendi.";
    } elseif ($kira_kalan != 0) {
        $kira_durum = "Kiranız Ödenmedi.";
    }
    if (empty($kira_tutarı) || empty($kira_odenen_tutar)) {
        echo "Lütfen ödenen kira tutarı bölümünü boş bırakmayınız.";
    } elseif (!is_numeric($kira_odenen_tutar)) {
        echo "Lütfen sayısal veriler giriniz.";
    } else {
        $guncelle = $db->prepare("UPDATE kiralar SET
        kira_tutar         =:kira_tutar,
        kira_odenen_tutar  =:kira_odenen_tutar,
        kira_kalan         =:kira_kalan, 
        kira_durum         =:kira_durum WHERE kira_id=:kira_id
        ");
        $guncelle->execute([
            'kira_id' => $kira_id,
            'kira_tutar'           => $kira_tutarı,
            'kira_odenen_tutar'    => $kira_odenen_tutar,
            'kira_kalan'           => $kira_kalan,
            'kira_durum'           => $kira_durum,
        ]);
        if ($guncelle) {
            header("location:kiralar.php");
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
                <h3 class="card-title">Kira Ödendi Sayfası</h3>
                <form method="post">
                    <input type="hidden" name="kira_id" value="<?= $kiralar['kira_id'] ?>">
                    <input type="hidden" name="kira_durum" value="<?= $kiralar['kira_durum'] ?>">
                    <div class="mb-3">
                        <label for="" class="form-label">Toplam Kira</label>
                        <input type="number" class="form-control" name="kira_tutar" value="<?= $kiralar['kira_tutar'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Ödenen Kira Tutarını Giriniz</label>
                        <input type="number" class="form-control" name="kira_odenen_tutar">
                    </div>
                    <button type="submit" name="kira_duzenle" class="btn btn-primary w-100">Güncelle</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>