<?php

require_once '../lib/Uploaded.php';

$up = new Uploaded('ACC_ID', 'ACC_PW');

if(!$up->login_check())
	die("Login fehlgeschlagen");

$files = $up->get_folder_files("Mein Ordner");

if($files == null)
	die("Keine Dateien im Ordner");
	
for($i = 0, $c = count($files); $i < $c; $i++)
{
	echo 'Dateiname: ' . $files[$i]->filename . '<br>';
}