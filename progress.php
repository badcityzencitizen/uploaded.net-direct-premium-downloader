<?php
session_start();

if(isset($_POST['cancel'])) {
	$_SESSION['download']['cancel'] = true;
}

echo json_encode($_SESSION['download']);