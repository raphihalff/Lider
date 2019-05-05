$(".yud_page").on("click",function(){
    $(".moshe").fadeTo(800, .01, function() {
         $(".yud").fadeTo(1000, .01, function() {
            $(".cover2").fadeIn(1000, function() {
                    window.setTimeout(window.location.href = "http://www.לידער.us.org/yud_browse.php", 3000);
            });
         });
    });
});
