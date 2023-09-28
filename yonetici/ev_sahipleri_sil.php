<?php
define("giriskontrol", true);
require_once 'header.php';
require_once '../islemler/baglanti.php';

$ev_sahibi_veri = $db->prepare("SELECT * FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
$ev_sahibi_veri->execute();
$sahip = $ev_sahibi_veri->fetch(PDO::FETCH_ASSOC);

$sil = $db->prepare("DELETE FROM oturanlar WHERE oturan_tc={$_GET['oturan_tc']}");
$sil->execute();

if ($sil) {
    header("location:ev_sahipleri.php");
}

require_once 'footer.php';
