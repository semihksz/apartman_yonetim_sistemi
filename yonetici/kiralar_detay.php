<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM kiralar INNER JOIN oturanlar ON kiralar.oturan_tc = oturanlar.oturan_tc WHERE kira_id={$_GET['kira_id']}");
$veri->execute();
$kira = $veri->fetch(PDO::FETCH_ASSOC);

?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row">
        <!-- İçerik Sütunu -->
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-3 text-center">Kira Detay</h3>
                <form method="post">
                    <div class="col-lg-5 text-center mx-auto mb-4">
                        <?php
                        if ($kira['kira_durum'] == "Kiranız Ödenmedi.") { ?>
                            <div class="card text-white bg-danger">
                                <img class="card-img-top" src="holder.js/100px180/" alt="">
                                <div class="card-body">
                                    <p class="card-text">Kiranız Henüz Ödenmemiştir.</p>
                                    <hr class="bg-white">
                                    <h2 class="card-title">Borcunuz: <?= $kira['kira_kalan'] ?> &#8378;</h2>
                                    <hr class="bg-white">
                                </div>
                            </div>
                        <?php } elseif ($kira['kira_durum'] == "Kiranız Ödendi.") { ?>
                            <div class="card text-white bg-success">
                                <img class="card-img-top" src="holder.js/100px180/" alt="">
                                <div class="card-body">
                                    <p class="card-text">Kiranız Ödenmiştir.</p>
                                    <hr class="bg-white">
                                    <h2 class="card-title">Borcunuz: <?= $kira['kira_kalan'] ?> &#8378;</h2>
                                    <hr class="bg-white">
                                </div>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Daire Adı</label>
                            <input type="text" disabled class="form-control" value="<?= $kira['oturan_daire_adi'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Daire No</label>
                            <input type="text" disabled class="form-control" value="<?= $kira['oturan_daire_no'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Açık Ev Adresi</label>
                        <input type="text" disabled class="form-control" value="<?= $kira['oturan_daire_adresi'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kira Tutarı</label>
                        <input type="text" disabled class="form-control" value="<?= $kira['kira_tutar'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ödenen Kira Tutarı</label>
                        <input type="text" disabled class="form-control" value="<?= $kira['kira_odenen_tutar'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kalan Kira Tutarı</label>
                        <input type="text" disabled class="form-control" value="<?= $kira['kira_kalan'] ?>">
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>