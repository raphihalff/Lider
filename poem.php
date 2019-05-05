<?php 
	require_once '/home/xn7dbl5/config/mysql_config.php';
	// Create connection
	$mysql = new mysqli($servername, $username, $password, $dbname);
	$mysql->set_charset('utf8');
	// Check connection
	if ($mysql->connect_error) {
		die("Connection failed: " . $mysql->connect_error);
	}
	$code = $_GET["poem"];
	
	$sql = "SELECT * FROM poem WHERE poem='" . $code . "' AND genre='poem'";
    $poem = $mysql->query($sql)->fetch_assoc();
	
	if (!$poem) {
		header('HTTP/1.0 404 Not Found');
		readfile('vos.html');
		exit();
	}
	
	$sql = "SELECT * FROM poet WHERE name_e='" . $poem['poet'] . "'";
	$poet = $mysql->query($sql)->fetch_assoc();
	
	$def_con = "One day, <em>beezras hashem</em>, there will be a <em>bisl (ober zayer gut geshribn)</em> background here!";
	$def_bio = "Tomorrow, <em>keyn eyn ore</em>, I'll write <em>zayer a fayne</em> bio!";
	$def_trans = "<em>Hot geduld!</em> We're working on it!";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
	<link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
        <title><?php echo $poem['title_e']; ?></title>
    </head>

   <body>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        <div class="img_popup" id="the_img_popup"><img class="img_popup_cnt" id="the_pop_img">
	  <div id="img_popup_cap"></div>
          <span class="close" >&times</span>
        </div>

        <div class="poem_context">
            
            <h3 class="poem_context_title">A <em>Bisl</em> Background<span class="poem_context_title yid" dir="rtl">אַ קלײנער פֿאָן</span></h3> 
            <img class="context" src="<?php echo "images/" . (is_null($poem['img']) ? "con_default.jpg" : $poem['img']); ?>" data-tippy="<?php echo (is_null($poem['img']) ? "Illustration © Christophe Vorlet" : $poem['img_src']); ?>" data-src="<?php echo (is_null($poem['img']) ? "Illustration © Christophe Vorlet" : $poem['img_src']); ?>">    
            <p>
            <?php echo (is_null($poem['context']) ? $def_con : nl2br($poem['context']));?>
        	</p>
        </div>

        <div class="poem_wrapper">
            <div class="reading">
	    	<?php echo (is_null($poem['reader']) ? '<img class="rec_img" src="aleph.jpeg">' : ('<audio controls><source src="readings/' . $poem['rec'] . '" type="audio/mpeg">Your browser does not support the audio element. </audio>')); ?>
                <h4 class="reader"><em>Read by</em> <?php echo (is_null($poem['reader']) ? "no one yet &#9785" : $poem['reader']); ?></h4>
            </div>
            <div class="lang_btns">
                <button class="lang_btn eng" id="eng_btn">AB</button>
                <button class="lang_btn yid cur_lang_btn" id="yid_btn" dir="rtl">אב</button>
		<div class="styles" > 
			<span class="dark_poem" data-tippy="Darken or Lighten Background" title="Darken or Lighten Background"></span>
			<span class="expand_poem" data-tippy="Expand or Shrink the Poem" title="Expand or Shrink the Poem"></span>
			<span class="font_poem" data-tippy="Change the Font" title="Change the Font"></span>
		</div>
            </div>
            <div class="title_container eng">
	    <h2 class="title eng" <?php echo (is_null($poem['source']) ? "" : 'title="' . $poem['source']  . '"') ?>><?php echo $poem['title_e']; ?></h2>
            <h3 class="author eng"><form action="poet.php" method="get"><button type="submit" class="clk_poet" name="poet" value="<?php echo $poet['name_e']; ?>"><?php echo $poet['name_e']; ?></button></form></h3>
	    </div>
            <div class="title_container yid">
	    <h2 class="title yid" dir="rtl" <?php echo (is_null($poem['source']) ? "" : 'title="' . $poem['source']  . '" data-tippy="' . $poem['source']  . '"') ?>><?php echo $poem['title_y']; ?></h2>
            <h3 class="author yid" dir="rtl"><form action="poet.php" method="get"><button type="submit" class="clk_poet" name="poet" value="<?php echo $poet['name_e']; ?>"><?php echo $poet['name_y']; ?></button></form></h3>
</div>

            <h3 class="translator"><em>translated by </em><?php echo $poem['translator']; ?></h3>  
            <div class="poem_body eng">
                <?php echo (is_null($poem['text_e']) ? $def_trans : str_replace('    ','&emsp;', str_replace("\t",'&emsp;', nl2br($poem['text_e']))));?>
            </div>
            <div class="poem_body yid" id="yid_text" dir="rtl">
                <?php echo str_replace('    ','&emsp;', str_replace("\t",'&emsp;', nl2br($poem['text_y']))); ?>
            </div>
            <?php 
            	$months_y = ['יאַנואַר','פֿעברואַר','מערץ','אַפּריל','מײ','יוני','יולי','אױגוסט','סעפּטעמבער','אָקטאָבער','נאָװעמבער','דעצעמבער']; 
            	$months_e = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            	$date = preg_split('[-]', $poem['date']);
            	$full_date_y = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : "<font size='4'>" . $months_y[((int)$date[1])-1] . "</font>, ") . ($date[0] == "0000" ? "" : $date[0]);
            	$full_date_e = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : $months_e[((int)$date[1])-1] . ", ") . ($date[0] == "0000" ? "" : $date[0]);
            ?>
            <br>
            <div class="date yid" dir="rtl"><?php echo $full_date_y; ?></div>
            <div class="date eng"><?php echo $full_date_e; ?></div>
        </div>

        <div class="author_blurb">
            <h3 class="author_blurb_title"> The Poet<span class="yid author_blurb_title">דער דיכטער</span></h3>
            <img class="poet" src="<?php echo "images/" . (is_null($poet['img']) ? "default.png" : $poet['img']); ?>" data-tippy="<?php echo (is_null($poet['img_src']) ? "" : $poet['img_src']); ?>" data-src="<?php echo (is_null($poet['img_src']) ? "" : $poet['img_src']); ?>">
            <p>
            <?php echo (is_null($poet['bio']) ? $def_bio : nl2br($poet['bio']));?>
        	</p>
        </div>

        <div class="resources">
            <h3 class="resource_title">Resources</h3>
            <span class="resource_subtitle">More on the poet: &nbsp</span>
            <?php
            $sql = "SELECT * FROM bio_links WHERE poet='" . $poet['name_e'] . "'";
       		$results = $mysql->query($sql);
       		if ($results->num_rows > 0) {
       			while($result = $results->fetch_assoc()) {
       				echo '<a href="' . $result['link'] . '">' . $result['descr'] . '</a>; ';
       			}
       		} else {
       			echo "I swear I put a link here... ";
       		}
       		?>
            <span class="resource_subtitle">More on the poem: &nbsp</span>
			<?php
            $sql = "SELECT * FROM poem_links WHERE poem='" . $poem['poem'] . "' AND type='poem'";
       		$results = $mysql->query($sql);
       		if ($results->num_rows > 0) {
       			while($result = $results->fetch_assoc()) {
       				echo '<a href="' . $result['link'] . '">' . $result['descr'] . '</a>; ';
       			}
       		} else {
       			echo "I swear I put a link here... ";
       		}
       		?>
            <span class="resource_subtitle">More on context: &nbsp</span> 
            <?php
            $sql = "SELECT * FROM poem_links WHERE poem='" . $poem['poem'] . "' AND type='context'";
       		$results = $mysql->query($sql);
       		if ($results->num_rows > 0) {
       			while($result = $results->fetch_assoc()) {
       				echo '<a href="' . $result['link'] . '">' . $result['descr'] . '</a>; ';
       			}
       		} else {
       			echo "I swear I put a link here... ";
       		}
       		?>
        </div>

		<div class="tooltiptext " id="word_option" disabled>
			<button class="tooltip_btn" id="close_tt">&times</button>
	        <h3 class="lkup_word yid" dir="rtl">TOKENS</h3>
	        <form action="#" method="" enctype="multipart/form-data">
			    1) <input class="token" type="text" name="token0"><br>
			    2) <input class="token" type="text" name="token1"><br>
			    3) <input class="token" type="text" name="token2"><br>
			    4) <input class="token" type="text" name="token3"><br>
			    5) <input class="token" type="text" name="token4"><br>
			    <input type="reset" class="clr_tokens" value="Clear">
			    <br>Check usage of the tokens...<br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=0" href="">...by date (all poems)</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=1" href="">...by poet (all poems)</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=2&tokens[]=<?php echo $code; ?>" href="">...in this poem</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=3&tokens[]=<?php echo $code; ?>" href="">...by poem (this poet only)</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=4&tokens[]=<?php echo $code; ?>" href="">...by date (this poet only)</a>
            </form>
       	</div>
		
        <script src="poem.js"></script>  
	<script src="https://unpkg.com/tippy.js@3/dist/tippy.all.min.js"></script>
	<script>
	    tippy.setDefaults({
		interactive: true,
		interactiveBorder: 2,
		theme: 'oytser',
		animateFill: false,
		placement: 'bottom',
		arrow: true,
		arrowType: 'round'
	    });
	</script>

	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
