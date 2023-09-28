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
        <div class="col-lg-8 mb-4 p-3 mx-auto">

            <form action="" method="post">
                <div class="card p-5 shadow-lg">
                    <img class="rounded-circle shadow mx-auto" src="../img/yoneticiler/<?= $yonetici['yonetici_resim'] ?>" style="border:3px solid black; max-width: 300px;" alt="yonetici_profil_resmi">
                    <div class="card-body text-left">
                        <p class="card-text">Kiracı Adı Soyadı: <input class="form-control" type="text" disabled value="<?= $yonetici['yonetici_isim'] . " " . $yonetici['yonetici_soyisim']; ?>"></p>
                        <p class="card-text">Kiracı TC Kimlik Numarası: <input class="form-control" type="text" disabled value="<?= $yonetici['yonetici_tc']; ?>"></p>
                        <p class="card-text">Kiracı Telefon Numarası: <input class="form-control" type="text" disabled value="<?= $yonetici['yonetici_telefon']; ?>"></p>
                        <p class="card-text">Kiracı Maili: <input class="form-control" type="text" disabled value="<?= $yonetici['yonetici_mail']; ?>"></p>
                    </div>
                    <a href="">
                        <div class="card-footer">
                            <a href="profil_duzenle.php?yonetici_id=<?= $yonetici['yonetici_id'] ?>" class="btn btn-primary btn-block" name="bilgileriduzenle">Bilgileri Düzenle</a>
                        </div>
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>