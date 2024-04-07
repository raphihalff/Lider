<?php
	require_once '/home/xn7dbl5/config/mysql_config.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/sql_queries.php';
	// Create connection
	$mysql = new mysqli($servername, $username, $password, $dbname);
	$mysql->set_charset('utf8');
	// Check connection
	if ($mysql->connect_error) {
		die("Connection failed: " . $mysql->connect_error);
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=.6, maximum-scale=.6">
        <script src="/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
	<link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
        <title>י</title>
    </head>

    <body>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        <div class="lang_btns">
            <button class="lang_btn eng" id="eng_btn">AB</button>
            <button class="lang_btn yid cur_lang_btn" id="yid_btn" dir="rtl">אב</button>
        </div>

        <div class="frame">
            <h2 class="browse_hdr eng" id="work_hdr_eng">Yud: A Poem in Fifty Chapters</h2>
            <h2 class="browse_hdr yid default" id="work_hdr_yid" dir="rtl">י : אַ ליד אין פֿופֿציק קאַפּיטלען</h2>

            <ul class="link_list yid default" id="work_list_yid" dir="rtl">
            	<?php
            	 $poet_y = "משה בראָדערזאָן";
        			$poems = $mysql->query($yud_yid);
            		if ($poems->num_rows > 0) {
            			while($poem = $poems->fetch_assoc()) {
            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get"><button type="submit" class="poem_link" name="poem" value="' . $poem['poem'] . '"><img class="thumb" src="images/' . (is_null($poem['img']) ? "default.png" : $poem['img']) . '"><h3 class="link_title">' . $poem['title_y'] . ' <em class="browse_em">פֿון</em> ' . $poet_y . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>
            <ul class="link_list eng" id="work_list_eng">
            	<?php
            		$results = $mysql->query($yud_eng);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get"><button type="submit" class="poem_link" name="poem" value="' . $result['poem'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['title'] . ' <em class="browse_em">by</em> ' . $result['poet'] . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>

        </div>

        <script src="browse.js"></script>

	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="https://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="https://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
