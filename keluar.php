<?php
session_start();
require("includes/config.php");
// disini kita bakal menghancurkan session yg bernama username yg dibuat pas kita login.
if(isset($_SESSION['username'])){ // jika 'username' sudah diset, maka...
 unset($_SESSION['username']); // kita hancurkan 'username' yg sudah di 'ISSET' tadi menggunakan 'UNSET'
 header("location:../index.php"); // kita bawa adminnya ke index.php
}
?>