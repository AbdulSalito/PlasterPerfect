<?php
	session_start();
if (isset($_SESSION['PPadminlogin'])) {
	unset($_SESSION['PPadminlogin']);
}
header('Location: index.php');
exit;


?>