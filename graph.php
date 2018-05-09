<?php 
	$func = $_GET["func"];
	$r_tokens = $_GET['tokens'];
	$tokens = "";
	foreach ($r_tokens as $value) {
		$tokens = $tokens . " " . $value;
	}
	
	if (!$tokens) {
		header('HTTP/1.0 404 Not Found');
		readfile('vos.html');
		exit();
	}
   
    $tmpfname = tempnam(getcwd() . "/", "grf");
    chmod($tmpfname, 0644);
	$cmd = "python grapher.py " . $tmpfname . " " . $func . " " . $tokens;
	$cmd = escapeshellcmd($cmd);
	$output = shell_exec($cmd);
	
	if ((int)$output != 0 || is_null($output) || filesize($tmpfname)==0) {
		header('HTTP/1.0 404 Not Found');
		readfile('vos.html');
		unlink($tmpfname);
		exit();
	} else {
	    readfile($tmpfname);
	    unlink($tmpfname);
	    exit();
	}

?>
