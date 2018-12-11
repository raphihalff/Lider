$("#yid_poem_btn").on("click",function(){
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $("#poem_hdr_yid").css("display","block");
    $("#poem_list_yid").css("display","block");
    $(".thumb").css("display","block");
    
    $("#yid_poem_btn").addClass("cur_browse_btn");
});
$("#eng_poem_btn").on("click",function(){
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $("#poem_hdr_eng").css("display","block");
    $("#poem_list_eng").css("display","block");
    $(".thumb").css("display","block");
    
    $("#eng_poem_btn").addClass("cur_browse_btn");
});
$("#yid_poet_btn").on("click",function(){
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $("#poet_hdr_yid").css("display","block");
    $("#poet_list_yid").css("display","block");
    $(".thumb").css("display","block");
    
    $("#yid_poet_btn").addClass("cur_browse_btn");
});
$("#eng_poet_btn").on("click",function(){
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $("#poet_hdr_eng").css("display","block");
    $("#poet_list_eng").css("display","block");
    $(".thumb").css("display","block");
    
    $("#eng_poet_btn").addClass("cur_browse_btn");
});
$("#yid_btn").on("click", function() {
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    
    $(".lang_btn").removeClass("cur_lang_btn");
    
    $("#work_hdr_yid").css("display","block");
    $("#work_list_yid").css("display","block");
    $(".thumb").css("display","block");
    
    $("#yid_btn").addClass("cur_lang_btn");
});
    
$("#eng_btn").on("click", function() {
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    
    $(".lang_btn").removeClass("cur_lang_btn");
    
    $("#work_hdr_eng").css("display","block");
    $("#work_list_eng").css("display","block");
    $(".thumb").css("display","block");
    
    $("#eng_btn").addClass("cur_lang_btn");
});
$("#eng_date_btn").on("click", function() {
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    $(".thumb").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $("#year_hdr_eng").css("display","block");
    $("#year_list").css("direction","ltr");
    $("#year_list").css("display","block");

    $("#eng_date_btn").addClass("cur_browse_btn");
});
$("#yid_date_btn").on("click", function() {
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    $(".thumb").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $("#year_hdr_yid").css("display","block");
    $("#year_list").css("direction","rtl");
    $("#year_list").css("display","block");
    
    $("#yid_date_btn").addClass("cur_browse_btn");
});
$("#alpha_accordion").on("click", function() {
    $("#alpha a").toggle();
    if ($("#alpha a").is(":hidden")) {
	$(this).html("+");
	$(this).attr("title","Expand");
    } else {
	$(this).html("-");
	$(this).attr("title","Collapse");
    };
});
$("#alpha_accordion_eng").on("click", function() {
    $("#alpha_eng a").toggle();
    if ($("#alpha_eng a").is(":hidden")) {
	$(this).html("+");
	$(this).attr("title","Expand");
    } else {
	$(this).html("-");
	$(this).attr("title","Collapse");
    };
});
$("#alpha_accordion_poet").on("click", function() {
    $("#alpha_poet a").toggle();
    if ($("#alpha_poet a").is(":hidden")) {
	$(this).html("+");
	$(this).attr("title","Expand");
    } else {
	$(this).html("-");
	$(this).attr("title","Collapse");
    };
});
$("#alpha_accordion_poet_eng").on("click", function() {
    $("#alpha_poet_eng a").toggle();
    if ($("#alpha_poet_eng a").is(":hidden")) {
	$(this).html("+");
	$(this).attr("title","Expand");
    } else {
	$(this).html("-");
	$(this).attr("title","Collapse");
    };
});

var windw = this;
$.fn.followTo = function ( pos ) {
    var $this = this,
    $window = $(windw);
    $window.scroll(function(e){
	if ($window.scrollTop() < pos) {
	    $this.css({
		position: 'absolute',
		top: pos
	    });
	} else {
	    $this.css({
		position: 'fixed',
		top: 10
	    });
	}
    });
};

$('#alpha, #alpha_eng, #alpha_poet, #alpha_poet_eng').followTo(310);

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
