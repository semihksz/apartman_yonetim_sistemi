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
                <h3>Şikayetler</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>TC</th>
                                <th>Ad Soyad</th>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>Şikayet Başlığı</th>
                                <th>Şikayet Durumu</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM sikayetler INNER JOIN oturanlar ON sikayetler.oturan_tc = oturanlar.oturan_tc ORDER BY sikayet_id DESC");
                            $veri->execute();
                            $sikayetler =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($sikayetler as $key => $sikayet) { ?>
                                <tr>
                                    <td><?= $sikayet["oturan_tc"] ?></td>
                                    <td><?= $sikayet["oturan_isim"] . " " . $sikayet['oturan_soyisim'] ?></td>
                                    <td><?= $sikayet["daire_adi"] ?></td>
                                    <td><?= $sikayet["daire_no"] ?></td>
                                    <td><?= $sikayet["sikayet_baslik"] ?></td>
                                    <td>
                                        <!-- Şikayetin durumuna göre renk değişecek -->
                                        <!-- şikayet durumu -->
                                        <?php
                                        if ($sikayet['sikayet_durum'] == "Okunmayı Bekliyor.") { ?>
                                            <p class="bg-danger text-white rounded p-1"> <?= $sikayet["sikayet_durum"] ?> </p>
                                        <?php  } elseif ($sikayet['sikayet_durum'] == "Okundu (Çözülüyor).") { ?>
                                            <p class="bg-primary text-white rounded p-1"> <?= $sikayet["sikayet_durum"] ?> </p>
                                        <?php } elseif ($sikayet['sikayet_durum'] == "Şikayetiniz Çözüldü.") { ?>
                                            <p class="bg-success text-white rounded p-1"> <?= $sikayet["sikayet_durum"] ?> </p>
                                        <?php }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- eğer yönetici gelen şikayeti okumuşsa düzenleme ve silme butonu kaybolacak eğer okumamışsa hepsi görünür olacak -->
                                        <!-- butonlar -->
                                        <?php
                                        if ($sikayet['sikayet_durum'] == "Okunmayı Bekliyor.") { ?>
                                            <a href="sikayet_detay.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                            <a href="sikayet_sil.php?sikayet_sil=sikayet_sil&sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-danger" title="Sil"><i class="fa-solid fa-trash"></i></a>
                                            <a href="sikayet_okundu.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-warning" title="Okundu Olarak İşaretle"><i class="fa-solid fa-check"></i></a>
                                            <a href="sikayet_cozuldu.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-success mt-1" title="Çözüldü Olarak İşaretle"><i class="fa-solid fa-check-double"></i></a>
                                        <?php } elseif ($sikayet['sikayet_durum'] == "Okundu (Çözülüyor).") { ?>
                                            <a href="sikayet_detay.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                            <a href="sikayet_cozuldu.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-success mt-1" title="Çözüldü Olarak İşaretle"><i class="fa-solid fa-check-double"></i></a>
                                        <?php } elseif ($sikayet['sikayet_durum'] == "Şikayetiniz Çözüldü.") { ?>
                                            <a href="sikayet_detay.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
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