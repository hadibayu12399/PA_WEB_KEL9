<?php 

require 'koneksi.php';
session_start();
session_destroy();
 
header("Location: LOG-IN.php");
 
?>