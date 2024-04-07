$(".yud_page").on("click",function(){
    $(".moshe").fadeTo(800, .01, function() {
         $(".yud").fadeTo(1000, .01, function() {
            $(".cover2").fadeIn(1000, function() {
                    window.setTimeout(window.location.href = "https://www.לידער.us.org/exhibits/yud_browse.php", 3000);
            });
         });
    });
});
