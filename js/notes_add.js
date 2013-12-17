// Set up the options for ajax
/*
var options = { 
    type: 'POST',
    url: '/notes/p_add/',
    beforeSubmit: function() {
        $('#results').html("Adding...");
    },
    success: function(response) {   
        // Whatever is echo'd out from the page we're calling will be
        // returned as the parameter "response".
        // Let's inject that data into the page 
        $('#results').html(response);
    } 
}; 

// Using the above options, ajax'ify the form
$('form').ajaxForm(options);
*/
$('#rightmiddle').height($('#leftmiddle').height());
$('#leftcolumn').height($('#rightmiddle').height());
$("textarea").onresize({
    resize: function() {
        $('#leftmiddle').height($('#rightmiddle').height());
        $('#leftcolumn').height($('#rightmiddle').height());
    }
});
