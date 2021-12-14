<?php

$server   ="localhost";
$username ="root";
$password ="";
$db  ="04_mywebsite_12rpl2";

$koneksi = mysqli_connect($server, $username, $password, $db);

if(!$koneksi) {
    die("koneksi gagal".mysqli_connect_error()."<br>".mysqli_connect_error());
}
//else{
//    echo "Koneksi Berhasil";
//}

?>

