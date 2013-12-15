// Set up the options for ajax
var options = { 
    type: 'POST',
    url: '/notes/p_add/',
    beforeSubmit: function() {
        $('#results').html("Adding...");
    },
    success: function(response) {   
        $('#results').html("Your note was added.");
    } 
}; 

// Using the above options, ajax'ify the form
$('form').ajaxForm(options);