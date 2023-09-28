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
        <div class="col-lg-12 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5">Borçlarınız</h3>
                <div class="col-lg-6 mx-auto mb-5">
                    <?php
                    $veri   =   $db->prepare("SELECT * FROM kiralar WHERE oturan_tc={$_GET['oturan_tc']} ORDER BY kira_id DESC");
                    $veri->execute();
                    $kiralar =   $veri->fetch(PDO::FETCH_ASSOC);

                    $veri   =   $db->prepare("SELECT * FROM aidatlar WHERE oturan_tc={$_GET['oturan_tc']} ORDER BY aidat_id DESC");
                    $veri->execute();
                    $aidatlar =   $veri->fetch(PDO::FETCH_ASSOC);

                    //gelen borçtan ödenen borcu çıkardıktan sonra bulunan kalan borçtur
                    @$toplam_borc = $kiralar['kira_tutar'] + $aidatlar['aidat_tutar'];
                    @$odenen_borc = $kiralar['kira_odenen_tutar'] + $aidatlar['aidat_odenen_tutar'];
                    @$kalan_borc  = $toplam_borc - $odenen_borc;

                    if ($kalan_borc != 0) { ?>
                        <div class="card text-white bg-danger">
                            <img class="card-img-top" src="holder.js/100px180/" alt="">
                            <div class="card-body">
                                <p class="card-text">Borcunuz Henüz Ödenmemiştir.</p>
                                <hr class="bg-white">
                                <h2 class="card-title">Borcunuz: <?= $kalan_borc ?> &#8378;</h2>
                                <hr class="bg-white">
                                <p class="card-text"><a href="borclar_detay.php?borc_id=<?= $borclar['borc_id'] ?>" style="text-decoration: none;" class="text-white">Detaylı Görmek İçin Tıklayınız.</a></p>
                            </div>
                        </div>
                    <?php } elseif ($kalan_borc == 0) { ?>
                        <div class="card text-white bg-success">
                            <img class="card-img-top" src="holder.js/100px180/" alt="">
                            <div class="card-body">
                                <p class="card-text">Borcunuz Ödenmiştir.</p>
                                <hr class="bg-white">
                                <h2 class="card-title">Borcunuz: <?= $kalan_borc ?> &#8378;</h2>
                                <hr class="bg-white">
                                <p class="card-text"><a href="borclar_detay.php?borc_id=<?= $borclar['borc_id'] ?>" style="text-decoration: none;" class="text-white">Detaylı Görmek İçin Tıklayınız.</a></p>
                            </div>
                        </div>
                    <?php }


                    ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>