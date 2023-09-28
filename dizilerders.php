<?php
/* 
$sayi1 = @$_POST['sayi1'];
$sayi2 = @$_POST['sayi2'];
$metin = @$_POST['metin'];

$topla = $sayi1 + $sayi2;
$cikar = $sayi1 - $sayi2;
$carp = $sayi1 * $sayi2;
$bol = $sayi1 / $sayi2;
$mod = $sayi1 % $sayi2;
$birlestir = $sayi1 . $metin;

echo $topla . "<br>";
echo $cikar . "<br>";
echo $carp . "<br>";
echo $bol . "<br>";
echo $mod . "<br>";
echo $birlestir . "<br>";



$arabalar = array("deneme", "", "deneme2");
@$arabalar[1] = $_POST['arabalar'];

echo $arabalar[0] . "<br>";
echo $arabalar[1] . "<br>";
echo $arabalar[2] . "<br>";


$kisi = [
    "ad" => "hayri",
    "soyad" => "koç",
    "yas" => 37,
    "örnek veri"
];

foreach ($kisi as $anahtar => $deger) {

    echo $anahtar . " =>" . $deger . "<br>";
}

echo "<pre>";
print_r($kisi);


$toplam = $uretim["2005"]["mısır"] + $uretim["2006"]["mısır"] + $uretim["2007"]["mısır"] + $uretim["2008"]["mısır"] + $uretim["2009"]["mısır"];



$a =  array("a" => "elma", "b" => "armut");
$b =  array("a" => "çilek", "b" => "visne", "c" => "kiraz");
$c = $a + $b;
echo $c["a"] . "<br>";
echo $c["b"] . "<br>";
echo $c["c"] . "<br>";
*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
    </style>


</head>

<body>

    <iframe style="border: 1px solid rgba(0, 0, 0, 0.1);" width="800" height="450" src="https://www.figma.com/embed?embed_host=share&url=https%3A%2F%2Fwww.figma.com%2Ffile%2FR8PhYLJsqpPX8ylosWNc86%2FUntitled%3Fnode-id%3D0%253A1%26t%3DlliqFM0pFfTur8NP-1" allowfullscreen></iframe>

    <form action="" method="post">
        <input type="text" name="sayi1">
        <input type="text" name="sayi2">
        <input type="text" name="metin">
        <input type="text" name="arabalar">
        <button type="submit" name="hesapla">Hesapla</button>
    </form>



</body>

</html>