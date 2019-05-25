<?php 
//from poem.php
function poem_sql($poem) {
    return "SELECT *, poem.poet as ogpoet, poem.source as ogsource, trans.source as tsource, trans.poet as tpoet, trans.translator as ttranslator FROM poem LEFT JOIN trans on poem.poem=trans.poem WHERE poem.poem='" . $poem . "' AND genre='poem' ORDER BY trans.lang='eng' desc";
}
function poet_sql($poet_eng) {
    return "SELECT * FROM poet WHERE name_e='" . $poet_eng . "'";
}
function biolinks_sql($poet_eng) {
    return "SELECT * FROM bio_links WHERE poet='" . $poet_eng . "'";
}
function poemlinks_sql($poem) {
    return "SELECT * FROM poem_links WHERE poem='" . $poem . "' AND type='poem'";
}
function contextlinks_sql($poem) {
    return "SELECT * FROM poem_links WHERE poem='" . $poem . "' AND type='context'";
}

//from index
$poem_list_yid_sql = "SELECT title_y, poet, img, poem FROM poem WHERE public IS TRUE AND genre='poem' ORDER BY title_y;";
function poet_yid_sql($poet_eng) {
    return "SELECT name_y FROM poet WHERE name_e='" . $poet_eng . "'";
}
$poem_list_eng_sql = "SELECT *, poem.poet as poet_e FROM poem LEFT JOIN trans on poem.poem=trans.poem WHERE genre='poem' AND public IS TRUE AND trans.lang='eng' ORDER BY title";
$poet_list_yid_sql = "SELECT name_y, name_e, img FROM poet ORDER BY name_y;";
$poet_list_eng_sql = "SELECT name_y, name_e,img FROM poet ORDER BY name_e;";
function count_poems($poet_eng) {
    return "SELECT * FROM poem WHERE poet='" . $poet_eng . "' AND public IS TRUE AND genre='poem'";
}
$poem_year_list_sql = "SELECT DISTINCT YEAR(date) FROM poem WHERE public IS TRUE AND genre='poem' ORDER BY date;";
function count_poems_by_year($date) {
    return "SELECT * FROM poem WHERE YEAR(date)=" . $date . " AND public IS TRUE AND genre='poem' ORDER BY title_y";
}

//from poet
function poet_check($poet) {
    return "SELECT poem FROM poem WHERE poet='" . $poet . "' AND public IS TRUE AND genre='poem'";
}
function poet_poem_yid_list($poet) {
    return "SELECT title_y, poet, img, poem FROM poem WHERE poet='" . $poet . "' AND public IS TRUE AND genre='poem' ORDER BY title_y";
}
function poet_poem_eng_list($poet) {
    return "SELECT *, poem.poet as poet_e FROM poem LEFT JOIN trans on poem.poem=trans.poem WHERE genre='poem' AND public IS TRUE AND trans.lang='eng' and poem.poet='" . $poet . "' ORDER BY title";
}
//from year
function poem_year_eng($year) {
    return "SELECT trans.title, poem.poet, poem.poem, poem.img FROM poem LEFT JOIN trans on poem.poem=trans.poem WHERE YEAR(date)='" . $year . "' AND genre='poem' AND public IS TRUE AND trans.lang='eng' ORDER BY title";
}
//from yud
$yud_eng = "SELECT trans.title, poem.poet, poem.poem, poem.img FROM poem LEFT JOIN trans on poem.poem=trans.poem WHERE poem.genre='poem' AND public IS TRUE AND trans.lang='eng' and poem.poet='Moyshe Broderzon' AND title_e LIKE '%Yud%' ORDER BY title";
$yud_yid = "SELECT title_y, poet, img, poem FROM poem WHERE poet='Moyshe Broderzon' AND title_y LIKE '%י [%' AND public IS TRUE ORDER BY title_y";
?>