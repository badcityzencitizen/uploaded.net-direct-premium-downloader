<?php
require_once '../lib/Uploaded.php';

$up = new Uploaded('ACC_ID', 'ACC_PW');

if($up->login_check())
	echo "Login erfolgreich <br>";

$backup_file = $up->backup_file('abcdert');

if($backup_file === false)
{
	echo "Backup Error <br>";
}
else
{
	$file_id 	= $backup_file->auth;
	$file_name 	= $backup_file->filename;
	$file_size	= $backup_file->size;  
}
?>