            $("#yid_btn").on("click",function(){
                $(".poem_body").css("display","none");
                $(".title").css("display","none");
                $(".author").css("display","none");
                $(".translator").css("display","none");
                $(".date").css("text-align","right");
                
                $(".lang_btn").removeClass("cur_lang_btn");
                
                $(".poem_body.yid").css("display","block");
                $(".title.yid").css("display","block");
                $(".author.yid").css("display","block");
                $(".lang_btn.yid").addClass("cur_lang_btn");
            });
            $("#eng_btn").on("click",function(){
                $(".poem_body").css("display","none");
                $(".title").css("display","none");
                $(".author").css("display","none");
                
                $(".lang_btn").removeClass("cur_lang_btn");
                
                $(".poem_body.eng").css("display","block");
                $(".title.eng").css("display","block");
                $(".author.eng").css("display","block");
                $(".translator").css("display","block");
                $(".date").css("text-align","left");
                $(".lang_btn.eng").addClass("cur_lang_btn");
            });
            $("#close_tt").on("click", function() {
                if ( document.selection ) {
                    document.selection.empty();
                } else if ( window.getSelection ) {
                    window.getSelection().removeAllRanges();
                }
                $(".tooltiptext").css("visibility", "hidden");
            }); 
            $(".poem_body.yid").on("click",function(){
                var words = document.getElementsByClassName("lkup_word");
                var text = getSelectionText();
                if (text.trim() && text.length < 50) {
                    for (var i = 0; i < words.length; i++) {
                        words[i].innerHTML = text;
                    }
                   
                    $(".tooltiptext").css("visibility", "visible");
                    $(".tooltip").css("visibility", "visible");
                }
            });
            
            $("img.poet").on("click", function() {
                    document.getElementById("the_pop_img").src = this.src;
                    document.getElementById('the_img_popup').style.display = "block";
                    $(".img_popup").css("background-color", "rgba(118,215,196,0.9)");
                    $(".close").css("color", "#F9E79F");
            });
            
            $("img.context").on("click", function() {
                    document.getElementById("the_pop_img").src = this.src;
                    document.getElementById('the_img_popup').style.display = "block";
                    $(".img_popup").css("background-color", "rgba(249,231,159,0.9)");
                    $(".close").css("color", "#76D7C4");
            });


            $(".close").on("click", function() {
                    document.getElementById('the_img_popup').style.display = "none";
            });

            function getSelectionText() {
                var text = "";
                if (window.getSelection) {
                    text = window.getSelection().toString();
                } else if (document.selection && document.selection.type != "Control") {
                    text = document.selection.createRange().text;
                }
                return text;
           }
