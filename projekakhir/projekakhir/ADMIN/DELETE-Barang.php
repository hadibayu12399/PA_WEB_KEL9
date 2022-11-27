<?php
session_start();
require '..\koneksi.php';

$ID = $_GET["ID"];

$delete_sql2 = "SELECT ID_Cabang FROM barang WHERE ID = '$ID'";
$RE = mysqli_query($conn, $delete_sql2);
$DataBarang = [];
while ($row = mysqli_fetch_assoc($RE)) {
    $DataBarang[] = $row;
}
$DataBarang = $DataBarang[0];
$Nama_Barang = $DataBarang['ID_Cabang'];

$delete_sql3 = "SELECT Nama FROM cabang WHERE ID = '$Nama_Barang'";
$RE = mysqli_query($conn, $delete_sql3);
$DataCabang = [];
while ($row = mysqli_fetch_assoc($RE)) {
    $DataCabang[] = $row;
}
$DataCabang = $DataCabang[0];
$Nama_Barang = $DataCabang['Nama'];


$delete_sql = "DELETE FROM barang WHERE ID = '$ID'";
$result = mysqli_query($conn, $delete_sql);

if ($result) {
    echo "<script>
        alert('Data berhasil dihapus!');
        document.location.href = 'Admin-Barang.php?Nama=$Nama_Barang';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus!');
        document.location.href = 'Admin-Barang.php?Nama=$Nama_Barang';
    </script>";
}