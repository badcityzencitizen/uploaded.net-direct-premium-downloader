<?php

require_once '../lib/Uploaded.php';

/**
 * Beispiel Free-User
 */

// Inialiserung
$up = new Uploaded();

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
	echo "Upload fehlgeschlagen";
}

?>