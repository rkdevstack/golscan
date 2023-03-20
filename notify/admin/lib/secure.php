<?php
session_start();
if(empty($_SESSION['superadmin'] || $_SESSION['subadmin'])){
	//session_destroy();
	unset($_SESSION['superadmin']);
    unset($_SESSION['subadmin']);
	header('location:index.php');
}
