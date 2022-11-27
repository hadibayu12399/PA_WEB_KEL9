<?php 
require 'koneksi.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['username'])) {
    header("Location: LOG-IN.php");
}
 
if (isset($_POST['submit'])) {
    $username       = htmlspecialchars($_POST['username']);
    $LastName       = htmlspecialchars($_POST['LastName']);
    $JenisKelamin   = htmlspecialchars($_POST['JenisKelamin']);
    $Umur           = htmlspecialchars($_POST['Umur']);
    $email          = htmlspecialchars($_POST['email']);
    $password       = htmlspecialchars(md5($_POST['password']));
    $cpassword      = htmlspecialchars(md5($_POST['cpassword']));
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username,LastName,JenisKelamin,Umur, email, password)
                    VALUES ('$username','$LastName','$JenisKelamin','$Umur', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                header("Location: LOG-IN.php");
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Niagahoster Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600&display=swap');
        .input-group{
            height: 50px;
            width: 100%;
            display: flex;
            position: relative;
            margin-bottom: 15px;
            margin-top: 15px;

        }

        .input-group #cpassword,
        .input-group #password{
            width: 100%;
            font-size: 18px;
            outline: none;
            color: white;
            font-family: 'Poppins',sans-serif;
        }
        .input-group #cpassword:hover,
        .input-group #password:hover{
            color: black;

        }


        #cpassword::placeholder,
        #password::placeholder{
            color: #a6a6a6;
        }
        .show-hide{
            position: absolute;
            right: 20px;
            top: 34%;
        }
        .show-hide i{
            color: #0084ff;
            cursor: pointer;
            display: none;
        }
        .show-hide i.hide:before{
            content: '\f070';
        }
        #cpassword:valid ~ .show-hide i,
        #password:valid ~ .show-hide i{
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Register</p>
            <p style="transform: translateX(22px);">Nama Depan</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan Nama Depan......" name="username" value="<?php echo $username; ?>" required>
            </div>
            <p style="transform: translateX(22px);">Nama Belakang</p>
            <div class="input-group">
                <input type="text"     placeholder="Masukan Nama Belakang..." name="LastName">
            </div>
            <div class="input-group">
                <select name="JenisKelamin" style="width=100px">
                    <option  value="Pria">  Pria</option>
                    <option  value="Wanita">Wanita</option>
                </select>
            </div>
            <p style="transform: translateX(22px);">Tanggal Lahir</p>
            <div class="input-group">
                <input  type="date"    placeholder="Tanggal Lahir" name="Umur" required>
            </div>

            <p style="transform: translateX(22px);">Email</p>
            <div class="input-group">
                <input type="email"    placeholder="Masukan Email Anda......" name="email" value="<?php echo $email; ?>" required>
            </div>
            <p style="transform: translateX(22px);">Password</p>
            <div class="input-group">
                <input type="password" placeholder="Masukan Password Anda..." id="password" name="password" value="<?php echo $_POST['password']; ?>" required>
                <span class="show-hide">
                    <i class="fa fa-eye"></i>
                </span>
            </div>
            <script>
                const pass_field = document.getElementById("password");
                const show_btn = document.querySelector("i");
                show_btn.addEventListener("click", function(){
                if(pass_field.type === "password"){
                    pass_field.type = "text";
                    show_btn.classList.add("hide");
                }else{
                    pass_field.type = "password";
                    show_btn.classList.remove("hide");
                }
                });
            </script>



            <p style="transform: translateX(22px);">Confirm Password</p>

            <div class="input-group" >
                <input type="password" placeholder="Confirm Password Anda..." id="cpassword" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
                <span class="show-hide">
                    <i id="ayam" class="fa fa-eye"></i>
                </span>
            </div>
            <script>
                const pass_field2 = document.getElementById("cpassword");
                const show_btn2 = document.getElementById("ayam");
                show_btn2.addEventListener("click", function(){
                if(pass_field2.type === "password"){
                    pass_field2.type = "text";
                    show_btn2.classList.add("hide");
                }else{
                    pass_field2.type = "password";
                    show_btn2.classList.remove("hide");
                }
                });
            </script>







            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Sudah punya akun? <a href="LOG-IN.php">Login Disini </a></p>
        </form>
    </div>
</body>
</html>