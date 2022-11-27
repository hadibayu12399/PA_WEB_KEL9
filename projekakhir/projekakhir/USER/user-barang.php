<?php 
 
require '..\koneksi.php'; 

$NIK = $_GET["Nama"];
$BG = $_GET["BG"];

session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}
 
$select_sql = " SELECT barang.ID,
                barang.Nama,
                barang.Harga,
                cabang.Nama AS Cabang,
                barang.Gambar FROM barang
                INNER JOIN cabang
                ON ID_Cabang = cabang.ID
                Where cabang.Nama='$NIK';";




$result = mysqli_query($conn, $select_sql);

if (!$result) {
    echo mysqli_error($conn);
    echo"Terjadi eror sql";
}

$DATA = [];

while ($row = mysqli_fetch_assoc($result)) {
    $DATA[] = $row;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ZDN Elecktronik - Barang</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="user-menu2.css">
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
        <link rel = "icon" href = "images/logo.png" type = "image/png">
    </head>
    <body>
        <nav>
            <div class = "head-top">
                <div class = "site-name">
                    <span>ZDN Elecktronik</span>
                </div>
                <div class = "site-nav">
                    <span id = "nav-btn">MENU <i class = "fas fa-bars"></i></span>
                </div>
            </div>
        </nav>
        <!-- side navbar -->
        <div class = "sidenav" id = "sidenav">
            <span class = "cancel-btn" id = "cancel-btn">
                <i class = "fas fa-times"></i>
            </span>
            <ul class = "navbar">
                <li><a href = "user-final.php">Riwayat Anda</a></li>
                <li><a href = "user-menu.php">List Toko</a></li>
                <li><a href = "user-feed.php">Feed Back</a></li>
                <li><a href = "user-akun.php">Akun : <?=$_SESSION['username']; ?></a></li>
            </ul>
            <a type="button" class = "btn log-in" href="..\LOG-OUT.php" onClick="return confirm ('Yakin?')">Logout</a>
        </div>
        <!-- end of side navbar -->


        <!-- fullscreen modal -->
        <div id = "modal"></div>
        <!-- end of fullscreen modal -->
        <section class = "rooms sec-width" id = "rooms">
            <div class = "title">
                <h2>Daftar kamar <?=$DATA[0]["Cabang"]?></h2>
            </div>
            <div class = "rooms-container">
                <?php foreach ($DATA as $DATABARANG) : ?>
                    <!-- single room -->
                    <article class = "room">
                        <div class = "room-image">
                                <?php $PT = "../barang/".$DATABARANG["Gambar"]; ?>
                                <img src = "<?=$PT?>" alt = "room image" >
                            
                        </div>
                        <div class = "room-text">
                            <h3><?= $DATABARANG["Nama"] ?></h3>
                            <p class = "rate">
                                <span>RP <?= $DATABARANG["Harga"] ?> /</span> barang
                            </p>
                            <a href="user-pesan.php?ID=<?=$DATABARANG["ID"];?>&BG=<?=$BG?>&PT=<?=$PT?>"><button type = "button" class = "btn">Pilih Barang</button></a>

                        </div>
                    </article>
                    
                    <!-- end of single room -->
                <?php endforeach; ?>    


            </div>
        </section>
        <!-- end of body content -->
        <!-- footer -->
        <footer class = "footer">
            <div class = "footer-container">
                <div>
                    <h2>About Us </h2>
                    <ul class = "social-icons">
                        <li class = "flex">
                            <i class = "fa fa-twitter fa-2x"></i>
                        </li>
                        <li class = "flex">
                            <i class = "fa fa-facebook fa-2x"></i>
                        </li>
                        <li class = "flex">
                            <i class = "fa fa-instagram fa-2x"></i>
                        </li>
                    </ul>
                </div>

                <div>
                    <h2>Kritik & Saran</h2>
                    <div class = "contact-item">
                        <span>
                            <i class = "fas fa-map-marker-alt"></i>
                        </span>
                        <span>
                            Jalan Pramuka IV, Samarinda
                        </span>
                    </div>
                    <div class = "contact-item">
                        <span>
                            <i class = "fas fa-phone-alt"></i>
                        </span>
                        <span>
                            +6282243809090
                        </span>
                    </div>
                    <div class = "contact-item">
                        <span>
                            <i class = "fas fa-envelope"></i>
                        </span>
                        <span>
                        electro.zdm@gmail.com
                        </span>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end of footer -->
        
        <script src="script.js"></script>
    </body>
</html>