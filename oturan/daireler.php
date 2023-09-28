<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';


if ($_SESSION['oturan_tc'] != $_GET['oturan_tc']) {
    header("location:index.php");
}

?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5">Daireler</h3>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tablo">
                        <thead>
                            <tr>
                                <th>Kiracı Adı Soyadı</th>
                                <th>Apartman Adı</th>
                                <th>Daire No</th>
                                <th>Daire Adresi</th>
                                <th>Daire Durumu</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
                            $veri->execute();
                            $oturanlar = $veri->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($oturanlar as $key => $oturan) { ?>
                                <tr>
                                    <td><?= $oturan["oturan_isim"] . " " . $oturan["oturan_soyisim"] ?></td>
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