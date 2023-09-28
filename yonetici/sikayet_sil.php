<?php
require_once '../islemler/baglanti.php';

$sil = $db->prepare("DELETE FROM sikayetler WHERE sikayet_id={$_GET['sikayet_id']}");
$sil->execute();
if ($sil) {
    header("location:sikayet.php");
}
