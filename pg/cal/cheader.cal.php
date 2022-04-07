<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once 'database.php';
include_once 'var.php';
include_once 'shamsi.date.cal.php';
include_once 'functions.cal.php';


if (isset($_SESSION['u_uid'])){
  $uid = $_SESSION['u_uid'];
  $upost = $_SESSION['u_upost'];
}

if (isset($_POST['f'])) {
  $_POST['f']();
}


?>
