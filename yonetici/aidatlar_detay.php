<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM aidatlar INNER JOIN oturanlar ON aidatlar.oturan_tc = oturanlar.oturan_tc WHERE aidat_id={$_GET['aidat_id']}");
$veri->execute();
$aidat = $veri->fetch(PDO::FETCH_ASSOC);

?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row">
        <!-- İçerik Sütunu -->
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-3 text-center">Aidat Detay</h3>
                <form method="post">
                    <div class="col-lg-5 text-center mx-auto mb-4">
                        <?php
                        if ($aidat['aidat_durum'] == "Aidatınız Ödenmedi.") { ?>
                            <div class="card text-white bg-danger">
                                <img class="card-img-top" src="holder.js/100px180/" alt="">
                                <div class="card-body">
                                    <p class="card-text">Aidat Henüz Ödenmemiştir.</p>
                                    <hr class="bg-white">
                                    <h2 class="card-title">Borcunuz: <?= $aidat['aidat_kalan'] ?> &#8378;</h2>
                                    <hr class="bg-white">
                                </div>
                            </div>
                        <?php } elseif ($aidat['aidat_durum'] == "Aidatınız Ödendi.") { ?>
                            <div class="card text-white bg-success">
                                <img class="card-img-top" src="holder.js/100px180/" alt="">
                                <div class="card-body">
                                    <p class="card-text">Aidatınız Ödenmiştir.</p>
                                    <hr class="bg-white">
                                    <h2 class="card-title">Borcunuz: <?= $aidat['aidat_kalan'] ?> &#8378;</h2>
                                    <hr class="bg-white">
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Daire Adı</label>
                            <input type="text" disabled class="form-control" value="<?= $aidat['oturan_daire_adi'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Daire No</label>
                            <input type="text" disabled class="form-control" value="<?= $aidat['oturan_daire_no'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Açık Ev Adresi</label>
                        <input type="text" disabled class="form-control" value="<?= $aidat['oturan_daire_adresi'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Aidat Tutarı</label>
                        <input type="text" disabled class="form-control" value="<?= $aidat['aidat_tutar'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ödenen Aidat Tutarı</label>
                        <input type="text" disabled class="form-control" value="<?= $aidat['aidat_odenen_tutar'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kalan Aidat Tutarı</label>
                        <input type="text" disabled class="form-control" value="<?= $aidat['aidat_kalan'] ?>">
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>