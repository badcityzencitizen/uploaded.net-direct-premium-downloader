<?php
require_once '../lib/Uploaded.php';

$up = new Uploaded();


if(!$up->login('ACC_ID', 'ACC_PW'))
{
	die('Login fehlgeschlagen!');
}

if($up->download('File-ID', 'D:\testD'))
{
	echo 'Download OK';
}
else
{
	echo $up->get_last_errno(), ' ', $up->get_last_error();
	//Errno = UP_ERR_DOWNLOAD_SERVER or UP_ERR_FILE_EXISTS or UP_ERR_FILENAME or UP_ERR_PATH or UP_ERR_404
}

/**
 * Resume Download
 * Nimmt ein Download wieder auf
 */
$opt[UP_RESUME_DOWNLOAD] = true; 

if($up->download('File-ID', 'D:\testD', $opt))
{
	echo 'Download OK';
}
else
{
	echo $up->get_last_errno(), ' ', $up->get_last_error();
	//Errno = UP_ERR_DOWNLOAD_SERVER or UP_ERR_FILE_EXISTS or UP_ERR_FILENAME or UP_ERR_PATH or UP_ERR_404
}

/**
 * Progress-Handler
 */
$opt[UP_PROGRESS_HANDLER] = 'my_progress_handler';

if($up->download('File-ID', 'D:\testD', $opt))
{
	echo 'Download OK';
}
else
{
	echo $up->get_last_errno(), ' ', $up->get_last_error();
	//Errno = UP_ERR_DOWNLOAD_SERVER or UP_ERR_FILE_EXISTS or UP_ERR_FILENAME or UP_ERR_PATH or UP_ERR_404
}

function my_progress_handler($download_size, $download_progress, $upload_size, $upload_progress) {

}

/**
 * Alternavier File-Handler
 */

$opt[UP_FILE_HANDLER] = STDOUT;

//oder auch
$fp = fopen('file.txt', 'w+');

$opt[UP_FILE_HANDLER] = $fp;

if($up->download('File-ID', null, $opt))
{
	echo 'Download OK';
}
else
{
	echo $up->get_last_errno(), ' ', $up->get_last_error();
	//Errno = UP_ERR_DOWNLOAD_SERVER or UP_ERR_FILE_EXISTS or UP_ERR_FILENAME or UP_ERR_PATH or UP_ERR_404
}

fclose($fp);

/**
 * Resume + File-Handler
 */

$opt[UP_RESUME_DOWNLOAD] = true;
$opt[UP_RESUME_START_BYTE] = filesize('file.txt');

$fp = fopen('file.txt', 'w+');
$opt[UP_FILE_HANDLER] = $fp;

if($up->download('File-ID', null, $opt))
{
	echo 'Download OK';
}
else
{
	echo $up->get_last_errno(), ' ', $up->get_last_error();
	//Errno = UP_ERR_DOWNLOAD_SERVER or UP_ERR_FILE_EXISTS or UP_ERR_FILENAME or UP_ERR_PATH or UP_ERR_404
}

fclose($fp);

/**
 * File-Handler Output wird direkt an Browser ausgegeben
 */
$info = $up->get_download_infos('qhvvidj8');

header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename="'.$info['filename'].'"');
header('Content-Length:'.$info['size']);

$opt[UP_FILE_HANDLER] = false;

$up->download('File-ID', null, $opt);