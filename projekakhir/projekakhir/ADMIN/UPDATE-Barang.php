<?php
require '..\koneksi.php';
session_start();

$ID = $_GET["ID"];
$select_sql = "SELECT * FROM barang WHERE ID ='$ID'";
$result = mysqli_query($conn, $select_sql);

$DATA_BARANG = [];

while ($row = mysqli_fetch_assoc($result)) {
    $DATA_BARANG[] = $row;
}
$DATA_BARANG = $DATA_BARANG[0];



$ID_CABANG = $DATA_BARANG['ID_Cabang'];

$updt_sql = "SELECT Nama FROM cabang WHERE ID = '$ID_CABANG'";
$RE = mysqli_query($conn, $updt_sql);
$DATA_CABANG = [];
while ($row = mysqli_fetch_assoc($RE)) {
    $DATA_CABANG[] = $row;}
$DATA_CABANG = $DATA_CABANG[0];
$Nama_Cabang = $DATA_CABANG['Nama'];




if (isset($_POST["kirim"])) {
    $ID              = htmlspecialchars($_POST['ID']);
    $ID_Cabang       = $ID_CABANG;
    $Nama            = htmlspecialchars($_POST['Nama']);
    $Harga           = htmlspecialchars($_POST['Harga']);

      // Set File Gambar
      $rename = $DATA_BARANG['gambar'];
      if($_FILES['gambar']['size'] != 0) {
          $format_file = $_FILES['gambar']['name'];
          $tmp_name = $_FILES['gambar']['tmp_name'];
  
          $tipe = explode('.',$format_file);
          $rename = $tipe[0] . '.' . $tipe[1];
          move_uploaded_file($tmp_name, './../barang/' . $rename);
      }
      // End Set File Gambar
    $update_sql = "UPDATE barang SET
                   Nama     ='$Nama',
                   Harga    ='$Harga',
                   Gambar   ='$rename'
                   WHERE ID ='$ID'";

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        echo "<script>
            alert('Data berhasil diupdate!');
            document.location.href = 'Admin-Barang.php?Nama=$Nama_Cabang';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diupdate!');
            document.location.href = 'Admin-Barang.php?Nama=$Nama_Cabang';
        </script>";
    }}
?>

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <title>Create Hotel</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email" enctype="multipart/form-data">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Ubah Barang</p>
            <p style="transform: translateX(22px);">ID Barang</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan ID Hotel....."  name="ID" value="<?= $DATA_BARANG["ID"]?>" readonly>
            </div>
            <p style="transform: translateX(22px);">Nama Barang</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan ID Hotel....."  name="Nama" value="<?= $DATA_BARANG["Nama"]?>">
            </div>
            <p style="transform: translateX(22px);">Harga Barang</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan ID Hotel....."  name="Harga" value="<?= $DATA_BARANG["Harga"]?>">
            </div>
            <p style="transform: translateX(22px);">Upload Gambar</p>
            <div class="input-group">
                <input  name="gambar" type="file" accept=".jpg,.jpeg,.png" required>
            </div>
            <div class="input-group">
                <button name="kirim" class="btn">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>