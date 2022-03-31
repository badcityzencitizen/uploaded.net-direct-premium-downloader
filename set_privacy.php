<?php
require_once '../lib/Uploaded.php';

$up = new Uploaded('ACC_ID', 'ACC_PW');

if(!$up->login_check())
	die("Login fehlgeschlagen");

// Alle 
$up->set_privacy("File-Id", UP_PRIVACY_NONE);

//Download nur mit PW
$up->set_privacy("File-Id", UP_PRIVACY_PW, "1234");

//Download nur von meinen Account möglich
$up->set_privacy("File-Id", UP_PRIVACY_PRIVATE);


if(!$up->set_privacy("File-Id", UP_PRIVACY_PW, "1234"))
{
	echo $up->get_last_errno()." ".$up->get_last_error();
}
?>