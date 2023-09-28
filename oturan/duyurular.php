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
                <h3 class="mb-5">Duyurular</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Duyuru Başlığı</th>
                                <th>Duyuru Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM duyurular WHERE oturan_tc={$_GET['oturan_tc']} ORDER BY duyuru_id DESC");
                            $veri->execute();
                            $duyurular =   $veri->fetchAll(PDO::FETCH_ASSOC);
                            $duyurular = array_reverse($duyurular);

                            foreach ($duyurular as $duyuru) {
                            ?>
                                <tr>
                                    <td><?= $duyuru["duyuru_baslik"] ?></td>
                                    <td><?= tarihdegistirme($duyuru["duyuru_tarih"]) ?></td>
                                    <td>
                                        <a href="duyurular_detay.php?duyuru_id=<?= $duyuru['duyuru_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
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