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
                <h3 class="mb-5">Ev Sahiplerinin Listesi</h3>
                <div class="col-md-4">
                    <a href="ev_sahipleri_ekle.php" class="btn btn-success mb-3" style="float: left;"><i class="fa-solid fa-plus"></i> Yeni Ev Sahibi Ekle</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Ev Sahibi Resmi</th>
                                <th>Ev Sahibi TC</th>
                                <th>Ev Sahibi Adı</th>
                                <th>Ev Sahibi Soyadı</th>
                                <th>Ev Sahibi Telefonu</th>
                                <th>Ev Sahibi Maili</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM oturanlar WHERE oturan_durum='Ev Sahibi' ORDER BY oturan_isim");
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
                                        <a href="ev_sahipleri_detay.php?oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                        <a href="ev_sahipleri_duzenle.php?oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-success" title="Detaylı Gör"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="ev_sahipleri_sil.php?oturan_sil=oturan_sil&oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-danger" title="Detaylı Gör"><i class="fa-solid fa-trash"></i></a>
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