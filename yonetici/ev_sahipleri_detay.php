<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$ev_sahibi_veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
$ev_sahibi_veri->execute();
$oturan = $ev_sahibi_veri->fetch(PDO::FETCH_ASSOC);

?>


<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row">
        <!-- İçerik Sütunu -->
        <div class="col-lg-10 mb-4 p-3 mx-auto">
            <div class="card p-5 shadow-lg">
                <h3 class="mb-5 text-center">Ev Sahibi Detayı</h3>

                <img src="../img/" class="rounded-circle shadow mx-auto" style="border:3px solid black; max-width: 300px;" alt="Ev Sahibi Resmi">

                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Ev Sahibi TC</label>
                        <input type="number" class="form-control" disabled name="oturan_tc" value="<?= $oturan['oturan_tc'] ?>">
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Adı: </label>
                            <input type="text" class="form-control" disabled name="oturan_isim" value="<?= $oturan['oturan_isim'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Soyadı: </label>
                            <input type="text" class="form-control" disabled name="oturan_soyisim" value="<?= $oturan['oturan_soyisim'] ?>">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Telefonu</label>
                            <input type="number" class="form-control" disabled name="oturan_telefon" value="<?= $oturan['oturan_telefon'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Ev Sahibi Maili</label>
                            <input type="email" class="form-control" disabled name="oturan_mail" value="<?= $oturan['oturan_mail'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Apartman Adı</label>
                            <input type="text" class="form-control" disabled name="oturan_daire_adi" value="<?= $oturan['oturan_daire_adi'] ?>">
                        </div>
                        <div class="col mb-3">
                            <label class="form-label">Daire Numarası</label>
                            <input type="text" class="form-control" disabled name="oturan_daire_no" value="<?= $oturan['oturan_daire_no'] ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Açık Ev Adresi</label>
                        <input type="text" class="form-control" disabled name="oturan_daire_adresi" value="<?= $oturan['oturan_daire_adresi'] ?>">
                    </div>
                    <a href="ev_sahipleri_duzenle.php?oturan_tc=<?= $oturan['oturan_tc'] ?>" class="btn btn-primary w-100">Ev Sahibi Bilgilerini Düzenle</a>

                </form>

            </div>
        </div>
    </div>

</div>


<?php require_once 'footer.php'; ?>