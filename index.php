<?php
include 'koneksi.php';

if(!isset($_SESSION['username'])){
    header("Location:login.php");
}
else{
    header("Location:dashboard.php");
}
?>