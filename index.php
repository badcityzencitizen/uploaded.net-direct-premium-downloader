<?php 
session_start(); 
$_SESSION['download'] = null;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Download Progress-Demo</title>
<script src="inc/jquery-1.8.2.min.js" ></script>
<style type="text/css">
div {
	padding:5px;
}
#file_id, #file_dir {
	width:300px;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
	$('#download_start').click(function(e) {
        $('#progressbar').val('0');
		$('#msg').html('');
			
		$.ajax({
			type: 'POST',
			url:'start_download.php',
			data: {
				userid: $('#user_id').val(),
				userpw: $('#user_pw').val(),
				fileid: $('#file_id').val(), 
				filedir: $('#file_dir').val()
			}
		})
		.done(function(html) {		
			id = setInterval(function() {
				$.ajax({
					url:'progress.php',
					dataType: 'json'
				})
				.done(function(json) {
					if(json.finish) {
						clearInterval(id);
						$('#progressbar').val('100');
						$('#msg').html('Download Fertig');
					} else if(json.error) {
						$('#msg').html(json.error_msg);
						clearInterval(id);
					}else {
						if(json.size > 0) {
							$('#progressbar').val( json.progess / json.size * 100);
						}
					}
				});
			}, 500);
		});
		
		e.preventDefault();
    });
	
	$('#download_stop').click(function(e) {
		$.ajax({
			url:'progress.php',
			type: 'POST',
			data: {cancel: true}
		});  
    });

});
</script>

</head>

<body>



<div style="padding:10px; font-weight:bold;">
	Nur unter PHP >= 5.3
</div>

<div>
	<div>
    	<div>
            <label for="user_id">
                User-ID
            </label>
        </div>
	    <input type="text" id="user_id">
	</div>
    <div>
    	<div>
            <label for="user_pw">
                User-PW
            </label>
        </div>
	    <input type="password" id="user_pw">
	</div>
    <div>
    	<div>
            <label for="file_id">
                File-ID
            </label>
        </div>
	    <input type="text" id="file_id">
	</div>
    <div>
    	<div>
            <label for="file_dir">
                 Downloadverzeichnis
            </label>
        </div>
        <input type="text" id="file_dir">
    </div>
    <div>
    	<input type="button" name="start" value="Download starten" id="download_start">
        <input type="button" name="stop" value="Download stoppen" id="download_stop">
    </div>
</div>
<div>
	<progress max="100" value="0" id="progressbar"></progress>
    <div id="msg">

    </div>
</div>

</body>
</html>