
$('#rightmiddle').height($('#leftmiddle').height());
$('#leftcolumn').height($('#rightmiddle').height());
$("textarea").onresize({
    resize: function() {
        $('#leftmiddle').height($('#rightmiddle').height());
        $('#leftcolumn').height($('#rightmiddle').height());
    }
});
