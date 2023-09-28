<?php


require_once '../islemler/baglanti.php';

$sil = $db->prepare("DELETE FROM istek_oneri WHERE istek_id={$_GET['istek_id']}");
$sil->execute();
if ($sil) {
    header("location:istek_oneri.php");
}
