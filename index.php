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
    	<?php
			require_once '/your/path/to/mysql/config.php';
			// Create connection
			$mysql = new mysqli($servername, $username, $password, $dbname);
			$mysql->set_charset('utf8');
			// Check connection
			if ($mysql->connect_error) {
				die("Connection failed: " . $mysql->connect_error);
			}
		?> 
        <div class="browse_btns">
            <button class="browse_btn yid" id="yid_poet_btn" dir="rtl">די דיכטערס</button>
            <button class="browse_btn yid cur_browse_btn" id="yid_poem_btn" dir="rtl">די לידער</button>
            <button class="browse_btn yid" id="yid_date_btn" dir="rtl">די יאָרן</button>
        </div>
        <div class="browse_btns">
            <button class="browse_btn eng" id="eng_poet_btn">Poets</button>
            <button class="browse_btn eng " id="eng_poem_btn">Poems</button>
            <button class="browse_btn eng" id="eng_date_btn">Years</button>
        </div>
        <div class="frame">
            <h2 class="browse_hdr eng" id="poet_hdr_eng">Browse the Poets</h2>
            <h2 class="browse_hdr yid default" id="poet_hdr_yid" dir="rtl">בלעטערעט איבער די דיכטערס</h2>
           
            <h2 class="browse_hdr eng" id="poem_hdr_eng">Browse the Poems</h2>
            <h2 class="browse_hdr yid" id="poem_hdr_yid" dir="rtl">בלעטערעט איבער די לידער</h2>

            <h2 class="browse_hdr eng" id="year_hdr_eng">Browse by Year</h2>
            <h2 class="browse_hdr yid" id="year_hdr_yid" dir="rtl">בלעטערעט דורך די יאָרן</h2>

            <ul class="link_list yid default" id="poem_list_yid" dir="rtl">
            	<?php
            		$sql = "SELECT title_y, poet, img, poem FROM poem ORDER BY title_y;";
            		$results = $mysql->query($sql);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
							$sql = "SELECT name_y FROM poet WHERE name_e='" . $result['poet'] . "'";
							$poet = $mysql->query($sql)->fetch_assoc()['name_y'];

            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get"><button type="submit" class="poem_link" name="poem" value="' . $result['poem'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['title_y'] . ' <em style="color: #F9E79F">פֿון</em> ' . $poet . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>
            <ul class="link_list eng" id="poem_list_eng">
                <?php
            		$sql = "SELECT title_y, title_e, poet, poem, img FROM poem ORDER BY title_e;";
            		$results = $mysql->query($sql);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get"><button type="submit" class="poem_link" name="poem" value="' . $result['poem'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['title_e'] . ' <em style="color: #F9E79F">by</em> ' . $result['poet'] . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>

            <ul class="link_list yid" id="poet_list_yid" dir="rtl">
            	<?php
            		$sql = "SELECT name_y, name_e,img FROM poet ORDER BY name_y;";
            		$results = $mysql->query($sql);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
            				$sql = "SELECT * FROM poem WHERE poet='" . $result['name_e'] . "'";
							$how_many_poems = $mysql->query($sql)->num_rows;
            				echo '<li class="link_list_item"><div class="link_box"><form action="poet.php" method="get"><button type="submit" class="poem_link" name="poet" value="' . $result['name_e'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['name_y'] . ' (' . $how_many_poems . ')' . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>
            
            <ul class="link_list eng" id="poet_list_eng">
            	<?php
            		$sql = "SELECT name_y, name_e,img FROM poet ORDER BY name_e;";
            		$results = $mysql->query($sql);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
            				$sql = "SELECT * FROM poem WHERE poet='" . $result['name_e'] . "'";
							$how_many_poems = $mysql->query($sql)->num_rows;
            				echo '<li class="link_list_item"><div class="link_box"><form action="poet.php" method="get"><button type="submit" class="poem_link" name="poet" value="' . $result['name_e'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['name_e'] . ' (' . $how_many_poems . ')' . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>
            
            <ul class="link_list" id="year_list">
            	<?php
            		$sql = "SELECT DISTINCT YEAR(date) FROM poem ORDER BY date;";
            		$results = $mysql->query($sql);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
            				$sql = "SELECT * FROM poem WHERE YEAR(date)=" . $result['YEAR(date)'];
							$how_many_poems = $mysql->query($sql)->num_rows;    				
            				echo '<li class="link_list_item"><div class="link_box"><form action="year.php" method="get"><button type="submit" class="poem_link" name="year" value="' . $result['YEAR(date)'] . '"><h3 class="link_title">' . $result['YEAR(date)'] . ' (' . $how_many_poems . ')' . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>
        </div>
        </div>
        
        

        <script src="browse.js"></script>  
        
   	
	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
