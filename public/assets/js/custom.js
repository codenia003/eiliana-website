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
function toExperience()
{
    var experience_year = parseInt($("#experience_year").val());
    var experience_year = parseInt(1) + experience_year;

    var options = '';
    for (i = experience_year; i < 50; i++) {
        options += "<option value='"+i+"'>"+i+" Years</option>";
    }
    //console.log(options);
    $('#experience_to_year').html(options);
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

function change_category1()
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
                });
                //console.log(options);
                $('#project_sub_category').html(options);

        },
        error: function(xhr, status, error) {
            console.log("error: ",error);
        },
    });
}

function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(element).text()).select();
    document.execCommand("copy");
    $temp.remove();
}
$(document).ready(function(){
    $('ul.submenu1').hide();
    $('ul.sub_navbar > li, ul.submenu1 > li').hover(function () {
    if ($('> ul.submenu1',this).length > 0) {
        $('> ul.submenu1',this).stop().slideDown('slow');
    }
    },function () {
        if ($('> ul.submenu1',this).length > 0) {
            $('> ul.submenu1',this).stop().slideUp('slow');
        }
    });
});
