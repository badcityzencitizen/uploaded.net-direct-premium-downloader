<?php
ignore_user_abort(true);
set_time_limit(0);

header('Connection: close', true);
header('Content-Length: 0', true);

ob_end_flush();
flush();

include_once '../../lib/Uploaded.php';

session_start();

$_SESSION['download'] = null;

session_commit();

/**
 * Library Uploaded.net start 
 */

$up = new Uploaded($_POST['userid'], $_POST['userpw']);

$opt = array(
	UP_PROGRESS_HANDLER => 'progress_handler'
	//UP_RESUME_DOWNLOAD => true   --->>> Ohne weiteres möglicht
);

$check = $up->download($_POST['fileid'], $_POST['filedir'], $opt);

/**
 * Library Uploaded.net ende
 */

session_start();

if($check === true) {
	$_SESSION['download'] = array('finish' => true);
}
else
{
	$_SESSION['download']['error'] = true;
	$_SESSION['download']['error_msg'] = $up->get_last_error();
}

session_commit();

function progress_handler($download_size, $download_progress, $upload_size, $upload_progress) {
	session_start();
	
	$cancel = false;
	
	$_SESSION['download']['size'] = $download_size;
	$_SESSION['download']['progess'] = $download_progress;
	$_SESSION['download']['finish'] = false;
	
	if(isset($_SESSION['download']['cancel'])) {
		$_SESSION['download']['error'] = true;
		$_SESSION['download']['error_msg'] = 'Download abgebrochen';
		$cancel = true;
	}
	
	session_commit();
	
	if($cancel)
		exit;	
}