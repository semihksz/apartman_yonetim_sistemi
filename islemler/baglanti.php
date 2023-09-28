<?php
ob_start();
session_start();

$host       =   "localhost";
$dbname     =   "apartman_yonetim_sistemi";
$username   =   "root";
$password   =   "";


try {
    $db = new PDO("mysql:host=$host; dbname=$dbname; charset=UTF8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $hata) {
    echo $hata->getMessage();
}

$veri = $db->prepare("SELECT * FROM oturanlar ");
$veri->execute();
$oturan = $veri->fetch(PDO::FETCH_ASSOC);

$veri = $db->prepare("SELECT * FROM yoneticiler ");
$veri->execute();
$yonetici = $veri->fetch(PDO::FETCH_ASSOC);


$veri = $db->prepare("SELECT * FROM site_ayarlari");
$veri->execute();
$site = $veri->fetch(PDO::FETCH_ASSOC);
