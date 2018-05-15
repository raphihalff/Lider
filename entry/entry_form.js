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
    var theName = newField[i].name
    if (theName)
	newField[i].name = theName + poetcounter;
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
	newField[i].name = theName + poemcounter;
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
	newField[i].name = theName + concounter;
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
