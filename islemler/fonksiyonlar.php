<?php

function oturum()
{
    require_once 'baglanti.php';
    if (!isset($_SESSION['oturan_tc']) or !isset($_SESSION['oturan_sifre'])) {
        header("location:giris.php");
        exit;
    } else {
        return true;
    }
}

function yoneticioturum()
{
    require_once 'baglanti.php';
    if (!isset($_SESSION['yonetici_tc']) or !isset($_SESSION['yonetici_sifre'])) {
        header("location:giris.php");
        exit;
    } else {
        return true;
    }
}

function filtrele($deger)
{
    $bir = trim($deger);
    $iki = strip_tags($bir);
    $uc = htmlspecialchars($iki, ENT_QUOTES);
    $sonuc = $uc;
    return $sonuc;
}


function tarihdegistirme($duyuru_tarih)
{
    require_once 'baglanti.php';
    $eklenmetarihi = date('d/m/Y', strtotime($duyuru_tarih));
    return $eklenmetarihi;
}


function profil_get_kontrol()
{
    if ($_SESSION['kiraci_tc'] != $_GET['kiraci_tc']) {
        header("location:index.php");
    }

    return;
}


function oturan_get_kontol()
{
    if ($_SESSION['oturan_tc'] != $_GET['oturan_tc']) {
        header("location:index.php");
    }

    return;
}
