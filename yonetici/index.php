<?php
define("giriskontrol", true);
require_once 'header.php';
?>

<!-- Sayfa İçeriği Başlangıcı sayfa içeriği sonu footerda -->
<div class="container-fluid">
    <!-- İçerik Satırı -->
    <div class="row text-center">
        <!-- İçerik Sütunu -->
        <div class="col-lg-3 mb-4 p-3 ">
            <a href="daireler.php" class="text-success">
                <div class="card shadow-lg p-3 bg-body border-left-success">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fas fa-home"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Daireler</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 mb-4 p-3">
            <a href="kiralar.php?yonetici_tc=<?= $yonetici['yonetici_tc'] ?>" class="text-warning">
                <div class="card shadow-lg p-3 bg-body border-left-warning">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fas fa-hand-holding-dollar"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Kiralar</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 mb-4 p-3">
            <a href="aidatlar.php" class="text-warning">
                <div class="card shadow-lg p-3 bg-body border-left-warning">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fas fa-hand-holding-dollar"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Aidatlar</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 mb-4 p-3">
            <a href="duyurular.php?yonetici_tc=<?= $yonetici['yonetici_tc'] ?>" class="text-secondary">
                <div class="card shadow-lg p-3 bg-body border-left-secondary">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fa-solid fa-bell"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Duyurular</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 mb-4 p-3">
            <a href="istek_oneri.php" class="text-primary">
                <div class="card shadow-lg p-3 bg-body border-left-primary">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fa-solid fa-message"></i></h4>
                        <p class="card-text" style="font-size: 20px;">İstek ve Öneri</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 mb-4 p-3">
            <a href="sikayet.php" class="text-danger">
                <div class="card shadow-lg p-3 bg-body border-left-danger">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fa-solid fa-circle-exclamation"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Şikayet</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 mb-4 p-3">
            <a href="ev_sahipleri.php" style="color: #90278d;">
                <div class="card shadow-lg p-3 bg-body" style="border-left: #90278d solid 0.25rem;">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fa-solid fa-users"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Ev Sahipleri</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 mb-4 p-3">
            <a href="kiracilar.php" style="color: #90278d;">
                <div class="card shadow-lg p-3 bg-body" style="border-left: #90278d solid 0.25rem;">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fa-solid fa-users"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Kiracılar</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 mb-4 p-3">
            <a href="profil.php" class="text-info">
                <div class="card shadow-lg p-3 bg-body border-left-info">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 50px;"><i class="fas fa-user"></i></h4>
                        <p class="card-text" style="font-size: 20px;">Profil</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>


<?php require_once 'footer.php'; ?>