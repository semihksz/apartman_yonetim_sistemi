<?php
session_start();
session_destroy();
header("location:../yonetici/giris.php");
