$(document).ready(function() {
    $("input[type='checkbox']").iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
    });

    $('#omb_loginForm').bootstrapValidator({
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'The email address is required',
                    },
                    emailAddress: {
                        message: 'The input is not a valid email address',
                    },
                },
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Password is required',
                    },
                    different: {
                        field: 'first_name,last_name',
                        message: 'Password should not match user Name',
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
            var userCheck = result;
            if (userCheck.success == '0') {
                Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: userCheck.errors,
                  showConfirmButton: false,
                  timer: 2000
                });
                $('.spinner-border').addClass("d-none");
            } else if (userCheck.success == '1') {
                Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: userCheck.errors,
                  showConfirmButton: false,
                  timer: 2000
                });
                localStorage.setItem("user_id", userCheck.id);
                window.location.href = '/account/loginfirst';
            } else {
                // get return url from query parameters or default to home page
                // localStorage.setItem('user', JSON.stringify(this.userCheck.user));
                $('.spinner-border').addClass("d-none");
                window.location.href = '/home';
            }
        }, 'json');
    });

    $('#first_loginForm').bootstrapValidator({
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty',
                    },
                    regexp: {
                        regexp: /^\d{6}$/,
                        message: 'Password must be at least 6 characters',
                    },
                },
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'The Confirm Password is required and cannot be empty',
                    },
                    identical: {
                        field: 'password',
                    },
                    different: {
                        field: 'first_name,last_name',
                        message: 'Confirm Password should match with password',
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
            var userCheck = result;
            if (userCheck.success == '0') {
                Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: this.userCheck.error,
                  showConfirmButton: false,
                  timer: 2000
                });
                $('.spinner-border').addClass("d-none");                
            } else {
                localStorage.removeItem('reg_id');
                localStorage.setItem("user_id", userCheck.id);
                Swal.fire({
                  type: 'success',
                  title: 'Success...',
                  text: 'Password changed sucessfully',
                }).then(function() {
                    window.location.href = '/profile';
                });
                
            }
        }, 'json');
    });

     $('#omb_searchForm').bootstrapValidator({
        fields: {
            keyword: {
                validators: {
                    notEmpty: {
                        message: 'Keyword is required',
                    },
                },
            },
        },
    });
});
