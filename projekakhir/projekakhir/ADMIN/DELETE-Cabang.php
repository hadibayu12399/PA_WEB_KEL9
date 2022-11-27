<?php
session_start();
require '..\koneksi.php';

$ID = $_GET["ID"];

$delete_sql = "DELETE FROM cabang WHERE ID = '$ID'";
$result = mysqli_query($conn, $delete_sql);

if ($result) {
    echo "<script>
        alert('Data berhasil dihapus!');
        document.location.href = 'Admin-Cabang.php';
    </script>";
} else {
    echo "<script>
        alert('Data gagal dihapus!');
        document.location.href = 'Admin-Cabang.php';
    </script>";
}