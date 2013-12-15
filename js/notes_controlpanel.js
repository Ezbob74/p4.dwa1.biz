//$('#user_count').html(data['user_count']);
//$('#user_count').prepend('You have');


$('#refbut').click(function() {

    $.ajax({
       
        type: 'POST',
        dataType: 'JSON',
        url: '/controlpanel/refresh/',
        success: function(response) { 

            // For debugging purposes
            console.log(response);
          //   console.log(escape(response));
            // Example response: {"post_count":"9","user_count":"13","most_recent_post":"May 23, 2012 1:14am"}

            // Parse the JSON results into an array
          //  var data = $.parseJSON ('{"post_count":"9","user_count":"13","most_recent_post":"May 23, 2012 1:14am"}');
            //
             var data = $.parseJSON (response);
            // Inject the data into the page
           $('#note_count').html(data['note_count']);
            $('#usercount').html(data['usercount']);
        //    $('#most_recent_note').html(data['most_recent_note']);

        },
    });
});