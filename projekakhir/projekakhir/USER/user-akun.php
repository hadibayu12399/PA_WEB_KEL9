<?php 

require '..\koneksi.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}

$US = $_SESSION['id'];

$select_sql = "SELECT * FROM users WHERE id = $US";
$result = mysqli_query($conn, $select_sql);

$KTP = [];

while ($row = mysqli_fetch_assoc($result)) {
    $KTP[] = $row;
}

$KTP = $KTP[0];
$id              = $KTP["id"];
$username        = $KTP["username"];
$LastName        = $KTP["LastName"];
$JenisKelamin    = $KTP["JenisKelamin"];
$Umur            = $KTP["Umur"];
$email           = $KTP["email"];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ZDN Elecktronik - Akun</title>
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
            .elang{
                font-size:20px;
            }
            @media screen and (max-width:1200px){
            .kerbau{
                margin:auto;
                width: 60%;
            }
            .elang{
                font-size:18px;
            }
            }
            @media screen and (max-width:1000px){
            .kerbau{
                margin:auto;
                width: 70%;
            }
            .elang{
                font-size:16px;
            }
            }
            @media screen and (max-width:900px){
            .kerbau{
                margin:auto;
                width: 75%;
            }
            .elang{
                font-size:15px;
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
            .elang{
                font-size:14px;
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
            .elang{
                font-size:13px;
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


        <section  class = "kerbau" id = "rooms" >
            <div  class = "title">
                <h2>Manage Akun</h2>
            </div>
            <div class="confir">
                <a href="UPDATE-Akun.php?id=<?=$KTP["id"];?>" onClick="return confirm ('Anda Yakin Ingin Mengupdate Biodata  ?')"><button style="font-family: 'Montserrat Semibold';"  type = "button" class = "btn">Ubah Profil</button></a>
                <a href="UPDATESANDI-Akun.php?id=<?=$KTP["id"];?>" onClick="return confirm ('Anda Yakin Ingin Mengubah Kata sandi ?')"><button style="font-family: 'Montserrat Semibold';"  type = "button" class = "btn">Ubah Sandi</button></a>
                <a href="DELETE-Akun.php?id=<?=$KTP["id"];?>" onClick="return confirm ('Anda Yakin Ingin Menghapus Akun ini ?')"><button style="background-color:#fc7265;font-family: 'Montserrat Semibold';"  type = "button" class = "btn">Hapus Akun</button></a>
            </div>
            <div style="display:flex; justify-content:center;"  >
                <div style="width:85%;background-color:#white; display:flex;align-items:center;justify-content:center;flex-direction:column;padding-bottom:40px;">
                <div style="display:flex; align-items:center;justify-content:space-around;margin-bottom: 20px;  margin-top: 20px;width:100% ">
                    <p class="elang" style="font-family: Montserrat;">Profil Anda</p>
                </div>           
                    <table class="burung" >
                        <tr>
                            <td class="pjg" style="font-family: 'Montserrat Semibold';" width="200px" height="50px">Nama </td>
                            <td> : <?php echo $username." ".$LastName; ?> </td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Jenis Kelamin</td>
                            <td> : <?php echo $JenisKelamin ?></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Tanggal Lahir</td>
                            <td> : <?php echo $Umur ?></td>
                        </tr>
                        <tr>
                            <td style="font-family: 'Montserrat Semibold';" height="50px">Alamat Email</td>
                            <td> : <?php echo $email ?></td>
                        </tr>
                    </table>
                </div>
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