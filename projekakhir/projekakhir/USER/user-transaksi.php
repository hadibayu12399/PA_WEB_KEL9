<?php

require '..\koneksi.php'; 
session_start();
date_default_timezone_set('Asia/Jakarta');
if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}

$username = $_SESSION['id'];

$select_sql = "SELECT * FROM users WHERE id = $username";

$result = mysqli_query($conn, $select_sql);

if (!$result) {
    echo mysqli_error($conn);
}

$DataUser = [];

while ($row = mysqli_fetch_assoc($result)) {
    $DataUser[] = $row;
}

$DataUser = $DataUser[0];


$ID_User        = $DataUser['id'];
$fullname       = $DataUser['username']." ".$DataUser['LastName'];

$ID_Barang       = $_GET['ID_Barang'];
$select_sql2 = "SELECT 
                cabang.Nama as 'Nama_Cabang',
                cabang.Lokasi as 'Alamat',
                barang.Nama as 'Nama_Barang'
                FROM barang JOIN cabang ON
                barang.ID_Cabang = cabang.ID WHERE barang.id = '$ID_Barang'";

$result2 = mysqli_query($conn, $select_sql2);

if (!$result2) {
    echo mysqli_error($conn);
}

$DataBarang = [];

while ($row1 = mysqli_fetch_assoc($result2)) {
    $DataBarang[] = $row1;
}

$DataBarang = $DataBarang[0];


$Cabang         = $DataBarang['Nama_Cabang'];
$Alamat         = $DataBarang['Alamat'];
$Barang         = $DataBarang['Nama_Barang'];
$Jumlah_Barang  = $_GET['Jumlah_Barang'];
$Harga_Barang = $_GET['Harga_Barang'];
$Total_Harga = $Jumlah_Barang*$Harga_Barang;




if( isset($_POST["konfir"])){


    $insert_sql = "INSERT INTO transaksi VALUES (NULL,$ID_User,'$ID_Barang',$Jumlah_Barang,$Total_Harga)";
    $result = mysqli_query($conn, $insert_sql);

    if ($result) {
        echo "<script>
            alert('Transaksi Anda Dicetak');
            document.location.href = 'user-final.php';
        </script>";
    } else {
        echo "<script>
            alert('Eits Transaksi Gagal');
        </script>";
    }

}



?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ZDN Elecktronik - Konfirmasi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="user-menu2.css">
        <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
        <link rel = "icon" href = "images/logo.png" type = "image/png">
        <style>

            .confir{
                display: flex;
                justify-content:space-around;
            }
            .kerbau{
                padding-top:60px;
                margin:auto;
                width: 50%;
            }
            .ayam{
                
                display:flex;
                align-items:center;
                justify-content:space-between;
                width:100%;
                padding: 20px;

            }
            @media screen and (max-width:1200px){
            .kerbau{
                margin:auto;
                width: 60%;
            }
            }
            @media screen and (max-width:1000px){
            .kerbau{
                margin:auto;
                width: 70%;
            }
            }
            @media screen and (max-width:900px){
            .kerbau{
                margin:auto;
                width: 75%;
            }
            .burung{
                font-size: 15px;
            }
            .burung tr td{
                height:20px;
            }
            .pjg{
                width:170px;
            }

            }
            @media screen and (max-width:800px){
            .kerbau{
                margin:auto;
                width: 80%;
            }
            .burung{
                font-size: 12px;
                
            }
            .pjg{
                width:150px;
            }
            }
            @media screen and (max-width:600px){
            .kerbau{
                margin:auto;
                width: 85%;
            }
            .burung{
                font-size: 11px;
            
            }
            .pjg{
                width:100px;
            }
            }
            @media screen and (max-width:550px){
            .kerbau{
                margin:auto;
                width: 95%;
            }
            .burung{
                font-size: 11px;
            
            }
            .pjg{
                width:100px;
            }
            }
        </style>
    </head>
    <body >
        <!-- <nav>
            <div class = "head-top">
                <div class = "site-name">
                    <span>ZDN Elecktronik</span>
                </div>
                <div class = "site-nav">
                    <span id = "nav-btn">MENU <i class = "fas fa-bars"></i></span>
                </div>
            </div>
        </nav> -->
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
            <a type="button" class = "btn log-in" href="LOG-OUT.php" onClick="return confirm ('Yakin?')">Logout</a>
        </div>
        <!-- end of side navbar -->


        <!-- fullscreen modal -->
        <div id = "modal"></div>
        <!-- end of fullscreen modal -->


        <section  class = "kerbau" id = "rooms" >
            <div  class = "title">
                <h2>Transaksi</h2>
            </div>

            <div style="display:flex; justify-content:center;"  >

                <div style="width:85%;background-color:#white;border:9px solid black; display:flex;align-items:center;justify-content:center;flex-direction:column">

                <div style="background-color:black;width:50%;height:20px; margin-bottom: 0px;  "></div>
                <div style="display:flex; align-items:center;justify-content:space-around;margin-bottom: 20px;  margin-top: 20px;width:100% ">
                    <p style="font-family: Montserrat; font-size:20px;">Invoice</p>
                    <img src="https://www.pngarts.com/files/4/Hotel-PNG-Image-Background.png"  style="width:8%" width=35px height=40px>
                </div>
                <div style="background-color:#ffc421;width:100%;height:5px; margin-bottom: 30px;  margin-top: 0px;"></div>
                    <div class="ayam" >
                        <table class="burung" >
                            <tr>
                                <td style="font-family: 'Montserrat Semibold';" >Nama User</td>
                                <td> : <?= $fullname ?></td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Montserrat Semibold';" >Pemesanan </td>
                                <td> Barang</td>
                            </tr>
                        </table>
                        <table class="burung" >
                            <tr>
                                <td style="font-family: 'Montserrat Semibold';" >Invoice #</td>
                                <td> 0000</td>
                            </tr>
                            <tr>
                                <td style="font-family: 'Montserrat Semibold';" >Tanggal</td>
                                <td> <?=date('d-m-Y H:i:s');?> </td>
                            </tr>
                        </table>
                    </div>               
                    <table class="burung" >
                        <tr>
                            <td class="pjg" style="font-family: 'Montserrat Semibold';" width="200px" height="50px">Nama Cabang</td>
                            <td> : <?=$Cabang;?></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Alamat Cabang</td>
                            <td> : <?=$Alamat;?></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Nama Barang</td>
                            <td> : <?=$Barang;?></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Jumlah Barang</td>
                            <td> : <?=$Jumlah_Barang;?></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Harga Satuan</td>
                            <td> : Rp <?= $Harga_Barang;?></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Total Harga </td>
                            <td> : Rp <?=  $Total_Harga;?></td>
                        </tr>
                    </table>
                    <div style="display:flex; align-items:center;margin-bottom: 20px;  margin-top: 20px;width:100% ">
                        <div style="background-color:#ffc421;width:100%;height:5px; "></div>
                            <p style="padding:0 3px 0 3px;">ZDM</p>
                        <div style="background-color:#ffc421;width:30%;height:5px; "></div>
                    </div>
                </div>
                
            </div>
            <div class="confir">
                <a href="user-menu.php" onClick="return confirm ('Anda Yakin Ingin Membatalkan Pesanan ?')"><button style="background-color:#fc7265;font-family: 'Montserrat Semibold';"  type = "button" class = "btn">Batalkan</button></a>
                <form ACTION="" METHOD="POST">
                    <button style="background-color:#86ff6e;font-family: 'Montserrat Semibold';" name="konfir"  type = "submit" class = "btn">Konfirmasi</button>
                </form>
            </div>
        </section>


        
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