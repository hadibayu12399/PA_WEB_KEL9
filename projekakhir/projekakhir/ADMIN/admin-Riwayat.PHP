<?php 
 
require '..\koneksi.php'; 
session_start();
 
if (!isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");}
 

$select_sql = "SELECT transaksi.id,
                users.username as 'Nama User',
                cabang.nama    as 'Nama Cabang',
                barang.nama    as 'Nama Barang',
                barang.harga   as 'Harga Satuan',
                transaksi.Jumlah_Barang  as 'Jumlah Beli',
                Total_Harga from transaksi
                INNER JOIN users  on transaksi.ID_User = users.id
                INNER JOIN barang on transaksi.ID_Barang = barang.ID
                INNER JOIN cabang on barang.ID_Cabang = cabang.ID";

//menampung record sql yang dipilih dalam array
$result = mysqli_query($conn, $select_sql);

if (!$result) {
    echo mysqli_error($conn);
}

$DATA = [];

while ($row = mysqli_fetch_assoc($result)) {
    $DATA[] = $row;
}
?>

<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Admin - Riwayat</title>
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
            max-width: 1200px;
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
            width: 1097px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .tblKiri{
            display: flex;
        }
        .tblKiri form{
            margin-right: 20px;
        }



        table {
            width: 1100px;
            box-sizing: border-box;
            border-collapse: collapse;
            margin-bottom: 100px;
        }

        th,td {
            box-sizing: border-box;
            text-align: center;
            font-size: 12px;
            padding: 5px;
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
            <li><a style="background-color:#1b63ff;" href="#">Info User</a>
                <ul>
                    <li><a href="admin.php"><p >Registrasi</p ></a></li>
                    <li><a style="background-color:#1b63ff;" href="admin-Riwayat.php"><p >Riwayat</p></a></li>
                </ul>
            </li>
            <li><a href="#">Info Barang</a>
                <ul>
                    <li><a href="Admin-Cabang.php"><p >Cabang</p></a></li>
                </ul>
            </li>
            <li><a href="..\LOG-OUT.php" onClick="return confirm ('Yakin?')">Logout</a></li>
            <div class="logo">
                <img src="admin_logo.png" width=40px height=40px>
                <a style="text-decoration: none;" href="Manage-Akun.php"><p> <?=$_SESSION['username']; ?> </p> </a> 
            </div>
        </ul>
    </nav>

    <div class="magin">
        <section class="content">
            <h1 class="title">Riwayat Pembelian</h1>
            <div class="paraTombol">
                
                <div class="tblKiri">
                        <form ACTION="" METHOD="POST" >
                            <select name="salahuddin" class="create">
                                <option nama="jenisSort" value="Askending" >Askending</option>
                                <option nama="jenisSort" value="Deskending">Deskending</option>
                            </select>
                            <button  class="create" type="submit" name="urut"><i class="fas fa-sort"></i>Urutkan Nama</button>
                        </form>
                </div>

                <form ACTION="" METHOD="POST" >
                    <input type="text" name="keyword" style="height: 30px;" placeholder="Masukan keyword pencarian">
                    <button  class="create" type="submit" name="cari"><i class="fas fa-search"></i>Cari Kata</button>
                </form>
            </div>

            <table>
                <tr>
                    <th>Nama User</th>
                    <th style="width: 130px;">Nama Cabang</th>
                    <th>Nama Barang</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah Beli</th>
                    <th>Total Harga</th>
                    <!-- <th>Cetak Resi</th> -->
                    
                </tr>
                <?php foreach ($DATA as $data) : ?>
                    <tr>
                        <td ><?= $data["Nama User"   ] ?></td>
                        <td ><?= $data["Nama Cabang" ] ?></td>
                        <td ><?= $data["Nama Barang" ] ?></td>
                        <td ><?= $data["Harga Satuan"] ?></td>
                        <td ><?= $data["Jumlah Beli" ] ?></td>
                        <td ><?= $data["Total_Harga" ] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </section>
    </div>


</div>
</body>
</html>


