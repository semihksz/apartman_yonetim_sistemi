<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';
oturan_get_kontol();
?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-12 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5">Kiranız</h3>
                <div class="col-lg-6 mx-auto mb-5">
                    <?php
                    $veri   =   $db->prepare("SELECT * FROM kiralar WHERE oturan_tc={$_GET['oturan_tc']} ORDER BY kira_id DESC");
                    $veri->execute();
                    $kiralar =   $veri->fetch(PDO::FETCH_ASSOC);

                    //gelen borçtan ödenen borcuu çıkardıktan sonra bulunan kalan borçtur
                    @$odenen_kira = $kiralar['kira_tutar'] - $kiralar['kira_odenen_tutar'];

                    if (@$kiralar['kira_durum'] == "Kiranız Ödenmedi." || $odenen_kira != "0") { ?>
                        <div class="card text-white bg-danger">
                            <img class="card-img-top" src="holder.js/100px180/" alt="">
                            <div class="card-body">
                                <p class="card-text">Kiranız Henüz Ödenmemiştir.</p>
                                <hr class="bg-white">
                                <h2 class="card-title">Borcunuz: <?= $odenen_kira ?> &#8378;</h2>
                                <hr class="bg-white">
                                <p class="card-text"><a href="kiralar_detay.php?kira_id=<?= $borclar['kira_id'] ?>" style="text-decoration: none;" class="text-white">Detaylı Görmek İçin Tıklayınız.</a></p>
                            </div>
                        </div>
                    <?php } elseif (@$kiralar['kira_durum'] == "Kiranız Ödendi." && $odenen_kira == "0") { ?>
                        <div class="card text-white bg-success">
                            <img class="card-img-top" src="holder.js/100px180/" alt="">
                            <div class="card-body">
                                <p class="card-text">Kiranız Ödenmiştir.</p>
                                <hr class="bg-white">
                                <h2 class="card-title">Borcunuz: <?= $odenen_kira ?> &#8378;</h2>
                                <hr class="bg-white">
                                <p class="card-text"><a href="kiralar_detay.php?kira_id=<?= $kiralar['kira_id'] ?>" style="text-decoration: none;" class="text-white">Detaylı Görmek İçin Tıklayınız.</a></p>
                            </div>
                        </div>
                    <?php }


                    ?>

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>Kira Tutarınız</th>
                                <th>Toplam Ödenen Kira Tutarınız</th>
                                <th>Toplam Kalan Kiranız Tutarınız</th>
                                <th>Kira Durumu</th>
                                <th>Kira Eklenme Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM kiralar WHERE oturan_tc={$_GET['oturan_tc']} ORDER BY kira_id DESC");
                            $veri->execute();
                            $kiralar =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($kiralar as $key => $kira) {
                            ?>

                                <tr>
                                    <td><?= $oturanlar["oturan_daire_adi"] ?></td>
                                    <td><?= $oturanlar["oturan_daire_no"] ?></td>
                                    <td><?= $kira["kira_tutar"] ?></td>
                                    <td><?= $kira["kira_odenen_tutar"] ?></td>
                                    <!-- yönetici sayfası yapıldıktan sonra düzenleme gerekebilir.  -->
                                    <td><?= $odenen_kira ?></td>
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