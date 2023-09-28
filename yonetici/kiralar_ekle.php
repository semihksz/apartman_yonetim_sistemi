<?php
define("giriskontrol", true);
require_once 'header.php';

$veri = $db->prepare("SELECT * FROM oturanlar");
$veri->execute();
$oturanlar = $veri->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['kira_ekle'])) {


    $kira_tutar = filtrele($_POST['kira_tutar']);
    $kira_durum = "Kiranız Ödenmedi.";
    $kira_odenen_tutar = "0";
    $kira_kalan = $kira_tutar;

    if (isset($_POST['oturan_sec']) && isset($_POST['tum_oturanlar'])) {
        echo "Tüm oturanları seçmek istiyorsanız işaretlenen bireysel kullanıcıların işaretlerini kaldırınız.";
    } elseif (empty($_POST['kira_tutar'])) {
        echo "Lütfen kira tutarı bölümünü boş bırakmayınız.";
    } elseif (!is_numeric($kira_tutar)) {
        echo "Lütfen kira bölümüne sayısal değerler giriniz.";
    } elseif (isset($_POST['oturan_sec'])) {
        $secilenler = $_POST['oturan_sec'];
        foreach ($secilenler as $secilen) {
            $ekle = $db->prepare("INSERT INTO kiralar SET oturan_tc=?, kira_tutar=?, kira_odenen_tutar=?, kira_kalan=?, kira_durum=?");
            $ekle->execute([
                $secilen,
                $kira_tutar,
                $kira_odenen_tutar,
                $kira_kalan,
                $kira_durum,
            ]);
        }
    } elseif (isset($_POST['tum_oturanlar'])) {
        $tum_secilenler = $_POST['tum_oturanlar'];
        foreach ($oturanlar as $secilen) {
            $ekle = $db->prepare("INSERT INTO kiralar SET oturan_tc=?, kira_tutar=?, kira_odenen_tutar=?, kira_kalan=?, kira_durum=?");
            $ekle->execute([
                $secilen['oturan_tc'],
                $kira_tutar,
                $kira_odenen_tutar,
                $kira_kalan,
                $kira_durum,
            ]);
        }
        if ($ekle) {
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
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="card-title">Kira Ekleme Sayfası</h3>
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
                            <label for="" class="form-label">Kira Ekle</label>
                            <input type="number" class="form-control" name="kira_tutar">
                        </div>
                    </div>



                    <button type="submit" name="kira_ekle" class="btn btn-primary w-100">kira Ekle</button>
                </form>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>