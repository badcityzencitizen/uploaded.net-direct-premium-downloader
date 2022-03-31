<?php
require_once '../lib/Uploaded.php';

$up = new Uploaded('ACC_ID', 'ACC_PW');

if($up->login_check())
	echo "Login erfolgreich <br>";

$info = $up->add_import('http://uploaded.to/file/File-ID');
//Oder
$info = $up->add_import(array('http://ul.to/File-ID', 'http://ul.to/File-ID'));

foreach($info as $i)
{
	if(!isset($i->err))
	{
		echo "Import: ".$i->filename." erfolgreich";
		echo "neue File-ID: ".$i->newAuth;
	}
	else
	{
		echo "Import fehlgeschlagen!";
		echo "Error: ".$i->err;
	}
}

/*
 * z.B
 * 
 * array
 * 0 => 
 *   object(stdClass)[2]
 *     public 'auth' => string '91tm51j0' (length=8)
 *     public 'newAuth' => string 'nlpip8kk' (length=8)
 *     public 'filename' => string 'Cisterna.rar' (length=12)
 *     public 'size' => string '2,34 MB' (length=7)
 *     
 *  ODER
 * 
 * 
 * array
 *	  0 => 
 *	    object(stdClass)[2]
 *      public 'auth' => string 'File_ID' (length=8)
 *      public 'filename' => string 'Dateiname' (length=36)
 *      public 'size' => string 'Größe' (length=7)
 *      public 'err' => string 'bereits Ihnen zustehend' (length=23)
 * 
 * Mögliche err:
 * - bereits Ihnen zustehend
 * - link must contain http://uploaded.to/ or http://ul.to/
 * 
 * 
 * 
 */
?>