<script>
$(document).ready(function(){

    // fetch_user();

    setInterval(function(){
        // update_last_activity();
        update_chat_history_data();
        // fetch_user();
    }, 5000);

    function fetch_user()
    {
        $.ajax({
            url:"chat/fetch_user",
            method:"POST",
            data:{_token: "{{ csrf_token() }}"},
            success:function(data){
                // $('#user_details').html(data);
                $('.open-button1').html(data);
            }
        })
    }

    // function update_last_activity()
    // {
    //     $.ajax({
    //         url:"chat-new/update_last_activity.php",
    //         success:function()
    //         {

    //         }
    //     })
    // }

    function make_chat_dialog_box(to_user_id, to_user_name,chat_type)
    {
        // var modal_content = '<div id="user_dialog_'+to_user_id+'" class="modal fade pullDown user_dialog" title="You have chat with '+to_user_name+'" role="dialog">';
        // modal_content += '<div class="modal-dialog float"><div class="modal-content">';
        // modal_content += ' <div class="modal-header bg-blue text-white"><h5 class="modal-title">You have chat with <b>'+to_user_name+'</b>.</h5><button type="button" class="close" data-dismiss="modal">&times;</button></div>';
        // modal_content += '<div class="modal-body delivery-details"><div class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'" style="height:360px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">';
        // // modal_content += fetch_user_chat_history(to_user_id);
        // modal_content += '<span class="spinner-border spinner-border-sm mr-1"></span>';
        // modal_content += '</div>';
        // modal_content += '<div id="error_show_'+to_user_id+'"></div>';
        // modal_content += '<div class="form-group">';
        // modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
        // modal_content += '</div><div class="form-group singup-body" align="right">';
        // modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" chattype="'+chat_type+'" class="btn btn-primary send_chat">Send</button></div>';
        // modal_content += '</div></div></div></div>';

        var modal_content = '<div class="modal fade pullDown border-0 modal-refer user_chat" id="user_dialog_'+to_user_id+'" role="dialog" title="You have chat with '+to_user_name+'" aria-labelledby="modalLabelnews"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body"><button class="btn times" data-dismiss="modal"><i class="fas fa-times"></i></button><div class="row">';
        modal_content += '<div class="col align-self-center"><div class="eiliana-logo"><img class="img-fluid" src="{{ asset('assets/img/logo.png') }}" alt="SVG"></div><div class="user-info"><div class="basic-padding"><div class="text-center"><div class="avatar avatar-xxl avatar-circle mb-3">@if(Sentinel::getUser()->pic)<img class="image-preview avatar-img" src="{{ url('/') }}{{ Sentinel::getUser()->pic }}" class="avatar" alt="Avatar">@else<img class="avatar-img" src="/images/authors/no_avatar.jpg" alt="Image Description">@endif</div></div><div class="text-center"><h5 class="card-title text-secondary">{{ Sentinel::getUser()->full_name }}</h5><p class="card-text font-size-1">@isset(Session::get('users')['country_name']){{ Session::get('users')['country_name'] }} @endisset <br> {{ Sentinel::getUser()->city }}</p></div></div></div></div>';
        modal_content += '<div class="col"><div class="chat_main"><div class="chat_box">'
        modal_content += '<div class="head"><div class="user"><div class="avatar"><img src="https://picsum.photos/g/40/40" /></div><div class="name"><b>'+to_user_name+'</b></div></div><ul class="bar_tool"><li><span class="alink"><i class="fas fa-ellipsis-v"></i></span></li></ul></div>'
        modal_content += '<div class="body chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
        modal_content += '<span class="spinner-border spinner-border-sm mr-1"></span>';
        modal_content += '</div>';
        // modal_content += '<div id="error_show_'+to_user_id+'"></div>';
        modal_content += '<div class="foot"><input type="text" name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="msg chat_message" placeholder="Type a message..." /><button type="button" name="send_chat" id="'+to_user_id+'" chattype="'+chat_type+'" class="send_chat"><i class="fas fa-paper-plane"></i></button></div>';
        modal_content += '</div></div></div>';
        modal_content += '</div></div></div></div></div>';

        $('#user_model_details').html(modal_content);
    }

    $(document).on('click', '.start_chat', function(){
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        var chat_type = $(this).data('chattype');
        make_chat_dialog_box(to_user_id, to_user_name,chat_type);
        $('#user_dialog_'+to_user_id).modal();
        // $('#user_dialog').modal();
        // $('#user_dialog_'+to_user_id).dialog('open');
        // $('#chat_message_'+to_user_id).emojioneArea({
        //     pickerPosition:"top",
        //     toneStyle: "bullet"
        // });
    });

    $(document).on('click', '.send_chat', function(){
        var to_user_id = $(this).attr('id');
        var chat_type = $(this).attr('chattype');
        var chat_message = $.trim($('#chat_message_'+to_user_id).val());
        if(chat_message != '')
        {
            $.ajax({
                url:"/chat/insert_chat",
                method:"POST",
                data:{_token: "{{ csrf_token() }}",chat_type:chat_type, to_user_id:to_user_id, chat_message:chat_message},
                success:function(data)
                {
                $('#chat_message_'+to_user_id).val('');
                fetch_user_chat_history(to_user_id);
                // var element = $('#chat_message_'+to_user_id).emojioneArea();
                // element[0].emojioneArea.setText('');
                // $('#chat_history_'+to_user_id).html(data);
                }
            })
        } else {
        alert('Type something');
        }
    });

    $(document ).on( "keyup", ".chat_message", function(){
        // console.log('n dhg ');
        if (event.keyCode == 13) {
            var content = this.value;
            var caret = getCaret(this);
            if(event.shiftKey){
                this.value = content.substring(0, caret - 1) + "\n" + content.substring(caret, content.length);
                event.stopPropagation();
            } else {
                this.value = content.substring(0, caret - 1) + content.substring(caret, content.length);
                $(".send_chat").trigger("click");
            }
        }
    });

    function fetch_user_chat_history(to_user_id)
    {
        $.ajax({
            url:"/chat/fetch_chat_history",
            method:"POST",
            data:{_token: "{{ csrf_token() }}",to_user_id:to_user_id},
            success:function(data){
                $('#chat_history_'+to_user_id).html(data);
            }
        })
    }

    function update_chat_history_data()
    {
        $('.chat_history').each(function(){
            var to_user_id = $(this).data('touserid');
            fetch_user_chat_history(to_user_id);
        });
    }

    function getCaret(el) {
        if (el.selectionStart) {
            return el.selectionStart;
        } else if (document.selection) {
            el.focus();

            var r = document.selection.createRange();
            if (r == null) {
            return 0;
            }

            var re = el.createTextRange(),
                rc = re.duplicate();
            re.moveToBookmark(r.getBookmark());
            rc.setEndPoint('EndToStart', re);

            return rc.text.length;
        }
        return 0;
    }


    // $(document).on('focus', '.chat_message', function(){
    //     var is_type = 'yes';
    //     $.ajax({
    //         url:"/chat-new/update_is_type_status.php",
    //         method:"POST",
    //         data:{_token: "{{ csrf_token() }}",is_type:is_type},
    //         success:function()
    //         {

    //         }
    //     })
    // });

    // $(document).on('blur', '.chat_message', function(){
    //     var is_type = 'no';
    //     $.ajax({
    //         url:"/chat-new/update_is_type_status.php",
    //         method:"POST",
    //         data:{_token: "{{ csrf_token() }}",is_type:is_type},
    //         success:function()
    //         {

    //         }
    //     })
    // });

    $(document).on('click', '.remove_chat', function(){
        var chat_message_id = $(this).attr('id');
        if(confirm("Are you sure you want to remove this chat?"))
        {
            $.ajax({
            url:"/chat-new/remove_chat.php",
            method:"POST",
            data:{_token: "{{ csrf_token() }}",chat_message_id:chat_message_id},
            success:function(data)
            {
            update_chat_history_data();
            }
        })
        }
    });
});
</script>
