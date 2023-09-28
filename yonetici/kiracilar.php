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
                <h3 class="mb-5">Kiracıların Listesi</h3>
                <div class="col-md-4">
                    <a href="kiracilar_ekle.php" class="btn btn-success mb-3" style="float: left;"><i class="fa-solid fa-plus"></i> Yeni Kiracı Ekle</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Kiracı Resmi</th>
                                <th>Kiracı TC</th>
                                <th>Kiracı Adı</th>
                                <th>Kiracı Soyadı</th>
                                <th>Kiracı Telefonu</th>
                                <th>Kiracı Maili</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM oturanlar WHERE oturan_durum='Kiracı' ORDER BY oturan_isim");
                            $veri->execute();
                            $oturanlar =   $veri->fetchAll(PDO::FETCH_ASSOC); ?>
                            <?php foreach ($oturanlar as $key => $oturan) {  ?>
                                <tr>
                                    <td><img src="../img/<?= $oturan["oturan_resim"] ?>" alt="" style="border-radius: 100%; max-width:50px; height:auto;"></td>
                                    <td><?= $oturan["oturan_tc"] ?></td>
                                    <td><?= $oturan["oturan_isim"] ?></td>
                                    <td><?= $oturan["oturan_soyisim"] ?></td>
                                    <td><?= $oturan["oturan_telefon"] ?></td>
                                    <td><?= $oturan["oturan_mail"] ?></td>
                                    <td>
                                        <a href="kiracilar_detay.php?oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                        <a href="kiracilar_duzenle.php?oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-success" title="Detaylı Gör"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="kiracilar_sil.php?kiracilar_sil=kiracilar_sil&oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-danger" title="Detaylı Gör"><i class="fa-solid fa-trash"></i></a>
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