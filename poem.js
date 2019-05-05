            $("#yid_btn").on("click",function(){
                $(".poem_body").css("display","none");
                $(".title").css("display","none");
                $(".author").css("display","none");
                $(".translator").css("display","none");
                $(".date").css("display","none");
                //$(".date").css("text-align","right");
                
                $(".lang_btn").removeClass("cur_lang_btn");
                
                $(".poem_body.yid").css("display","block");
                $(".title.yid").css("display","block");
                $(".date.yid").css("display","block");
                $(".author.yid").css("display","block");
                $(".lang_btn.yid").addClass("cur_lang_btn");
            });
            $("#eng_btn").on("click",function(){
                $(".poem_body").css("display","none");
                $(".title").css("display","none");
                $(".author").css("display","none");
                $(".date").css("display","none");
                
                $(".lang_btn").removeClass("cur_lang_btn");
                
                $(".poem_body.eng").css("display","block");
                $(".title.eng").css("display","block");
                $(".author.eng").css("display","block");
                $(".translator").css("display","block");
                //$(".date").css("text-align","left");
                $(".date.eng").css("display","block");
                $(".lang_btn.eng").addClass("cur_lang_btn");
            });
            $("#close_tt").on("click", function() {
                if ( document.selection ) {
                    document.selection.empty();
                } else if ( window.getSelection ) {
                    window.getSelection().removeAllRanges();
                }
                $(".tooltip_btn").each(function() {
                	$(this).attr("href", "");
                });
                $(".tooltiptext").css("visibility", "hidden");
            }); 
            $(".poem_body.yid").on("click",function(){
                var words = document.getElementsByClassName("lkup_word");
                var tks = document.getElementsByClassName("token");
                var text = getSelectionText();
                
                $(".tooltip_btn").each(function() {
                	$(this).attr("href", "");
                });
                
                if (text.trim() && text.length < 50) {
                    //for (var i = 0; i < words.length; i++) {
                      //  words[i].innerHTML = text;
                   // }
                    var full = true;
                    for (var i = 0; i < tks.length; i++) {
                        if (tks[i].value == '') {
                        	tks[i].value = text;
                        	full = false;
                        	break;
                        } 
                    }
                    if (full == true) {
                        	alert("Only five tokens allowed--try clearing one or all them");
                    }
                   
                    $(".tooltiptext").css("visibility", "visible");
                }
            });
            
            $(".tooltip_btn").on("click", function() {
            	var tokens = "";
            	$(".token").each(function() {
            		if ($(this).val() != "") {
            			tokens = tokens + "&tokens[]=" + $(this).val();
            		}
            	});
            	$(this).attr("href", encodeURI($(this).data("og") + tokens));
                $(".tooltiptext").css("visibility", "hidden");
            });
            
            $("img.poet").on("click", function() {
                    document.getElementById("the_pop_img").src = this.src;
                    document.getElementById('the_img_popup').style.display = "block";
		    document.getElementById("img_popup_cap").innerHTML = this.dataset.src;
                    $(".img_popup").css("background-color", "rgba(118,215,196,0.9)");
                    $(".close").css("color", "#F9E79F");
            });
            
            $("img.context").on("click", function() {
                    document.getElementById("the_pop_img").src = this.src;
                    document.getElementById('the_img_popup').style.display = "block";
		    document.getElementById("img_popup_cap").innerHTML = this.dataset.src;
                    $(".img_popup").css("background-color", "rgba(249,231,159,0.9)");
                    $(".close").css("color", "#76D7C4");
            });


            $(".close").on("click", function() {
                    document.getElementById('the_img_popup').style.display = "none";
            });

	    $(".font_poem").on("click", function() {
		if ($(this).css("box-shadow") == "none") {
		    $(".poem_body.yid, .poem_body, .title, .author, .translator").css("font-family", "simple");
		    $(this).css("box-shadow", "0 0 3px 3px var(--main-blue)");
		} else {
		    $(".poem_body.yid, .poem_body, .title, .author, .translator").css("font-family", "frank");
		    $(this).css("box-shadow", "none");
		}
	    });
	    $(".dark_poem").on("click", function() {
		if ($(this).css("box-shadow") == "none") {
		    $("body, .tooltiptext").css("background", "var(--main-dark)");
		    $("body, .homepage, .clk_poet, .tooltiptext").css("color", "var(--sec-dark)");
		    $(".tooltip_btn, .clr_tokens").css("color", "var(--main-blue-o)");
		    $(".tooltip_btn, .clr_tokens").css("background", "var(--main-yellow-o)");
		    $(".cur_lang_btn, .lang_btn").addClass("dark");
		    $("input.token").css("background", "var(--sec-dark)");
		    $(".poem_wrapper").css("border-color", "var(--main-yellow-o)");
		    $(".author_blurb, .resources, .poem_context, .tooltiptext").css("border-color", "var(--main-blue-o)");
		    $(this).css("box-shadow", "0 0 3px 3px var(--main-blue)");
		} else {
		    $("body").css("background", "white");
		    $(".tooltiptext").css("background", "var(--sec-blue)");
		    $(".tooltiptext, .tooltip_btn, .clr_tokens").css("color", "var(--con-blue)");
		    $("input.token").css("background", "white");
		    $(".tooltip_btn, .clr_tokens").css("background", "var(--sec-yellow)");
		    $(".cur_lang_btn, .lang_btn").removeClass("dark");
		    $("body, .homepage, .clk_poet").css("color", "black");
		    $(".poem_wrapper").css("border-color", "var(--main-yellow)");
		    $(".author_blurb, .resources, .poem_context, .tooltiptext").css("border-color", "var(--main-blue)");
		    $(this).css("box-shadow", "none");
		}
	    });
	    $(".expand_poem").on("click", function() {
		if ($(this).css("box-shadow") == "none" && $(window).width() > 890) {
		    $(".poem_context, .author_blurb, .resources").toggle();
		    $(".poem_wrapper").css("width", "60%");
		    $(".poem_wrapper").css("margin", "0 17%");
		    $(this).css("box-shadow", "0 0 3px 3px var(--main-blue)");
		} else if ($(window).width() > 890) {
		    $(".poem_wrapper").css("width", "38%");
		    $(".poem_wrapper").css("margin", "0 1%");
		    $(".poem_context, .author_blurb, .resources").toggle();
		    $(this).css("box-shadow", "none");

		}
	    });

            function getSelectionText() {
                var text = "";
                if (window.getSelection) {
                    text = window.getSelection().toString();
                } else if (document.selection && document.selection.type != "Control") {
                    //text = document.selection.createRange().text;
                }
                return text;
           }
