$(".yud").on("click",function(){
    window.location.href = "yud.php";
});
$(".postcards").on("click",function(){
    window.location.href = "Bennypostcards/";
});
$(".monologue").on("click",function(){
    window.location.href = "monologue.html";
});
$( ".exhibit" ).hover(function() {
    $( this ).fadeTo( "slow", 1 );
  }, function() {
    $( this ).fadeTo( "slow", 0.3 );
  }
);
$(".exhibit").on("click", function(){
    var url = $(this).data("poem");
    if ($(window).width() > 700) {
       $(".bookburn").fadeIn("slow").delay(2400).fadeOut("slow");

    }
    setTimeout(function(){window.location.href = url;}, 3000)
});
