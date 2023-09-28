<?php

require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM istek_oneri WHERE istek_id={$_GET['istek_id']}");
$veri->execute();
$istek = $veri->fetch(PDO::FETCH_ASSOC);
$istek_id = $istek['istek_id'];
$istek_durum = "Okundu.";

$okundu = $db->prepare("UPDATE istek_oneri SET 
istek_durum =:istek_durum WHERE istek_id=:istek_id
");
$okundu->execute([
    'istek_id' => $istek_id,
    'istek_durum' => $istek_durum,

]);

if ($okundu) {
    header("location:istek_oneri.php");
}
