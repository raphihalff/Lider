<?php
require_once '/your/path/to/entry_pass.php';
# Upload files
function uploadFile($file, $new_name, $is_img) {
	$target_dir = ($is_img ? "images/" : "readings/");
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($_FILES[$file]["name"],PATHINFO_EXTENSION));
	$target_file = $target_dir . $new_name . "." . $imageFileType;

	// Check if file already exists
	if (file_exists($target_file)) {
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES[$file]["size"] > 25000000) {
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 1) {
		if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {

		} else {
		    echo "Sorry, there was an error uploading your file.";
		}
	}
}

# Handling the poem
function getPoemCode($poet_name, $isnew) {
	$poet_code = "";
	$index = 0;

	if (!$isnew) {
      // Create connection
      require_once '/your/path/to/mysql_config.php';
      $mysql = new mysqli($servername, $username, $password, $dbname);
      $mysql->set_charset('utf8');
      // Check connection
      if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
      }
      $sql = "SELECT MAX(poem) AS poem FROM poem WHERE poet='" .$poet_name . "'";
      $poet_code =  $results = $mysql->query($sql)->fetch_assoc()['poem'];
      $index = (int)substr($poet_code, strrpos($poet_code, "_") + 1) + 1;
      $poet_code = substr($poet_code, 0, strrpos($poet_code, "_"));
	} else {
		$poet_code = strtolower($poet_name);
		$poet_code = str_replace(".","",$poet_code);
		$poet_code = str_replace(" ","_",$poet_code);
		$index = 0;
	}
	if (file_exists("unprocessed")) {
		$unproc = fopen("unprocessed", "r");
		while(!feof($unproc)) {
			$line = explode(' ', fgets($unproc));
	  		if ($line[0] == $poet_code) {
	  			if ((int)$line[1] >= $index) {
	  				$index = (int)$line[1] + 1;
	  			}
	  		}
		}
		fclose($unproc);
	}
	$unproc = fopen("unprocessed", "a");
	fwrite($unproc, $poet_code . " " . $index . "\n");
	fclose($unproc);
	return $poet_code . "_"  . $index;
}

function process() {
	# MAKE POEM
	/*
		poem title_y title_e poet translator reader date text_y
		text_e context rec img source
	*/
	$make_poet = False;
	$title_y = ($_POST['title_yid'] ? $_POST['title_yid'] : '\N');
	$title_e = ($_POST['title_eng'] ? $_POST['title_eng'] : '\N');
	# check if poet is new
	$poet = $_POST['poet_eng'];
	$new_poet = ($_POST['new_poet_eng'] ? $_POST['new_poet_eng'] : '\N');
	$trans = ($_POST['translator'] ? $_POST['translator'] : '\N');
	$reader = ($_POST['reader'] ? $_POST['reader'] : '\N');
	$date = ($_POST['year'] ? $_POST['year'] : '0000') . '-' . ($_POST['month'] ? $_POST['month'] : '00') . '-' . ($_POST['date'] ? $_POST['date'] : '00');
	$text_y = ($_POST['poem_yid'] ? $_POST['poem_yid'] : '\N');
	$text_e = ($_POST['poem_eng'] ? $_POST['poem_eng'] : '\N');
	$con = ($_POST['con'] ? $_POST['con'] : '\N');
	$con_src = ($_POST['con_img_credit'] ? $_POST['con_img_credit'] : '\N');
	$src = ($_POST['poem_source'] ? $_POST['poem_source'] : '\N');

	if ($poet == "new") {
		$poem = getPoemCode($new_poet, True);
		$poet = $new_poet;
		$make_poet = True;
	} else {
		$poem = getPoemCode($poet, False);
	}

	#upload rec and rename file to poem code + ext
	$rec = ($_FILES['rec']['name'] ? ($poem . "." . strtolower(pathinfo($_FILES['rec']["name"],PATHINFO_EXTENSION))) : '\N');
	if ($rec != '\N') {
		uploadFile("rec", $poem, False);
	}
	#uplaod con_img and rename file to poem code + ext
	$con_img = ($_FILES['con_img']['name'] ? ($poem . "." . strtolower(pathinfo($_FILES['con_img']["name"],PATHINFO_EXTENSION))) : '\N');
	if ($con_img != '\N') {
		uploadFile("con_img", $poem, True);
	}

	# write to file
	$poem_f = fopen("new_poems", "a");
	fwrite($poem_f, $poem . "@" . $title_y . "@" . $title_e . "@" . $poet . "@" . $trans . "@" . $reader . "@" . $date . "@" . $text_y . "@" . $text_e . "@" . $con . "@" . $rec . "@" . $con_img . "@" . $con_src . "@" . $src . "@0" . "@@\n@@");
	fclose($poem_f);

	# MAKE POET
	/*
		name_y name_e birth death bio img
	*/
	if ($make_poet) {
		$poet_y = ($_POST['new_poet_yid'] ? $_POST['new_poet_yid'] : '\N');
		$b_date = ($_POST['b_year'] ? $_POST['b_year'] : '0000') . '-' . ($_POST['b_month'] ? $_POST['b_month'] : '00') . '-'. ($_POST['b_date'] ? $_POST['b_date'] : '00');
		$d_date = ($_POST['d_year'] ? $_POST['d_year'] : '0000') . '-' . ($_POST['d_month'] ? $_POST['d_month'] : '00') . '-'. ($_POST['d_date'] ? $_POST['d_date'] : '00');
		$bio = ($_POST['bio'] ? $_POST['bio'] : '\N');
		$poet_img_credit = ($_POST['poet_img_credit'] ? $_POST['poet_img_credit'] : '\N');

		#upload rec and rename file to poet code + ext
		$poet_code = strtolower($poet);
		$poet_code = str_replace(".","",$poet_code);
		$poet_code = str_replace(" ","_",$poet_code);
		$poet_img = ($_FILES['poet_img']['name'] ? ($poet_code . "." . strtolower(pathinfo($_FILES['poet_img']["name"],PATHINFO_EXTENSION))) : '\N');
		if ($poet_img != '\N') {

			uploadFile("poet_img", $poet_code, True);
		}

		# write to file
		$poet_f = fopen("new_poets", "a");
		fwrite($poet_f, $poet_y . "@" . $poet . "@" . $b_date . "@" . $d_date . "@" . $bio . "@" . $poet_img . "@" . $poet_img_credit . "@@\n@@");
		fclose($poet_f);

		# MAKE BIO LINKS
		/*
			poet descr link
		*/
		$bio_links = "";
		for ($x = 0; $x <= count($_POST['poetlink']); $x++) {
			if ($_POST['poetlink'][$x]) {
				$bio_links = $bio_links . $poet . "@" . $_POST['poetlink_title'][$x] . "@" . $_POST['poetlink'][$x] . "@@\n@@";
			}
		}
		if ($bio_links) {
			# write to file
			$bio_links_f = fopen("new_bio_links", "a");
			fwrite($bio_links_f, $bio_links);
			fclose($bio_links_f);
		}
	}

	# MAKE POEM LINKS
	/*
		poem descr link type
	*/
	$poem_links = "";
	for ($x = 0; $x <= count($_POST['poemlink']); $x++) {
		if ($_POST['poemlink'][$x]) {
			$poem_links = $poem_links . $poem . "@" . $_POST['poemlink_title'][$x] . "@" . $_POST['poemlink'][$x] . "@poem@@\n@@";
		}
	}
	$con_links = "";
	for ($x = 0; $x <= count($_POST['conlink']); $x++) {
		if ($_POST['conlink'][$x]) {
			$con_links = $con_links . $poem . "@" . $_POST['conlink_title'][$x] . "@" . $_POST['conlink'][$x] . "@context@@\n@@";
		}
	}

	if ($poem_links || $con_links) {
		# write to file
		$poem_links_f = fopen("new_poem_links", "a");
		fwrite($poem_links_f, $poem_links . $con_links);
		fclose($poem_links_f);
	}
	readfile('dank.html');
	mail("balebos@xn--7dbli0a4a.us.org","Poem Submitted", "User: " . $_POST['user'] . " submitted " . $poem );
	return $poem;
}

if ($_POST['pwd'] == $contrib_pass) {
	$poem = process();
	$log_f = fopen("contrib_log", "a");
	fwrite($log_f, $_POST['user'] . " " . $poem . "\n");
	fclose($log_f);
	exit();
} else {
    mail("balebos@xn--7dbli0a4a.us.org","Attempted Submission", "User: " . $_POST['user'] . " needs the password. Failed submission." );
 	echo "Sorry, incorrect password was supplied.";
}
?>
