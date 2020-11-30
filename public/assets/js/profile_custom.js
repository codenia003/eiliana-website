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
        $('.spinner-border').removeClass("d-none");
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        // console.log($form.serialize());
        $.post($form.attr('action'), $form.serialize(), function(result) {
            // console.log(result);
            var userDatas = result;
            if (userDatas.success == '0') {
                Swal.fire({
                   icon: 'error',
                   title: 'Oops...',
                   text: userDatas.errors,
                   showConfirmButton: false,
                   timer: 2000
                });
                $('.spinner-border').addClass("d-none");
            } else {
                localStorage.removeItem('reg_id');
                $('.spinner-border').addClass("d-none");
                var radioValue = $("input[name='wanttofill']:checked").val();
                if (radioValue == 1 || radioValue == 3) {
                    var redirect = '/profile/education';
                } else if(radioValue == 2) {
                    var redirect = '/profile/certification';
                } else {
                    var redirect = '/profile/professional-experience';
                }
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    text: 'Profile sucessfully updated',
                }).then(function() {
                    window.location.href = redirect;
                });
            }
        }, 'json');
    });
});
