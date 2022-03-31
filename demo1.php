<?php

require_once '../lib/Uploaded.php';

/**
 * Beispiel Free-User
 */

// Inialiserung
$up = new Uploaded();

//Uploadvorgang starten
$info = $up->upload('C:\test.txt'); //Gibt im Erfolg File-ID und EditKey zurück

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

/**
 * Beispeil Premium-User 
 */

$up = new Uploaded('ACC_ID', 'ACC_PW');

if($up->login_check())
	echo "Login erfolgreich";
	
//Uploadvorgang starten
$info = $up->upload('C:\test.txt'); //Gibt im Erfolg File-ID und EditKey zurück (siehe Beispiel Free-User)

//Remote Upload starten
$up->add_remote_upload('http://test.de/upload.zip');

//Gibt alle Files des Accounts zurück als Objektarray!
$up->get_files();

//Gibt alle Files mit dem namen test.txt zurück
$up->get_files('fielname', 'test.txt');

//Gibt maximal 5 Files mit dem namen test.txt zurück
$up->get_files('fielname', 'test.txt',  5);

//Gibt das File direkt als Objekt zurück
$up->get_files('fielname', 'test.txt',  0);

//Gibt für das File test.txt die Eigenschaft ID zurück
$up->get_files('fielname', 'test.txt',  'id');

//Erstellt einen Ordner
$up->create_folder('Test'); //Gibt Folder-ID zurück

//Verschiebt eine Datei in einen Ordner
$up->move_to_folder('FILE-ID', 'FOLDER-ID');

//Verschiebt eine Datei in einen Ordner #2
$up->move_to_folder($up->get_files('filename', 'test.txt', 'id'), $up->get_folders('title', 'Test Ordner', 'id'));

//Löscht einen Ordner
$up->delete_folder('FOLDER-ID');

//Löscht eine Datei
$up->delete_file('File-ID');

//Benennt eine Datei um
$up->set_file_name('File-ID', 'Dateiname mit Erweiterung! z.b. test.txt');

//Bennent einen Ordner um
$up->set_folder_name('Folder-ID', 'Ordnername');

/**
 * File-Objekt
 * 
array
  0 => 
    object(stdClass)
      public 'id' => string 'File-ID'
      public 'date' => string '27 Minuten'
      public 'filename' => string 'Dateiname mit Erweiterung'
      public 'desc' => null
      public 'size' => string '1,13 KB'
      public 'admin' => string 'EditKey'
      public 'file_extension' => string '.zip'
      public 'dls' => string '0'
      public 'lastdownload' => string 'kein Eintrag vorhanden'
      public 'privacy' => string ''
      public 'ddl' => boolean false
      public 'available' => boolean true
  1 => 
    object(stdClass)
      public 'id' => string 'File-ID'
      ...

Zugriff:

$obj[0]->id
*/

/**
 * Folder-Objekt
 * 
array
  0 => 
    object(stdClass)
      public 'id' => string 'Folder-ID'
      public 'title' => string 'name des Ordners'
      public 'files' => string '0'
      public 'ispublic' => boolean false
  1 => 
    object(stdClass)
      public 'id' => string 'Folder-ID'
      
Zugriff:
$obj[0]->id
 */
?>