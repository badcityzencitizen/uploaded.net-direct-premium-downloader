<?php

require_once '../lib/Uploaded.php';

// Inialiserung
$up = new Uploaded('ACC_ID', 'ACC_PW');

if(!$up->login_check())
	die("Login fehlgeschlagen");

/*
 * Aufbau File-Objekt
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

*/

/*
 * Gibt alle Dateien aus (siehe Aufbau File-Objekt)
 */
$info = $up->get_files();

var_dump($info);

/*
 * Gibt alle Files mit dem Dateinamen test.zip zurück
 */
$info =  $up->get_files('filename', 'test.zip');

var_dump($info);
var_dump($info[0]->id);


/*
 * Gibt maximal 5 Files mit dem Dateinamen test.txt zurück
 */
$info = $up->get_files('fielname', 'test.txt',  5);

var_dump($info);
var_dump($info[0]->id);
var_dump($info[4]->id);

/*
 * Gibt das File direkt als Objekt zurück
 */
$info = $up->get_files('fielname', 'test.txt',  0);

var_dump($info->id);

/*
 * Gibt für das File test.txt die Eigenschaft ID zurück
 */
$info = $up->get_files('fielname', 'test.txt',  'id');

var_dump($info);

/*
 * Fehler
 */
$info = $up->get_files('xyz', 'test.txt',  'id');

if($info === false)
{
	/*
	 * File-Liste konnte nicht geladen werden
	 * 1. Parameter gibt es in der File-Liste nicht (z.B. xyz (siehe dazu Aufbau File-Objekt))
	 * 2. Parameter gibt es in der File-Liste nicht (z.B. bei $up->get_files('filename', 'test.txt') -> Dateiname test.txt gibt es nicht)
	 * Allgemein wenn ein Parameter in der File-Liste nicht gefunden werden konnte
	 */
	echo "Fehler";
	
}

?>