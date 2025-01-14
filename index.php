<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=.6, maximum-scale=.6">
        <script src="libs/jquery/1.11.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
	    <link rel='shortcut icon' href='favicon.png' type='image/x-icon' />
        <title>Treasury of Yiddish Poetry</title>
        <div itemscope itemtype="https://schema.org/WebSite">
          <meta itemprop="url" content="https://www.לידער.us.org"/>
          <meta itemprop="name" content="לידער"/>
          <meta itemprop="alternateName" content="¡Yiddish!"/>
        </div>
    </head>

   <body>
    	<?php
			include_once $_SERVER['DOCUMENT_ROOT'].'/header.php';
			require_once '/home/xn7dbl5/config/mysql_config.php';		
			require_once $_SERVER['DOCUMENT_ROOT'] . '/sql_queries.php';			
			// Create connection
			$mysql = new mysqli($servername, $username, $password, $dbname);
			$mysql->set_charset('utf8');
			// Check connection
			if ($mysql->connect_error) {
				die("Connection failed: " . $mysql->connect_error);
			}
			include $_SERVER['DOCUMENT_ROOT'].'/nav.html';
		?>
        <br>
	<div class="browse_btns">
            <button class="browse_btn button yid" id="yid_poet_btn" dir="rtl">די דיכטערס</button>
            <button class="browse_btn button yid cur_browse_btn" id="yid_poem_btn" dir="rtl">די לידער</button>
            <button class="browse_btn button yid" id="yid_date_btn" dir="rtl">די יאָרן</button>
        </div>
        <div class="browse_btns">
            <button class="browse_btn button eng" id="eng_poet_btn">Poets</button>
            <button class="browse_btn button eng " id="eng_poem_btn">Poems</button>
            <button class="browse_btn button eng" id="eng_date_btn">Years</button>
        </div>
        <div class="frame">
            <h2 class="browse_hdr eng" id="poet_hdr_eng">Browse the Poets</h2>
            <h2 class="browse_hdr yid default" id="poet_hdr_yid" dir="rtl">בלעטערט איבער די דיכטערס</h2>

            <h2 class="browse_hdr eng" id="poem_hdr_eng">Browse the Poems</h2>
            <h2 class="browse_hdr yid" id="poem_hdr_yid" dir="rtl">בלעטערט איבער די לידער</h2>

            <h2 class="browse_hdr eng" id="year_hdr_eng">Browse by Year</h2>
            <h2 class="browse_hdr yid" id="year_hdr_yid" dir="rtl">בלעטערט דורך די יאָרן</h2>

            <ul class="link_list yid default" id="poem_list_yid" dir="rtl">
                
            	<?php
            		$results = $mysql->query($poem_list_yid_sql);
            		if ($results->num_rows > 0) {
            		    
            		    # alpha 1
            		    $sect_links = '<button id="alpha_accordion" title="Collapse">–</button><a href="#punc" class="section">!</a>';
            		    $cur_let = "";
            		    # end of alpha 1
            	
            			while($result = $results->fetch_assoc()) {
							$sql = poet_yid_sql($result['poet']);
							$poet = $mysql->query($sql)->fetch_assoc()['name_y'];
							
							# alpha 2
							$let = mb_substr($result['title_y'], 0, 1, 'utf-8');
							$open = 0;
							$first = 0;
                            if (!ctype_punct($let) and $let != $cur_let) {
                                    echo '<a class="section" name="' . $let . '">';
                                    $cur_let = $let;
                                    $sect_links = $sect_links . '<a href="#' . $let . '" class="section">' . $let . '</a>';
                                    $open = 1;
                            } elseif (ctype_punct($let) and $first == 0) {
                                echo '<a name="punc" class="section">';
                                $open = 1;
                                $first = 1;
                                $cur_let = $let;
                            }
                            # end of alpha 2
                            
            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get" target="_blank"><button type="submit" class="poem_link" name="poem" value="' . $result['poem'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['title_y'] . ' <em class="browse_em">פֿון</em> ' . $poet . '</h3></button></form></div></li>';
            				
            				# alpha 3
            				if ($open == 1) {
            				    echo '</a>';
            				    $open == 0;
            				}
            				# end of alpha 3
            			}
            			# alpha 4
            			echo '<div id="alpha">' . $sect_links . '<button onclick="topFunction()" class="topper" title="Go to top">&uarr;</button>' . '</div>';
            			# end of alpha 4
            		}
            	?>
            </ul>
            <ul class="link_list eng" id="poem_list_eng">
                <?php
            		$results = $mysql->query($poem_list_eng_sql);
            		if ($results->num_rows > 0) {
            		    
            		    # alpha 1
            		    $sect_links = '<button id="alpha_accordion_eng" title="Collapse">–</button><a href="#punc_eng" class="section">!</a>';
            		    $cur_let = "";
            		    # end of alpha 1
            		    
            			while($result = $results->fetch_assoc()) {
            			    
            			    # alpha 2
							$let = mb_substr($result['title'], 0, 1, 'utf-8');
							$open = 0;
							$first = 0;
                            if (!ctype_punct($let) and $let != $cur_let) {
                                    echo '<a class="section" name="' . $let . '">';
                                    $cur_let = $let;
                                    $sect_links = $sect_links . '<a href="#' . $let . '" class="section">' . strtolower($let) . '</a>';
                                    $open = 1;
                            } elseif (ctype_punct($let) and $first == 0) {
                                echo '<a name="punc_eng" class="section">';
                                $open = 1;
                                $first = 1;
                                $cur_let = $let;
                            }
                            # end of alpha 2
                            
            				echo '<li class="link_list_item"><div class="link_box"><form action="poem.php" method="get" target="_blank"><button type="submit" class="poem_link" name="poem" value="' . $result['poem'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['title'] . ' <em class="browse_em">by</em> ' . $result['poet_e'] . '</h3></button></form></div></li>';
            				
            				# alpha 3
            				if ($open == 1) {
            				    echo '</a>';
            				    $open == 0;
            				}
            				# end of alpha 3
            			}
            			# alpha 4
            			echo '<div id="alpha_eng">' . $sect_links . '<button onclick="topFunction()" class="topper" title="Go to top">&uarr;</button>' .'</div>';
            			# end of alpha 4
            		}
            	?>
            </ul>

            <ul class="link_list yid" id="poet_list_yid" dir="rtl">
            	<?php
            		$results = $mysql->query($poet_list_yid_sql);
            		if ($results->num_rows > 0) {
            		    # alpha 1
            		    $sect_links = '<button id="alpha_accordion_poet" title="Collapse">–</button>';
            		    $cur_let = "";
            		    # end of alpha 1
            			while($result = $results->fetch_assoc()) {
            			    # alpha 2
							$how_many_poems = $mysql->query(count_poems($result['name_e']))->num_rows;
							if ($how_many_poems > 0) {
    							$let = mb_substr($result['name_y'], 0, 1, 'utf-8');
    							$open = 0;
    							$first = 0;
                                if (!ctype_punct($let) and $let != $cur_let) {
                                        echo '<a class="section" name="דיכטער_' . $let . '">';
                                        $cur_let = $let;
                                        $sect_links = $sect_links . '<a href="#דיכטער_' . $let . '" class="section">' . strtolower($let) . '</a>';
                                        $open = 1;
                                }
                                # end of alpha 2
                				echo '<li class="link_list_item"><div class="link_box"><form action="poet.php" method="get"><button type="submit" class="poem_link" name="poet" value="' . $result['name_e'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['name_y'] . ' (' . $how_many_poems . ')' . '</h3></button></form></div></li>';
                				# alpha 3
                				if ($open == 1) {
                				    echo '</a>';
                				    $open == 0;
                				}
                			}
            			   	# end of alpha 3
            			}
            			# alpha 4
            			echo '<div id="alpha_poet">' . $sect_links . '<button onclick="topFunction()" class="topper" title="Go to top">&uarr;</button>' . '</div>';
            			# end of alpha 4
            		}
            	?>
            </ul>

            <ul class="link_list eng" id="poet_list_eng">
            	<?php
            		$results = $mysql->query($poet_list_eng_sql);
            		if ($results->num_rows > 0) {
            		    # alpha 1
            		    $sect_links = '<button id="alpha_accordion_poet_eng" title="Collapse">–</button>';
            		    $cur_let = "";
            		    # end of alpha 1
            			while($result = $results->fetch_assoc()) {
            			    # alpha 2
            			    $how_many_poems = $mysql->query(count_poems($result['name_e']))->num_rows;
							if ($how_many_poems > 0) {
    							$let = mb_substr($result['name_e'], 0, 1, 'utf-8');
    							$open = 0;
    							$first = 0;
                                if (!ctype_punct($let) and $let != $cur_let) {
                                        echo '<a class="section" name="poet_' . $let . '">';
                                        $cur_let = $let;
                                        $sect_links = $sect_links . '<a href="#poet_' . $let . '" class="section">' . strtolower($let) . '</a>';
                                        $open = 1;
                                }
                                # end of alpha 2
                				
                				echo '<li class="link_list_item"><div class="link_box"><form action="poet.php" method="get"><button type="submit" class="poem_link" name="poet" value="' . $result['name_e'] . '"><img class="thumb" src="images/' . (is_null($result['img']) ? "default.png" : $result['img']) . '"><h3 class="link_title">' . $result['name_e'] . ' (' . $how_many_poems . ')' . '</h3></button></form></div></li>';
                				# alpha 3
                				if ($open == 1) {
                				    echo '</a>';
                				    $open == 0;
                				}
							}
            				# end of alpha 3
            			}
            			# alpha 4
            			echo '<div id="alpha_poet_eng">' . $sect_links . '<button onclick="topFunction()" class="topper" title="Go to top">&uarr;</button>' . '</div>';
            			# end of alpha 4
            		}
            	?>
            </ul>

            <ul class="link_list" id="year_list">
            	<?php
            		$results = $mysql->query($poem_year_list_sql);
            		if ($results->num_rows > 0) {
            			while($result = $results->fetch_assoc()) {
							$how_many_poems = $mysql->query(count_poems_by_year($result['YEAR(date)']))->num_rows;
            				echo '<li class="link_list_item"><div class="link_box"><form action="year.php" method="get"><button type="submit" class="poem_link" name="year" value="' . $result['YEAR(date)'] . '"><h3 class="link_title">' . $result['YEAR(date)'] . ' (' . $how_many_poems . ')' . '</h3></button></form></div></li>';
            			}
            		}
            	?>
            </ul>
        </div>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/nav.html'; ?>
        <script src="browse.js"></script>

	<div id="license" style="float: right; font-size: xx-small; width: 150px; text-align: justify; margin:auto; padding: 10px; display: block;">
		<a rel="license" ref="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Creative Commons License" style="display: block; border-width:0; margin: 0 auto;" src="https://i.creativecommons.org/l/by-sa/4.0/80x15.png" /></a><br />Except where otherwise noted, content on this site is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Creative Commons Attribution-ShareAlike 4.0 International License</a>.
	</div>
    </body>
</html>
