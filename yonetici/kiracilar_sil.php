<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
$veri->execute();
$oturan = $veri->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['kiracilar_sil'])) {
    $kiraci_sil = $db->prepare("DELETE FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
    $kiraci_sil->execute();

    if ($kiraci_sil && $daire_sil) {
        header("location:kiracilar.php");
    } else {
        header("location:kiracilar.php");
        echo "Kiracı silinirken bir hata oluştu.";
    }
}
