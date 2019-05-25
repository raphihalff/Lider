var poetcounter = 0;
var poemcounter = 0;
var concounter = 0;

function morePoetLinks() {
poetcounter++;
var newFields = document.getElementById('poet_links').cloneNode(true);
newFields.id = '';
newFields.style.display = 'block';
var newField = newFields.childNodes;
for (var i=0;i<newField.length;i++) {
    var theName = newField[i].name;
    if (theName)
	newField[i].name = theName.substring(0, theName.length-3) + "[" + poetcounter + "]";
}
var insertHere = document.getElementById('poet_links_append');
insertHere.parentNode.insertBefore(newFields,insertHere);
}

function morePoemLinks() {
poemcounter++;
var newFields = document.getElementById('poem_links').cloneNode(true);
newFields.id = '';
newFields.style.display = 'block';
var newField = newFields.childNodes;
for (var i=0;i<newField.length;i++) {
    var theName = newField[i].name
    if (theName)
	newField[i].name = theName.substring(0, theName.length-3) + "[" + poemcounter + "]";
}
var insertHere = document.getElementById('poem_links_append');
insertHere.parentNode.insertBefore(newFields,insertHere);
}


function moreConLinks() {
concounter++;
var newFields = document.getElementById('con_links').cloneNode(true);
newFields.id = '';
newFields.style.display = 'block';
var newField = newFields.childNodes;
for (var i=0;i<newField.length;i++) {
    var theName = newField[i].name
    if (theName)
	newField[i].name = theName.substring(0, theName.length-3) + "[" + concounter + "]";
}
var insertHere = document.getElementById('con_links_append');
insertHere.parentNode.insertBefore(newFields,insertHere);
}

$( ".name_e, .name_y" ).change(function() {
  var name = $(this).prop("selectedIndex");
  $(".name_y option, .name_e option").prop('selected', false)
  $(".name_y option:eq(" + name + ")").prop('selected', true);
  $(".name_e option:eq(" + name + ")").prop('selected', true);
  if ($(this).val() == "new") {
    $(".poet").attr("disabled", false);
  } else {
    $(".poet").attr("disabled", true);
  }
});
$(".lang").change(function () {
   if ($(this).val() == "eng"){
        $(this).parent().find("input[name='name_v[]'], input[name='title_v[]']").val("");
        $(this).parent().find("input[name='name_v[]'], input[name='title_v[]']").attr("readonly", true);
    } else {
        $(this).parent().find("input[name='name_v[]'], input[name='title_v[]']").attr("readonly", false);
    }
}); 
function moreTrans(){
    var new_obj = $("#og_trans_set").clone(true).removeAttr("id").insertBefore("#moretrans");
    new_obj.find("input[name='name_v'], input[name='title_v'], textarea[name='poem_v'],input[name='translator'],input[name='trans_src']").val("");
    new_obj.find("input[name='name_v'], input[name='title_v']").attr("readonly", true);
}
$('input[name="subtype"]').change(function() {
    if ($(this).val() == "transonly") {
        $("#fs_poem, #fs_pblurb, #fs_cblurb, #fs_rsrcs, #fs_record").attr("disabled", true);
        $("#add_trans_dp").attr("disabled", false)
    } else {
        $("#fs_poem, #fs_pblurb, #fs_cblurb, #fs_rsrcs, #fs_record").attr("disabled", false);
        $("#add_trans_dp").attr("disabled", true)

    }
});