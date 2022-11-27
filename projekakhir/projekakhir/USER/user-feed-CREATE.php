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
    $str   = htmlspecialchars($_POST['rate']);
    $insert_sql = "INSERT INTO feedback VALUES ('','$idd','$komen','$waktu',$str)";
    $result = mysqli_query($conn, $insert_sql);
    if ($result) {
        echo "<script>
            alert('Komentar berhasil ditambahkan!');
            document.location.href = 'user-feed.php';
        </script>";
    } else {
        echo "<script>
            alert('Komentar gagal ditambahkan!');
            document.location.href = 'user-feed-CREATE.php';
        </script>";
    }

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
        .tmpat{
            margin: 100px auto;
            margin-bottom: 50px;
            background: #363636;
            padding:50px;
            border-radius:1%;
            width:50%;
        }
        .rate {

            margin:auto;
            height: 46px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:50px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
        #komen{
            display:flex;
            flex-direction:column;
        }
        button {
            font-size: 12px;
            
            color: white;
            border: 0;
            border-radius: 10px;
            cursor: pointer;
            margin: 5px;
        }

        button.create {
            margin-top:45px;
            color: #0084ff;
            height: 40px;
            background-color: rgb(253, 253, 87);
            font-weight: 700;
            font-size: 17px;
        }

        button.create i {
            margin: 5px;
            
        }
        button.create:hover,
        button.cetak:hover,
        button.update:hover,
        button.delete:hover {
            filter: brightness(120%);
        }
        @media screen and (max-width:1200px){
            .tmpat{
                width:60%;
                padding:50px;

        }
            textarea{
                rows="10";
            }

        }
        @media screen and (max-width:900px){
            .tmpat{
                width:70%;
                padding:40px;

        }
            textarea{
                rows:10;
            }
        }
        @media screen and (max-width:800px){
            .tmpat{
                width:80%;
                padding:30px;
        }
            textarea{
                rows:9;
            }
        }
        @media screen and (max-width:600px){
            .tmpat{
                width:90%;
                padding:20px;
        }
            textarea{
                rows:8;
            }
        }
        @media screen and (max-width:550px){
            .tmpat{
                width:95%;
                padding:10px;
        }
            textarea{
                rows:7;
            }
        }
    </style>
  </head>
  <body style="margin-top:0;   background-image: url('ht3.jpeg');background-repeat: no-repeat;background-attachment: fixed; background-size: cover;">
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
    <div class="tmpat">
        <section class="content2">
            <form id="komen" ACTION="" METHOD="POST" >
                <textarea name="komentar" id="" cols="45" rows="12" required></textarea>
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value=5 required/>
                    <label for="star5" title="text">5 stars</label>

                    <input type="radio" id="star4" name="rate" value=4 />
                    <label for="star4" title="text">4 stars</label>

                    <input type="radio" id="star3" name="rate" value=3 />
                    <label for="star3" title="text">3 stars</label>

                    <input type="radio" id="star2" name="rate" value=2 />
                    <label for="star2" title="text">2 stars</label>

                    <input type="radio" id="star1" name="rate" value=1 />
                    <label for="star1" title="text">1 star</label>
                </div>
                <button class="create" type="submit" name="koemen"><i class="fas fa-share"></i>Komen</button>
            </form>
        </section>

    </div>
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