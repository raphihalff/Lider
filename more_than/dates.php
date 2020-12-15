<?php 
$months_y = ['יאַנואַר','פֿעברואַר','מערץ','אַפּריל','מײ','יוני','יולי','אױגוסט','סעפּטעמבער','אָקטאָבער','נאָװעמבער','דעצעמבער']; 
$months_e = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$months_f = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
$months_h = ['ינואר','פברואר','מרץ','אפריל','מאי','יוני','יולי','אוגוסט','ספטמבר','אוקטובר','נובמבר','דצמבר']; 
$months_r = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
$months_es = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
$months_sl = [ 'januar', 'februar', 'marec', 'april', 'maj', 'junij', 'julij', 'avgust', 'september', 'oktober', 'november', 'december'];
$translate_msg = array("eng"=>"Translated by", "fr"=>"Traduit par",   
                  "heb"=>'תורגם ע"י', "esp"=>"Traducido por", "ru"=>"переведено", "slv"=>"Prevedel");
$date = preg_split('[-]', $poem['date']);
$full_date_y = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : "<font size='4'>" . $months_y[((int)$date[1])-1] . "</font>, ") . ($date[0] == "0000" ? "" : $date[0]);
$full_date_e = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : $months_e[((int)$date[1])-1] . ", ") . ($date[0] == "0000" ? "" : $date[0]);
$full_date_h = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : $months_h[((int)$date[1])-1] . ", ") . ($date[0] == "0000" ? "" : $date[0]);
$full_date_r = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : $months_r[((int)$date[1])-1] . ", ") . ($date[0] == "0000" ? "" : $date[0]);
$full_date_f = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : $months_f[((int)$date[1])-1] . ", ") . ($date[0] == "0000" ? "" : $date[0]);
$full_date_es = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : $months_es[((int)$date[1])-1] . ", ") . ($date[0] == "0000" ? "" : $date[0]);
$full_date_sl = ($date[2] == "00" ? "" : (int)$date[2] . " ") . ($date[1] == "00" ? "" : $months_sl[((int)$date[1])-1] . ", ") . ($date[0] == "0000" ? "" : $date[0]);
$full_date = array("eng"=>$full_date_e, "fr"=>$full_date_f,   
    "heb"=>$full_date_h, "esp"=>$full_date_es,
    "ru"=>$full_date_r, "slv"=>$full_date_sl);
?>
