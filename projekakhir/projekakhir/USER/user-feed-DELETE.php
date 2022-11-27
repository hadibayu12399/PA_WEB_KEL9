<?php
session_start();
require '..\koneksi.php';

$ID = $_GET["IDD"];

$delete_sql = "DELETE FROM feedback WHERE ID = $ID";
$result = mysqli_query($conn, $delete_sql);

if ($result) {
    echo "<script>
        alert('Komentar berhasil dihapus!');
        document.location.href = 'user-feed.php';
    </script>";
} else {
    echo "<script>
        alert('Komentar gagal dihapus!');
        document.location.href = 'user-feed.php';
    </script>";
}