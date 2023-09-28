 <?php

    for ($x = 1; $x < 100; $x++) {
        for ($y = 1; $y < 100; $y++) {
            for ($z = 1; $z < 100; $z++) {
                $x2 = pow($x, 2);
                $y2 = pow($y, 2);
                $z2 = pow($z, 2);
                if ($z2 == $y2 + $x2) {
                    echo $x . " - " . $y . " - " . $z . "<br>";
                }
            }
        }
    }




    // if (isset($_POST['hesapla'])) {

    //     $sayi = $_POST['sayi'];
    //     $hesapla = 1;

    //     for ($i = 1; $i <= $sayi; $i++) {
    //         $hesapla = $hesapla * $i;
    //     }
    //     echo $hesapla;
    // }






    ?>
 <!--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="sayi">
        <button type="submit" name="hesapla">Hesapla</button>
    </form>
</body>

</html> -->