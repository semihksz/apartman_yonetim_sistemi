<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';


$veri   =   $db->prepare("SELECT * FROM istek_oneri");
$veri->execute();
$sikayetler =   $veri->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['istek_gonder'])) {
    $oturan_tc          =   $_POST['oturan_tc'];
    $daire_adi    =   $_POST['daire_adi'];
    $daire_no       =   $_POST['daire_no'];
    $istek_baslik     =   htmlspecialchars(strip_tags(trim($_POST['istek_baslik'])));
    $istek_detay      =   htmlspecialchars(strip_tags(trim($_POST['istek_detay'])));
    $istek_durum      =   $_POST['istek_durum'];

    if (empty($istek_baslik)) {
        echo "Lütfen şikayetinize bir başlık ekleyiniz";
    } elseif (empty($istek_detay)) {
        echo "Lütfen şikayetinizi açıklayınız";
    } else {
        $istek_ekle = $db->prepare("INSERT INTO istek_oneri SET oturan_tc=?, daire_adi=?, daire_no=?, istek_baslik=?, istek_detay=?, istek_durum=?");
        $istek_ekle->execute([
            $oturan_tc,
            $daire_adi,
            $daire_no,
            $istek_baslik,
            $istek_detay,
            $istek_durum
        ]);

        if (isset($istek_ekle)) {
            echo  "<div class='alert alert-success' role='alert'>
                <strong>İstek ve Öneriniz Başarı İle Gönderildi</strong>
            </div>";
            header("refresh:2 istek_oneri.php?oturan_tc=$oturan_tc");
        } else {
            echo  "<div class='alert alert-danger' role='alert'>
                <strong>İstek ve Öneriniz Oluşturulurken Bir Hata Oldu. Lütfen Tekrar Deneyiniz.</strong>
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
                    <h3 class="card-title">İstek ve Öneri Sayfası</h3>
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
                        <input type="hidden" class="form-control" name="istek_durum" value="Okunmayı Bekliyor.">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">İstek ve Öneri Başlığı</label>
                        <input type="text" class="form-control" name="istek_baslik" placeholder="İstek ve Öneri Başlığı Başlığı">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">İstek ve Öneri Detayı</label>
                        <textarea class="form-control" name="istek_detay" id="editor" rows="3"></textarea>
                    </div>
                    <button type="submit" name="istek_gonder" class="btn btn-outline-primary">İstek ve Öneri Gönder</button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php require_once 'footer.php'; ?>