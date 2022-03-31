<?php

set_time_limit(0);

require_once '../lib/Uploaded.php';

/**
 * Beispiel Free-User
 */

// Inialiserung
$up = new Uploaded();

//Login
if(!$up->login('ACC_ID', 'ACC_PW'))
{
	die("Login fehlgeschlagen!");
}

//Uploadvorgang starten

$info = $up->upload('D:\test.c'); //Gibt im Erfolg File-ID und EditKey zurück
	
if($info !== false)
{
	echo "Upload erfolgreich! <br>";
	echo "File-ID: ".$info['id']."<br>";
	echo "EditKey: ".$info['editKey']."<br>";	
}
else
{
	echo "Upload fehlgeschlagen <br>";
	
	echo $up->get_last_errno(), ": ", $up->get_last_error();
	//Errno: UP_ERR_PATH or UP_ERR_INTERNAL or UP_ERR_LOGIN
}
?>