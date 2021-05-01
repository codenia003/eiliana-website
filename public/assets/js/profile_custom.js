$(document).ready(function() {
    $("input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
    });

    $('#basic_form').bootstrapValidator({
        fields: {
            username: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required',
                    },
                },
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'Title is required',
                    }
                },
            },
            interested: {
                validators: {
                    notEmpty: {
                        message: 'Title is required',
                    }
                },
            },
            first_name: {
                validators: {
                    notEmpty: {
                        message: 'First Name is required',
                    }
                },
            },
            last_name: {
                validators: {
                    notEmpty: {
                        message: 'Last Name is required',
                    }
                },
            },
            pseudoName: {},
            dob: {
                validators: {
                    notEmpty: {
                        message: 'Date of Birth is required',
                    },
                    regexp: {
                        regexp: /^\d{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])$/,
                        message: 'Date of Birth must be a valid date in the format YYYY-MM-DD',
                    },
                },
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'Country is required',
                    }
                },
            },
        },
    }).on('success.form.bv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        // $('.spinner-border').removeClass("d-none");
        // console.log($form.serialize());
        $.post($form.attr('action'), $form.serialize(), function(result) {
            // console.log(result);
            var userDatas = result;
            if (userDatas.success == '0') {
                Swal.fire({
                   type: 'error',
                   title: 'Oops...',
                   text: userDatas.errors,
                   showConfirmButton: false,
                   timer: 2000
                });
                $('.spinner-border').addClass("d-none");
            } else {
                localStorage.removeItem('reg_id');
                $('.spinner-border').addClass("d-none");
                var interested = $("input[name='interested']:checked").val();
                var radioValue = $("input[name='wanttofill']:checked").val();
                if(interested == '2') 
                {
                        var msg = 'Redirecting To Education';
                        var redirect = '/profile/education';
                }
                else if(interested == '1') {
                    if (radioValue == 1 || radioValue == 3) {
                        var msg = 'Redirecting To Education';
                        var redirect = '/profile/education';
                    } else if(radioValue == 2) {
                        var msg = 'Redirecting To Certification';
                        var redirect = '/profile/certification';
                    } else if(radioValue == 4) {
                        var msg = 'Redirecting To Professional Experience';
                        var redirect = '/profile/professional-experience';
                    } else {
                        // var redirect = '/profile/professional-experience';
                        var msg = 'Redirecting To Education';
                        var redirect = '/profile/education';
                    }
                }
                Swal.fire({
                    type: 'success',
                    title: 'Success...',
                    text: msg,
                }).then(function() {
                    window.location.href = redirect;
                });
            }
        }, 'json');
    });
});