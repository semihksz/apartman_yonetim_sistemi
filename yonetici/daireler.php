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
                <h3 class="mb-5">Daireler</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Oturan İsim Soyisim</th>
                                <th>Daire Adı</th>
                                <th>Daire Numarası</th>
                                <th>Daire Adresi</th>
                                <th>Oturma Durumu</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri   =   $db->prepare("SELECT * FROM oturanlar ORDER BY oturan_id ASC");
                            $veri->execute();
                            $oturanlar =   $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($oturanlar as $key => $oturan) {
                            ?>
                                <tr>
                                    <td><?= $oturan["oturan_isim"] . " " . $oturan['oturan_soyisim'] ?></td>
                                    <td><?= $oturan["oturan_daire_adi"] ?></td>
                                    <td><?= $oturan["oturan_daire_no"] ?></td>
                                    <td><?= $oturan["oturan_daire_adresi"] ?></td>
                                    <td><?= $oturan["oturan_durum"] ?></td>
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