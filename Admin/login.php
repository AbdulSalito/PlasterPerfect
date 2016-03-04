<?php
session_start();
if (!isset($_SESSION['PPadminlogin']) || $_SESSION['PPadminlogin'] !== true) {
	header('Location: loginconfirm.php');
	exit;
}
?>