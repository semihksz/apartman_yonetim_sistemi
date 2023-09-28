<?php


require_once '../islemler/baglanti.php';

$sil = $db->prepare("DELETE FROM duyurular WHERE duyuru_id={$_GET['duyuru_id']}");
$sil->execute();
if ($sil) {
    header("location:duyurular.php");
}
