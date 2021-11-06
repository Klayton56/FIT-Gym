<?php
session_start();
$_SESSION['u']="";
$_SESSION['p']="";
header("Location: login.php");
?> 