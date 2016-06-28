$(document).ready(function(){
    $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });



    $('#addbutton').click(function () {
        var title = $('#note_title').val();
        var body = $('#note_body').val();
        var reminder_id =$('#reminder_id').val();
        $.post('/notes',{title:title, body:body, reminder_id:reminder_id}, function(data) {
                $('#noteinfo').remove();
                $('#accordion').append(data);
                $('#accordion').show(500);
        });
    });
    $(document).on( 'click', '.delete-button', function() {
        var note = $(this).val();
        console.log(note);
        $.get('/notes/'+note+'/delete', function(){
           $('#note_'+note).hide(300, function(){
                         $('#note_'+note).remove();
            });
        });
    });
    
    $("#userName").keyup(function() {
        var username = $(this).val();
        $.ajax({  
            url: 'users/check/{username}',
            type: "GET",
            data: { username: username },
            success: function(data){
                if(data=='true'){
                    $("#checker").html("<p style='color:red'>Username is already taken</p>")
                } else {
                    $("#checker").html("<p style='color:green'>Username is available</p>")
                }
            } 
        });
    });


    $('#page').on('click', function (event) {
        event.preventDefault();
        if ( $(this).attr('href') != '#' ) {
            $("html, body").animate({ scrollTop: 0 }, "slow");
            $('#sample').load($(this).attr('href'));
        }
    });

});
