/**
 *  Initialize required functions (e.g. datetime, popover, date etc.)
 */
$(function() {
    /** form datetime */
    $('.form_datetime').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    /** form date */
    $('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });

    /** popover */
    $('[data-toggle="popover"]').popover();
    /** uniform */
    $(".uniform_on").uniform();
    /** chosen */
    $(".chzn-select").chosen();
    /** textarea */
    $('.textarea').wysihtml5();

    /** rootwizard show/hide */
    $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
        $('#rootwizard').find('.bar').css({width:$percent+'%'});
        // If it's the last tab then hide the last button and show the finish instead
        if($current >= $total) {
            $('#rootwizard').find('.pager .next').hide();
            $('#rootwizard').find('.pager .finish').show();
            $('#rootwizard').find('.pager .finish').removeClass('disabled');
        } else {
            $('#rootwizard').find('.pager .next').show();
            $('#rootwizard').find('.pager .finish').hide();
        }
    }});
    $('#rootwizard .finish').click(function() {
        alert('Finished!, Starting over!');
        $('#rootwizard').find("a[href*='tab1']").trigger('click');
    });
});


/**
 * Department form validation using jQuery
 */
$(document).ready(function () {

    $('#department-form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            head: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('.control-group').find('.help-block').html(error.text());
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        unhighlight: function(element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');
        },
        success: function (element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');

        }
    });

});

/**
 * User register form validation using jQuery
 */
$(document).ready(function () {

    $('#user-form').validate({
        rules: {
            first_name: {
                minlength: 2,
                required: true
            },
            last_name: {
                minlength: 2,
                required: true
            },
            father_name: {
                minlength: 2,
                required: true
            },
            mother_name: {
                minlength: 2,
                required: true
            },
            gender: {
                required: true
            },
            marital_status: {
                required: true
            },
            main_email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            nationality: {
                required: true
            },
            religion: {
                required: true
            },
            address: {
                required: true
            },
            dob: {
                required: true
            },
            department_id: {
                required: true
            },
            designation: {
                required: true
            },
            employee_id: {
                required: true
            },
            joining_date: {
                required: true
            },
            email: {
                required: true
            },
            password: {
                required: true
            }
        },

        errorPlacement: function(error, element) {
            $(element).closest('.control-group').find('.help-block').html(error.text());
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        unhighlight: function(element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');
        },
        success: function (element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');

        }
    });

});

/**
 * Company Info form validation using jQuery
 */
$(document).ready(function () {

    $('#company_info-form').validate({
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            phone: {
                required: true
            },
            email: {
                email: true,
                required: true
            },
            address: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('.control-group').find('.help-block').html(error.text());
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        unhighlight: function(element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');
        },
        success: function (element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');

        }
    });

});

/**
 * login form validation using jQuery
 */
$(document).ready(function () {

    $('#login-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('.control-group').find('.help-block').html(error.text());
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        unhighlight: function(element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');
        },
        success: function (element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');

        }
    });

});


/**
 * Group form validation using jQuery
 */
$(document).ready(function () {

    $('#group-form').validate({
        rules: {
            name: {
                required: true,
                maxlength: 50
            },
            description: {
                required: true,
                maxlength: 300
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('.control-group').find('.help-block').html(error.text());
        },
        highlight: function (element) {
            $(element).closest('.control-group').removeClass('success').addClass('error');
        },
        unhighlight: function(element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');
        },
        success: function (element) {
            $(element).closest('.control-group').removeClass('error').addClass('success');

        }
    });

});

/**
 * Preview browse image
 */
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result).css(
            {
                 'width': '200',
                 'height': '200'
            });
        };

        reader.readAsDataURL(input.files[0]);
    }
}

/**
 *  Upload image via ajax
 */
function uploadImage (input, user_type, user_id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#image-preview').attr('src', e.target.result).css(
            {
                 'width': '200',
                 'height': '200'
            });
        };


        //set uploading sign
        $("#upload-image-msg").html('<i class="fa fa-spinner fa-pulse"></i> Uploading...');

        //Upload to Server
        var form_data = new FormData();

        form_data.append('image', input.files[0]);
        form_data.append('user_type', user_type);
        form_data.append('user_id', user_id);

        $.ajax({
            url: baseUrl() + '/ajax/upload-image', // point to server-side PHP script
            dataType: 'json',  // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response){
                //display when upload successful
                if(response.success) reader.readAsDataURL(input.files[0]);

                //show message
                $("#upload-image-msg").html(response.message);
            },
            error: function(jqXHR, textStatus, errorThrown){
                $("#upload-image-msg").html("<span style='color:red;'>Error occurred<span>");
            }
        });
    }
}

/**
 *  Get base URL
 */
function baseUrl() {
	var href = window.location.href.split('/');

	var uri = '';
	for (var i = 3; i < href.length; i++)
	{
		uri += '/' + href[i];
		if(href[i] == 'admin-panel') break;
	}

	return uri;
}
