<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';
?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-12 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5">Aidatlar</h3>
                <div class="col-md-4">
                    <a href="aidatlar_ekle.php" class="btn btn-success mb-3" style="float: left;"><i class="fa-solid fa-plus"></i> Yeni Aidat Ekle</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>Aidat Tutarınız</th>
                                <th>Toplam Ödenen Aidat Tutarınız</th>
                                <th>Kalan Aidat Tutarınız</th>
                                <th>Aidat Durumu</th>
                                <th>Aidat Eklenme Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM aidatlar INNER JOIN oturanlar ON aidatlar.oturan_tc = oturanlar.oturan_tc ORDER BY aidat_id DESC");
                            $veri->execute();
                            $aidatlar =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($aidatlar as $key => $aidat) {
                            ?>
                                <tr>
                                    <td><?= $aidat["oturan_daire_adi"] ?></td>
                                    <td><?= $aidat["oturan_daire_no"] ?></td>
                                    <td><?= $aidat["aidat_tutar"] ?></td>
                                    <td><?= $aidat["aidat_odenen_tutar"] ?></td>
                                    <td><?= $aidat["aidat_kalan"] ?></td>
                                    <td><?php

                                        if ($aidat["aidat_durum"] == "Aidatınız Ödenmedi.") { ?>
                                            <p class="bg-danger text-white rounded"><?= $aidat["aidat_durum"] ?></p>
                                        <?php } elseif ($aidat["aidat_durum"] == "Aidatınız Ödendi.") { ?>
                                            <p class="bg-success text-white rounded"><?= $aidat["aidat_durum"] ?></p>

                                        <?php }

                                        $aidat["aidat_durum"] ?>
                                    </td>
                                    <td><?= tarihdegistirme($aidat["aidat_tarih"]) ?></td>
                                    <td>
                                        <a href="aidatlar_detay.php?aidat_id=<?= $aidat['aidat_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                        <a href="aidatlar_duzenle.php?aidat_id=<?= $aidat['aidat_id'] ?>" class="btn btn-success" title="Düzenle"><i class="fa-solid fa-edit"></i></a>
                                    </td>
                                </tr>
                            <?php }

                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>