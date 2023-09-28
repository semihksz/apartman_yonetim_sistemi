<?php
define("giriskontrol", true);
require_once 'header.php';
?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-12 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5">Kiralar</h3>
                <div class="col-md-4">
                    <a href="kiralar_ekle.php" class="btn btn-success mb-3" style="float: left;"><i class="fa-solid fa-plus"></i> Yeni Kira Ekle</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>Kira Tutarınız</th>
                                <th>Toplam Ödenen Kira Tutarınız</th>
                                <th>Kalan Kira Tutarınız</th>
                                <th>Kira Durumu</th>
                                <th>Kira Eklenme Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM kiralar INNER JOIN oturanlar ON kiralar.oturan_tc = oturanlar.oturan_tc ORDER BY kira_id DESC");
                            $veri->execute();
                            $kiralar =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($kiralar as $key => $kira) {
                            ?>
                                <tr>
                                    <td><?= $kira["oturan_daire_adi"] ?></td>
                                    <td><?= $kira["oturan_daire_no"] ?></td>
                                    <td><?= $kira["kira_tutar"] ?></td>
                                    <td><?= $kira["kira_odenen_tutar"] ?></td>
                                    <td><?= $kira["kira_kalan"] ?></td>
                                    <td><?php

                                        if ($kira["kira_durum"] == "Kiranız Ödenmedi.") { ?>
                                            <p class="bg-danger text-white rounded"><?= $kira["kira_durum"] ?></p>
                                        <?php } elseif ($kira["kira_durum"] == "Kiranız Ödendi.") { ?>
                                            <p class="bg-success text-white rounded"><?= $kira["kira_durum"] ?></p>

                                        <?php }

                                        $kira["kira_durum"] ?>
                                    </td>
                                    <td><?= tarihdegistirme($kira["kira_tarih"]) ?></td>
                                    <td>
                                        <a href="kiralar_detay.php?kira_id=<?= $kira['kira_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                        <a href="kiralar_duzenle.php?kira_id=<?= $kira['kira_id'] ?>" class="btn btn-success" title="Düzenle"><i class="fa-solid fa-edit"></i></a>
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