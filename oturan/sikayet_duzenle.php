<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';




$veri   =   $db->prepare("SELECT * FROM sikayetler WHERE sikayet_id={$_GET['sikayet_id']}");
$veri->execute();
$sikayetler =   $veri->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['sikayet_duzenle'])) {
    $oturan_tc          =   $_POST['oturan_tc'];
    $daire_adi          =   $_POST['daire_adi'];
    $daire_no           =   $_POST['daire_no'];
    $sikayet_baslik     =   htmlspecialchars(strip_tags(trim($_POST['sikayet_baslik'])));
    $sikayet_detay      =   htmlspecialchars(strip_tags(trim($_POST['sikayet_detay'])));
    $sikayet_durum      =   $_POST['sikayet_durum'];
    $sikayet_id         =   $_POST['sikayet_id'];

    if (empty($sikayet_baslik)) {
        echo "Lütfen şikayetinize bir başlık ekleyiniz";
    } elseif (empty($sikayet_detay)) {
        echo "Lütfen şikayetinizi açıklayınız";
    } else {
        $sikayet_duzenle = $db->prepare("UPDATE sikayetler SET 
        oturan_tc       =:oturan_tc,
        daire_adi       =:daire_adi,
        daire_no        =:daire_no,
        sikayet_baslik  =:sikayet_baslik,
        sikayet_detay   =:sikayet_detay,
        sikayet_durum   =:sikayet_durum WHERE sikayet_id=:sikayet_id
        ");
        $sikayet_duzenle->execute([
            'oturan_tc'         =>  $oturan_tc,
            'daire_adi'         =>  $daire_adi,
            'daire_no'          =>  $daire_no,
            'sikayet_baslik'    =>  $sikayet_baslik,
            'sikayet_detay'     =>  $sikayet_detay,
            'sikayet_durum'     =>  $sikayet_durum,
            'sikayet_id'        =>  $sikayet_id
        ]);
        if (isset($sikayet_duzenle)) {
            echo  "<div class='alert alert-success' role='alert'>
                <strong>Şikayetiniz Başarı İle Düzenlendi</strong>
            </div>";
            header("refresh:2 sikayet.php?oturan_tc=$oturan_tc");
        } else {
            echo  "<div class='alert alert-danger' role='alert'>
                <strong>Şikayetiniz Düzeltilirken Bir Hata Oldu. Lütfen Tekrar Deneyiniz.</strong>
            </div>";
        }
    }
}




?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-8 mb-4 p-3 mx-auto">

            <form action="" method="post">
                <div class="card p-5 shadow-lg">
                    <h3 class="card-title">Şikayet Sayfası</h3>
                    <div>
                        <input type="hidden" class="form-control" name="oturan_tc" value="<?= $oturanlar['oturan_tc'] ?>">
                    </div>
                    <div>
                        <input type="hidden" class="form-control" name="daire_adi" value="<?= $daire['daire_adi'] ?>">
                    </div>
                    <div>
                        <input type="hidden" class="form-control" name="daire_no" value="<?= $daire['daire_no'] ?>">
                    </div>
                    <div>
                        <input type="hidden" class="form-control" name="sikayet_id" value="<?= $sikayetler['sikayet_id'] ?>">
                    </div>
                    <div>
                        <input type="hidden" class="form-control" name="sikayet_durum" value="Okunmayı Bekliyor.">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Şikayet Başlığı</label>
                        <input type="text" class="form-control" name="sikayet_baslik" placeholder="Şikayet Başlığı" value="<?= $sikayetler['sikayet_baslik'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Şikayet Detayı</label>
                        <textarea class="form-control" name="sikayet_detay" id="editor" rows="3"><?= $sikayetler['sikayet_detay'] ?></textarea>
                    </div>
                    <button type="submit" name="sikayet_duzenle" class="btn btn-outline-primary">Güncelle</button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>