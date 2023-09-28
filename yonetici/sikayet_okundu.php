<?php

require_once '../islemler/baglanti.php';

$veri = $db->prepare("SELECT * FROM sikayetler WHERE sikayet_id={$_GET['sikayet_id']}");
$veri->execute();
$sikayet = $veri->fetch(PDO::FETCH_ASSOC);
$sikayet_id = $sikayet['sikayet_id'];
$sikayet_durum = "Okundu (Çözülüyor).";

$okundu = $db->prepare("UPDATE sikayetler SET 
sikayet_durum =:sikayet_durum WHERE sikayet_id=:sikayet_id
");
$okundu->execute([
    'sikayet_id' => $sikayet_id,
    'sikayet_durum' => $sikayet_durum,

]);

if ($okundu) {
    header("location:sikayet.php");
}
