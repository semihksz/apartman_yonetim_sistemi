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
                <h3 class="mb-5">Aidatınız</h3>
                <div class="col-lg-6 mx-auto mb-5">
                    <?php
                    $veri   =   $db->prepare("SELECT * FROM aidatlar WHERE oturan_tc={$_GET['oturan_tc']} ORDER BY aidat_id DESC");
                    $veri->execute();
                    $aidatlar =   $veri->fetch(PDO::FETCH_ASSOC);

                    //gelen borçtan ödenen borcu çıkardıktan sonra bulunan kalan borçtur
                    @$odenen_aidat = $aidatlar['aidat_tutar'] - $aidatlar['aidat_odenen_tutar'];

                    if (@$aidatlar['aidat_durum'] == "Aidatınız Ödenmedi." || $odenen_aidat != "0") { ?>
                        <div class="card text-white bg-danger">
                            <img class="card-img-top" src="holder.js/100px180/" alt="">
                            <div class="card-body">
                                <p class="card-text">Aidatınız Henüz Ödenmemiştir.</p>
                                <hr class="bg-white">
                                <h2 class="card-title">Borcunuz: <?= $odenen_aidat ?> &#8378;</h2>
                                <hr class="bg-white">
                                <p class="card-text"><a href="aidatlar_detay.php?aidat_id=<?= $borclar['aidat_id'] ?>" style="text-decoration: none;" class="text-white">Detaylı Görmek İçin Tıklayınız.</a></p>
                            </div>
                        </div>
                    <?php } elseif (@$aidatlar['aidat_durum'] == "Aidatınız Ödendi." && $odenen_aidat == "0") { ?>
                        <div class="card text-white bg-success">
                            <img class="card-img-top" src="holder.js/100px180/" alt="">
                            <div class="card-body">
                                <p class="card-text">Aidatınız Ödenmiştir.</p>
                                <hr class="bg-white">
                                <h2 class="card-title">Borcunuz: <?= $odenen_aidat ?> &#8378;</h2>
                                <hr class="bg-white">
                                <p class="card-text"><a href="aidatlar_detay.php?aidat_id=<?= $aidatlar['aidat_id'] ?>" style="text-decoration: none;" class="text-white">Detaylı Görmek İçin Tıklayınız.</a></p>
                            </div>
                        </div>
                    <?php }


                    ?>

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Aidat Tutarınız</th>
                                <th>Toplam Ödenen Aidat Tutarınız</th>
                                <th>Toplam Kalan Aidat Tutarınız</th>
                                <th>Aidat Durumu</th>
                                <th>Aidat Eklenme Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM aidatlar WHERE oturan_tc={$_GET['oturan_tc']} ORDER BY aidat_id DESC");
                            $veri->execute();
                            $aidatlar =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($aidatlar as $key => $aidat) {
                            ?>

                                <tr>
                                    <td><?= $aidat["aidat_tutar"] ?></td>
                                    <td><?= $aidat["aidat_odenen_tutar"] ?></td>
                                    <!-- yönetici sayfası yapıldıktan sonra düzenleme gerekebilir.  -->
                                    <td><?= $odenen_aidat ?></td>
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