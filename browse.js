$("#yid_poem_btn").on("click",function(){
    $(".browse_hdr.eng").css("display","none");
    $(".link_list.eng").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $(".browse_hdr.yid").css("display","block");
    $(".link_list.yid").css("display","block");
    
    $("#yid_poem_btn").addClass("cur_browse_btn");
});
$("#eng_poem_btn").on("click",function(){
    $(".browse_hdr.yid").css("display","none");
    $(".link_list.yid").css("display","none");
    
    $(".browse_btn").removeClass("cur_browse_btn");
    
    $(".browse_hdr.eng").css("display","block");
    $(".link_list.eng").css("display","block");
    
    $("#eng_poem_btn").addClass("cur_browse_btn");
});
    
