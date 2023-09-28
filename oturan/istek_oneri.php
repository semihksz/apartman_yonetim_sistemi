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
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3>İstek ve Önerileriniz</h3>
                <div class="col-md-4">
                    <a href="istek_oneri_ekle.php" class="btn btn-success mb-3" style="float: left;"><i class="fa-solid fa-plus"></i> İstek ve Öneri EKle</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>İstek ve Öneri Başlığı</th>
                                <th>İstek Ve Öneri Durumu</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM istek_oneri WHERE oturan_tc={$_GET['oturan_tc']}");
                            $veri->execute();
                            $istek_oneriler =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($istek_oneriler as $key => $istek_oneri) { ?>
                                <tr>
                                    <td><?= $oturanlar["oturan_daire_adi"] ?></td>
                                    <td><?= $oturanlar["oturan_daire_no"] ?></td>
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
                                            <a href="istek_oneri_duzenle.php?istek_id=<?= $istek_oneri['istek_id'] ?>" class="btn btn-success" title="Düzenle"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="istek_oneri_sil.php?istek_oneri_sil=istek_oneri_sil&istek_id=<?= $istek_oneri['istek_id'] ?>" class="btn btn-danger" title="Sil"><i class="fa-solid fa-trash"></i></a>

                                        <?php } elseif ($istek_oneri['istek_durum'] == "Okundu.") { ?>

                                            <a href="" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>

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