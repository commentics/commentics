$(document).ready(function() {
    /* Initialise the FlexNav menu */
    $('.flexnav').flexNav({
        'animationSpeed': 300,
        'transitionOpacity': false,
        'calcItemWidths': true
    });

    /* When pressing Enter inside filter fields, submit the form */
    $('.filter').keydown(function(e) {
        if (e.keyCode == 13) {
            $('#filter').trigger('click');
        }
    });

    /* When top checkbox is selected, select all checkboxes */
    $('table thead input:checkbox').change(function() {
        if ($('table thead input:checkbox').is(':checked')) {
            $('table tbody input:checkbox').prop('checked', true);
        } else {
            $('table tbody input:checkbox').prop('checked', false);
        }
    });

    /* When all checkboxes are selected, select top checkbox */
    $('table tbody input:checkbox').change(function() {
        var all_checked = true;

        $('table tbody input:checkbox').each(function() {
            if (!$(this).is(':checked')) {
                all_checked = false;
            }
        });

        if (all_checked) {
            $('table thead input:checkbox').prop('checked', true);
        } else {
            $('table thead input:checkbox').prop('checked', false);
        }
    });

    /* Show a password strength indicator for better security */
    $('input[name="password_1"]').keyup(function() {
        var password = $('input[name="password_1"]').val();

        password = $.trim(password);

        var description = [];

        description[0] = '';
        description[1] = 'Very Weak';
        description[2] = 'Weak';
        description[3] = 'Fair';
        description[4] = 'Good';
        description[5] = 'Strong';
        description[6] = 'Strongest';

        var score = 0;

        // if password is bigger than 0 give 1 point
        if (password.length > 0) {
            score++;
        }

        // if password bigger than 6 give 1 point
        if (password.length > 6) {
            score++;
        }

        // if password has both lowercase and uppercase characters give 1 point
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) {
            score++;
        }

        // if password has at least one number give 1 point
        if (password.match(/\d+/)) {
            score++;
        }

        // if password has at least one special character give 1 point
        if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
            score++;
        }

        // if password bigger than 12 give 1 point
        if (password.length > 12) {
            score++;
        }

        $('#password_description').html(description[score]);

        $('#password_strength').removeClass();

        $('#password_strength').addClass('strength_' + score);
    });

    /* Convert certain inputs to jQuery UI datepicker */
    $('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    /* Convert certain inputs to jQuery UI tabs */
    $('#tabs').tabs();

    /* Add a divider after certain fields */
    $('.divide_after').after('<div class="fieldset"><label></label></div>');

    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var content = '';

                content += '<section class="upload_section">';
                content += '    <img src="' + e.target.result + '" class="upload_image">';
                content += '    <span class="upload_remove"><a data-upload-id="">' + $('.lang_link_remove').text() + '</a></span>';
                content += '</section>';

                $('.upload_msg_hasnt').after(content + ' ');
            }

            reader.readAsDataURL(input.files[0]);

            $('.upload_msg_has').show();
            $('.upload_msg_hasnt').hide();
        }
    }

    $('body').on('change', '.edit_comment_page .upload_image_input', function() {
        readURL(this);
    });

    var upload_add_count = 0;

    $('.edit_comment_page .upload_add').click(function(e) {
        e.preventDefault();

        /* Tidy up any unused file inputs */
        $('.upload_image_input').each(function() {
            if ($(this).val() == '') {
                $(this).remove();
            }
        });

        $('.upload_msg_hasnt').after('<input name="upload_add_' + upload_add_count + '" hidden class="upload_image_input" type="file" accept=".png,.jpg,.jpeg,.gif">');

        upload_add_count++;

        $('.upload_image_input:first').click();
    });

    $('body').on('click', '.edit_comment_page .upload_remove a', function(e) {
        e.preventDefault();

        var upload_id = $(this).attr('data-upload-id');

        if (upload_id) {
            $('.edit_comment_page form').append('<input type="hidden" name="upload_remove[]" value="' + upload_id + '">');
        }

        $(this).closest('.upload_section').fadeOut(500, function() {
            if (!upload_id) {
                $(this).closest('.upload_section').next('.upload_image_input').remove();
            }

            $(this).closest('.upload_section').remove();

            if (!$('.upload_section').length) {
                $('.upload_msg_has').hide();
                $('.upload_msg_hasnt').show();
            }
        });
    });
});

/* Upgrade */
function cmtx_start_upgrade(csrf_key) {
    var request = $.ajax({
        type: 'POST',
        cache: false,
        url: 'index.php?route=tool/upgrade/download',
        data: 'csrf_key=' + csrf_key,
        dataType: 'json'
    });

    request.done(function(response) {
        $.each(response['messages'], function(index, value) {
            $('#upgrade-progress').append('<p>' + value + '</p>');
        });

        if (response['error']) {
            $('#upgrade-progress').append('<p class="negative">' + response['error'] + '</p>');
        } else {
            var request = $.ajax({
                type: 'POST',
                cache: false,
                url: 'index.php?route=tool/upgrade/unpack',
                data: 'csrf_key=' + csrf_key,
                dataType: 'json'
            });

            request.done(function(response) {
                $.each(response['messages'], function(index, value) {
                    $('#upgrade-progress').append('<p>' + value + '</p>');
                });

                if (response['error']) {
                    $('#upgrade-progress').append('<p class="negative">' + response['error'] + '</p>');
                } else {
                    var request = $.ajax({
                        type: 'POST',
                        cache: false,
                        url: 'index.php?route=tool/upgrade/verify',
                        data: 'csrf_key=' + csrf_key,
                        dataType: 'json'
                    });

                    request.done(function(response) {
                        $.each(response['messages'], function(index, value) {
                            $('#upgrade-progress').append('<p>' + value + '</p>');
                        });

                        if (response['error']) {
                            $('#upgrade-progress').append('<p class="negative">' + response['error'] + '</p>');
                        } else {
                            var request = $.ajax({
                                type: 'POST',
                                cache: false,
                                url: 'index.php?route=tool/upgrade/requirements',
                                data: 'csrf_key=' + csrf_key,
                                dataType: 'json'
                            });

                            request.done(function(response) {
                                $.each(response['messages'], function(index, value) {
                                    $('#upgrade-progress').append('<p>' + value + '</p>');
                                });

                                if (response['error']) {
                                    $('#upgrade-progress').append('<p class="negative">' + response['error'] + '</p>');
                                } else {
                                    var request = $.ajax({
                                        type: 'POST',
                                        cache: false,
                                        url: 'index.php?route=tool/upgrade/install',
                                        data: 'csrf_key=' + csrf_key,
                                        dataType: 'json'
                                    });

                                    request.done(function(response) {
                                        $.each(response['messages'], function(index, value) {
                                            $('#upgrade-progress').append('<p>' + value + '</p>');
                                        });

                                        if (response['error']) {
                                            $('#upgrade-progress').append('<p class="negative">' + response['error'] + '</p>');
                                        } else {
                                            var request = $.ajax({
                                                type: 'POST',
                                                cache: false,
                                                url: 'index.php?route=tool/upgrade/database',
                                                data: 'csrf_key=' + csrf_key,
                                                dataType: 'json'
                                            });

                                            request.done(function(response) {
                                                $.each(response['messages'], function(index, value) {
                                                    $('#upgrade-progress').append('<p>' + value + '</p>');
                                                });

                                                if (response['error']) {
                                                    $('#upgrade-progress').append('<p class="negative">' + response['error'] + '</p>');
                                                } else {
                                                    var request = $.ajax({
                                                        type: 'POST',
                                                        cache: false,
                                                        url: 'index.php?route=tool/upgrade/clean',
                                                        data: 'csrf_key=' + csrf_key,
                                                        dataType: 'json'
                                                    });

                                                    request.done(function(response) {
                                                        $.each(response['messages'], function(index, value) {
                                                            $('#upgrade-progress').append('<p>' + value + '</p>');
                                                        });

                                                        if (response['error']) {
                                                            $('#upgrade-progress').append('<p class="negative">' + response['error'] + '</p>');
                                                        }

                                                        if (response['success']) {
                                                            $('#upgrade-progress').append('<p class="positive">' + response['success'] + '</p>');
                                                        }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        }
    });
}