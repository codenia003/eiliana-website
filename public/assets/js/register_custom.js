$(document).ready(function() {
    $("input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
    });
    const swalWithBootstrapButtons = swal.mixin({
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
    });

    $('#reg_form').bootstrapValidator({
        excluded: [':disabled'],
        fields: {
            mobile: {
                validators: {
                    notEmpty: {
                        message: 'Mobile Number is required',
                    },
                    regexp: {
                        regexp: /^\d{10}$/,
                        message: 'Mobile Number must be at least 10 digits',
                    },
                },
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Email id is required',
                    },
                    emailAddress: {
                        message: 'Email must be a valid email address',
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
            if (userExists.usersexist == '1') {
                swalWithBootstrapButtons.fire({
                  type: 'warning',
                  title: 'Oops...',
                  text: userExists.error,
                  showConfirmButton: false,
                  timer: 2000
                });
               $('.spinner-border').addClass("d-none");
            } else if (userExists.usersexist == '2') {
                swalWithBootstrapButtons.fire({
                  type: 'warning',
                  title: 'Oops...',
                  text: userExists.error,
                  showConfirmButton: false,
                  timer: 2000
                });
                $('.spinner-border').addClass("d-none");
            } else {
                localStorage.setItem("reg_id", userExists.reg_id);
                localStorage.setItem("email_otp", userExists.email);
                localStorage.setItem("mobile_otp", userExists.mobile_number);
                $('.spinner-border').addClass("d-none");
                /*var mobile_otp = 'A one time password has been send to <b>'+userExists.email+'</b> and Email <b>'+userExists.mobile_number+'</b>';
                $("#mobile_otp").append(mobile_otp);
                $("#otp_form").append('<input type="hidden" name="reg_id" id="reg_id" value="'+userExists.reg_id+'" />');
                */
                swalWithBootstrapButtons.fire({
                  type: 'success',
                  title: 'Success...',
                  text: 'OTP send to your mobile and email successful',
                }).then(function() {
                    window.location.href = '/account/registerotp';
                });
            }
        }, 'json');
    });

    $('#otp_form').bootstrapValidator({
        excluded: [':disabled'],
        fields: {
            otp: {
                validators: {
                    notEmpty: {
                        message: 'Email Otp is required',
                    },
                    regexp: {
                        regexp: /^\d{4}$/,
                        message: 'Email Otp must be at least 4 digits',
                    },
                },
            },
            otpm: {
                validators: {
                    notEmpty: {
                        message: 'Mobile Otp is required',
                    },
                    regexp: {
                        regexp: /^\d{4}$/,
                        message: 'Mobile Otp must be at least 4 digits',
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
                swalWithBootstrapButtons.fire({
                  type: 'warning',
                  title: 'Oops...',
                  text: userExists.errors,
                  showConfirmButton: false,
                  timer: 2000
                });
                $('.spinner-border').addClass("d-none");
            } else {
                $('.spinner-border').addClass("d-none");
                swalWithBootstrapButtons.fire({
                    type: 'success',
                    title: 'Success...',
                    text: 'OTP verify successful',
                }).then(function() {
                    window.location.href = '/account/registerbasic';
                });
            }
        }, 'json');
    });

    $('#register_basic_form').bootstrapValidator({
        excluded: [':disabled'],
        fields: {
            applyas: {
                validators: {
                    notEmpty: {
                        message: 'Apply As is required',
                    }
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
                swalWithBootstrapButtons.fire({
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
                swalWithBootstrapButtons.fire({
                  type: 'success',
                  title: 'Success...',
                  text: 'Account sucessfully created, Login credentials send to your email!',
                }).then(function() {
                    window.location.href = '/account/login';
                });
            }
        }, 'json');
    });

    $('#reset').on('click', function() {
        $('#register_basic_form').bootstrapValidator('resetForm', true);
        $('.company_show').addClass("d-none");
        $('.anonymousShow-1').removeClass("col-12");
        $('.anonymousShow-1').addClass("col")
        $('.anonymousShow').removeClass("d-none");
    });
});