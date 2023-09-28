<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';


$veri   =   $db->prepare("SELECT * FROM istek_oneri");
$veri->execute();
$istek_oneri =   $veri->fetch(PDO::FETCH_ASSOC);


if (isset($_GET['istek_oneri_sil'])) {
    $oturan_tc          =   $oturan['oturan_tc'];
    $istek_sil = $db->prepare("DELETE FROM istek_oneri WHERE istek_id={$_GET['istek_id']} ");
    $istek_sil->execute();
    if (isset($istek_sil)) {
        echo  "<div class='alert alert-success' role='alert'>
            <strong>İstek ve Öneriniz Başarı İle Düzenlendi</strong>
        </div>";
        header("location:istek_oneri.php?oturan_tc=$oturan_tc");
    } else {
        echo  "<div class='alert alert-danger' role='alert'>
            <strong>İstek ve Öneriniz Düzeltilirken Bir Hata Oldu. Lütfen Tekrar Deneyiniz.</strong>
        </div>";
    }
}
