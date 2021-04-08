function change_framework()
{
    var technologty_pre = $("#technologty_pre").val();
    // console.log(technologty_pre);
    $.ajax({
        type:"GET",
        url:"/getframework",
        data:"technologty_pre="+technologty_pre,
        success: function(data) {
            // console.log("data",data);
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

function change_category()
{
    var category_id = $("#project_category").val();
    // console.log(technologty_pre);
    $.ajax({
        type:"GET",
        url:"/getprojectcategory",
        data:"category_id="+category_id,
        success: function(data) {
            var category_text = [];
            // console.log("data",data);

                var options = '';
                $.each( data, function( key, value ) {
                    options += "<option value='"+value['id']+"'>"+value['name']+"</option>";
                    category_text.push(options);
                });
                if (category_text.length === 0) {
                    $('#project_sub').addClass("d-none");
                } else {
                    $('#project_sub').removeClass("d-none");
                    $('#project_sub_category').html(options);
                }

                //console.log(options);


        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}
