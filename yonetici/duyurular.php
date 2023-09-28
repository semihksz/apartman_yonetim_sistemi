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
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5">Duyurular</h3>
                <div class="col-md-4">
                    <a href="duyurular_ekle.php" class="btn btn-success mb-3" style="float: left;"><i class="fa-solid fa-plus"></i> Yeni Duyuru Oluştur</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Apartman Adı</th>
                                <th>Daire Numarası</th>
                                <th>Duyuru Başlığı</th>
                                <th>Duyuru Tarihi</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM duyurular INNER JOIN oturanlar ON duyurular.oturan_tc = oturanlar.oturan_tc ORDER BY duyuru_id DESC");
                            $veri->execute();
                            $duyurular =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($duyurular as $key => $duyuru) {
                            ?>

                                <tr>
                                    <td><?= $duyuru["oturan_daire_adi"] ?></td>
                                    <td><?= $duyuru["oturan_daire_no"] ?></td>
                                    <td><?= $duyuru["duyuru_baslik"] ?></td>
                                    <td><?= tarihdegistirme($duyuru["duyuru_tarih"]) ?></td>
                                    <td>
                                        <a href="duyurular_detay.php?duyuru_id=<?= $duyuru['duyuru_id'] ?>" class="btn btn-primary" title="Detaylı Gör"><i class="fa-solid fa-eye"></i></a>
                                        <a href="duyurular_sil.php?duyuru_id=<?= $duyuru['duyuru_id'] ?>" class="btn btn-danger" title="Sil"><i class="fa-solid fa-trash"></i></a>
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