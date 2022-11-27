<?php 

require '..\koneksi.php'; 
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}

$US = $_SESSION['id'];

$select_sql = "SELECT * FROM users WHERE id = $US";
$result = mysqli_query($conn, $select_sql);

$DATA = [];

while ($row = mysqli_fetch_assoc($result)) {
    $DATA[] = $row;
}

$DATA = $DATA[0];
$id              = $DATA["id"];
$username        = $DATA["username"];
$LastName        = $DATA["LastName"];
$JenisKelamin    = $DATA["JenisKelamin"];
$Umur            = $DATA["Umur"];
$email           = $DATA["email"];
?>

<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Navbar</title>
    <style>
        * {margin:0; padding:0;}
        
        body {
            background-color:#abdbe3;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            font-family:Arial, Helvetica, sans-serif;
            color:#000;
            }

        nav {
            margin:auto;
            text-align: center;
            } 

        nav ul ul {
            display: none;
            }

        nav ul li:hover > ul{
            display: block;
            width: 155px;
            }

        nav ul {
            background: rgba(0, 0, 0, 0.7);
            padding: 0 20px;
            list-style: none;
            position: relative;
            }

        nav ul:after {
            content: ""; 
            clear:both; 
            display: block;
            }

        nav ul li{
            width: 155px;
            float:left;
            }

        nav ul li:hover{
            background: white;
            
            }

        nav ul li:hover a{
            color:black;
            }

        nav ul li a{
            display: block;
            padding: 25px;
            color: #fff;
            text-decoration: none;
            }

        nav ul ul{
        
            background: rgba(0, 0, 0, 0.7);
            
            border-radius: 0px;
            padding: 0;
            position: absolute;
            top:100%;
            }

        nav ul ul li{
        
            float:none;
            border-top: 1px soild #53bd84;
            border-bottom: 1px solid #1b63ff;;
            position: relative;
            
            }

        nav ul ul li a{
            color: #fff;
            padding: 15px 40px;
            
            }

        nav ul ul li a:hover{
            background: white;
            color:black;
            }

        nav ul ul ul{
            color: #fff;
            position: absolute;
            left: 100%;
            top: 0;
            }
        .logo{
            height:67px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            float:right;
            width: 155px;
            }
        .logo p{
            margin-left: 5px;
            color: white;
            font-family:Arial, Helvetica, sans-serif;
            }
        .logo a p:hover{
            color: rgb(245, 188, 199);
            }
        section{
            box-sizing: border-box;
            background-color: rgba(46, 45, 45, 0.7);
            border-radius: 5px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: auto;
            max-width: 800px;
            height: auto;
            }
        .magin{
    
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            max-width: 1200px;
            margin: auto;
            }
        .content {
            margin: 30px;}
        .paraTombol{
            width: 710px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            }

        .tblKiri{
            display: flex;
            }
        .tblKiri form{
            margin-right: 5px;
            }




        .Biodata{
            width: 700px;
            box-sizing: border-box;
            border-collapse: collapse;
            margin-bottom: 40px;

        }


        th,td {
            box-sizing: border-box;
            font-size: 18px;
            padding: 5px;
            height:45px;
        }
        tr{
            background-color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #0084ff;
            color: white;
            padding: 15px;
        }

        button {
            font-size: 12px;
            padding: 10px;
            color: white;
            border: 0;
            border-radius: 10px;
            cursor: pointer;
            margin: 5px;
        }

        button.create {
            color: #0084ff;
            margin: auto;
            height: 40px;
            background-color: rgb(253, 253, 87);
            font-weight: 700;
            margin-bottom: 10px;
        }

        button.create i {
            margin: 5px;
        }

        button.update {
            padding: 10px 15px 10px 15px;
            background-color: #fd7e14;
        }

        button.delete {
            padding: 10px 15px 10px 15px;
            background-color: #df2538;
        }
        button.cetak {
            padding: 10px 15px 10px 15px;
            background-color: #07bcf3;
        }
        button.create:hover,
        button.cetak:hover,
        button.update:hover,
        button.delete:hover {
            filter: brightness(120%);
        }
        .bagiankanan{
            align-items: center;
            display: flex;
            flex-wrap: wrap;
        }

        .bagiankanan button{
            background-color:  rgb(241, 241, 113);
            color: #0084ff;
        }
        .bagiankanan button:hover{
            filter: brightness(120%);
        }
        select{
            border: 0;
            cursor: pointer;
            color: #0084ff;
            margin: auto;
            padding-left: 15px;
            width: 120px;
            height: 40px;
            background-color: rgb(253, 253, 87);
            font-weight: 700;
            margin-bottom: 10px;
            border-radius: 10px;
            }
        select:hover{
            filter: brightness(120%);
            }


        li a p{
            color:white;
            }
        li a:hover p{
            color:black;;
            }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><img src="https://www.pngarts.com/files/4/Hotel-PNG-Image-Background.png" style="padding-top:15px; padding-bottom: 9.1px;" width=40px height=40px alt=""></li>
            <li><a href="admin-dashboard.php">Dashboard</a></li>
            <li><a href="#">Info User</a>
                <ul>
                    <li><a href="admin.php"><p >Info User</p ></a></li>
                    <li><a href="Riwayat.php"><p >Riwayat</p></a></li>
                </ul>
            </li>
            <li><a href="#">Info Reservasi</a>
                <ul>
                    <li><a href="Admin-Hotel.php"><p >Hotel</p></a></li>
                    <li><a href="#"><p >Kamar</p></a></li>
                </ul>
            </li>
            <li><a href="../LOG-OUT.php" onClick="return confirm ('Yakin?')">Logout</a></li>
            <div class="logo">
                <img src="admin_logo.png" width=40px height=40px>
                <a style="text-decoration: none;" href=""><p> <?=$_SESSION['username']; ?> </p> </a> 
            </div>
        </ul>
    </nav>

    <div class="magin">
        <section class="content">



            <h1 style="color: white;" class="title">Profil Admin</h1>
            <table class="Biodata">
                <tr>
                    <td>Nama </td>
                    <td> : </td>
                    <td><?php echo $username." ".$LastName; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin </td>
                    <td> : </td>
                    <td><?php echo $JenisKelamin ?></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir </td>
                    <td> : </td>
                    <td><?php echo $Umur ?></td>
                </tr>
                <tr>
                    <td>Alamat Email </td>
                    <td> : </td>
                    <td><?php echo $email ?></td>
                </tr>
            </table>
 
        </section>
    </div>


</div>
</body>
</html>
