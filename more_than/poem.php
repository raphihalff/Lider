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
	$code = $_GET["poem"];
    $complete_poem = $mysql->query(poem_sql($code))->fetch_all( $resulttype = MYSQLI_ASSOC);
    $poem = $complete_poem['0'];
	if (!$poem) {
		header('HTTP/1.0 404 Not Found');
		readfile('vos.html');
		exit();
	}
	
	$poet = $mysql->query(poet_sql($poem['ogpoet']))->fetch_assoc();
	$def_con = "One day, <em>beezras hashem</em>, there will be a <em>bisl (ober zayer gut geshribn)</em> background here!";
	$def_bio = "Tomorrow, <em>keyn eyn ore</em>, I'll write <em>zayer a fayne</em> bio!";
	$def_trans = "<em>Hot geduld!</em> We're working on it!";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5">
        <script src="libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
	<link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
        <title><?php echo $poem['title_y']; ?></title>
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
	    	<?php echo (is_null($poem['reader']) ? '<img class="rec_img" src="' . $_SERVER['DOCUMENT_ROOT'] . '/aleph.jpeg">' : ('<audio controls><source src="readings/' . $poem['rec'] . '" type="audio/mpeg">Your browser does not support the audio element. </audio>')); ?>
                <h4 class="reader"><em>Read by</em> <?php echo (is_null($poem['reader']) ? "no one yet &#9785" : $poem['reader']); ?></h4>
            </div>
            <div class="lang_btns">
                <!-- 
                check what trans are available
                add the trans
                add the buttons
                js swap button possition and tippy data
                -->
                <?php 
                include $_SERVER['DOCUMENT_ROOT'] . '/dates.php';
                $trans_but = "";
                $trans_text = "";
                $trans_title = "";
                $trans_trans = "";
                $trans_date = "";
                $trans_tippy = "";
                $lang_labels = array("eng"=>"EN", "fr"=>"FR",   
                  "heb"=>"עב", "esp"=>"ES", "ru"=>"RU", "slv"=>"SL");
                foreach ($complete_poem as $trec) { 
                    if (!empty($trec['text']) and !is_null($trec['text'])) {
                        if (empty($trans_but)) {
                            $trans_but = '<button class="lang_btn main ' . $trec['lang'] .'" id="' . $trec['lang'] . '_btn"  data-lang="' . $trec['lang'] . '">' . $lang_labels[$trec['lang']] . '</button>';
                        } else {
                            $trans_tippy .= "<button class='lang_btn extra " . $trec['lang'] ."' id='" . $trec['lang'] . "_btn'  data-lang='" . $trec['lang'] . "'>" . $lang_labels[$trec['lang']] . "</button> ";
                        }
                        // title
                        $trans_title .= '<div class="not_cur title_container ' . $trec['lang'] . '"><h2 class="title ' . $trec['lang'] . '"' . (is_null($trec['tsource']) ? "" : 'title="' . $trec['tsource']  . '" data-tippy="' . $trec['tsource'] . '"') . '>' . $trec['title'] . '</h2><h3 class="author ' . $trec['lang'] . '"><form action="poet.php" method="get"><button type="submit" class="clk_poet" name="poet" value="' . $poet['name_e'] . '">' . (is_null($trec['tpoet']) ? $poet['name_e'] : $trec['tpoet'])  . '</button></form></h3></div>';
                        // translator
                        $trans_trans .= '<h3 class="not_cur translator ' . $trec['lang'] . '"><em>' . $translate_msg[$trec['lang']] . '</em> ' . $trec['ttranslator'] . '</h3>';
                        // text
                        $trans_text .= '<div class="not_cur poem_body ' . $trec['lang'] . '">' . str_replace('    ','&emsp;', str_replace("\t",'&emsp;', nl2br($trec['text']))) . '</div>';
                        $trans_date .= '<div class="not_cur date ' . $trec['lang'] . '">' . $full_date[$trec['lang']] . '</div>';
                        
                    }
                }
                if (empty($trans_but)) {
                    $trans_but = '<button class="not_cur lang_btn eng" id="eng_btn" data-lang="eng">AB</button>';
                }
                if (empty($trans_title)) {
                    $trans_title .= '<div class="not_cur title_container eng"><h2 class="title eng"' . (is_null($poem['tsource']) ? "" : 'title="' . $poem['tsource']  . '" data-tippy="' . $poem['tsource'] . '"') . '>' . $poem['title'] . '</h2><h3 class="author eng"><form action="poet.php" method="get"><button type="submit" class="clk_poet" name="poet" value="' . $poet['name_e'] . '">' . $poet['name_e'] . '</button></form></h3></div>';
                }
                if (empty($trans_trans)) {
                    $trans_trans = '<h3 class="not_cur translator eng"><em>translated by </em> nobody yet :(</h3>';
                }
                if (empty($trans_text)) {
                    $trans_text = '<div class="not_cur poem_body eng"> ' . $def_trans . '</div>';
                }
                //$trans_but = str_replace('data-tippy=""', 'data-tippy="' . $trans_tippy . '"', $trans_but);
                echo $trans_but;
                ?>
                <button class="lang_btn yid cur_lang_btn" id="yid_btn" data-lang="yid" dir="rtl">אב</button>
		<div class="styles" > 
			<span class="dark_poem" data-tippy="Darken or Lighten Background" title="Darken or Lighten Background"></span>
			<span class="expand_poem" data-tippy="Expand or Shrink the Poem" title="Expand or Shrink the Story"></span>
			<span class="font_poem" data-tippy="Change the Font" title="Change the Font"></span>
		</div>
             </div>
             <!-- TITLE -->
            <?php echo $trans_title; ?>
            <div class="title_container yid">
	    <h2 class="title yid" dir="rtl" <?php echo (is_null($poem['ogsource']) ? "" : 'title="' . $poem['ogsource']  . '" data-tippy="' . $poem['ogsource']  . '"') ?>><?php echo $poem['title_y']; ?></h2>
            <h3 class="author yid" dir="rtl"><form action="poet.php" method="get"><button type="submit" class="clk_poet" name="poet" value="<?php echo $poet['name_e']; ?>"><?php echo $poet['name_y']; ?></button></form></h3>
</div>
            <!-- TRANSLATOR -->
            <?php echo $trans_trans; ?>
            
            <!-- POEM -->
            <?php echo $trans_text; ?>
            <div class="poem_body yid" id="yid_text" dir="rtl">
                <?php echo str_replace('    ','&emsp;', str_replace("\t",'&emsp;', nl2br($poem['text_y']))); ?>
            </div>
            
            <br>
            
            <!-- DATE -->
            <?php echo $trans_date; ?>
            <div class="date yid" dir="rtl"><?php echo $full_date_y; ?></div>
        </div>

        <div class="author_blurb">
            <h3 class="author_blurb_title"> The Writer<span class="yid author_blurb_title">דער שרײַבער</span></h3>
            <img class="poet" src="<?php echo "images/" . (is_null($poet['img']) ? "default.png" : $poet['img']); ?>" data-tippy="<?php echo (is_null($poet['img_src']) ? "" : $poet['img_src']); ?>" data-src="<?php echo (is_null($poet['img_src']) ? "" : $poet['img_src']); ?>">
            <p>
            <?php echo (is_null($poet['bio']) ? $def_bio : nl2br($poet['bio']));?>
        	</p>
        </div>

        <div class="resources">
            <h3 class="resource_title">Resources</h3>
            <span class="resource_subtitle">More on the writer: &nbsp</span>
            <?php
       		$results = $mysql->query(biolinks_sql($poet['name_e']));
       		if ($results->num_rows > 0) {
       			while($result = $results->fetch_assoc()) {
       				echo '<a href="' . $result['link'] . '">' . $result['descr'] . '</a>; ';
       			}
       		} else {
       			echo "I swear I put a link here... ";
       		}
       		?>
            <span class="resource_subtitle">More on the story: &nbsp</span>
			<?php
       		$results = $mysql->query(poemlinks_sql($poem['poem']));
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
       		$results = $mysql->query(contextlinks_sql($poem['poem']));
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
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=0" href="">...by date (all stories)</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=1" href="">...by writer (all stories)</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=2&tokens[]=<?php echo $code; ?>" href="">...in this story</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=3&tokens[]=<?php echo $code; ?>" href="">...by story (this writer only)</a>
			    <br>
			    <a class="tooltip_btn" dir="ltr" data-og="http://<?php echo $servername; ?>/graph.php?func=4&tokens[]=<?php echo $code; ?>" href="">...by date (this writer only)</a>
            </form>
       	</div>
		<?php 
		if (!empty($trans_tippy)){
		    echo '<div id="extra_langs" style="display: none;">' . $trans_tippy . '</div>';
		    echo '<div id="multilang" style="display:none;">';
		}
		?>
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
	       const langs = document.getElementById('extra_langs');
	       if (langs != null) {
            tippy('.lang_btn.main', { content: langs }); 
            langs.style.display = 'block';
	       }
	       
	</script>

	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
