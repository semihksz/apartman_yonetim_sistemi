<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM oturanlar");
$veri->execute();
$oturanlar = $veri->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['aidat_ekle'])) {


    $aidat_tutar = filtrele($_POST['aidat_tutar']);
    $aidat_durum = "Aidatınız Ödenmedi.";
    $aidat_odenen_tutar = "0";
    $aidat_kalan = $aidat_tutar;

    if (isset($_POST['oturan_sec']) && isset($_POST['tum_oturanlar'])) {
        echo "Tüm oturanları seçmek istiyorsanız işaretlenen bireysel kullanıcıların işaretlerini kaldırınız.";
    } elseif (empty($_POST['aidat_tutar'])) {
        echo "Lütfen aidat bölümünü boş bırakmayınız.";
    } elseif (!is_numeric($aidat_tutar)) {
        echo "Lütfen aidat bölümüne sayısal değerler giriniz.";
    } elseif (isset($_POST['oturan_sec'])) {
        $secilenler = $_POST['oturan_sec'];
        foreach ($secilenler as $secilen) {
            $ekle = $db->prepare("INSERT INTO aidatlar SET oturan_tc=?, aidat_tutar=?, aidat_odenen_tutar=?, aidat_kalan=?, aidat_durum=?");
            $ekle->execute([
                $secilen,
                $aidat_tutar,
                $aidat_odenen_tutar,
                $aidat_kalan,
                $aidat_durum,
            ]);
        }
    } elseif (isset($_POST['tum_oturanlar'])) {
        $tum_secilenler = $_POST['tum_oturanlar'];
        foreach ($oturanlar as $secilen) {
            $ekle = $db->prepare("INSERT INTO aidatlar SET oturan_tc=?, aidat_tutar=?, aidat_odenen_tutar=?, aidat_kalan=?, aidat_durum=?");
            $ekle->execute([
                $secilen['oturan_tc'],
                $aidat_tutar,
                $aidat_odenen_tutar,
                $aidat_kalan,
                $aidat_durum,
            ]);
        }
    }
}


?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="card-title">Aidat Ekleme Sayfası</h3>
                <form method="post">

                    <div class="mb-3">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablo">
                                <thead>
                                    <tr>
                                        <th>Adı Soyadı</th>
                                        <th>Daire Adı</th>
                                        <th>Daire No</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    foreach ($oturanlar as $key => $oturan) { ?>
                                        <tr>
                                            <td><?= $oturan["oturan_isim"] . " " . $oturan["oturan_soyisim"] ?></td>
                                            <td><?= $oturan['oturan_daire_adi'] ?></td>
                                            <td><?= $oturan['oturan_daire_no'] ?></td>
                                            <td>
                                                <input type="checkbox" class="form-check-input" name="oturan_sec[]" value="<?= $oturan['oturan_tc'] ?>">
                                            </td>
                                        </tr>
                                    <?php  }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" name="oturan_tc" value="<?= $oturan['oturan_tc'] ?>">
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Bütün Oturanları Seç</label>
                            <input type="checkbox" class="form-control" name="tum_oturanlar[]" value="<?= $oturan['oturan_tc'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label for="" class="form-label">Aidat Ekle</label>
                            <input type="number" class="form-control" name="aidat_tutar">
                        </div>
                    </div>



                    <button type="submit" name="aidat_ekle" class="btn btn-primary w-100">Aidat Ekle</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>