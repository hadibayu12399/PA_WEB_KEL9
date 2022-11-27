<?php
require '..\koneksi.php';
session_start();

$ID = $_GET["id"];
$select_sql = "SELECT * FROM users WHERE ID =$ID";
$result = mysqli_query($conn, $select_sql);

$KTP = [];

while ($row = mysqli_fetch_assoc($result)) {
    $KTP[] = $row;
}

$KTP = $KTP[0];


if (isset($_POST["kirim"])) {
    $username       = htmlspecialchars($_POST['username']);
    $LastName       = htmlspecialchars($_POST['LastName']);
    $JenisKelamin   = htmlspecialchars($_POST['JenisKelamin']);
    $Umur           = htmlspecialchars($_POST['Umur']);
    $email          = htmlspecialchars($_POST['email']);

    $update_sql = "UPDATE users SET
                   username='$username',
                   LastName='$LastName',
                   JenisKelamin='$JenisKelamin',
                   Umur='$Umur',
                   email='$email'
                   WHERE id =$ID";

    $result = mysqli_query($conn, $update_sql);

    if ($result) {
        echo "<script>
            alert('Data berhasil diupdate!');
            document.location.href = 'user-akun.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diupdate!');
            document.location.href = 'user-akun.php';
        </script>";
    }}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ADMIN/style2.css">
 
    <title>Update Hotel</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Update Akun</p>
            <p style="transform: translateX(22px);">Nama Depan</p>
            <div class="input-group">
                <input type="text" placeholder="Masukan Nama Depan...- "value="<?= $KTP["username"] ?>"   name="username" required>
            </div>
            <p style="transform: translateX(22px);">Nama Belakang</p>
            <div class="input-group">
                <input type="text" placeholder="Masukan nama Belakang.."value="<?= $KTP["LastName"] ?>" name="LastName">
            </div>
            <p style="transform: translateX(22px);">Jenis Kelamin</p>
            <div class="input-group">
                <select name="JenisKelamin" value="<?= $KTP["JenisKelamin"] ?>">
                    <option  value="Pria">  Pria</option>
                    <option  value="Wanita">Wanita</option>
                </select>
            </div>
            <p style="transform: translateX(22px);">Tanggal Lahir</p>
            <div class="input-group">
                <input type="date" value="<?= $KTP["Umur"] ?>"    name="Umur" >
            </div>
            <p style="transform: translateX(22px);">Alamat Email</p>
            <div class="input-group">
                <input type="email" placeholder="Masukan Alamat Email.." value="<?= $KTP["email"] ?>"    name="email" required>
            </div>
            <div class="input-group">
                <button name="kirim" class="btn">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>