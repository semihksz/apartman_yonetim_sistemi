<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';



$veri   =   $db->prepare("SELECT * FROM sikayetler");
$veri->execute();
$sikayetler =   $veri->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['sikayet_sil'])) {
    $oturan_tc          =   $oturan['oturan_tc'];
    $sikayet_sil = $db->prepare("DELETE FROM sikayetler WHERE sikayet_id={$_GET['sikayet_id']} ");
    $sikayet_sil->execute();
    if (isset($sikayet_sil)) {
        echo  "<div class='alert alert-success' role='alert'>
            <strong>Şikayetiniz Başarı İle Düzenlendi</strong>
        </div>";
        header("location:sikayet.php?oturan_tc=$oturan_tc");
    } else {
        echo  "<div class='alert alert-danger' role='alert'>
            <strong>Şikayetiniz Düzeltilirken Bir Hata Oldu. Lütfen Tekrar Deneyiniz.</strong>
        </div>";
    }
}
