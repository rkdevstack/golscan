<?php ob_start();
session_start();
unset($_SESSION['superadmin']);
unset($_SESSION['admin_user']);

header('location:index.php');?>