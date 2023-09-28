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
                <h3>Şikayetler</h3>
                <div class="col-md-4">
                    <a href="sikayet_ekle.php" class="btn btn-success mb-3" style="float: left;"><i class="fa-solid fa-plus"></i> Şikayet Oluştur</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>Şikayet Başlığı</th>
                                <th>Şikayet Durumu</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM sikayetler WHERE oturan_tc={$_GET['oturan_tc']}");
                            $veri->execute();
                            $sikayetler =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($sikayetler as $key => $sikayet) { ?>
                                <tr>
                                    <td><?= $oturanlar["oturan_daire_adi"] ?></td>
                                    <td><?= $oturanlar["oturan_daire_no"] ?></td>
                                    <td><?= $sikayet["sikayet_baslik"] ?></td>
                                    <td>
                                        <!-- Şikayetin durumuna göre renk değişecek -->
                                        <?php
                                        if ($sikayet['sikayet_durum'] == "Okunmayı Bekliyor.") { ?>
                                            <p class="bg-danger text-white rounded"> <?= $sikayet["sikayet_durum"] ?> </p>
                                        <?php  } elseif ($sikayet['sikayet_durum'] == "Okundu (Çözülüyor).") { ?>
                                            <p class="bg-primary text-white rounded"> <?= $sikayet["sikayet_durum"] ?> </p>
                                        <?php } elseif ($sikayet['sikayet_durum'] == "Şikayetiniz Çözüldü.") { ?>
                                            <p class="bg-success text-white rounded"> <?= $sikayet["sikayet_durum"] ?> </p>
                                        <?php }
                                        ?>
                                    </td>
                                    <td>
                                        <!-- eğer yönetici gelen şikayeti okumuşsa düzenleme ve silme butonu kaybolacak eğer okumamışsa hepsi görünür olacak -->
                                        <?php
                                        if ($sikayet['sikayet_durum'] == "Okunmayı Bekliyor.") { ?>

                                            <a href="sikayet_detay.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                            <a href="sikayet_duzenle.php?sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-success" title="Düzenle"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="sikayet_sil.php?sikayet_sil=sikayet_sil&sikayet_id=<?= $sikayet['sikayet_id'] ?>" class="btn btn-danger" title="Sil"><i class="fa-solid fa-trash"></i></a>

                                        <?php } elseif ($sikayet['sikayet_durum'] == "Okundu (Çözülüyor)." || $sikayet['sikayet_durum'] == "Şikayetiniz Çözüldü.") { ?>

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