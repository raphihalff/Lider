<?php
  $text = array("heb"=>'בוקר מוקדם אחד בתל אביב. מזג האוויר קריר, ולהפליא, ריח טרי של גשם מכסה את הרחובות המלוכלכים כמו איפור דק. במונית הנהג והנוסע משוחחים, בדרך לנתב"ג.
"ומה אתה עושה בארץ?“
"אני לומד פה באניברסיטה."
"מה אתה לומד?"
"ספרות ביידיש..."
"יידיש? באמת? אתה לומד יידיש? כל הכבוד! אמי דיברה יידיש…“
"ואתה? אתה גם מדבר?"
"לא, — אני רק סופר ביידיש."
פתאום הרוח, ערבוב ריחות של גשם ולכלוך, מחחיל להביא לתוך המונית רק הריחה המתוק של לנטנה ססגונית.
"אתה סופר יידיש!?"
"מה? אה! לא. אני סופר — אחד, שתים, שלוש!"', "yid"=>'„זיצט, זיצט. אײדער איר נעמט ביכער מיט, מוז איך װיסן װער איר זײַט.“ די צװײ סטודענטן זײַנען געזעסן. דער גאַסטגעבער האָט זײ אַ קוק געטאָן און אַרײַנגעזאָגט, „װײסט איר װאָס איז אַ ייִדישיסט?! װײסט איר? פֿאַרװאָס זײַט איר זיך פֿאַרנומען מיט ביכער און נישט מיט לערנען זיך ייִדיש? אַ בוך איז װירטועל! ס׳איז דאָ געװען נאָך אײנער װי איר, האָט זיך פֿאַרנומען מיט זאַמלען ביכער, און קען אַפֿילו נישט רעדן קײן װאָרט ייִדיש! איר זײַט פֿאַרבענקט, נאַיִװ, קינדיש! צי גײט איר אַרײַן אין פֿרעמדע הײמער צו ראַטעװען שיריים? צי װאַרפֿט איר נישט אַװעק די אַלטע שיך?“ צװישן אירע װערטער האָבן מיר צו מאָל באַוויזן אַרײַנשטעקן אַ פֿאַרצװײפֿלטן פּראָטעסט: „פֿאַרװאָס זשע זײַט איר אין כּעס?!“
דערװײַל האָט אײנער פֿון די סטודענטן געמאַכט אַ בערגל ביכער װעלכע ער האָט געװאָלט מיטנעמען. דער צװײטער איז אָבער אַרויס מיט ליידיקע הענט, אָן שום בוך.
האָט זי אים געפֿרעגט, „נו, װעלכע ביכער װילט איר?“
„איך װיל גאָרנישט,“ האָט ער געענטפֿערט.
„אַהאַ! איר האָט שױן אַלץ געלײענט! או־װאַ!“
„נײן,“ האָט ער איר געענטפֿערט. „אָבער אױב איך נעם אַ בוך פֿון דאַנעט, װעל איך תּמיד געדענקען פֿון װאַנען איך האָב עס גענומען. און אַזאַ זאַך וויל איך נישט געדענקען.‟', "eng"=>'One by one, the students in a graduate class on Holocaust literature answer the professor\'s question, posed as a kind of conclusion to the semester: of all the books we\'ve read, which would you choose to add to the high school curriculum as required reading. "Zalman Gradowski." Why? "Because we it was written in the camp without the literary benefit of hindsight." Fine. "Spiegelman." Why? "Because it discusses the trauma of second generation survivors." Good. "Chava Rosenfarb." Why? "Because it explores themes usually neglected in the shorter memoir literature." Okay. "Tadeusz Borowski." Why? "Because he villainizes himself and we don\'t know how to deal with that." You wouldn\'t choose a Jewish writer? "No." You wouldn\'t choose a female writer? "No." You wouldn\'t choose a Yiddish writer?! "No."');
  $title = array("heb"=>"יום יידיש בארץ", "yid"=>"אַ טאָג ייִדיש אין ישׂראל", "eng"=>"A Day of Yiddish in Israel");
  $by = array("heb"=>"מאת", "yid"=>"פֿון", "eng"=>"By");
  $lang = array(
    "heb" => array("heb"=>"עברית", "yid"=>"העברעיִש", "eng"=>"Hebrew"),
    "eng" => array("heb"=>"אנגלית", "yid"=>"ענגליש", "eng"=>"English"),
    "yid" => array("heb"=>"יידיש", "yid"=>"ייִדיש", "eng"=>"Yiddish")
  );

  function get_trans($src_lang, $out_lang) {
    global $lang;
    $trans_by = array("heb"=>'תורגם מ{} ע"י ', "yid"=>"איבערגעזעצט פֿון {} פֿון", "eng"=>"Translate from {} by");
    $trans = array("heb"=>"רפאל הלף", "yid"=>"רפֿאל חלף", "eng"=>"Raphael Halff");
    return str_replace("{}", $lang[$src_lang][$out_lang], $trans_by[$out_lang]) . " " . $trans[$out_lang];
  }
  function get_author() {
    $author_f = array(
      array("heb"=>"חנה", "yid"=>"חנה", "eng"=>"Hana"),
      array("heb"=>"קירה", "yid"=>"קיראַ", "eng"=>"Kira")
    );
    $author_m = array(
      array("heb"=>"מ.", "yid"=>"מ.", "eng"=>"M."),
      array("heb"=>"ר.", "yid"=>"ר.", "eng"=>"R.")
    );
    $author_l = array(
      array("heb"=>"קובלוף", "yid"=>"קאָװאַלאָװ", "eng"=>"Kovaloff"),
      array("heb"=>"גוטויליג", "yid"=>"גוטװיליק", "eng"=>"Gutwillig")
    );
    return array($author_f[rand(0,2)], $author_m[rand(0,2)], $author_l[rand(0,2)]);
  }

  function get_lang($used = 0 {
    $selector = array("heb","yid","eng");
    if ($used == 0) {
      return $selector[rand(0,2)];
    } else {
      $sug = $selector[rand(0,2)];
      while (in_array($sug, $used)){
        $sug = $selector[rand(0,2)];
      }
      return $sug;
    }
  }
?>
