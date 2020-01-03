/* Wait for jQuery to load, in case loaded after Commentics */
var cmtx_wait_for_jquery = setInterval(function() {
    /* jQuery is loaded */
    if (window.jQuery) {
        clearInterval(cmtx_wait_for_jquery);

        /* The document (excluding images) has finished loading */
        $(document).ready(function() {
            /* Form settings may not exist (if the form is disabled) */
            if ($('#cmtx_js_settings_form').length) {
                cmtx_js_settings_form = JSON.parse($('#cmtx_js_settings_form').text());
            }

            /* Comment settings may not exist (if there are no comments) */
            if ($('#cmtx_js_settings_comments').length) {
                cmtx_js_settings_comments = JSON.parse($('#cmtx_js_settings_comments').text());
            }

            /* Notify settings may not exist (if the notify feature is disabled) */
            if ($('#cmtx_js_settings_notify').length) {
                cmtx_js_settings_notify = JSON.parse($('#cmtx_js_settings_notify').text());
            }

            /* Online settings may not exist (if the online feature is disabled) */
            if ($('#cmtx_js_settings_online').length) {
                cmtx_js_settings_online = JSON.parse($('#cmtx_js_settings_online').text());
            }

            /* User settings may not exist (if not on user page) */
            if ($('#cmtx_js_settings_user').length) {
                cmtx_js_settings_user = JSON.parse($('#cmtx_js_settings_user').text());
            }

            /* Is Commentics loaded using the iFrame integration method */
            isInIframe = (window.location != window.parent.location) ? true : false;

            /* Show a BB Code modal */
            $('#cmtx_container span[data-cmtx-target-modal]').click(function(e) {
                e.preventDefault();

                var target = $(this).attr('data-cmtx-target-modal');

                $('body').append($(target));

                $('body').append('<div class="cmtx_overlay"></div>');

                /*
                 * The following stops the modal from showing in the vertical centre of the iFrame
                 * Instead we position the modal relative to an element on the page
                 */
                if (isInIframe) {
                    var destination = $('.cmtx_bb_code_container').offset();

                    $($(target)).css({top: destination.top + 150});

                    /*
                     * The overlay is set to transparent as otherwise it would only cover the iFrame
                     * It's still useful to show it so that clicking on the overlay closes the modal
                     */
                    $('.cmtx_overlay').css('background-color', 'transparent');
                }

                $('.cmtx_overlay').fadeIn(200);

                $(target).fadeIn(200);
            });

            /* Show an agreement modal */
            $('#cmtx_container label[for="cmtx_privacy"] a, #cmtx_container label[for="cmtx_terms"] a').click(function(e) {
                e.preventDefault();

                var target = $(this).parent().parent().attr('data-cmtx-target-modal');

                $('body').append($(target));

                $('body').append('<div class="cmtx_overlay"></div>');

                if (isInIframe) {
                    var destination = $('.cmtx_checkbox_container').offset();

                    $($(target)).css({top: destination.top - 150});

                    $('.cmtx_overlay').css('background-color', 'transparent');
                }

                $('.cmtx_overlay').fadeIn(200);

                $(target).fadeIn(200);
            });

            /* Show the flag modal */
            $('#cmtx_container').on('click', '.cmtx_flag_link', function(e) {
                e.preventDefault();

                var comment_id = $(this).closest('.cmtx_comment_box').attr('data-cmtx-comment-id');

                $('#cmtx_flag_modal_yes').attr('data-cmtx-comment-id', comment_id);

                if ($('body > #cmtx_flag_modal').length === 0) {
                    $('body').append($('#cmtx_flag_modal'));
                }

                $('body').append('<div class="cmtx_overlay"></div>');

                if (isInIframe) {
                    var destination = $(this).offset();

                    $('#cmtx_flag_modal').css({top: destination.top - 150});

                    $('.cmtx_overlay').css('background-color', 'transparent');
                }

                $('.cmtx_overlay').fadeIn(200);

                $('#cmtx_flag_modal').fadeIn(200);
            });

            /* Modal cancel button */
            $('body').on('click', '.cmtx_modal_box .cmtx_button_secondary', function(e) {
                e.preventDefault();

                $('.cmtx_modal_close').trigger('click');
            });

            /* Close modal */
            $('body').on('click', '.cmtx_modal_close, .cmtx_overlay', function(e) {
                e.preventDefault();

                $('.cmtx_modal_box, .cmtx_overlay').fadeOut(200, function() {
                    $('.cmtx_overlay').remove();
                });
            });

            /* Style the blank select options as placeholders */
            var selected = $('.cmtx_form_container select').find('option:selected');

            if (selected.val() == '') {
                $('.cmtx_form_container select').css('color', '#666');
                $('.cmtx_form_container select').children().css('color', 'black');
            }

            $('body').on('change', '.cmtx_form_container select', function () {
                if ($(this).find('option:selected').val() == '') {
                    $(this).css('color', '#666');
                    $(this).children().css('color', 'black');
                } else {
                    $(this).css('color', 'black');
                    $(this).children().css('color', 'black');
                }
            });

            /* When the comment field gets focus, show some other fields */
            $('#cmtx_comment').focus(function() {
                $(this).addClass('cmtx_comment_field_active');

                $('.cmtx_comment_container').addClass('cmtx_comment_container_active');

                $('.cmtx_wait_for_comment').fadeIn('slow');
            });

            /* When the name or email field gets focus, show some other fields */
            $('#cmtx_name, #cmtx_email').focus(function() {
                if ($('input[name="cmtx_subscribe"]').val() == '') {
                    $('.cmtx_wait_for_user').fadeIn('slow');
                }
            });

            /* Adds a BB Code tag for the simple non-modal ones */
            $('.cmtx_bb_code:not([data-cmtx-target-modal])').click(function() {
                var bb_code = $(this).attr('data-cmtx-tag');

                if (bb_code) {
                    bb_code = bb_code.split('|');

                    if (typeof(bb_code[1]) === 'undefined') {
                        cmtx_add_tag('', bb_code[0]);
                    } else {
                        cmtx_add_tag(bb_code[0], bb_code[1]);
                    }
                }
            });

            /* Adds a smiley tag */
            $('.cmtx_smilies_container .cmtx_smiley').click(function() {
                var smiley = $(this).attr('data-cmtx-tag');

                cmtx_add_tag('', smiley);
            });

            /* Insert content from bullet modal */
            $('#cmtx_bullet_modal_insert').click(function(e) {
                var bb_code = $('.cmtx_bb_code_bullet').attr('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var tag = '';

                $('#cmtx_bullet_modal input[type="text"]').each(function() {
                    var item = $.trim($(this).val());

                    if (item != null && item != '') {
                        tag += bb_code[1] + item + bb_code[2] + '\r\n';
                    }
                });

                if (tag != null && tag != '') {
                    tag = bb_code[0] + '\r\n' + tag + bb_code[3];

                    cmtx_add_tag('', tag);
                }

                $('#cmtx_bullet_modal input[type="text"]').val('');

                $('.cmtx_modal_close').trigger('click');
            });

            /* Insert content from numeric modal */
            $('#cmtx_numeric_modal_insert').click(function(e) {
                var bb_code = $('.cmtx_bb_code_numeric').attr('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var tag = '';

                $('#cmtx_numeric_modal input[type="text"]').each(function() {
                    var item = $.trim($(this).val());

                    if (item != null && item != '') {
                        tag += bb_code[1] + item + bb_code[2] + '\r\n';
                    }
                });

                if (tag != null && tag != '') {
                    tag = bb_code[0] + '\r\n' + tag + bb_code[3];

                    cmtx_add_tag('', tag);
                }

                $('#cmtx_numeric_modal input[type="text"]').val('');

                $('.cmtx_modal_close').trigger('click');
            });

            /* Insert content from link modal */
            $('#cmtx_link_modal_insert').click(function(e) {
                var bb_code = $('.cmtx_bb_code_link').attr('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var link = $.trim($('#cmtx_link_modal input[type="url"]').val());

                if (link != null && link != '' && link != 'http://') {
                    var text = $.trim($('#cmtx_link_modal input[type="text"]').val());

                    if (text != null && text != '') {
                        var tag = bb_code[1] + link + bb_code[2] + text + bb_code[3];
                    } else {
                        var tag = bb_code[0] + link + bb_code[3];
                    }

                    cmtx_add_tag('', tag);
                }

                $('#cmtx_link_modal input[type="url"]').val('http://');

                $('#cmtx_link_modal input[type="text"]').val('');

                $('.cmtx_modal_close').trigger('click');
            });

            /* Insert content from email modal */
            $('#cmtx_email_modal_insert').click(function(e) {
                var bb_code = $('.cmtx_bb_code_email').attr('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var email = $.trim($('#cmtx_email_modal input[type="email"]').val());

                if (email != null && email != '') {
                    var text = $.trim($('#cmtx_email_modal input[type="text"]').val());

                    if (text != null && text != '') {
                        var tag = bb_code[1] + email + bb_code[2] + text + bb_code[3];
                    } else {
                        var tag = bb_code[0] + email + bb_code[3];
                    }

                    cmtx_add_tag('', tag);
                }

                $('#cmtx_email_modal input[type="email"]').val('');

                $('#cmtx_email_modal input[type="text"]').val('');

                $('.cmtx_modal_close').trigger('click');
            });

            /* Insert content from image modal */
            $('#cmtx_image_modal_insert').click(function(e) {
                var bb_code = $('.cmtx_bb_code_image').attr('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var image = $.trim($('#cmtx_image_modal input[type="url"]').val());

                if (image != null && image != '' && image != 'http://') {
                    var tag = bb_code[0] + image + bb_code[1];

                    cmtx_add_tag('', tag);
                }

                $('#cmtx_image_modal input[type="url"]').val('http://');

                $('.cmtx_modal_close').trigger('click');
            });

            /* Insert content from YouTube modal */
            $('#cmtx_youtube_modal_insert').click(function(e) {
                var bb_code = $('.cmtx_bb_code_youtube').attr('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var video = $.trim($('#cmtx_youtube_modal input[type="url"]').val());

                if (video != null && video != '' && video != 'http://') {
                    var tag = bb_code[0] + video + bb_code[1];

                    cmtx_add_tag('', tag);
                }

                $('#cmtx_youtube_modal input[type="url"]').val('http://');

                $('.cmtx_modal_close').trigger('click');
            });

            /* Update the comment counter whenever anything is entered */
            $('#cmtx_comment').keyup(function(e) {
                var length = $(this).val().length;

                var maximum = $(this).attr('maxlength');

                $('#cmtx_counter').html(maximum - length);
            });

            /* Simulate entering a comment on page load to update the counter in case it has default text */
            $('#cmtx_comment').trigger('keyup');

            /* Allows the user to deselect the star rating */
            $('input[type="radio"][name="cmtx_rating"]').on('click', function() {
                if ($(this).is('.cmtx_rating_active')) {
                    $(this).prop('checked', false).removeClass('cmtx_rating_active');
                } else {
                    $('input[type="radio"][name="cmtx_rating"].cmtx_rating_active').removeClass('cmtx_rating_active');

                    $(this).addClass('cmtx_rating_active');
                }
            });

            /* Image uploads */
            if (typeof(cmtx_js_settings_form) != 'undefined') {
                if (cmtx_js_settings_form.enabled_upload) {
                    total_size = 0;

                    $('#cmtx_upload').change(function(e) {
                        e.preventDefault();

                        e.stopPropagation();

                        var image = $('#cmtx_upload')[0].files[0];

                        cmtx_upload(image);
                    });

                    function cmtx_upload(image) {
                        $('.cmtx_upload_container').removeClass('cmtx_dragging');

                        if (image) {
                            var size = parseFloat((image.size / 1024 / 1024).toFixed(2));
                            var filename = image.name;
                            var extension = filename.split('.').pop().toLowerCase();

                            if (cmtx_validate_upload(size, extension)) {
                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    var src = e.target.result;

                                    template = '';

                                    template += '<div class="cmtx_image_upload">';
                                    template += '    <div class="cmtx_image_section">';
                                    template += '        <img src="' + src + '" draggable="false" data-cmtx-size="' + size + '">';
                                    template += '        <span class="cmtx_image_overlay">' + size + ' MB</span>';
                                    template += '    </div>';
                                    template += '    <div class="cmtx_button_section">';
                                    template += '        <button type="button" class="cmtx_button cmtx_button_remove" title="' + cmtx_js_settings_form.lang_button_remove + '">' + cmtx_js_settings_form.lang_button_remove + '</button>';
                                    template += '    </div>';
                                    template += '</div>';

                                    $('.cmtx_image_container').append(template);
                                    $('.cmtx_image_row').show();
                                };

                                reader.readAsDataURL(image);
                            }
                        }
                    }

                    $('.cmtx_upload_container').bind('dragenter', function(e) {
                        e.preventDefault();

                        e.stopPropagation();
                    });

                    $('.cmtx_upload_container').bind('dragover', function(e) {
                        e.preventDefault();

                        e.stopPropagation();

                        $('.cmtx_upload_container').addClass('cmtx_dragging');
                    });

                    $('.cmtx_upload_container').bind('dragleave', function(e) {
                        e.preventDefault();

                        e.stopPropagation();

                        $('.cmtx_upload_container').removeClass('cmtx_dragging');
                    });

                    $('body').on('click', '.cmtx_button_remove', function(e) {
                        e.preventDefault();

                        $(this).closest('.cmtx_image_upload').remove();

                        // Hide container if no images
                        var num_images = $('.cmtx_image_upload').length;

                        if (num_images == 0) {
                            $('.cmtx_image_row').hide();
                        }
                    });

                    $('body').on('drop', '#cmtx_upload', function(e) {
                        e.preventDefault();

                        e.stopPropagation();

                        if (e.originalEvent.dataTransfer && e.originalEvent.dataTransfer.files.length) {
                            cmtx_upload(e.originalEvent.dataTransfer.files[0]);
                        }
                    });

                    function cmtx_validate_upload(size, extension) {
                        var num_images = $('.cmtx_image_upload').length;

                        var total_size = 0;

                        $('.cmtx_image_upload').each(function() {
                            total_size = Number(total_size) + Number($(this).find('img').attr('data-cmtx-size'));
                        });

                        total_size = Number(total_size) + Number(size);

                        if (num_images >= cmtx_js_settings_form.maximum_upload_amount) {
                            $('#cmtx_upload_modal .cmtx_modal_body').html('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_num.replace('%d', cmtx_js_settings_form.maximum_upload_amount));

                            $('body').append($('#cmtx_upload_modal'));

                            $('body').append('<div class="cmtx_overlay"></div>');

                            if (isInIframe) {
                                var destination = $('.cmtx_upload_container').offset();

                                $('#cmtx_upload_modal').css({top: destination.top + 50});

                                $('.cmtx_overlay').css('background-color', 'transparent');
                            }

                            $('.cmtx_overlay').fadeIn(200);

                            $('#cmtx_upload_modal').fadeIn(200);

                            return false;
                        }

                        if (size > cmtx_js_settings_form.maximum_upload_size) {
                            $('#cmtx_upload_modal .cmtx_modal_body').html('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_size.replace('%d', cmtx_js_settings_form.maximum_upload_size));

                            $('body').append($('#cmtx_upload_modal'));

                            $('body').append('<div class="cmtx_overlay"></div>');

                            if (isInIframe) {
                                var destination = $('.cmtx_upload_container').offset();

                                $('#cmtx_upload_modal').css({top: destination.top + 50});

                                $('.cmtx_overlay').css('background-color', 'transparent');
                            }

                            $('.cmtx_overlay').fadeIn(200);

                            $('#cmtx_upload_modal').fadeIn(200);

                            return false;
                        }

                        if (total_size > cmtx_js_settings_form.maximum_upload_total) {
                            $('#cmtx_upload_modal .cmtx_modal_body').html('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_total.replace('%d', cmtx_js_settings_form.maximum_upload_total));

                            $('body').append($('#cmtx_upload_modal'));

                            $('body').append('<div class="cmtx_overlay"></div>');

                            if (isInIframe) {
                                var destination = $('.cmtx_upload_container').offset();

                                $('#cmtx_upload_modal').css({top: destination.top + 50});

                                $('.cmtx_overlay').css('background-color', 'transparent');
                            }

                            $('.cmtx_overlay').fadeIn(200);

                            $('#cmtx_upload_modal').fadeIn(200);

                            return false;
                        }

                        if ($.inArray(extension, ['gif', 'jpg', 'jpeg', 'png']) == -1) {
                            $('#cmtx_upload_modal .cmtx_modal_body').html('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_type);

                            $('body').append($('#cmtx_upload_modal'));

                            $('body').append('<div class="cmtx_overlay"></div>');

                            if (isInIframe) {
                                var destination = $('.cmtx_upload_container').offset();

                                $('#cmtx_upload_modal').css({top: destination.top + 50});

                                $('.cmtx_overlay').css('background-color', 'transparent');
                            }

                            $('.cmtx_overlay').fadeIn(200);

                            $('#cmtx_upload_modal').fadeIn(200);

                            return false;
                        }

                        return true;
                    }
                }
            }

            /* Populate states field */
            if (typeof(cmtx_js_settings_form) != 'undefined') {
                if (cmtx_js_settings_form.enabled_country && cmtx_js_settings_form.enabled_state) {
                    $('#cmtx_country').bind('change', function() {
                        var country_id = encodeURIComponent($('#cmtx_country').val());

                        if (country_id) {
                            var request = $.ajax({
                                type: 'POST',
                                cache: false,
                                url: cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/getStates',
                                data: 'country_id=' + country_id,
                                dataType: 'json',
                                beforeSend: function() {
                                    $('#cmtx_state').html('<option value="">' + cmtx_js_settings_form.lang_text_loading + '</option>');
                                }
                            });

                            request.done(function(response) {
                                setTimeout(function() {
                                    states = response;

                                    html = '<option value="" hidden>' + cmtx_js_settings_form.lang_placeholder_state + '</option>';

                                    if (states.length) {
                                        for (i = 0; i < states.length; i++) {
                                            html += '<option value="' + states[i]['id'] + '"';

                                            if (states[i]['id'] == cmtx_js_settings_form.state_id) {
                                                html += ' selected';
                                            }

                                            html += '>' + states[i]['name'] + '</option>';
                                        }
                                    } else {
                                        html += '<option value="" disabled>' + cmtx_js_settings_form.lang_text_country_first + '</option>';
                                    }

                                    $('#cmtx_state').html(html);

                                    $('#cmtx_state').trigger('change');
                                }, 500);
                            });

                            request.fail(function(jqXHR, textStatus, errorThrown) {
                                if (console && console.log) {
                                    console.log(jqXHR.responseText);
                                }
                            });
                        } else {
                            html = '<option value="" hidden>' + cmtx_js_settings_form.lang_placeholder_state + '</option>';

                            html += '<option value="" disabled>' + cmtx_js_settings_form.lang_text_country_first + '</option>';

                            $('#cmtx_state').html(html);
                        }
                    });

                    $('#cmtx_country').trigger('change');
                }
            }

            /* Securimage captcha */
            if (typeof(cmtx_js_settings_form) != 'undefined') {
                if (cmtx_js_settings_form.securimage) {
                    $('#cmtx_securimage_refresh').click(function() {
                        var src = cmtx_js_settings_form.securimage_url + '&' + Math.random();

                        $('#cmtx_securimage_image').attr('src', src);
                    });
                }
            }

            /* Submit or preview a comment */
            $('#cmtx_submit_button, #cmtx_preview_button').click(function(e) {
                e.preventDefault();

                $('.cmtx_upload_field').remove();

                $('.cmtx_image_upload').each(function() {
                    var image = $(this).find('img').attr('src');

                    $('#cmtx_form').append('<input type="hidden" name="cmtx_upload[]" class="cmtx_upload_field" value="' + image + '">');
                });

                // Find any disabled inputs and remove the "disabled" attribute
                var disabled = $('#cmtx_form').find(':input:disabled').removeAttr('disabled');

                // Serialize the form
                var serialized = $('#cmtx_form').serialize();

                // Re-disable the set of inputs that were originally disabled
                disabled.attr('disabled', 'disabled');

                var request = $.ajax({
                    type: 'POST',
                    cache: false,
                    url: cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/submit',
                    data: serialized + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_form.page_id) + '&cmtx_type=' + encodeURIComponent($(this).attr('data-cmtx-type')) + $('#cmtx_hidden_data').val(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#cmtx_submit_button, #cmtx_preview_button').val(cmtx_js_settings_form.lang_button_processing);

                        $('#cmtx_submit_button, #cmtx_preview_button').prop('disabled', true);

                        $('#cmtx_submit_button, #cmtx_preview_button').addClass('cmtx_button_disabled');
                    }
                });

                request.always(function() {
                    $('#cmtx_submit_button').val(cmtx_js_settings_form.lang_button_submit);

                    $('#cmtx_preview_button').val(cmtx_js_settings_form.lang_button_preview);

                    $('#cmtx_submit_button, #cmtx_preview_button').prop('disabled', false);

                    $('#cmtx_submit_button, #cmtx_preview_button').removeClass('cmtx_button_disabled');

                    $('#cmtx_comment').addClass('cmtx_comment_field_active');

                    $('.cmtx_comment_container').addClass('cmtx_comment_container_active');

                    $('.cmtx_wait_for_user, .cmtx_wait_for_comment').not('.cmtx_captcha_complete').fadeIn('slow');
                });

                request.done(function(response) {
                    $('.cmtx_message_success, .cmtx_message_error, .cmtx_error').remove();

                    $('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

                    if (response['result']['preview']) {
                        $('#cmtx_preview').html(response['result']['preview']);

                        cmtxHighlightCode();
                    } else {
                        $('#cmtx_preview').html('');
                    }

                    if (response['result']['success']) {
                        $('#cmtx_comment, #cmtx_answer, #cmtx_securimage').val('');

                        $('.cmtx_image_upload').remove();

                        $('.cmtx_image_row').hide();

                        $('input[name="cmtx_rating"]').prop('checked', false).removeClass('cmtx_rating_active');

                        if (response['hide_rating']) {
                            $('.cmtx_rating_row').remove();
                        }

                        $('#cmtx_securimage_refresh').trigger('click');

                        if (typeof(grecaptcha) != 'undefined') {
                            grecaptcha.reset();
                        }

                        $('input[name="cmtx_reply_to"]').val('');

                        $('.cmtx_message_reply').remove();

                        $('#cmtx_form').before('<div class="cmtx_message cmtx_message_success">' + response['result']['success'] + '</div>');

                        $('.cmtx_message_success').fadeIn(1500).delay(3000).fadeOut(1000);

                        var options = {
                            'commentics_url': cmtx_js_settings_form.commentics_url,
                            'page_id'       : cmtx_js_settings_form.page_id,
                            'page_number'   : '',
                            'sort_by'       : '',
                            'search'        : '',
                            'effect'        : false
                        }

                        cmtxRefreshComments(options);
                    }

                    if (response['result']['error']) {
                        if (response['error']['comment']) {
                            $('#cmtx_comment').addClass('cmtx_field_error');

                            $('#cmtx_comment').after('<span class="cmtx_error">' + response['error']['comment'] + '</span>');
                        }

                        if (response['error']['name']) {
                            $('#cmtx_name').addClass('cmtx_field_error');

                            $('#cmtx_name').after('<span class="cmtx_error">' + response['error']['name'] + '</span>');
                        }

                        if (response['error']['email']) {
                            $('#cmtx_email').addClass('cmtx_field_error');

                            $('#cmtx_email').after('<span class="cmtx_error">' + response['error']['email'] + '</span>');
                        }

                        if (response['error']['rating']) {
                            $('#cmtx_rating').addClass('cmtx_field_error');

                            $('#cmtx_rating').after('<span class="cmtx_error">' + response['error']['rating'] + '</span>');
                        }

                        if (response['error']['website']) {
                            $('#cmtx_website').addClass('cmtx_field_error');

                            $('#cmtx_website').after('<span class="cmtx_error">' + response['error']['website'] + '</span>');
                        }

                        if (response['error']['town']) {
                            $('#cmtx_town').addClass('cmtx_field_error');

                            $('#cmtx_town').after('<span class="cmtx_error">' + response['error']['town'] + '</span>');
                        }

                        if (response['error']['country']) {
                            $('#cmtx_country').addClass('cmtx_field_error');

                            $('#cmtx_country').after('<span class="cmtx_error">' + response['error']['country'] + '</span>');
                        }

                        if (response['error']['state']) {
                            $('#cmtx_state').addClass('cmtx_field_error');

                            $('#cmtx_state').after('<span class="cmtx_error">' + response['error']['state'] + '</span>');
                        }

                        if (response['error']['answer']) {
                            $('#cmtx_answer').addClass('cmtx_field_error');

                            $('#cmtx_answer').after('<span class="cmtx_error">' + response['error']['answer'] + '</span>');
                        }

                        if (response['error']['recaptcha']) {
                            $('#g-recaptcha').after('<span class="cmtx_error">' + response['error']['recaptcha'] + '</span>');

                            grecaptcha.reset();
                        }

                        if (response['error']['securimage']) {
                            $('#cmtx_securimage').addClass('cmtx_field_error');

                            $('#cmtx_securimage').after('<span class="cmtx_error">' + response['error']['securimage'] + '</span>');

                            $('#cmtx_securimage_refresh').trigger('click');

                            $('#cmtx_securimage').val('');
                        }

                        $('#cmtx_form').before('<div class="cmtx_message cmtx_message_error">' + response['result']['error'] + '</div>');

                        $('.cmtx_message_error, .cmtx_container_error, .cmtx_error').fadeIn(2000);
                    }

                    if (response['question']) {
                        $('#cmtx_question').text(response['question']);
                    }

                    cmtxAutoScroll($("#cmtx_form_container"));
                });

                request.fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {
                        console.log(jqXHR.responseText);
                    }
                });
            });

            /* Show a bio popup when hovering over the Gravatar image */
            $('body').on('mouseenter', '.cmtx_gravatar_area', function() {
                $(this).find('.cmtx_bio').stop(true, true).fadeIn(750);
            });

            $('body').on('mouseleave', '.cmtx_gravatar_area', function() {
                $(this).find('.cmtx_bio').stop(true, true).fadeOut(500);
            });

            if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
                $('body').on('mouseenter', '.cmtx_bio', function() {
                    $(this).stop(true, true).fadeOut(500);
                });
            }

            /* Show replies when view replies link is clicked */
            $('body').on('click', '.cmtx_view_replies_link', function(e) {
                e.preventDefault();

                $(this).parent().hide();

                $(this).closest('.cmtx_comment_box').next().fadeIn('slow');
            });

            /* Sort by */
            $('#cmtx_container').on('change', '.cmtx_sort_by_field', function(e) {
                e.preventDefault();

                var options = {
                    'commentics_url': cmtx_js_settings_comments.commentics_url,
                    'page_id'       : cmtx_js_settings_comments.page_id,
                    'page_number'   : '',
                    'sort_by'       : $(this).val(),
                    'search'        : cmtxGetSearchValue(),
                    'effect'        : true
                }

                cmtxRefreshComments(options);
            });

            /* Search */
            $('#cmtx_container').on('focus', '.cmtx_search', function(e) {
                $(this).addClass('cmtx_search_focus');
            });

            $('#cmtx_container').on('click', '.cmtx_search_container .fa-search', function(e) {
                e.preventDefault();

                var options = {
                    'commentics_url': cmtx_js_settings_comments.commentics_url,
                    'page_id'       : cmtx_js_settings_comments.page_id,
                    'page_number'   : '',
                    'sort_by'       : cmtxGetSortByValue(),
                    'search'        : $(this).prev().val(),
                    'effect'        : true
                }

                cmtxRefreshComments(options);
            });

            $('#cmtx_container').on('keypress', '.cmtx_search', function(e) {
                if (e.which == 13) {
                    $(this).next().trigger('click');
                }
            });

            /* Average rating */
            $('#cmtx_container').on('click', '.cmtx_average_rating label', function(e) {
                e.preventDefault();

                var element = $(this);

                var rating = $(this).prev().val();

                var request = $.ajax({
                    type: 'POST',
                    cache: false,
                    url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=part/average_rating/rate',
                    data: 'cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id) + '&cmtx_rating=' + encodeURIComponent(rating),
                    dataType: 'json'
                });

                request.done(function(response) {
                    if (response['success']) {
                        $('.cmtx_average_rating input').prop('checked', false);

                        $(".cmtx_average_rating input[value=" + response['average_rating'] + "]").prop('checked', true);

                        $('.cmtx_average_rating_stat_rating, .cmtx_average_rating_stat_number').fadeOut(250, function() {
                            $('.cmtx_average_rating_stat_rating').text(response['average_rating']).fadeIn(2000);

                            $('.cmtx_average_rating_stat_number').text(response['num_of_ratings']).fadeIn(2000);
                        });

                        $('.cmtx_action_message_success').clearQueue();
                        $('.cmtx_action_message_success').html(response['success']);
                        $('.cmtx_action_message_success').fadeIn(500).delay(2000).fadeOut(500);

                        var destination = element.offset();

                        $('.cmtx_action_message_success').css({top: destination.top - 20, left: destination.left - 30});
                    }

                    if (response['error']) {
                        $('.cmtx_action_message_error').clearQueue();
                        $('.cmtx_action_message_error').html(response['error']);
                        $('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);

                        var destination = element.offset();

                        $('.cmtx_action_message_error').css({top: destination.top - 20, left: destination.left - 30});
                    }
                });

                request.fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {
                        console.log(jqXHR.responseText);
                    }
                });
            });

            /* Pagination */
            $('#cmtx_container').on('click', '.cmtx_pagination_url', function(e) {
                e.preventDefault();

                // This is to stop multiple calls to this event.
                // Occurs when pagination links shown twice (e.g. above and below comments).
                e.stopImmediatePropagation();

                var options = {
                    'commentics_url': cmtx_js_settings_comments.commentics_url,
                    'page_id'       : cmtx_js_settings_comments.page_id,
                    'page_number'   : $(this).find('span').attr('data-cmtx-page'),
                    'sort_by'       : cmtxGetSortByValue(),
                    'search'        : cmtxGetSearchValue(),
                    'effect'        : true
                }

                cmtxRefreshComments(options);
            });

            /* Notify */
            $('#cmtx_container').on('click', '.cmtx_notify_block a', function(e) {
                e.preventDefault();

                $('.cmtx_message, .cmtx_error, .cmtx_subscribe_row').remove();

                $('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

                $('.cmtx_wait_for_user').show();

                $('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_upload_row, .cmtx_image_row, .cmtx_rating_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_checkbox_container, .cmtx_button_row').hide();

                if ($('input[name="cmtx_subscribe"]').val() == '') {
                    cmtx_heading_text = $('.cmtx_form_heading').text();
                }

                $('.cmtx_form_heading').fadeOut(500, function() {
                    $('.cmtx_form_heading').text(cmtx_js_settings_notify.lang_heading_notify).fadeIn(500);
                });

                var notify_button = '';

                notify_button += '<div class="cmtx_row cmtx_button_row cmtx_subscribe_row cmtx_clear">';

                    notify_button += '<div class="cmtx_col_2">';

                        notify_button += '<div class="cmtx_container cmtx_submit_button_container">';

                            notify_button += '<input type="button" id="cmtx_notify_button" class="cmtx_button cmtx_button_primary" value="' + cmtx_js_settings_notify.lang_button_notify + '" title="' + cmtx_js_settings_notify.lang_button_notify + '">';

                        notify_button += '</div>';

                    notify_button += '</div>';

                    notify_button += '<div class="cmtx_col_10"></div>';

                notify_button += '</div>';

                $('.cmtx_button_row').after(notify_button);

                $('input[name="cmtx_subscribe"]').val('1');

                $('#cmtx_form').before('<div class="cmtx_message cmtx_message_info cmtx_message_notify">' + cmtx_js_settings_notify.lang_text_notify_info + ' ' + '<a href="#" title="' + cmtx_js_settings_notify.lang_title_cancel_notify + '">' + cmtx_js_settings_notify.lang_link_cancel + '</a></div>');

                cmtxAutoScroll($("#cmtx_form_container"));

                $('.cmtx_message_notify').fadeIn(1000);
            });

            $('body').on('click', '.cmtx_message_notify a', function(e) {
                e.preventDefault();

                cmtx_cancel_notify();
            });

            $('body').on('click', '#cmtx_notify_button', function(e) {
                e.preventDefault();

                // Find any disabled inputs and remove the "disabled" attribute
                var disabled = $('#cmtx_form').find(':input:disabled').removeAttr('disabled');

                // Serialize the form
                var serialized = $('#cmtx_form').serialize();

                // Re-disable the set of inputs that were originally disabled
                disabled.attr('disabled', 'disabled');

                var request = $.ajax({
                    type: 'POST',
                    cache: false,
                    url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=part/notify/notify',
                    data: serialized + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id) + $('#cmtx_hidden_data').val(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#cmtx_notify_button').val(cmtx_js_settings_notify.lang_button_processing);

                        $('#cmtx_notify_button').prop('disabled', true);

                        $('#cmtx_notify_button').addClass('cmtx_button_disabled');
                    }
                });

                request.always(function() {
                    $('#cmtx_notify_button').val(cmtx_js_settings_notify.lang_button_notify);

                    $('#cmtx_notify_button').prop('disabled', false);

                    $('#cmtx_notify_button').removeClass('cmtx_button_disabled');
                });

                request.done(function(response) {
                    $('.cmtx_message:not(.cmtx_message_notify), .cmtx_error').remove();

                    $('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

                    if (response['result']['success']) {
                        $('#cmtx_answer, #cmtx_securimage').val('');

                        $('#cmtx_securimage_refresh').trigger('click');

                        if (typeof(grecaptcha) != 'undefined') {
                            grecaptcha.reset();
                        }

                        cmtx_cancel_notify();

                        $('#cmtx_form').before('<div class="cmtx_message cmtx_message_success">' + response['result']['success'] + '</div>');

                        $('.cmtx_message_success').fadeIn(1500).delay(3000).fadeOut(1000);
                    }

                    if (response['result']['error']) {
                        if (response['error']['name']) {
                            $('#cmtx_name').addClass('cmtx_field_error');

                            $('#cmtx_name').after('<span class="cmtx_error">' + response['error']['name'] + '</span>');
                        }

                        if (response['error']['email']) {
                            $('#cmtx_email').addClass('cmtx_field_error');

                            $('#cmtx_email').after('<span class="cmtx_error">' + response['error']['email'] + '</span>');
                        }

                        if (response['error']['answer']) {
                            $('#cmtx_answer').addClass('cmtx_field_error');

                            $('#cmtx_answer').after('<span class="cmtx_error">' + response['error']['answer'] + '</span>');
                        }

                        if (response['error']['recaptcha']) {
                            $('#g-recaptcha').after('<span class="cmtx_error">' + response['error']['recaptcha'] + '</span>');

                            grecaptcha.reset();
                        }

                        if (response['error']['securimage']) {
                            $('#cmtx_securimage').addClass('cmtx_field_error');

                            $('#cmtx_securimage').after('<span class="cmtx_error">' + response['error']['securimage'] + '</span>');

                            $('#cmtx_securimage_refresh').trigger('click');

                            $('#cmtx_securimage').val('');
                        }

                        $('#cmtx_form').before('<div class="cmtx_message cmtx_message_error">' + response['result']['error'] + '</div>');

                        $('.cmtx_message_error, .cmtx_container_error, .cmtx_error').fadeIn(2000);
                    }

                    if (response['question']) {
                        $('#cmtx_question').text(response['question']);
                    }

                    cmtxAutoScroll($("#cmtx_form_container"));
                });
            });

            function cmtx_cancel_notify() {
                $('.cmtx_message:not(.cmtx_message_notify), .cmtx_error, .cmtx_subscribe_row').remove();

                $('.cmtx_field, .cmtx_rating').removeClass('cmtx_field_error');

                $('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_upload_row, .cmtx_rating_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_checkbox_container, .cmtx_button_row').show();

                $('#cmtx_comment').addClass('cmtx_comment_field_active');

                $('.cmtx_form_heading').fadeOut(250, function() {
                    $('.cmtx_form_heading').text(cmtx_heading_text).fadeIn(500);
                });

                $('input[name="cmtx_subscribe"]').val('');

                $('.cmtx_message_notify').fadeOut(500);
            }

            /* Like or dislike a comment */
            $('#cmtx_container').on('click', '.cmtx_vote_link', function(e) {
                e.preventDefault();

                var vote_link = $(this);

                if ($(this).hasClass('cmtx_like_link')) {
                    var type = 'like';
                } else {
                    var type = 'dislike';
                }

                var request = $.ajax({
                    type: 'POST',
                    cache: false,
                    url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/vote',
                    data: 'cmtx_comment_id=' + encodeURIComponent($(this).closest('.cmtx_comment_box').attr('data-cmtx-comment-id')) + '&cmtx_type=' + encodeURIComponent(type),
                    dataType: 'json'
                });

                request.done(function(response) {
                    if (response['success']) {
                        vote_link.find('.cmtx_vote_count').text(parseInt(vote_link.find('.cmtx_vote_count').text(), 10) + 1);

                        if (type == 'like') {
                            vote_link.find('.cmtx_vote_count').addClass('like_animation');

                            setTimeout(function() {
                                $('.cmtx_vote_count').removeClass('like_animation');
                            }, 2000);
                        } else {
                            vote_link.find('.cmtx_vote_count').addClass('dislike_animation');

                            setTimeout(function() {
                                $('.cmtx_vote_count').removeClass('dislike_animation');
                            }, 2000);
                        }
                    }

                    if (response['error']) {
                        $('.cmtx_action_message_error').clearQueue();
                        $('.cmtx_action_message_error').html(response['error']);
                        $('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);

                        var destination = vote_link.offset();

                        $('.cmtx_action_message_error').css({top: destination.top - 25, left: destination.left - 45});
                    }
                });

                request.fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {
                        console.log(jqXHR.responseText);
                    }
                });
            });

            /* Share a comment */
            $('#cmtx_container').on('click', '.cmtx_share_link', function(e) {
                e.preventDefault();

                $('.cmtx_share_box').hide();

                var share_link = $(this);

                var permalink = encodeURIComponent($(this).attr('data-cmtx-sharelink'));

                var reference = encodeURIComponent($('.cmtx_share_box').attr('data-cmtx-reference'));

                $('.cmtx_share_digg').parent().attr('href', 'http://digg.com/submit?url=' + permalink + '&title=' + reference);
                $('.cmtx_share_facebook').parent().attr('href', 'https://www.facebook.com/sharer.php?u=' + permalink);
                $('.cmtx_share_linkedin').parent().attr('href', 'https://www.linkedin.com/shareArticle?mini=true&url=' + permalink + '&title=' + reference);
                $('.cmtx_share_reddit').parent().attr('href', 'https://reddit.com/submit?url=' + permalink + '&title=' + reference);
                $('.cmtx_share_twitter').parent().attr('href', 'https://twitter.com/intent/tweet?url=' + permalink + '&text=' + reference);
                $('.cmtx_share_weibo').parent().attr('href', 'http://service.weibo.com/share/share.php?url=' + permalink + '&title=' + reference);

                $('.cmtx_share_box').clearQueue();
                $('.cmtx_share_box').fadeIn(400);

                var destination = share_link.offset();

                $('.cmtx_share_box').css({top: destination.top - 38, left: destination.left - 55});
            });

            $(document).mouseup(function(e) {
                var container = $('.cmtx_share_box');

                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.fadeOut(400);
                }
            });

            /* Flag modal */
            $('body').on('click', '#cmtx_flag_modal_yes', function(e) {
                e.preventDefault();

                var comment_id = $(this).attr('data-cmtx-comment-id');

                var flag_link = $('.cmtx_comment_box[data-cmtx-comment-id=' + comment_id + '] .cmtx_flag_link');

                var request = $.ajax({
                    type: 'POST',
                    cache: false,
                    url: cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/flag',
                    data: 'cmtx_comment_id=' + encodeURIComponent(comment_id) + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id),
                    dataType: 'json'
                });

                request.done(function(response) {
                    if (response['success']) {
                        $('.cmtx_action_message_success').clearQueue();
                        $('.cmtx_action_message_success').html(response['success']);
                        $('.cmtx_action_message_success').fadeIn(500).delay(2000).fadeOut(500);

                        var destination = flag_link.offset();

                        $('.cmtx_action_message_success').css({top: destination.top - 20, left: destination.left - 100});
                    }

                    if (response['error']) {
                        $('.cmtx_action_message_error').clearQueue();
                        $('.cmtx_action_message_error').html(response['error']);
                        $('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);

                        var destination = flag_link.offset();

                        $('.cmtx_action_message_error').css({top: destination.top - 25, left: destination.left - 100});
                    }
                });

                request.fail(function(jqXHR, textStatus, errorThrown) {
                    if (console && console.log) {
                        console.log(jqXHR.responseText);
                    }
                });

                $('.cmtx_modal_close').trigger('click');
            });

            /* Permalink for a comment */
            $('#cmtx_container').on('click', '.cmtx_permalink_link', function(e) {
                e.preventDefault();

                $('.cmtx_permalink_box').hide();

                var permalink_link = $(this);

                var permalink = $(this).attr('data-cmtx-permalink');

                $('#cmtx_permalink').val(permalink);

                $('.cmtx_permalink_box').clearQueue();
                $('.cmtx_permalink_box').fadeIn(400);

                var box_width = $('.cmtx_permalink_box').width();

                var box_height = $('.cmtx_permalink_box').height();

                var link_height = permalink_link.height();

                var destination = permalink_link.offset();

                $('.cmtx_permalink_box').css({top: destination.top - box_height - link_height - 5, left: destination.left - box_width});

                $('#cmtx_permalink').select();
            });

            $('#cmtx_container').on('click', '.cmtx_permalink_box a', function(e) {
                e.preventDefault();

                $('.cmtx_permalink_box').fadeOut(400);
            });

            $(document).mouseup(function(e) {
                var container = $('.cmtx_permalink_box');

                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    container.fadeOut(400);
                }
            });

            /* Reply to a comment */
            $('#cmtx_container').on('click', '.cmtx_reply_link', function(e) {
                e.preventDefault();

                if ($('input[name="cmtx_subscribe"]').val() == '1') {
                    $('.cmtx_message_notify a').trigger('click');
                }

                $('.cmtx_message_info').remove();

                var comment_id = $(this).closest('.cmtx_comment_box').attr('data-cmtx-comment-id');

                var name = $(this).closest('.cmtx_comment_box').find('.cmtx_name_text').text();

                $('input[name="cmtx_reply_to"]').val(comment_id);

                $('#cmtx_form').before('<div class="cmtx_message cmtx_message_info cmtx_message_reply">' + cmtx_js_settings_comments.lang_text_replying_to + ' ' + name + ' <a href="#" title="' + cmtx_js_settings_comments.lang_title_cancel_reply + '">' + cmtx_js_settings_comments.lang_link_cancel + '</a></div>');

                cmtxAutoScroll($("#cmtx_form_container"));

                $('.cmtx_message_reply').fadeIn(2000);
            });

            $('body').on('click', '.cmtx_message_reply a', function(e) {
                e.preventDefault();

                $('input[name="cmtx_reply_to"]').val('');

                $('.cmtx_message_reply').text(cmtx_js_settings_comments.lang_text_not_replying);
            });

            /* Load more comments button */
            $('#cmtx_container').on('click', '#cmtx_more_button', function(e) {
                e.preventDefault();

                $('#cmtx_more_button').val(cmtx_js_settings_comments.lang_button_loading);

                $('#cmtx_more_button').prop('disabled', true);

                $('#cmtx_more_button').addClass('cmtx_button_disabled');

                var next_page = parseInt($('#cmtx_next_page').val());

                $('#cmtx_next_page').val(next_page + 1);

                var options = {
                    'commentics_url': cmtx_js_settings_comments.commentics_url,
                    'page_id'       : cmtx_js_settings_comments.page_id,
                    'page_number'   : next_page,
                    'sort_by'       : cmtxGetSortByValue(),
                    'search'        : cmtxGetSearchValue(),
                    'pagination'    : 'button',
                    'effect'        : false
                }

                cmtxRefreshComments(options);
            });

            /* Return to comments link */
            $('#cmtx_container').on('click', '.cmtx_no_results a, .cmtx_return a', function(e) {
                e.preventDefault();

                $('#cmtx_search').val('');

                cmtx_js_settings_comments.is_permalink = false;

                var options = {
                    'commentics_url': cmtx_js_settings_comments.commentics_url,
                    'page_id'       : cmtx_js_settings_comments.page_id,
                    'page_number'   : '',
                    'sort_by'       : '',
                    'search'        : '',
                    'effect'        : true
                }

                cmtxRefreshComments(options);
            });

            /* Infinite scroll */
            if (typeof(cmtx_js_settings_comments) != 'undefined') {
                if (cmtx_js_settings_comments.show_pagination && cmtx_js_settings_comments.pagination_type == 'infinite') {
                    if (isInIframe) {
                        if (window.addEventListener) {
                            window.addEventListener('message', function (e) {
                                if (e.data && e.data == 'infinite_scroll' && !cmtx_js_settings_comments.is_permalink) {
                                    cmtxInfiniteScrollIframe();
                                }
                            }, false);
                        }
                    } else {
                        $(window).off('scroll', cmtxInfiniteScroll).on('scroll', cmtxInfiniteScroll);
                    }
                }
            }

            cmtxViewReplies();
            cmtxTimeago();
            cmtxHighlightCode();

            /* Viewers Online */

            if (typeof(cmtx_js_settings_online) != 'undefined') {
                if (cmtx_js_settings_online.online_refresh_enabled) {
                    setInterval(function() {
                        var request = $.ajax({
                            type: 'POST',
                            cache: false,
                            url: cmtx_js_settings_online.commentics_url + 'frontend/index.php?route=part/online/refresh',
                            data: 'cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_online.page_id),
                            dataType: 'json'
                        });

                        request.done(function(response) {
                            if (response['online'] != 'undefined') { // may be zero
                                if ($('.cmtx_online_num').first().text() != response['online']) { // only update if different
                                    $('.cmtx_online_num').fadeOut(function() {
                                        $('.cmtx_online_num').text(response['online']).fadeIn();
                                    });
                                }
                            }
                        });

                        request.fail(function(jqXHR, textStatus, errorThrown) {
                            if (console && console.log) {
                                console.log(jqXHR.responseText);
                            }
                        });
                    }, cmtx_js_settings_online.online_refresh_interval);
                }
            }

            /* User Page */

            if (typeof(cmtx_js_settings_user) != 'undefined') {
                if (cmtx_js_settings_user.to_all) {
                    $('#cmtx_user_container .cmtx_notifications_area_custom').hide();
                } else {
                    $('#cmtx_user_container .cmtx_notifications_area_custom').show();
                }

                $('#cmtx_user_container input[name="to_all"]').on('change', function() {
                    if ($(this).val() == '1') {
                        $('#cmtx_user_container .cmtx_notifications_area_custom').fadeOut(500);
                    } else {
                        $('#cmtx_user_container .cmtx_notifications_area_custom').fadeIn(1000);
                    }
                });

                cmtxTimeago();

                $('#cmtx_user_container input').change(function(e) {
                    var request = $.ajax({
                        type: 'POST',
                        cache: false,
                        url: cmtx_js_settings_user.commentics_url + 'frontend/index.php?route=main/user/save',
                        data: $('form').serialize() + '&u-t=' + encodeURIComponent(cmtx_js_settings_user.token),
                        dataType: 'json',
                        beforeSend: function() {
                            $('.cmtx_message').remove();

                            $('form').before('<div class="cmtx_message cmtx_message_info">' + cmtx_js_settings_user.lang_text_saving + '</div>');

                            $('.cmtx_message').show();
                        }
                    });

                    request.done(function(response) {
                        cmtxAutoScroll($(".cmtx_user_container"));

                        setTimeout(function() {
                            $('.cmtx_message').remove();

                            if (response['success']) {
                                $('form').before('<div class="cmtx_message cmtx_message_success">' + response['success'] + '</div>');

                                $('.cmtx_message').show();
                            }

                            if (response['error']) {
                                $('form').before('<div class="cmtx_message cmtx_message_error">' + response['error'] + '</div>');

                                $('.cmtx_message').show();
                            }
                        }, 1000);
                    });
                });

                $('#cmtx_user_container .cmtx_trash_icon').click(function(e) {
                    var $this = $(this);

                    var request = $.ajax({
                        type: 'POST',
                        cache: false,
                        url: cmtx_js_settings_user.commentics_url + 'frontend/index.php?route=main/user/deleteSubscription',
                        data: '&u-t=' + encodeURIComponent(cmtx_js_settings_user.token) + '&s-t=' + encodeURIComponent($(this).attr('data-sub-token')),
                        dataType: 'json'
                    });

                    request.done(function(response) {
                        $('.cmtx_message').remove();

                        if (response['success']) {
                            $this.parent().parent().remove();

                            $('.count').text(response['count']);

                            if (response['count'] == '0') {
                                $('tbody').append('<tr><td class="cmtx_no_results" colspan="4">' + cmtx_js_settings_user.lang_text_no_results + '</td></tr>');
                            } else {
                                var i = 1;

                                $('tbody tr td:first-child').each(function() {
                                    $(this).text(i);

                                    i++;
                                });
                            }
                        }

                        if (response['error']) {
                            cmtxAutoScroll($(".cmtx_user_container"));

                            $('form').before('<div class="cmtx_message cmtx_message_error">' + response['error'] + '</div>');

                            $('.cmtx_message').show();
                        }
                    });
                });

                $('#cmtx_user_container .cmtx_delete_all').click(function(e) {
                    e.preventDefault();

                    var request = $.ajax({
                        type: 'POST',
                        cache: false,
                        url: cmtx_js_settings_user.commentics_url + 'frontend/index.php?route=main/user/deleteAllSubscriptions',
                        data: '&u-t=' + encodeURIComponent(cmtx_js_settings_user.token),
                        dataType: 'json'
                    });

                    request.done(function(response) {
                        $('.cmtx_message').remove();

                        if (response['success']) {
                            $('.count').text('0');

                            $('tbody').html('<tr><td class="cmtx_no_results" colspan="4">' + cmtx_js_settings_user.lang_text_no_results + '</td></tr>');
                        }

                        if (response['error']) {
                            cmtxAutoScroll($(".cmtx_user_container"));

                            $('form').before('<div class="cmtx_message cmtx_message_error">' + response['error'] + '</div>');

                            $('.cmtx_message').show();
                        }
                    });
                });
            }
        });
    }
}, 100);

/* Get the value from the sort by field */
function cmtxGetSortByValue() {
    var sort_by = $('select[name="cmtx_sort_by"]').val();

    if (typeof(sort_by) == 'undefined') {
        sort_by = '';
    }

    return sort_by;
}

/* Get the value from the search field */
function cmtxGetSearchValue() {
    var search = $('input[name="cmtx_search"]').val();

    if (typeof(search) == 'undefined') {
        search = '';
    }

    return search;
}

/* Infinite scroll */
var scroll_timeout = null;

function cmtxInfiniteScroll() {
    if ($('#cmtx_loading_helper').attr('data-cmtx-load') == '1') {
        clearTimeout(scroll_timeout);

        scroll_timeout = setTimeout(function() {
            var element_distance = Math.ceil($('#cmtx_loading_helper').offset().top);

            // if the sum of the window height and scroll distance from the top is greater than the target element's distance from the top
            if (($(window).height() + $(this).scrollTop()) > element_distance) {
                var next_page = parseInt($('#cmtx_next_page').val());

                $('#cmtx_next_page').val(next_page + 1);

                var options = {
                    'commentics_url': cmtx_js_settings_comments.commentics_url,
                    'page_id'       : cmtx_js_settings_comments.page_id,
                    'page_number'   : next_page,
                    'sort_by'       : cmtxGetSortByValue(),
                    'search'        : cmtxGetSearchValue(),
                    'pagination'    : 'infinite',
                    'effect'        : false
                }

                cmtxRefreshComments(options);
            }
        }, 200);
    }
}

function cmtxInfiniteScrollIframe(e) {
    if ($('#cmtx_loading_helper').attr('data-cmtx-load') == '1') {
        var next_page = parseInt($('#cmtx_next_page').val());

        $('#cmtx_next_page').val(next_page + 1);

        var options = {
            'commentics_url': cmtx_js_settings_comments.commentics_url,
            'page_id'       : cmtx_js_settings_comments.page_id,
            'page_number'   : next_page,
            'sort_by'       : cmtxGetSortByValue(),
            'search'        : cmtxGetSearchValue(),
            'pagination'    : 'infinite',
            'effect'        : false
        }

        cmtxRefreshComments(options);
    }
}

if (typeof window.iFrameResizer != 'undefined' && window.iFrameResizer != null) {
    window.iFrameResizer = {
        messageCallback: function (message) {
            console.log('test');
            console.log(message);
        }
    };
}

/* Auto update the time with e.g. '2 minutes ago' */
function cmtxTimeago() {
    if (typeof(cmtx_js_settings_comments) != 'undefined') {
        if (cmtx_js_settings_comments.date_auto) {
            $.timeago.settings.strings = {
                suffixAgo: cmtx_js_settings_comments.timeago_suffixAgo,
                inPast   : cmtx_js_settings_comments.timeago_inPast,
                seconds  : cmtx_js_settings_comments.timeago_seconds,
                minute   : cmtx_js_settings_comments.timeago_minute,
                minutes  : cmtx_js_settings_comments.timeago_minutes,
                hour     : cmtx_js_settings_comments.timeago_hour,
                hours    : cmtx_js_settings_comments.timeago_hours,
                day      : cmtx_js_settings_comments.timeago_day,
                days     : cmtx_js_settings_comments.timeago_days,
                month    : cmtx_js_settings_comments.timeago_month,
                months   : cmtx_js_settings_comments.timeago_months,
                year     : cmtx_js_settings_comments.timeago_year,
                years    : cmtx_js_settings_comments.timeago_years
            };

            $('.cmtx_date_area .timeago').timeago();
        }
    }

    if (typeof(cmtx_js_settings_user) != 'undefined') {
        $.timeago.settings.strings = {
            suffixAgo: cmtx_js_settings_user.timeago_suffixAgo,
            inPast   : cmtx_js_settings_user.timeago_inPast,
            seconds  : cmtx_js_settings_user.timeago_seconds,
            minute   : cmtx_js_settings_user.timeago_minute,
            minutes  : cmtx_js_settings_user.timeago_minutes,
            hour     : cmtx_js_settings_user.timeago_hour,
            hours    : cmtx_js_settings_user.timeago_hours,
            day      : cmtx_js_settings_user.timeago_day,
            days     : cmtx_js_settings_user.timeago_days,
            month    : cmtx_js_settings_user.timeago_month,
            months   : cmtx_js_settings_user.timeago_months,
            year     : cmtx_js_settings_user.timeago_year,
            years    : cmtx_js_settings_user.timeago_years
        };

        $('#cmtx_user_container .timeago').timeago();
    }
}

/* Highlight any user-entered code */
function cmtxHighlightCode() {
    if (typeof(cmtx_js_settings_comments) != 'undefined') {
        if (cmtx_js_settings_comments.highlight) {
            $('.cmtx_code_box, .cmtx_php_box').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        }
    }
}

/* Show the 'View x replies' link */
function cmtxViewReplies() {
    if (typeof(cmtx_js_settings_comments) != 'undefined') {
        $('.cmtx_reply_counter').each(function() {
            var reply_counter = $(this).text();

            if (reply_counter) {
                if (reply_counter == 1) {
                    var view_replies = cmtx_js_settings_comments.lang_text_view + ' <span class="cmtx_reply_num">1</span> ' + cmtx_js_settings_comments.lang_text_reply;
                } else {
                    var view_replies = cmtx_js_settings_comments.lang_text_view + ' <span class="cmtx_reply_num">' + reply_counter + '</span> ' + cmtx_js_settings_comments.lang_text_replies;
                }

                $(this).closest('.cmtx_comment_section').find('.cmtx_view_replies_link').html('<i class="fa fa-commenting-o" aria-hidden="true"></i> ' + view_replies);
            }
        });
    }
}

/* Auto scroll to element */
function cmtxAutoScroll(element) {
    try {
       element[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
    } catch (error) {
       // fallback for browsers like Edge that don't yet support the options parameter
       element[0].scrollIntoView(true);
    }
}

/* Adds a tag (BB Code or Smiley) to the comment field */
function cmtx_add_tag(start, end) {
    var obj = document.getElementById('cmtx_comment');

    $('#cmtx_comment').focus();

    if (document.selection && document.selection.createRange) { // Internet Explorer
        selection = document.selection.createRange();

        if (selection.parentElement() == obj) {
            selection.text = start + selection.text + end;
        }
    } else if (typeof(obj) != 'undefined') { // Firefox
        var length = $('#cmtx_comment').val().length;
        var selection_start = obj.selectionStart;
        var selection_end = obj.selectionEnd;

        $('#cmtx_comment').val(obj.value.substring(0, selection_start) + start + obj.value.substring(selection_start, selection_end) + end + obj.value.substring(selection_end, length));
    } else {
        $('#cmtx_comment').val(start + end);
    }

    $('#cmtx_comment').trigger('keyup'); // update the counter

    $('#cmtx_comment').focus();
}

/* Function to refresh the comments using ajax */
function cmtxRefreshComments(options) {
    var request = $.ajax({
        type: 'POST',
        cache: false,
        url: options.commentics_url + 'frontend/index.php?route=main/comments/getComments',
        data: 'cmtx_page_id=' + encodeURIComponent(options.page_id) + '&cmtx_sort_by=' + encodeURIComponent(options.sort_by) + '&cmtx_search=' + encodeURIComponent(options.search) + '&cmtx_page=' + encodeURIComponent(options.page_number),
        dataType: 'json',
        beforeSend: function() {
            if (options.effect) {
                $('.cmtx_loading_icon').show();

                $('body').addClass('cmtx_loading_body');
            }
        }
    });

    request.always(function() {
        if (options.effect) {
            $('.cmtx_loading_icon').hide();

            $('body').removeClass('cmtx_loading_body');
        }
    });

    request.done(function(response) {
        if (response['result']) {
            if (options.pagination == 'button' || options.pagination == 'infinite') {
                var comments = $('.cmtx_comment_boxes', $(response['result'])).html();

                $('.cmtx_comment_boxes').append(comments);

                $('#cmtx_more_button').val(cmtx_js_settings_comments.lang_button_more);

                $('#cmtx_more_button').prop('disabled', false);

                $('#cmtx_more_button').removeClass('cmtx_button_disabled');

                var total_comments = parseInt($('#cmtx_loading_helper').attr('data-cmtx-total-comments'));

                if (total_comments > $('.cmtx_comment_section').length) {
                    // there are more comments that can be loaded
                } else {
                    $('#cmtx_more_button').remove();

                    $('#cmtx_loading_helper').attr('data-cmtx-load', '0');
                }
            } else {
                $('.cmtx_comments_section').html(response['result']);
            }

            if ($('#cmtx_search').val() != '') {
                $('#cmtx_search').addClass('cmtx_search_focus');
            };

            cmtxHighlightCode();
            cmtxTimeago();
            cmtxViewReplies();
        }
    });

    request.fail(function(jqXHR, textStatus, errorThrown) {
        if (console && console.log) {
            console.log(jqXHR.responseText);
        }
    });
}