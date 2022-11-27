<?php
require '..\koneksi.php';
session_start();

$ID = $_GET["ID"];
$select_sql = "SELECT * FROM cabang WHERE ID ='$ID'";
$result = mysqli_query($conn, $select_sql);

$KTP = [];

while ($row = mysqli_fetch_assoc($result)) {
    $KTP[] = $row;
}

$KTP = $KTP[0];

if (isset($_POST["kirim"])) {
    $Nama            = htmlspecialchars($_POST['Nama']);
    $Lokasi          = htmlspecialchars($_POST['Lokasi']);
    $Telepon         = htmlspecialchars($_POST['Telepon']);
    
    $update_sql = "UPDATE cabang SET
                   Nama='$Nama',
                   Lokasi='$Lokasi',
                   Telepon='$Telepon'
                   WHERE ID ='$ID'";

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        echo "<script>
            alert('Data berhasil diupdate!');
            document.location.href = 'Admin-Cabang.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diupdate!');
            document.location.href = 'UPDATE-Cabang.php';
        </script>";
    }}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style2.css">
 
    <title>Update Cabang</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Ubah Cabang</p>
            <p style="transform: translateX(22px);">Nama Cabang</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan Nama Hotel..." value="<?= $KTP["Nama"] ?>"   name="Nama" required>
            </div>
            <p style="transform: translateX(22px);">Lokasi Cabang</p>
            <div class="input-group">
                <input type="text"    placeholder="Masukan Lokasi Hotel.." value="<?= $KTP["Lokasi"] ?>" name="Lokasi" required>
            </div>
            <p style="transform: translateX(22px);">No Telepon</p>
            <div class="input-group">
                <input type="text" placeholder="Masukan No Telepon..." value="<?= $KTP["Telepon"] ?>"    name="Telepon" required>
            </div>
            <div class="input-group">
                <button name="kirim" class="btn">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>