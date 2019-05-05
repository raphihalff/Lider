<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
	<link rel='shortcut icon' href='http://לידער.us.org/favicon.png' type='image/x-icon' />
        <title>װעגן אונדז / About Us</title>
    </head>

   <body>
        <?php include_once $_SERVER['DOCUMENT_ROOT'].'/header.php'; ?>
        <div class="img_popup" id="the_img_popup"><img class="img_popup_cnt" id="the_pop_img">
          <span class="close" >&times</span>
        </div>

        <div class="poem_context">

            <h3 class="poem_context_title">A <em>Bisl</em> Background<span class="poem_context_title yid" dir="rtl">אַ קלײנער פֿאָן</span></h3>
            <img class="context" src="images/con_default.jpg">
            <p>
              Please, sir, can you tell me more? <br><br>
              More? Because of some very enthusiastic people who like this project and want to make it better, we are expanding the very concept of our site to include, for now, stories, and, for later, everything under the umbrella of the "literature."<br>
            <br>
            We are going to more actively encourage submission of new works.
            <br><br>
            We are going to offer translations into languages other than English.
            <br><br>
            Some other current dreams: a more refined search feature, a part of speech tagger, an offline downloadable dictionary, a digital hall of special exhibits, a forum/intergrated editing platform...
            </p>
        </div>

        <div class="poem_wrapper">
            <div class="reading">
                <audio controls>
                <source src="readings/vegn_undz.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                <h4 class="reader">This is where you may listen to a reading of the story.</h4>
            </div>
            <div class="lang_btns">
                <button class="lang_btn eng" id="eng_btn">AB</button>
                <button class="lang_btn yid cur_lang_btn" id="yid_btn" dir="rtl">אב</button>
            </div>
            <div class="title_container eng">
            <h2 class="title eng">Welcome!</h2>
            <h3 class="author eng"><em>by</em> The Treasury of Yiddish Stories</h3>
            </div>
            <div class="title_container yid">
            <h2 class="title yid" dir="rtl">ברוך־הבאָ!</h2>
            <h3 class="author yid" dir="rtl"><em>פֿון</em> דעם אוצר פֿון ייִדישע דערצײלונגען</h3>
            </div>

            <h3 class="translator"><em>translated by </em>Someone</h3>
            <div class="poem_body eng">
              Once upon a time there was a little website devoted to Yiddish poems. Poems are good things. They are the stream of light, the source of life and love. But there are also people, and no ordinary people at that, but people of the intellectual sort, that have enough of poetry. In short, they detest the things. And why not? Sometimes a poem is simply not enough. We don't want to think poetically, abstractly. We want to bite into a pile of words, messy like, without fancy stanzas and clean lines. It's just like the unknown poet, who goes by "the idiot," if I remember correctly, scribbled at some time:
<br><br>
Poems shmoems. <br>
Enough poems already. <br>
Give me something long and yummy <br>
for this here big ol' dummy. <br> <br>
We agree entirely. So here: the new branch of The Online Treasury of Yiddish Poetry: The Online Treasury of Yiddish <s>Poetry</s> Stories. Happy reading.
	      <br><br><br>
	      This completely profitless educational site has lots of stuff on it: if your intellectual property is found on this site and you do not like that at all please let us know and we will take it down! 
              <br>
              <br>
              <a href="http://לידער.us.org">The Online Treasury of Yiddish Poetry</a><br>
              <a href="mailto:balebos@לידער.us.org">Contact Us</a>
            </div>

            <div class="poem_body yid" id="yid_text" dir="rtl">
אַ מאָל איז געװען אַ קלײן װעבזײַטל װאָס האָט זיך עוסק געװען אין לידער. לידער זײַנען זײער גוט. זײ זײַנען דער קװאַל פֿון ליכט, ליבע און לעבן. אָבער זײַנען דאָ מענטשן, נישט נאָר הדיוטים, אָבער טאַקע אינטעלעקטואַלן — לידער געפֿעלן זײ ניט. בקיצור, זײ מאַכן זיך אױס אױף לידער. און פֿאַר װאָס ניט? אַ מאָל איז אַ ליד פּשוט נישט גענוג. מע װיל נישט טראַכטן פּאָעטיש, אַבסטראַקט. מע װיל זיך אײַנבײַסן אין אַ היפּש װערטער, אָן שײנע סטראָפֿעס און זױבערע שורות. פּונקט װי אַ דיכטער אַן אומבאַקאַנטער, דער נאַר הײסט ער, האָט אָנגעדרעפּטשעט:
<br><br>
	ליד שמיד,<br>
	אַ ליד אױסגעשמידט.<br>
	שלאָג אױס אַ ליד<br>
	דו, גאָלדשמיד.<br>
	— אָבער גיב מיר אַ מעשׂה.<br>
<br>
מיר זײַנען מסכּים: אָט איז אַ נײַ קאַפּיטל פֿונעם „אױפֿן־װעב“ אוצר פֿון ייִדישע לידער: דער „אױפֿן־װעב“ אוצר פֿון ייִדישע <s>לידער</s> דערצײלונגען. לײען געזונטערהײט.




                <br><br>
<a href="http://לידער.us.org">דער ״אױפֿן־װעב״ אוצר פֿון ייִדישע לידער</a><br>
              <a href="mailto:balebos@לידער.us.org">שרײַבט אונדז</a>
            </div>

            <div class="date yid" dir="rtl">24 פֿעברואַר, 2019</div>
            <div class="date eng">February 24, 2019</div>
        </div>

        <div class="author_blurb">
            <h3 class="author_blurb_title"> The Poet<span class="yid author_blurb_title">דער דיכטער</span></h3>
            <img class="poet" src="images/default.png">
            <p>
             We assume a new genre will require a new visual layout. As we amass texts we will think just how it should look. For now, as you can see, it looks the same. We like the look. Maybe you don't? Tell us why and as we rethink the design for stories, we will do the same for poetry. <br><br>
             Are you so excited and want to help?! Email us, submit poems, submit stories, submit drawings, write some code, offer suggestions!
            </p>
        </div>

        <div class="resources">
            <h3 class="resource_title">Resources</h3>
            <span class="resource_subtitle">The site: &nbsp</span>
            <a href="http://לידער.us.org">The Online Treasury of Yiddish Poetry</a>; <a href="http://מערװי.לידער.us.org">The Online Treasury of Yiddish <s>Poetry</s> Stories</a>; <a href="http://לידער.us.org/entry/entry_form.php">Submit a Poem!</a>; <a href="http://מערװי.לידער.us.org/entry/entry_form.php">Submit a Story!</a>
            <span class="resource_subtitle">The database: &nbsp</span>
            <a href="http://לידער.us.org/poetry_oytser.sql" download>Download the database (from February 22, 2018)</a>
			      <span class="resource_subtitle">The code: &nbsp</span>
            <a href="https://github.com/raphihalff/Lider/wiki">Our GitHub repository</a>
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
			    <a class="about_btns" dir="ltr" data-og="" href="" >...by date (all poems)</a>
			    <br>
			    <a class="about_btns" dir="ltr" data-og="" href="" disabled>...by poet (all poems)</a>
			    <br>
			    <a class="about_btns" dir="ltr" data-og="" href="">...in this poem</a>
			    <br>
			    <a class="about_btns" dir="ltr" data-og="" href="">...by poem (this poet only)</a>
			    <br>
			    <a class="about_btns" dir="ltr" data-og="" href="">...by date (this poet only)</a>
            </form>
       	</div>

        <script src="http://לידער.us.org/poem.js"></script>

	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
