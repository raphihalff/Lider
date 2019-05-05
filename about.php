<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=.5, maximum-scale=.5">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
	<link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
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
              This column usually contains a short text giving some context to the poem. Above you will find a picture
              that may enrich, complicate, sully, or do nothing to your understanding of the poem. You may click it to enlarge it.
              <br>
              <br>
              Since this is an About Page, we will use the context column to talk about our hopes and aspirations.<br><br> We hope this
              project grows tremendously. We don't think it possible without help from many people: people who type up poems, people who translate poems,
              people who write mini bios and little context blurbs, people who record readings, people who select good images, people who suggest new ideas, and people who help implement those ideas.
              It is certainly not possible without people who simply use this website and spread the word. <br><br>
              If you do feel motivated to actively contribute or want to just send us a note, do email us
              at balebos@לידער.us.org or leyen@lider.nu.
            </p>
        </div>

        <div class="poem_wrapper">
            <div class="reading">
                <audio controls>
                <source src="readings/vegn_undz.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                <h4 class="reader">This is where you may listen to a reading of the poem.</h4>
            </div>
            <div class="lang_btns">
                <button class="lang_btn eng" id="eng_btn">AB</button>
                <button class="lang_btn yid cur_lang_btn" id="yid_btn" dir="rtl">אב</button>
            </div>
            <div class="title_container eng">
            <h2 class="title eng">Welcome!</h2>
            <h3 class="author eng"><em>by</em> The Treasury of Yiddish Poetry</h3>
            </div>
            <div class="title_container yid">
            <h2 class="title yid" dir="rtl">ברוך־הבאָ!</h2>
            <h3 class="author yid" dir="rtl"><em>פֿון</em> דער אוצר פֿון ייִדישע לידער</h3>
            </div>

            <h3 class="translator"><em>translated by </em>Someone</h3>
            <div class="poem_body eng">
              Here, we usually display the English translation of the poem. But right now, we will use the space to welcome you. Welcome!<br><br>
              This is the beginning of what will someday be a large collection
              of Yiddish poetry. What you are looking at is the layout of a "poem page." It consists of the poem and its translation, usually here, a mini bio of the poet to the right along with a picture of the poet, a little context to the left along with some kind of relevant picture, a reading of the poem top center, and useful links at the very bottom. Lastly, when you highlight any word(s) in the Yiddish poem you will see a popup that enables you to perform certain analytical functions over the entire database. The value of this tool will only grow with the size of our database. This is a digital project. It is easy to change and improve things. If you have ideas or want to help let us know.
	      <br><br>
	      This completely profitless educational site has lots of stuff on it: if your intellectual property is found on this site and you do not like that at all please let us know and we will take it down! 
              <br>
              <br>
              <a href="http://לידער.us.org">The Online Treasury of Yiddish Poetry</a><br>
              <a href="mailto:balebos@לידער.us.org">Contact Us</a>
            </div>

            <div class="poem_body yid" id="yid_text" dir="rtl">
בדרך־כּלל, מען קען דאָ געפֿינען דאָס ליד. אָבער איצט, װעלן מיר באַניצן דעם הױפּט־שפּאַלט צו אײַך מקבל־פּנים זײַן. ברוך־הבאָ! 
<br><br>
דאָס איז דער אָנהײב פֿון װאָס מיר האָפֿן װעט זײַן זײער אַ גרױסע (דיגיטאַלישע) זאַמלבוך פֿון ייִדישע לידער. איר קוקט איצט אױף דעם אױסשטעל: אױף דער רעכטער זײַט איז אַ קלײנער פֿאָן װעגן דעם דיכטערן מיט אַ בילד, אױף דער לינקער זײַט איז אַ ביסל װעגן דעם ליד אױך מיט אַ בילד, אױבֿן איז אַ דעקלאַמאַציע, און אונטן זײַנען פֿאַרבינדונגען װאָס זײַנען אינטערעסאַנט אָדער ניצלעך. צום לעצט, װען איר גיט אַ קװעטש אױף אײן אָדער עטלעכע ייִדישע װערטער װעט עס זײַן מעגלעך צו זען װי אַזױ אַנדערע דיכטערס האָבן זיך באַניצט מיט זײ. דאָס פֿאַר אַ מכשיר װעט זײַן נאָר װיכטיקער און ניצלעכער מיט מער לידער אין אונדזער אוצר. גאָרנישט איז תּם־ונישלם--דאָס איז אַ דיגיטאַלישע פּראָיעקט װאָס קען אַלע מאָל אַנדערשן: מיר װילן אײַער הילף און אײַערע געדאַנקען!
<br><br>
<a href="http://לידער.us.org">דער ״אױפֿן־װעב״ אוצר פֿון ייִדישע לידער</a><br>
              <a href="mailto:balebos@לידער.us.org">שרײַבט אונדז</a>
            </div>

            <div class="date yid" dir="rtl">13 מײַ, 2018</div>
            <div class="date eng">May 13, 2018</div>
        </div>

        <div class="author_blurb">
            <h3 class="author_blurb_title"> The Poet<span class="yid author_blurb_title">דער דיכטער</span></h3>
            <img class="poet" src="images/default.png">
            <p>
              This column usually contains a little biography of the poet. Above you will usually find a picture of the poet, which can be enlarged by clicking it.
              <br>
              <br>
              Since this is an About Page, we will use the biography column to explain clearly what this site offers:<br><br>You may use this site as an access point to Yiddish poetry and you may browse, read and use its analytical tools at your pleasure. <br>You may also help us improve this site by contributing in countless ways to the text, the code, and the multi-media. Please <a href="mailto:balebos@לידער.us.org">contact us</a> for more details and <a href="https://github.com/raphihalff/Lider/wiki">fork our git repository</a>.<br>
              Lastly, you may use our database for whatever you wish and can download it below.
            </p>
        </div>

        <div class="resources">
            <h3 class="resource_title">Resources</h3>
            <span class="resource_subtitle">The site: &nbsp</span>
            <a href="http://לידער.us.org">The Online Treasury of Yiddish Poetry</a>; <a href="/entry/entry_form.php">Submit a Poem!</a>
            <span class="resource_subtitle">The database: &nbsp</span>
            <a href="poetry_oytser.sql" download>Download the database (from February 22, 2018)</a>
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

        <script src="poem.js"></script>

	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
