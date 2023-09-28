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
                <h3>İstek ve Önerileriniz</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Ad Soyad</th>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>İstek ve Öneri Başlığı</th>
                                <th>İstek Ve Öneri Durumu</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM istek_oneri INNER JOIN oturanlar ON istek_oneri.oturan_tc = oturanlar.oturan_tc");
                            $veri->execute();
                            $istek_oneriler =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($istek_oneriler as $key => $istek_oneri) { ?>
                                <tr>
                                    <td><?= $istek_oneri["oturan_isim"] . " " . $istek_oneri['oturan_soyisim'] ?></td>
                                    <td><?= $istek_oneri["daire_adi"] ?></td>
                                    <td><?= $istek_oneri["daire_no"] ?></td>
                                    <td><?= $istek_oneri["istek_baslik"] ?></td>
                                    <td>
                                        <!-- Şikayetin durumuna göre renk değişecek -->
                                        <?php
                                        if ($istek_oneri['istek_durum'] == "Okunmayı Bekliyor.") { ?>
                                            <p class="bg-danger text-white rounded"> <?= $istek_oneri["istek_durum"] ?> </p>
                                        <?php  } elseif ($istek_oneri['istek_durum'] == "Okundu.") { ?>
                                            <p class="bg-success text-white rounded"> <?= $istek_oneri["istek_durum"] ?> </p>
                                        <?php }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- eğer yönetici gelen şikayeti okumuşsa düzenleme ve silme butonu kaybolacak eğer okumamışsa hepsi görünür olacak -->
                                        <?php
                                        if ($istek_oneri['istek_durum'] == "Okunmayı Bekliyor.") { ?>

                                            <a href="istek_oneri_detay.php?istek_id=<?= $istek_oneri['istek_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                            <a href="istek_oneri_sil.php?istek_oneri_sil=istek_oneri_sil&istek_id=<?= $istek_oneri['istek_id'] ?>" class="btn btn-danger" title="Sil"><i class="fa-solid fa-trash"></i></a>
                                            <a href="istek_oneri_cozuldu.php?istek_id=<?= $istek_oneri['istek_id'] ?>" class="btn btn-success" title="Okundu Olarak İşaretle"><i class="fa-solid fa-check-double"></i></a>

                                        <?php } elseif ($istek_oneri['istek_durum'] == "Okundu.") { ?>

                                            <a href="istek_oneri_detay.php?istek_id=<?= $istek_oneri['istek_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>

                                        <?php }
                                        ?>
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