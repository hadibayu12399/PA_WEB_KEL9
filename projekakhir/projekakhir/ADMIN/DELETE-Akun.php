<?php
require '..\koneksi.php';
session_start();
//pilih id untuk di hapus
$ID = $_GET["id"];
$delete_sql = "DELETE FROM users WHERE ID = '$ID'";
$result = mysqli_query($conn, $delete_sql);

if ($result) {
    echo "<script>
        alert('Akun berhasil dihapus!');
        document.location.href = 'LOG-OUT.php';
    </script>";
} else {
    echo "<script>
        alert('Akun gagal dihapus!');
        document.location.href = 'user-akun.php';
    </script>";
}