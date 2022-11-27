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
    $email = $KTP["email"];
    $old_password       = htmlspecialchars(md5($_POST['old-password']));
    $new_password       = htmlspecialchars(md5($_POST['new-password']));
    $con_new_password   = htmlspecialchars(md5($_POST['con-new-password']));

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$old_password'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        if($new_password == $con_new_password){
            $update_sql = "UPDATE users SET password='$new_password' WHERE id =$ID";
            $result = mysqli_query($conn, $update_sql);

            if ($result) {
                echo "<script>
                        alert('Data berhasil diupdate!');
                        document.location.href = 'user-akun.php';
                    </script>";
            } else {
                echo "<script>alert('Data gagal diupdate!');</script>";
            }
        }
        else {
            echo "<script>alert('Konfirmasi Password Tidak Sesuai')</script>";
        }
    }
    else {
        echo "<script>alert('Password Lama Salah')</script>";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../ADMIN/style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>ZDN Elecktronik - Manage Akun</title>
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
        .input-group #opassword,
        .input-group #cpassword,
        .input-group #password{
            width: 100%;
            font-size: 18px;
            outline: none;
            color: white;
            font-family: 'Poppins',sans-serif;
        }
        .input-group #opassword:hover,
        .input-group #cpassword:hover,
        .input-group #password:hover{
            color: black;

        }

        #opassword::placeholder,
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
        #opassword:valid ~ .show-hide i,
        #cpassword:valid ~ .show-hide i,
        #password:valid ~ .show-hide i{
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800; color:white;">Update Sandi Akun</p>
            <div class="input-group">
                <input type="email"  value="<?= $KTP["email"] ?>"    name="email" readonly>
            </div>
            <p style="transform: translateX(22px);">Kata Sandi Lama</p>
            <div class="input-group">
                <input type="password" id="opassword" placeholder="Kata Sandi Lama" name="old-password" required>
                <span class="show-hide">
                    <i id="bebek" class="fa fa-eye"></i>
                </span>
            </div>
            <script>
                const pass_field3 = document.getElementById("opassword");
                const show_btn3 = document.getElementById("bebek");
                show_btn3.addEventListener("click", function(){
                if(pass_field3.type === "password"){
                    pass_field3.type = "text";
                    show_btn3.classList.add("hide");
                }else{
                    pass_field3.type = "password";
                    show_btn3.classList.remove("hide");
                }
                });
            </script>



            <p style="transform: translateX(22px);">Kata Sandi Baru</p>
            <div class="input-group">
                <input type="password" id="password" placeholder="Kata Sandi Baru" name="new-password" required>
                <span class="show-hide">
                    <i id="ikan" class="fa fa-eye"></i>
                </span>
            </div>
            <script>
                const pass_field = document.getElementById("password");
                const show_btn = document.getElementById("ikan");
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


            <p style="transform: translateX(22px);">Konfirmasi Kata Sandi Baru</p>
            <div class="input-group">
                <input type="password" id="cpassword" placeholder="Konfirmasi Kata Sandi Baru" name="con-new-password" required>
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
                <button name="kirim" class="btn">UPDATE</button>
            </div>
        </form>
    </div>
</body>
</html>