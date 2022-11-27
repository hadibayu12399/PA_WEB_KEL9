<?php 
 
require '..\koneksi.php'; 
session_start();
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}
 
if( isset($_POST["koemen"])){
    $ID = $_SESSION['id'];
    $select_sql = "SELECT * FROM users WHERE id =$ID";
    $result = mysqli_query($conn, $select_sql);

    $names = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $names[] = $row;
    }
    $names = $names[0];


    $user    = $names["username"];
    $komen   = htmlspecialchars($_POST['komentar']);
    $idd     = $names["id"];
    $waktu   = date('d-m-Y H:i:s'); 
    $star   = htmlspecialchars($_POST['star']);

    $insert_sql = "INSERT INTO feedback VALUES ('','$idd','$komen','$waktu',$star)";
    $result = mysqli_query($conn, $insert_sql);

}
    


$select_sql = "SELECT users.username AS user,Feed,waktu,star FROM feedback INNER JOIN users ON feedback.ID_User = users.ID";

$result = mysqli_query($conn, $select_sql);

if (!$result) {
    echo mysqli_error($conn);
}

$penduduk = [];

while ($row = mysqli_fetch_assoc($result)) {
    $penduduk[] = $row;
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ZDN Elecktronik - Feed</title>
    <link rel="stylesheet" href="user-menu2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <style>
        .container{
          background-color:white;
        }


            .customer-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            .customer-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            }

            .customer a:hover {background-color: #ddd;}

            .show {display: block;}
    </style>
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

    <div class = "book" style="padding-top:80px; height:140px; margin-bottom:0; display:flex; align-items:center; justify-content:space-between;">
          <div class = "title">
              <p>Feedback</p>
          </div>
          <div class = "title">
              <a href="user-feed-CREATE.php"><button style="font-size:14px; background-color:#32b2fc;font-family: 'Arial';"  type = "button" class = "btn">Add Comment</button></a>
          </div>
    </div>   
     
    <section style="margin-top:0;   background-image: url('ht3.jpeg');background-repeat: no-repeat;background-attachment: fixed; background-size: cover;" class = "customers" id = "customers">
            <div class = "sec-width">

                <div class = "customers-container">
                <?php $angka = 0; ?>
                  <?php foreach ($penduduk as $KTP) : ?>
                      <!-- single customer -->
                      <?php
                        $hps="";
                        $stail = "white";
                        if($KTP["user"] == $_SESSION["username"] ){
                            $stail = "#d2e3fc";
                            $hps = "myFunction()"; } 
                      ?>



                            <div id="demo<?=$angka;?>" OnClick="<?=$hps;?>"  style="background-color:<?=$stail;?>;" class = "customer">
                            <div id="myDropdown<?=$angka;?>" class="customer-content">
                                <a href="#home">Hapus Komentar</a>
                            </div>
                                <div class = "rating">
                                    <?php $start = $KTP["star"];
                                        $TTL = 5; 
                                        $stt = $TTL - $start;
                                        $i   = 0;?>
                                    <?php while($i<$start) : ?>
                                    <span><i class = "fas fa-star"></i></span>
                                    <?php $i += 1; endwhile; ?>

                                    <?php $i   = 0; while($i<$stt) : ?>
                                    <span><i class = "far fa-star"></i></span>
                                    <?php $i += 1; endwhile; ?>

                                </div>
                                <h3><?= $KTP["user"] ?></h3>
                                <p><?= $KTP["Feed"] ?></p>
                                <span><?= $KTP["waktu"] ?></span>
                            </div>
                            <script>
                                    /* Saat pengguna mengklik tombol,
                                    toggle antara menyembunyikan dan menampilkan konten dropdown */
                                    function myFunction() {
                                    document.getElementById("myDropdown<?=$angka;?>").classList.toggle("show");
                                    }

                                    // Tutup dropdown jika pengguna mengklik di luarnya
                                    window.onclick = function(event) {
                                    if (!event.target.matches('.customer')) {
                                        var dropdowns = document.getElementsByClassName("customer-content");
                                        var i;
                                        for (i = 0; i < dropdowns.length; i++) {
                                        var openDropdown = dropdowns[i];
                                        if (openDropdown.classList.contains('show')) {
                                            openDropdown.classList.remove('show');
                                        }
                                        }
                                    }
                                    }
                            </script>






                      <!-- end of single customer -->

                      <?php $angka++; ?>
                  <?php endforeach; ?>


                </div>
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