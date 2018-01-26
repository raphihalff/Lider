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
    $("#year_list").css("display","block");
    
    $("#eng_date_btn").addClass("cur_browse_btn");
});
$("#yid_date_btn").on("click", function() {
    $(".browse_hdr").css("display","none");
    $(".link_list").css("display","none");
    $(".thumb").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $("#year_hdr_yid").css("display","block");
    $("#year_list").css("display","block");
    
    $("#yid_date_btn").addClass("cur_browse_btn");
});
function imgError(image) {	
	var loc = window.location.pathname;
	var dir = loc.substring(0, loc.lastIndexOf('/'));
	var p_dir = dir.substring(dir.lastIndexOf('/') + 1);
	
	if (p_dir == "Lider") {
		image.src = "default.png";
	} else {
		image.src = "../default.png";
	}
    return true;
}
