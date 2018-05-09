<?php
	require_once '/home/xn7dbl5/config/mysql_config.php';
	// Create connection
	$mysql = new mysqli($servername, $username, $password, $dbname);
	$mysql->set_charset('utf8');
	// Check connection
	if ($mysql->connect_error) {
		die("Connection failed: " . $mysql->connect_error);
	}
    $poet = $_GET['poet'];
	$sql = "SELECT name_y FROM poet WHERE name_e='" . $poet . "'";
	$poet_y = $mysql->query($sql)->fetch_assoc()['name_y'];
	
	if (!$poet_y) {
		header('HTTP/1.0 404 Not Found');
		readfile('vos.html');
		exit();
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <a class="homepage" href="/">
            <h1 class="homepage">The Online Treasury of Yiddish Poetry</h1>
            <h1 class="homepage yid" dir="rtl">דער ״אױפֿן־װעב״ אוצר פֿון ייִדישע לידער</h1>
        </a>
        <title>Treasury of Yiddish Poetry</title>
    </head>

    <body>
        <div class="lang_btns">
            <button class="lang_btn yid cur_lang_btn" id="yid_btn" dir="rtl">אב</button>
            <button class="lang_btn eng" id="eng_btn">AB</button>
        </div>
        
        <div class="frame">
            <h2 class="browse_hdr eng" id="work_hdr_eng">Browse the Work of <?php echo $poet; ?></h2>
            <h2 class="browse_hdr yid default" id="work_hdr_yid" dir="rtl">בלעטערעט איבער די שריפֿטען פֿון <?php echo $poet_y; ?></h2>
           
            <ul class="link_list yid default" id="work_list_yid" dir="rtl">
            	<?php
            		$sql = "SELECT title_y, poet, img, poem FROM poem WHERE poet='" . $poet . "' ORDER BY title_y";
        			$poems = $mysql->query($sql);
            		if ($poems->num_rows > 0) {
            			while($poem = $poems->fetch_assoc()) {
            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get"><button type="submit" class="poem_link" name="poem" value="' . $poem['poem'] . '"><img class="thumb" src="images/' . (is_null($poem['img']) ? "default.png" : $poem['img']) . '"><h3 class="link_title">' . $poem['title_y'] . ' <em style="color: #F9E79F">פֿון</em> ' . $poet_y . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>
            <ul class="link_list eng" id="work_list_eng">
            	<?php
            		$sql = "SELECT title_e, poet, poem, img FROM poem WHERE poet='" . $poet . "' ORDER BY title_e";
            		$results = $mysql->query($sql);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get"><button type="submit" class="poem_link" name="poem" value="' . $result['poem'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['title_e'] . ' <em style="color: #F9E79F">by</em> ' . $result['poet'] . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>

        </div>
        
        <script src="browse.js"></script>  
    
	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
