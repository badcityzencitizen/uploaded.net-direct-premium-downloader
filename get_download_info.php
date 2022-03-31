<?php
require_once '../lib/Uploaded.php';

$up = new Uploaded();


if(!$up->login('ACC_ID', 'ACC_PW'))
{
	die('Login fehlgeschlagen!');
}

$info = $up->get_download_infos('File-ID');

if($info === false) 
{
	echo 'Ein Fehler ist aufgetretten. <br>';
	echo $up->get_last_errno(). ': '.$up->get_last_error();
}
else
{
	echo 'Filename: '.$info['filename'].'<br>'; 	//String -> Dateiname
	echo 'Filesize: '.$info['size'].'<br>';			//Int -> Dateigröße in byte
}