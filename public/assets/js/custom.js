function change_framework()
{
    var technologty_pre = $("#technologty_pre").val();
    // console.log(technologty_pre);
    $.ajax({
        type:"GET",
        url:"/getframework",
        data:"technologty_pre="+technologty_pre,
        success: function(data) {
            console.log("data",data);
            var options = '';
            $.each( data, function( key, value ) {
                options += "<option value='"+value['technology_id']+"'>"+value['technology_name']+"</option>";
            });
            //console.log(options);
            $('#framework').html(options);
        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
