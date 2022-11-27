<?php
require '..\koneksi.php';
session_start();

$Cabang = $_GET["Cabang"];
$Cabang_ID = "SELECT ID,Nama FROM cabang Where Nama = '$Cabang'";
$RE = mysqli_query($conn, $Cabang_ID);

$DATA = [];

while ($row = mysqli_fetch_assoc($RE)) {
    $DATA[] = $row;
}

$DATA = $DATA[0];

$Nama_Cabang = $DATA['Nama'];

if (isset($_POST['kirim'])) {
    $ID              = htmlspecialchars($_POST['ID']);
    $ID_Cabang        = $DATA['ID'];
    $Nama            = htmlspecialchars($_POST['Nama']);
    $Harga           = htmlspecialchars($_POST['Harga']);

        // Set File Gambar
        $format_file = $_FILES['gambar']['name'];
        $tmp_name = $_FILES['gambar']['tmp_name'];

        $tipe = explode('.',$format_file);
        $rename = $tipe[0] . '.' . $tipe[1];
        // End Set File Gambar
        
        move_uploaded_file($tmp_name, './../barang/' . $rename);
    
    $insert_sql = "INSERT INTO barang VALUES ('$ID','$ID_Cabang','$Nama',$Harga,'$rename')";
    $result = mysqli_query($conn, $insert_sql);

    if ($result) {
        echo "<script>
            alert('Data berhasil ditambahkan!');
            document.location.href = 'Admin-Barang.php?Nama=$Nama_Cabang';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambahkan!');
            document.location.href = 'CREATE-Barang.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>Create Barang</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email" enctype="multipart/form-data">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Tambah Barang</p>
            <p style="transform: translateX(22px);">ID Barang</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan ID Barang....." name="ID" required>
            </div>
            <p style="transform: translateX(22px);">Nama Barang</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan Nama Barang....." name="Nama" required>
            </div>
            <p style="transform: translateX(22px);">Harga Barang</p>
            <div class="input-group">
                <input type="number"     placeholder="Masukan Harga Barang....." name="Harga" required>
            </div>
            <p style="transform: translateX(22px);">Upload Gambar</p>
            <div class="input-group">
                <input  name="gambar" type="file" accept=".jpg,.jpeg,.png" required>
            </div>
            <div class="input-group">
                <button name="kirim" class="btn">CREATE</button>
            </div>
        </form>
    </div>
</body>
</html>