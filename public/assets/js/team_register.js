$(document).ready(function() {
    $("input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
    });
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    });

    $('#registerteams').bootstrapValidator({
        excluded: [':disabled'],
        fields: {
            uname: {
                validators: {
                    notEmpty: {
                        message: 'Username is required',
                    },
                },
            },
            to_user: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required',
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address',
                    },
                },
            },
            subject: {
                validators: {
                    notEmpty: {
                        message: 'Subject is required',
                    },
                },
            },
            messagetext: {
                validators: {
                    notEmpty: {
                        message: 'Message is required',
                    },
                },
            },
        },
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        $('.spinner-border').removeClass("d-none");
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.post($form.attr('action'), $form.serialize(), function(result) {
            // console.log(result);
            var userExists = result;
            if (userExists.success == '0') {
                $('.spinner-border').addClass("d-none");
                swalWithBootstrapButtons.fire({
                  type: 'warning',
                  title: 'Oops...',
                  text: userExists.errors,
                  showConfirmButton: false,
                  timer: 2000
                }).then(function() {
                    window.location.href = '/company/teams';
                });
            } else if (userExists.success == '2') {
                $('.spinner-border').addClass("d-none");
                swalWithBootstrapButtons.fire({
                  type: 'warning',
                  title: 'Oops...',
                  text: userExists.errors,
                  showConfirmButton: false,
                  timer: 2000
                }).then(function() {
                    window.location.href = '/company/teams';
                });
            }else {
                $('.spinner-border').addClass("d-none");
                swalWithBootstrapButtons.fire({
                    type: 'success',
                    title: 'Success...',
                    text: 'The Invite has been sent successfully',
                }).then(function() {
                    window.location.href = '/company/bench';
                });
            }
        }, 'json');
    });

});
