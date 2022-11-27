<?php 
 
require 'koneksi.php';
 
error_reporting(0);
 
session_start();



if (isset($_SESSION['submit'])) {
    header("Location: home.php");
}
 
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    //enkripsi password md5
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {//cek count record
        $row = mysqli_fetch_assoc($result);

        //menyimpan beberapa variabel ke SERVER agar bisa digunakan kapanpun
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];

        if($email == "admin@gmail.com"){ //login admin      
            echo "<script>
            alert('Login berhasil!');
            document.location.href = 'ADMIN/admin-dashboard.php';
          </script>";}

          //Login USer
        echo "<script>
                alert('Login berhasil!');
                document.location.href = 'USER/user.php';
              </script>";
    } else {
        echo "<script>alert('Email atau password Anda salah. Silahkan coba lagi!')</script>";
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
    <title>Halaman Login</title>
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
        .input-group #password{
            width: 100%;
            font-size: 18px;
            outline: none;
            color: white;
            font-family: 'Poppins',sans-serif;
        }

        .input-group #password:hover{
            color: black;

        }

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

        #password:valid ~ .show-hide i{
            display: block;
        }
    </style>
</head>
<body>
    <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
    </div>
 
    <div class="container" >
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800 ; color:white;">Login</p>
            <div class="input-group">
                <input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" id="password" name="password" value="<?php echo $_POST['password']; ?>" required>
                <span class="show-hide">
                    <i id="ayam" class="fa fa-eye"></i>
                </span>
            </div>
            <script>
                const pass_field2 = document.getElementById("password");
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
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Belum punya akun? <a href="REGIST.php">Registerasi Disini</a></p>
        </form>
    </div>
</body>
</html>