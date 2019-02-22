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

    function _uniord($c) {
        if (ord($c{0}) >=0 && ord($c{0}) <= 127)
            return ord($c{0});
        if (ord($c{0}) >= 192 && ord($c{0}) <= 223)
            return (ord($c{0})-192)*64 + (ord($c{1})-128);
        if (ord($c{0}) >= 224 && ord($c{0}) <= 239)
            return (ord($c{0})-224)*4096 + (ord($c{1})-128)*64 + (ord($c{2})-128);
        if (ord($c{0}) >= 240 && ord($c{0}) <= 247)
            return (ord($c{0})-240)*262144 + (ord($c{1})-128)*4096 + (ord($c{2})-128)*64 + (ord($c{3})-128);
        if (ord($c{0}) >= 248 && ord($c{0}) <= 251)
            return (ord($c{0})-248)*16777216 + (ord($c{1})-128)*262144 + (ord($c{2})-128)*4096 + (ord($c{3})-128)*64 + (ord($c{4})-128);
        if (ord($c{0}) >= 252 && ord($c{0}) <= 253)
            return (ord($c{0})-252)*1073741824 + (ord($c{1})-128)*16777216 + (ord($c{2})-128)*262144 + (ord($c{3})-128)*4096 + (ord($c{4})-128)*64 + (ord($c{5})-128);
        if (ord($c{0}) >= 254 && ord($c{0}) <= 255)    //  error
            return FALSE;
        return 0;
    }
    
    function char_check($c_val) {
        if (($c_val >= 1424 && $c_val <= 1535) || $c_val == 32 || ($c_val >= 8192 && $c_val <= 8303) || $c_val == 95 || ($c_val >= 48 && $c_val <= 57) ||($c_val >= 97 && $c_val <= 122)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /* function quote($t) {
        #10075/6 are already gone at this point
        $quotes = [8216, 8217, 8219, 10076, 10075];
        for ($i = 0, $j = count($quotes); $i < $j; $i++) {
            $q = mb_convert_encoding('&#'.intval($quotes[$i]).';', 'UTF-8', 'HTML-ENTITIES');
            $t = str_replace($q, "'\"'\"'", $t);
        }
        return '"' . $t . '"';
    } */
    
    function t_escape($t) {
        $t_array = preg_split('//u', $t, -1, PREG_SPLIT_NO_EMPTY);
        for ($i = 0, $j = count($t_array); $i < $j; $i++) {
            if (!char_check(_uniord($t_array[$i]))) {
                $t = str_replace($t_array[$i], "", $t);
            }
        }
        return $t;
    }
    
    $tokens = t_escape($tokens);
    $tmpfname = tempnam(getcwd() . "/", "grf");
    chmod($tmpfname, 0644);
	$cmd = "python grapher.py " . $tmpfname . " " . $func . " " . $tokens;
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
