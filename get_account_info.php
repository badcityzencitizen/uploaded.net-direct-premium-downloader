<?php
require_once '../lib/Uploaded.php';

$up = new Uploaded();


if(!$up->login('ACC_ID', 'ACC_PW'))
{
	die("Login fehlgeschlagen!");
}

$info = $up->get_account_info();

if(isset($info['err'])) 
{
	echo "Ein Fehler ist aufgetretten.<br>";
	echo $info['err'];
}
else 
{
	echo 'Account-ID: '.$info['id'].'<br>';					//Int
	echo 'Account Erstellt: '.$info['created'].'<br>';		//Int -> Datum in Unix Timestamp
	echo 'Account Alias: '.$info['alias'].'<br>';			//String
	echo 'Account Email: '.$info['email'].'<br>';			//String
	echo 'Account Status: '.$info['acc_status'].'<br>';		//String -> Premium|Free
	echo 'Download Traffic: '.$info['traffic'].'<br>';		//Int -> in Byte
	echo 'Premium läuft aus am: '.$info['expire'].'<br>';	//Int -> Datum in Unix Timestamp
	echo 'Punkte: '.$info['points'].'<br>';					//Int
	echo 'Guthaben: '.$info['credit'].'<br>';				//Float
}

/*
 * Aufbau
 * 
 * array (size=9)
 *   'id' => int 423000
 *   'created' => int 1234797283
 *   'alias' => string 'aliasname'
 *   'email' => string 'test@it-gecko.de'
 *   'acc_status' => string 'premium'
 *   'traffic' => float 676247379642
 *   'expire' => int 1352139430
 *   'credit' => float 149.21
 *   'points' => int 35371
 */

?>