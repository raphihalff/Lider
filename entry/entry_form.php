<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/style.css">
	    <link rel='shortcut icon' href='/favicon.png' type='image/x-icon' />
        <title>New Entry</title>
    </head>
    <body>
        <?php
          include_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
          require_once '/your/path/to/mysql_config.php';
          // Create connection
          $mysql = new mysqli($servername, $username, $password, $dbname);
          $mysql->set_charset('utf8');
          // Check connection
          if ($mysql->connect_error) {
            die("Connection failed: " . $mysql->connect_error);
          }
          $sql = "SELECT name_y, name_e FROM poet ORDER BY name_e";
        ?>
        <form id="poem_form" action="/entry/entry_maker.php" method="post" enctype="multipart/form-data">
		<div class="instructions">
	    		<h3>How to submit a poem:</h3>
			Please enter as much as possible, but only a few fields are actually required (marked with an asterix). <br>
			<br>If you want to edit an existing entry please email us. 
			<br>Any questions, just email.
			<br>Just want to suggest a poem/poet, just email.
			<br>Our email: balebos@לידער.us.org
</div>
	    <br>
            <fieldset>
                <legend>The Poem, in English</legend>
                Poem Title*:<br>
                <input type="text" name="title_eng" placeholder="Title" data-tippy="Enter the English translation of the title" required>
                <br>
                Poet*:<br>
                <select class="name_e" type="text" data-tippy="Check for various spellings of the poet in this list. If they are not there choose new poet." name="poet_eng">
                    <option value="new" selected>New Poet:</option>
                    <?php
                    $results = $mysql->query($sql);
                    while($result = $results->fetch_assoc()) {
                      echo '<option value="' . $result['name_e'] . '">' . $result['name_e'] . '</option>';
                    }?>
                </select>
                <input type="text" name="new_poet_eng" class="poet" placeholder="New Poet">
                <br>
                Translator:<br>
                <input type="text" name="translator" placeholder="Translator">
                <br>
                The Poem:<br>
                <textarea name="poem_eng" rows="10" cols="100" placeholder="The Poem (its translation)."></textarea>
                <br>
                Publication Date: <br>
                Month:
                <select name="month">
                    <option value="00">N/A</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                Day:
                <input type="number" name="date" min="0" max="31" value="0">
                Year*:
                <input type="number" name="year" placeholder="1900" data-tippy="If a date is specified on the poem itself, enter this, otherwise use the publication date of the source" required>
            </fieldset>
            <br>
            <fieldset>
                <legend>The Poem, in Yiddish</legend>
                Poem Title*:<br>
                <input type="text" name="title_yid" placeholder="טיטל" dir="rtl" required>
                <br>
                Poet*:<br>
                <select class="name_y" type="text" name="poet_yid" data-tippy="Check for various spellings of the poet in this list. If they are not there choose new poet." dir="rtl">
                    <option value="new" dir="rtl" selected>נײַער דיכטער</option>
                    <?php
                    $results = $mysql->query($sql);
                    while($result = $results->fetch_assoc()) {
                      echo '<option value="' . $result['name_e'] . '" dir="rtl">' . $result['name_y'] . '</option>';
                    }?>
                </select>
                <input type="text" name="new_poet_yid" class="poet" placeholder="נײַער דיכטער">
                <br>
                Source*:<br>
                <input type="text" name="poem_source" placeholder="מקור" data-tippy="If bibliographic information is in Yiddish, cite the work in Yiddish, i.e.: אױפֿן זאַמדיגען װעג, יוסף ראָלניק, גרײזעל און קאָמפּאַני, ניו־יאָרק, 1911." dir="rtl" required>
                <br>
                The Poem*:<br>
                <textarea name="poem_yid" rows="10" cols="100" dir="rtl" placeholder="דאָס ליד!" data-tippy="Try not to 'standardize' the Yiddish, but transcribe it as it is in the source." required></textarea>
            </fieldset>
            <br>
            <fieldset>
                <legend>The Recording</legend>
                The Poem Reading:<br>
                <input type="file" name="rec" accept="audio/*" data-tippy="This should be a Yiddish reading.">
                <br>
                The Reader: <br>
                <input type="text" name="reader" placeholder="The Reader">
            </fieldset>
            <br>
            <fieldset>
                <legend>Poet Blurb</legend>
                About the Poet:<br>
                <textarea name="bio" class="poet" rows="10" cols="100" placeholder="Write something interesting about the poet!" data-tippy="This should be an original short blurb and in English. Authorship is anonymous. It's great to reference things that are linked to in the resources section."></textarea><br>
                Birth Date: <br>
                Month:
                <select name="b_month" class="poet">
                    <option value="00">N/A</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                Day:
                <input type="number" class="poet" name="b_date" min="0" max="31" value="0">
                Year:
                <input type="number" class="poet" name="b_year" placeholder="1900">
                <br>
                Death Date: <br>
                Month:
                <select name="d_month" class="poet">
                    <option value="00">N/A</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                Day:
                <input type="number" name="d_date" class="poet" min="0" max="31" value="0">
                Year:
                <input type="number" name="d_year" class="poet" placeholder="1900"><br>
                A Photo of the Poet: <br>
                <input type="file" name="poet_img" class="poet" accept="image/*">
                <br>Photo Credit:<br>
                <input type="text" name="poet_img_credit" class="poet" data-tippy="At least note from where the image comes; more info (artist, date, medium, etc.) is welcomed" placeholder="Give it where it's due!">
                <br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Context Blurb</legend>
                Give Some Context:<br>
                <textarea name="con" rows="10" cols="100" placeholder="Write some historical/social/literary background relevant to this poem, poet, time, etc." data-tippy="This should be an original short blurb and in English. Authorship is anonymous. It can be anything from short analysis to historical context. It's great to reference things that are linked to in the resources section."></textarea><br>
                An Illuminating Image: <br>
                <input type="file" name="con_img" accept="image/*" data-tippy="A picture that may enrich, complicate, sully, or do nothing to one's understanding of the poem.">
                <br>Photo Credit:<br>
                <input type="text" name="con_img_credit" placeholder="Give it where it's due!" data-tippy="At least note from where the image comes; more info (artist, date, med    ium, etc.) is welcomed">
                <br>
            </fieldset>
            <br>
            <fieldset>
                <legend>Resources</legend>
                More on the poet: <br>
                <div id="poet_links">
                    URL:
                    <input type="text" name="poetlink[0]" class="poet" placeholder="http://example.com">
                    Title:
                    <input type="text" name="poetlink_title[0]" class="poet" placeholder="An Example">
                    <br>
                </div>
                <div id="poet_links_append"></div>
                <input type="button" id="morelinks" onclick="morePoetLinks()" value="+" />
                <br><br>
                More on the poem: <br>
                <div id="poem_links">
                    URL:
                    <input type="text" name="poemlink[0]" placeholder="http://example.com">
                    Title:
                    <input type="text" name="poemlink_title[0]" placeholder="An Example">
                    <br>
                </div>
                <div id="poem_links_append"></div>
                <input type="button" id="morelinks" onclick="morePoemLinks()" value="+" />
                <br><br>
                More on context: <br>
                <div id="con_links">
                    URL:
                    <input type="text" name="conlink[0]" placeholder="http://example.com">
                    Title:
                    <input type="text" name="conlink_title[0]" placeholder="An Example">
                    <br>
                </div>
                <div id="con_links_append"></div>
                <input type="button" id="morelinks" onclick="moreConLinks()" value="+" />
            </fieldset>
            <br>
            <fieldset>
            	<legend>Contributor Info</legend>
            	Name or Email:
            	<input type="text" name="user" placeholder="Mentsh (mentsh@velkher.com)" data-tippy="In case we have frages."><br>
            	Password:
            	<input type="password" name="pwd" data-tippy="Just to confirm you're a lebedikn mentsh, enter: ikhhobalidele!" required>
            </fieldset>
            <input type="submit" id="submit_poem_btn" value="Expand the Treasury!" data-tippy-placement="bottom" data-tippy="Do it Do it DO IT!">
            <br>
        </form>

    	<script src="entry_form.js"></script>
	<script src="https://unpkg.com/tippy.js@3/dist/tippy.all.min.js"></script>
	<script>
	    tippy.setDefaults({
		interactive: true,
		interactiveBorder: 2,
		theme: 'oytser',
		animateFill: false,
		placement: 'right',
		arrow: true,
		arrowType: 'round'
	    });
	    </script>
	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
