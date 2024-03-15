/* The document (excluding images) has finished loading */
document.addEventListener('DOMContentLoaded', function() {
    /* Page settings may not exist (if on user page) */
    if (document.querySelector('#cmtx_js_settings_page')) {
        cmtx_js_settings_page = JSON.parse(document.querySelector('#cmtx_js_settings_page').innerText);
    }

    /* Form settings may not exist (if the form is disabled) */
    if (document.querySelector('#cmtx_js_settings_form')) {
        cmtx_js_settings_form = JSON.parse(document.querySelector('#cmtx_js_settings_form').innerText);
    }

    /* Comment settings may not exist (if there are no comments) */
    if (document.querySelector('#cmtx_js_settings_comments')) {
        cmtx_js_settings_comments = JSON.parse(document.querySelector('#cmtx_js_settings_comments').innerText);
    }

    /* Notify settings may not exist (if the notify feature is disabled) */
    if (document.querySelector('#cmtx_js_settings_notify')) {
        cmtx_js_settings_notify = JSON.parse(document.querySelector('#cmtx_js_settings_notify').innerText);
    }

    /* Online settings may not exist (if the online feature is disabled) */
    if (document.querySelector('#cmtx_js_settings_online')) {
        cmtx_js_settings_online = JSON.parse(document.querySelector('#cmtx_js_settings_online').innerText);
    }

    /* User settings may not exist (if not on user page) */
    if (document.querySelector('#cmtx_js_settings_user')) {
        cmtx_js_settings_user = JSON.parse(document.querySelector('#cmtx_js_settings_user').innerText);
    }

    /* Is Commentics loaded using the iFrame integration method */
    isInIframe = (window.location != window.parent.location) ? true : false;

    /* Initialise */
    function cmtxInit() {
        cmtxViewReplies();
        cmtxTimeago();
        cmtxHighlightCode();
        cmtxViewersOnline();
        cmtxCloseShareBox();
        cmtxClosePermalinkBox();
        cmtxBioPopup();
        cmtxSearchFocus();
        cmtxSearchEnter();
        cmtxLightbox();
        cmtxCommentResize();
    }

    /* Wrapper for all ajax requests */
    function cmtxFetch(url, options) {
        options.method = 'POST';
        options.cache = 'no-store';
        options.headers = {
            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
            'X-Requested-With': 'XMLHttpRequest'
        };

        // If there's a file upload, we need to remove the content type.
        if (typeof(options.file_upload) != 'undefined') {
            delete options.headers['Content-Type'];
        }

        // Append the language
        if (typeof(cmtx_js_settings_page) != 'undefined') {
            options.body += '&cmtx_language=' + encodeURIComponent(cmtx_js_settings_page.language);
        }

        if (typeof(options.body) == 'string') {
            // Remove the leading '&' if it exists
            if (options.body.charAt(0) == '&') {
                options.body = options.body.substr(1);
            }

            // Send line breaks as \r\n
            options.body = options.body.replace(new RegExp('%0A', 'g'), '%0D%0A');
        }

        return fetch(url, options);
    }

    /* Show a BB Code modal */
    document.querySelectorAll('span[data-cmtx-target-modal]').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();

            var target = this.getAttribute('data-cmtx-target-modal');

            document.body.appendChild(document.querySelector(target));

            document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

            /*
              * The following stops the modal from showing in the vertical centre of the iFrame
              * Instead we position the modal relative to an element on the page
            */
            if (isInIframe) {
                var destination = document.querySelector('.cmtx_bb_code_container').getBoundingClientRect();

                document.querySelector(target).style.top = destination.top + 150 + 'px';

                /*
                  * The overlay is set to transparent as otherwise it would only cover the iFrame
                  * It's still useful to show it so that clicking on the overlay closes the modal
                */
                document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
            }

            cmtxFadeIn('.cmtx_overlay', 200);

            cmtxFadeIn(target, 200);
        });
    });

    /* Show an agreement modal */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('a[data-cmtx-target-modal]')) {
            e.preventDefault();

            var target = e.target.getAttribute('data-cmtx-target-modal');

            document.body.appendChild(document.querySelector(target));

            document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

            if (isInIframe) {
                if (e.target.closest('.quick_reply')) {
                    var destination = document.querySelector('.quick_reply').getBoundingClientRect();
                } else if (e.target.closest('.edit_comment')) {
                    var destination = document.querySelector('.edit_comment').getBoundingClientRect();
                } else {
                    var destination = document.querySelector('.cmtx_checkbox_container').getBoundingClientRect();
                }

                document.querySelector(target).style.top = destination.top - 150 + 'px';

                document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
            }

            cmtxFadeIn('.cmtx_overlay', 200);

            cmtxFadeIn(target, 200);
        }
    });

    /* Show the flag modal */
    document.addEventListener('click', function(e) {
        var flag_link = e.target.closest('.cmtx_flag_link');

        if (flag_link) {
            e.preventDefault();

            var comment_id = flag_link.closest('.cmtx_comment_box').getAttribute('data-cmtx-comment-id');

            document.querySelector('#cmtx_flag_modal_yes').setAttribute('data-cmtx-comment-id', comment_id);

            if (!document.querySelector('body > #cmtx_flag_modal')) {
                document.body.appendChild(document.querySelector('#cmtx_flag_modal'));
            }

            document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

            if (isInIframe) {
                var destination = flag_link.getBoundingClientRect();

                document.querySelector('#cmtx_flag_modal').style.top = destination.top - 150 + 'px';

                document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
            }

            cmtxFadeIn('.cmtx_overlay', 200);

            cmtxFadeIn('#cmtx_flag_modal', 200);
        }
    });

    /* Show the delete modal */
    document.addEventListener('click', function(e) {
        var delete_link = e.target.closest('.cmtx_delete_link');

        if (delete_link) {
            e.preventDefault();

            var comment_id = delete_link.closest('.cmtx_comment_box').getAttribute('data-cmtx-comment-id');

            document.querySelector('#cmtx_delete_modal_yes').setAttribute('data-cmtx-comment-id', comment_id);

            if (!document.querySelector('body > #cmtx_delete_modal')) {
                document.body.appendChild(document.querySelector('#cmtx_delete_modal'));
            }

            document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

            if (isInIframe) {
                var destination = delete_link.getBoundingClientRect();

                document.querySelector('#cmtx_delete_modal').style.top = destination.top - 150 + 'px';

                document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
            }

            cmtxFadeIn('.cmtx_overlay', 200);

            cmtxFadeIn('#cmtx_delete_modal', 200);
        }
    });

    /* Modal cancel button */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_modal_box .cmtx_button_secondary')) {
            e.preventDefault();

            cmtxCloseModal();
        }
    });

    /* Close modal */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_modal_close, .cmtx_overlay')) {
            e.preventDefault();

            document.querySelectorAll('.cmtx_modal_box, .cmtx_overlay').forEach(function(element) {
                element.style.transition = `opacity 200ms ease-in-out`;
                element.style.opacity = 0;

                setTimeout(function() {
                    element.style.display = 'none';

                    cmtxRemoveIfExists('.cmtx_overlay');
                }, 200);
            });
        }
    });

    /* When the comment field gets focus, show some other fields */
    if (typeof(cmtx_js_settings_form) != 'undefined') {
        document.querySelector('#cmtx_comment').addEventListener('focus', function() {
            cmtxCommentFocus(true);
        });
    }

    /* If the comment field should show straight away, give it focus */
    if (typeof(cmtx_js_settings_form) != 'undefined') {
        if (!cmtx_js_settings_form.cmtx_wait_for_comment) {
            cmtxCommentFocus(false);
        }
    }

    function cmtxCommentFocus($transition) {
        if ($transition) {
            document.querySelector('#cmtx_comment').classList.add('cmtx_comment_field_transition');
        }

        document.querySelector('#cmtx_comment').classList.add('cmtx_comment_field_active');

        document.querySelector('.cmtx_comment_container').classList.add('cmtx_comment_container_active');

        if (document.querySelector('input[name="cmtx_reply_to"]').value == '') {
            cmtxFadeIn('.cmtx_wait_for_comment', 600);
        }
    }

    /* Allow the vertical resizing of the comment field */
    function cmtxCommentResize() {
        document.querySelectorAll('.cmtx_comment_field').forEach(function(element) {
            element.addEventListener('mousedown', function(e) {
                if (element.classList.contains('cmtx_comment_field_near_bottom')) {
                    var startHeight = element.clientHeight;
                    var startY = e.clientY;

                    function cmtxHandleMouseMove(e) {
                        var newHeight = startHeight + (e.clientY - startY);

                        if (newHeight > 33) {
                            element.classList.remove('cmtx_comment_field_transition');
                            element.style.setProperty('height', newHeight + 'px', 'important');
                        }
                    }

                    function cmtxHandleMouseUp() {
                        document.removeEventListener('mousemove', cmtxHandleMouseMove);
                        document.removeEventListener('mouseup', cmtxHandleMouseUp);
                    }

                    document.addEventListener('mousemove', cmtxHandleMouseMove);
                    document.addEventListener('mouseup', cmtxHandleMouseUp);
                }
            });

            element.addEventListener('mousemove', function(e) {
                var rect = element.getBoundingClientRect();
                var distanceFromBottom = rect.bottom - e.clientY;

                if (distanceFromBottom <= 10 && rect.height > 50) {
                    element.classList.add('cmtx_comment_field_near_bottom');
                } else {
                    element.classList.remove('cmtx_comment_field_near_bottom');
                }
            });
        });
    }

    /* When the name or email field gets focus, show some other fields */
    document.querySelectorAll('#cmtx_name, #cmtx_email').forEach(function(element) {
        element.addEventListener('focus', function() {
            if (document.querySelector('input[name="cmtx_subscribe"]').value == '') {
                cmtxFadeIn('.cmtx_wait_for_user', 800);
            }
        });
    });

    /* Adds a BB Code tag for the simple non-modal ones */
    document.querySelectorAll('.cmtx_bb_code:not([data-cmtx-target-modal])').forEach(function(element) {
        element.addEventListener('click', function() {
            var bb_code = this.getAttribute('data-cmtx-tag');

            if (bb_code) {
                bb_code = bb_code.split('|');

                if (typeof(bb_code[1]) === 'undefined') {
                    cmtxAddTag('', bb_code[0]);
                } else {
                    cmtxAddTag(bb_code[0], bb_code[1]);
                }
            }
        });
    });

    /* Adds a smiley tag */
    document.querySelectorAll('.cmtx_smilies_container .cmtx_smiley').forEach(function(element) {
        element.addEventListener('click', function() {
            var smiley = this.getAttribute('data-cmtx-tag');

            cmtxAddTag('', smiley);
        });
    });

    if (typeof(cmtx_js_settings_form) != 'undefined') {
        /* Insert content from bullet modal */
        if (document.querySelector('#cmtx_bullet_modal_insert')) {
            document.querySelector('#cmtx_bullet_modal_insert').addEventListener('click', function() {
                var bb_code = document.querySelector('.cmtx_bb_code_bullet').getAttribute('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var tag = '';

                document.querySelectorAll('#cmtx_bullet_modal input[type="text"]').forEach(function(element) {
                    var item = cmtxTrim(element.value);

                    if (item != null && item != '') {
                        tag += bb_code[1] + item + bb_code[2] + '\r\n';
                    }
                });

                if (tag != null && tag != '') {
                    tag = bb_code[0] + '\r\n' + tag + bb_code[3];

                    cmtxAddTag('', tag);
                }

                document.querySelector('#cmtx_bullet_modal input[type="text"]').value = '';

                cmtxCloseModal();
            });
        }

        /* Insert content from numeric modal */
        if (document.querySelector('#cmtx_numeric_modal_insert')) {
            document.querySelector('#cmtx_numeric_modal_insert').addEventListener('click', function() {
                var bb_code = document.querySelector('.cmtx_bb_code_numeric').getAttribute('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var tag = '';

                document.querySelectorAll('#cmtx_numeric_modal input[type="text"]').forEach(function(element) {
                    var item = cmtxTrim(element.value);

                    if (item != null && item != '') {
                        tag += bb_code[1] + item + bb_code[2] + '\r\n';
                    }
                });

                if (tag != null && tag != '') {
                    tag = bb_code[0] + '\r\n' + tag + bb_code[3];

                    cmtxAddTag('', tag);
                }

                document.querySelector('#cmtx_numeric_modal input[type="text"]').value = '';

                cmtxCloseModal();
            });
        }

        /* Insert content from link modal */
        if (document.querySelector('#cmtx_link_modal_insert')) {
            document.querySelector('#cmtx_link_modal_insert').addEventListener('click', function() {
                var bb_code = document.querySelector('.cmtx_bb_code_link').getAttribute('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var link = cmtxTrim(document.querySelector('#cmtx_link_modal input[type="url"]').value);

                if (link != null && link != '' && link != 'http://') {
                    var text = cmtxTrim(document.querySelector('#cmtx_link_modal input[type="text"]').value);

                    if (text != null && text != '') {
                        var tag = bb_code[1] + link + bb_code[2] + text + bb_code[3];
                    } else {
                        var tag = bb_code[0] + link + bb_code[3];
                    }

                    cmtxAddTag('', tag);
                }

                document.querySelector('#cmtx_link_modal input[type="url"]').value = 'http://';

                document.querySelector('#cmtx_link_modal input[type="text"]').value = '';

                cmtxCloseModal();
            });
        }

        /* Insert content from email modal */
        if (document.querySelector('#cmtx_email_modal_insert')) {
            document.querySelector('#cmtx_email_modal_insert').addEventListener('click', function() {
                var bb_code = document.querySelector('.cmtx_bb_code_email').getAttribute('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var email = cmtxTrim(document.querySelector('#cmtx_email_modal input[type="email"]').value);

                if (email != null && email != '') {
                    var text = cmtxTrim(document.querySelector('#cmtx_email_modal input[type="text"]').value);

                    if (text != null && text != '') {
                        var tag = bb_code[1] + email + bb_code[2] + text + bb_code[3];
                    } else {
                        var tag = bb_code[0] + email + bb_code[3];
                    }

                    cmtxAddTag('', tag);
                }

                document.querySelector('#cmtx_email_modal input[type="email"]').value = '';

                document.querySelector('#cmtx_email_modal input[type="text"]').value = '';

                cmtxCloseModal();
            });
        }

        /* Insert content from image modal */
        if (document.querySelector('#cmtx_image_modal_insert')) {
            document.querySelector('#cmtx_image_modal_insert').addEventListener('click', function() {
                var bb_code = document.querySelector('.cmtx_bb_code_image').getAttribute('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var image = cmtxTrim(document.querySelector('#cmtx_image_modal input[type="url"]').value);

                if (image != null && image != '' && image != 'http://') {
                    var tag = bb_code[0] + image + bb_code[1];

                    cmtxAddTag('', tag);
                }

                document.querySelector('#cmtx_image_modal input[type="url"]').value = 'http://';

                cmtxCloseModal();
            });
        }

        /* Insert content from YouTube modal */
        if (document.querySelector('#cmtx_youtube_modal_insert')) {
            document.querySelector('#cmtx_youtube_modal_insert').addEventListener('click', function() {
                var bb_code = document.querySelector('.cmtx_bb_code_youtube').getAttribute('data-cmtx-tag');

                bb_code = bb_code.split('|');

                var video = cmtxTrim(document.querySelector('#cmtx_youtube_modal input[type="url"]').value);

                if (video != null && video != '' && video != 'http://') {
                    var tag = bb_code[0] + video + bb_code[1];

                    cmtxAddTag('', tag);
                }

                document.querySelector('#cmtx_youtube_modal input[type="url"]').value = 'http://';

                cmtxCloseModal();
            });
        }

        /* Update the comment counter whenever anything is entered */
        document.querySelector('#cmtx_comment').addEventListener('keyup', function() {
            cmtxUpdateCommentCounter();
        });

        /* Simulate entering a comment on page load to update the counter in case it has default text */
        cmtxUpdateCommentCounter();

        /* Allows the user to deselect the star rating */
        document.querySelectorAll('input[type="radio"][name="cmtx_rating"]').forEach(function(element) {
            element.addEventListener('click', function() {
                if (this.classList.contains('cmtx_rating_active')) {
                    this.checked = false;
                    this.classList.remove('cmtx_rating_active');
                } else {
                    document.querySelectorAll('input[type="radio"][name="cmtx_rating"].cmtx_rating_active').forEach(function(element) {
                        element.classList.remove('cmtx_rating_active');
                    });

                    this.classList.add('cmtx_rating_active');
                }
            });
        });
    }

    /* Image uploads */
    if (typeof(cmtx_js_settings_form) != 'undefined') {
        if (cmtx_js_settings_form.enabled_upload) {
            total_size = 0;

            document.querySelector('#cmtx_upload').addEventListener('change', function(e) {
                e.preventDefault();

                e.stopPropagation();

                var image = document.querySelector('#cmtx_upload').files[0];

                cmtx_upload(image);
            });

            function cmtx_upload(image) {
                document.querySelector('.cmtx_upload_container').classList.remove('cmtx_dragging');

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

                            document.querySelector('.cmtx_image_container').insertAdjacentHTML('beforeend', template);
                            cmtxShow('.cmtx_image_row');
                        };

                        reader.readAsDataURL(image);
                    }
                }
            }

            document.querySelector('.cmtx_upload_container').addEventListener('dragenter', (e) => {
                e.preventDefault();
                e.stopPropagation();
            });

            document.querySelector('.cmtx_upload_container').addEventListener('dragover', (e) => {
                e.preventDefault();
                e.stopPropagation();

                document.querySelector('.cmtx_upload_container').classList.add('cmtx_dragging');
            });

            document.querySelector('.cmtx_upload_container').addEventListener('dragleave', (e) => {
                e.preventDefault();
                e.stopPropagation();

                document.querySelector('.cmtx_upload_container').classList.remove('cmtx_dragging');
            });

            document.addEventListener('click', function(e) {
                if (e.target && e.target.matches('.cmtx_button_remove')) {
                    e.preventDefault();

                    e.target.closest('.cmtx_image_upload').remove();

                    // Hide container if no images
                    var num_images = document.querySelectorAll('.cmtx_image_upload').length;

                    if (num_images == 0) {
                        cmtxHide('.cmtx_image_row');
                    }
                }
            });

            document.querySelector('#cmtx_upload').addEventListener('drop', (e) => {
                e.preventDefault();
                e.stopPropagation();

                if (e.dataTransfer && e.dataTransfer.files.length) {
                    cmtx_upload(e.dataTransfer.files[0]);
                }
            });

            function cmtx_validate_upload(size, extension) {
                var num_images = document.querySelectorAll('.cmtx_image_upload').length;

                var total_size = 0;

                document.querySelectorAll('.cmtx_image_upload').forEach(function(element) {
                    total_size = Number(total_size) + Number(element.querySelector('img').getAttribute('data-cmtx-size'));
                });

                total_size = Number(total_size) + Number(size);

                if (num_images >= cmtx_js_settings_form.maximum_upload_amount) {
                    document.querySelector('#cmtx_upload_modal .cmtx_modal_body').innerHTML = ('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_num.replace('%d', cmtx_js_settings_form.maximum_upload_amount));

                    document.body.appendChild(document.querySelector('#cmtx_upload_modal'));

                    document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

                    if (isInIframe) {
                        var destination = document.querySelector('.cmtx_upload_container').getBoundingClientRect();

                        document.querySelector('#cmtx_upload_modal').style.top = destination.top + 50 + 'px';

                        document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
                    }

                    cmtxFadeIn('.cmtx_overlay', 200);

                    cmtxFadeIn('#cmtx_upload_modal', 200);

                    return false;
                }

                if (size > cmtx_js_settings_form.maximum_upload_size) {
                    document.querySelector('#cmtx_upload_modal .cmtx_modal_body').innerHTML = ('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_size.replace('%.1f', cmtx_js_settings_form.maximum_upload_size));

                    document.body.appendChild(document.querySelector('#cmtx_upload_modal'));

                    document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

                    if (isInIframe) {
                        var destination = document.querySelector('.cmtx_upload_container').getBoundingClientRect();

                        document.querySelector('#cmtx_upload_modal').style.top = destination.top + 50 + 'px';

                        document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
                    }

                    cmtxFadeIn('.cmtx_overlay', 200);

                    cmtxFadeIn('#cmtx_upload_modal', 200);

                    return false;
                }

                if (total_size > cmtx_js_settings_form.maximum_upload_total) {
                    document.querySelector('#cmtx_upload_modal .cmtx_modal_body').innerHTML = ('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_total.replace('%.1f', cmtx_js_settings_form.maximum_upload_total));

                    document.body.appendChild(document.querySelector('#cmtx_upload_modal'));

                    document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

                    if (isInIframe) {
                        var destination = document.querySelector('.cmtx_upload_container').getBoundingClientRect();

                        document.querySelector('#cmtx_upload_modal').style.top = destination.top + 50 + 'px';

                        document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
                    }

                    cmtxFadeIn('.cmtx_overlay', 200);

                    cmtxFadeIn('#cmtx_upload_modal', 200);

                    return false;
                }

                if (!['gif', 'jpg', 'jpeg', 'png'].includes(extension)) {
                    document.querySelector('#cmtx_upload_modal .cmtx_modal_body').innerHTML = ('<span class="cmtx_icon cmtx_alert_icon" aria-hidden="true"></span> ' + cmtx_js_settings_form.lang_error_file_type);

                    document.body.appendChild(document.querySelector('#cmtx_upload_modal'));

                    document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

                    if (isInIframe) {
                        var destination = document.querySelector('.cmtx_upload_container').getBoundingClientRect();

                        document.querySelector('#cmtx_upload_modal').style.top = destination.top + 50 + 'px';

                        document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
                    }

                    cmtxFadeIn('.cmtx_overlay', 200);

                    cmtxFadeIn('#cmtx_upload_modal', 200);

                    return false;
                }

                return true;
            }
        }
    }

    /* Populate countries field */
    if (typeof(cmtx_js_settings_form) != 'undefined') {
        if (cmtx_js_settings_form.enabled_country) {
            document.querySelector('#cmtx_country').innerHTML = ('<option value="">' + cmtx_js_settings_form.lang_text_loading + '</option>');

            var request = cmtxFetch(cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/getCountries', {
                body: ''
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                setTimeout(function() {
                    countries = data;

                    html = '<option value="" hidden>' + cmtx_js_settings_form.lang_placeholder_country + '</option>';

                    if (countries.length) {
                        for (i = 0; i < countries.length; i++) {
                            html += '<option value="' + countries[i]['id'] + '"';

                            if (countries[i]['name'] == '---') {
                                html += ' disabled';
                            } else if (countries[i]['id'] == cmtx_js_settings_form.country_id) {
                                html += ' selected';
                            }

                            html += '>' + countries[i]['name'] + '</option>';
                        }
                    }

                    document.querySelector('#cmtx_country').innerHTML = html;

                    if (cmtx_js_settings_form.enabled_state) {
                        // trigger change event
                        document.querySelector('#cmtx_country').dispatchEvent(new Event('change'));
                    }
                }, 500);
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    }

    /* Populate states field (when country field is enabled) */
    if (typeof(cmtx_js_settings_form) != 'undefined') {
        if (cmtx_js_settings_form.enabled_country && cmtx_js_settings_form.enabled_state) {
            document.querySelector('#cmtx_country').addEventListener('change', function() {
                document.querySelector('#cmtx_state').innerHTML = ('<option value="">' + cmtx_js_settings_form.lang_text_loading + '</option>');

                var country_id = document.querySelector('#cmtx_country').value;

                if (country_id) {
                    var request = cmtxFetch(cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/getStates', {
                        body: 'country_id=' + encodeURIComponent(country_id)
                    });

                    request.then(function(response) {
                        return response.json();
                    }).then(function(data) {
                        setTimeout(function() {
                            states = data;

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

                            document.querySelector('#cmtx_state').innerHTML = html;

                            document.querySelector('#cmtx_state').dispatchEvent(new Event('change'));
                        }, 500);
                    }).catch(function(error) {
                        if (console && console.log) {
                            console.log(error);
                        }
                    });
                } else {
                    html = '<option value="" hidden>' + cmtx_js_settings_form.lang_placeholder_state + '</option>';

                    html += '<option value="" disabled>' + cmtx_js_settings_form.lang_text_country_first + '</option>';

                    document.querySelector('#cmtx_state').innerHTML = html;
                }
            });

            document.querySelector('#cmtx_country').dispatchEvent(new Event('change'));
        }
    }

    /* Populate states field (when country field is disabled) */
    if (typeof(cmtx_js_settings_form) != 'undefined') {
        if (!cmtx_js_settings_form.enabled_country && cmtx_js_settings_form.enabled_state) {
            document.querySelector('#cmtx_state').innerHTML = ('<option value="">' + cmtx_js_settings_form.lang_text_loading + '</option>');

            var request = cmtxFetch(cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/getStates', {
                body: 'country_id=0'
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                setTimeout(function() {
                    states = data;

                    html = '<option value="" hidden>' + cmtx_js_settings_form.lang_placeholder_state + '</option>';

                    if (states.length) {
                        for (i = 0; i < states.length; i++) {
                            html += '<option value="' + states[i]['id'] + '"';

                            if (states[i]['id'] == cmtx_js_settings_form.state_id) {
                                html += ' selected';
                            }

                            html += '>' + states[i]['name'] + '</option>';
                        }
                    }

                    document.querySelector('#cmtx_state').innerHTML = html;

                    document.querySelector('#cmtx_state').dispatchEvent(new Event('change'));
                }, 500);
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    }

    /* Image captcha */
    if (typeof(cmtx_js_settings_form) != 'undefined') {
        if (cmtx_js_settings_form.captcha) {
            document.querySelector('#cmtx_captcha_refresh').addEventListener('click', function() {
                var src = cmtx_js_settings_form.captcha_url + '&' + Math.random();

                document.querySelector('#cmtx_captcha_image').setAttribute('src', src);
            });
        }
    }

    /* Submit or preview a comment */
    document.querySelectorAll('#cmtx_submit_button, #cmtx_preview_button').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.preventDefault();

            cmtxRemoveIfExists('.cmtx_upload_field');

            document.querySelectorAll('.cmtx_image_upload').forEach(function(element) {
                var image = element.querySelector('img').getAttribute('src');

                document.querySelector('#cmtx_form').insertAdjacentHTML('beforeend', '<input type="hidden" name="cmtx_upload[]" class="cmtx_upload_field" value="' + image + '">');
            });

            // Find any disabled inputs and remove the "disabled" attribute
            var disabled = document.querySelector('#cmtx_form').querySelectorAll('input:disabled').forEach(function(element) {
                element.removeAttribute('disabled');
            });

            // Serialize the form
            var serialized = new URLSearchParams(new FormData(document.querySelector('#cmtx_form')));

            // Re-disable the set of inputs that were originally disabled
            if (disabled) {
                disabled.forEach(function(element) {
                    element.setAttribute('disabled', 'disabled');
                });
            }

            document.querySelectorAll('#cmtx_submit_button, #cmtx_preview_button').forEach(function(element) {
                element.value = cmtx_js_settings_form.lang_button_processing;
            });

            document.querySelectorAll('#cmtx_submit_button, #cmtx_preview_button').forEach(function(element) {
                element.disabled = true;
                element.classList.add('cmtx_button_disabled');
            });

            var request = cmtxFetch(cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/submit', {
                body: serialized + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_form.page_id) + '&cmtx_type=' + encodeURIComponent(this.getAttribute('data-cmtx-type')) + document.querySelector('#cmtx_hidden_data').value
            });

            request.then(function(response) {
                document.querySelector('#cmtx_submit_button').value = cmtx_js_settings_form.lang_button_submit;

                if (document.querySelector('#cmtx_preview_button')) {
                    document.querySelector('#cmtx_preview_button').value = cmtx_js_settings_form.lang_button_preview;
                }

                document.querySelectorAll('#cmtx_submit_button, #cmtx_preview_button').forEach(function(element) {
                    element.disabled = false;
                    element.classList.remove('cmtx_button_disabled');
                });

                document.querySelector('#cmtx_comment').classList.add('cmtx_comment_field_active');

                document.querySelector('.cmtx_comment_container').classList.add('cmtx_comment_container_active');

                cmtxFadeIn('.cmtx_wait_for_user, .cmtx_wait_for_comment', 600, '.cmtx_headline_row, .cmtx_rating_row');

                if (document.querySelector('input[name="cmtx_reply_to"]').value == '') {
                    cmtxFadeIn('.cmtx_headline_row', 600);
                    cmtxFadeIn('.cmtx_rating_row', 600);
                }

                return response.json();
            }).then(function(data) {
                cmtxRemoveIfExists('.cmtx_message:not(.cmtx_message_reply), .cmtx_error');

                document.querySelectorAll('.cmtx_field, .cmtx_rating').forEach(function(element) {
                    element.classList.remove('cmtx_field_error');
                });

                if (data['result']['preview']) {
                    document.querySelector('#cmtx_preview').innerHTML = data['result']['preview'];

                    cmtxTimeago();
                    cmtxHighlightCode();
                } else {
                    document.querySelector('#cmtx_preview').innerHTML = '';
                }

                if (data['result']['success']) {
                    cmtxRemoveIfExists('.cmtx_message');

                    document.querySelectorAll('#cmtx_comment, #cmtx_headline, #cmtx_answer, [name^="cmtx_field_"], #cmtx_captcha').forEach(function(element) {
                        element.value = '';
                    });

                    cmtxUpdateCommentCounter();

                    cmtxRemoveIfExists('.cmtx_image_upload');

                    cmtxHide('.cmtx_image_row');

                    document.querySelectorAll('input[name="cmtx_rating"]').forEach(function(element) {
                        element.checked = false;
                        element.classList.remove('cmtx_rating_active');
                    });

                    if (data['hide_rating']) {
                        cmtxRemoveIfExists('.cmtx_rating_row');
                    }

                    if (document.querySelector('#cmtx_captcha_refresh')) {
                        document.querySelector('#cmtx_captcha_refresh').click();
                    }

                    if (typeof(grecaptcha) != 'undefined') {
                        grecaptcha.reset();
                    }

                    document.querySelector('input[name="cmtx_reply_to"]').value = '';

                    cmtxRemoveIfExists('.cmtx_message_reply');

                    document.querySelector('#cmtx_form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_success">' + data['result']['success'] + '</div>');

                    cmtxFadeIn('.cmtx_message_success', 200);

                    if (data['user_link']) {
                        document.querySelector('#cmtx_form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_info">' + data['user_link'] + '</div>');

                        cmtxFadeIn('.cmtx_message_info', 200);
                    }

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

                if (data['result']['error']) {
                    if (data['error']) {
                        if (data['error']['comment']) {
                            document.querySelector('#cmtx_comment').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_comment').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['comment'] + '</span>');
                        }

                        if (data['error']['headline']) {
                            document.querySelector('#cmtx_headline').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_headline').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['headline'] + '</span>');
                        }

                        if (data['error']['name']) {
                            document.querySelector('#cmtx_name').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_name').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['name'] + '</span>');
                        }

                        if (data['error']['email']) {
                            document.querySelector('#cmtx_email').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_email').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['email'] + '</span>');
                        }

                        if (data['error']['rating']) {
                            document.querySelector('#cmtx_rating').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_rating').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['rating'] + '</span>');
                        }

                        if (data['error']['website']) {
                            document.querySelector('#cmtx_website').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_website').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['website'] + '</span>');
                        }

                        if (data['error']['town']) {
                            document.querySelector('#cmtx_town').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_town').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['town'] + '</span>');
                        }

                        if (data['error']['country']) {
                            document.querySelector('#cmtx_country').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_country').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['country'] + '</span>');
                        }

                        if (data['error']['state']) {
                            document.querySelector('#cmtx_state').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_state').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['state'] + '</span>');
                        }

                        if (data['error']['answer']) {
                            document.querySelector('#cmtx_answer').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_answer').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['answer'] + '</span>');
                        }

                        for (var field in data['error']) {
                            if (field.startsWith('cmtx_field_')) {
                                document.querySelector('[name="' + field + '"]').classList.add('cmtx_field_error');

                                document.querySelector('[name="' + field + '"]').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error'][field] + '</span>');
                            }
                        }

                        if (data['error']['recaptcha']) {
                            document.querySelector('#g-recaptcha').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['recaptcha'] + '</span>');

                            grecaptcha.reset();
                        }

                        if (data['error']['captcha']) {
                            document.querySelector('#cmtx_captcha').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_captcha').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['captcha'] + '</span>');

                            document.querySelector('#cmtx_captcha_refresh').click();

                            document.querySelector('#cmtx_captcha').value = '';
                        }
                    }

                    document.querySelector('#cmtx_form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_error">' + data['result']['error'] + '</div>');

                    cmtxFadeIn('.cmtx_message_error, .cmtx_error', 2000);
                }

                if (data['question']) {
                    document.querySelector('#cmtx_question').textContent = data['question'];
                }

                cmtxAutoScroll(document.querySelector('#cmtx_form_container'));
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        });
    });

    /* Show a bio popup when hovering over the avatar image */
    function cmtxBioPopup() {
        document.querySelectorAll('.cmtx_avatar_area').forEach(function(element) {
            element.addEventListener('mouseenter', (e) => {
                cmtxFadeIn(e.target.querySelector('.cmtx_bio'), 750);
            });
        });

        document.querySelectorAll('.cmtx_avatar_area').forEach(function(element) {
            element.addEventListener('mouseleave', (e) => {
                cmtxFadeOut(e.target.querySelector('.cmtx_bio'), 750);
            });
        });

        if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
            document.querySelectorAll('.cmtx_bio').forEach(function(element) {
                element.addEventListener('mouseenter', (e) => {
                    cmtxFadeOut(e.target, 750);
                });
            });
        }
    }

    /* Show replies when view replies link is clicked */
    document.addEventListener('click', function(e) {
        var view_replies_link = e.target.closest('.cmtx_view_replies_link');

        if (view_replies_link) {
            e.preventDefault();

            cmtxHide(view_replies_link.parentElement);

            cmtxFadeIn(view_replies_link.closest('.cmtx_comment_box').nextElementSibling, 600);
        }
    });

    /* Sort by */
    document.addEventListener('change', function(e) {
        if (e.target && e.target.matches('.cmtx_sort_by_field')) {
            e.preventDefault();

            var options = {
                'commentics_url': cmtx_js_settings_comments.commentics_url,
                'page_id'       : cmtx_js_settings_comments.page_id,
                'page_number'   : '',
                'sort_by'       : e.target.value,
                'search'        : cmtxGetSearchValue(),
                'effect'        : true
            }

            cmtxRefreshComments(options);
        }
    });

    /* Search */
    function cmtxSearchFocus() {
        document.querySelectorAll('.cmtx_search').forEach(function(element) {
            element.addEventListener('focus', function() {
                this.classList.add('cmtx_search_focus');
            });
        });
    }

    function cmtxSearchEnter() {
        document.querySelectorAll('.cmtx_search').forEach(function(element) {
            element.addEventListener('keypress', function(e) {
                if (e.key == 'Enter') {
                    e.target.nextElementSibling.click();
                }
            });
        });
    }

    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_search_container .fa-search')) {
            e.preventDefault();

            var options = {
                'commentics_url': cmtx_js_settings_comments.commentics_url,
                'page_id'       : cmtx_js_settings_comments.page_id,
                'page_number'   : '',
                'sort_by'       : cmtxGetSortByValue(),
                'search'        : e.target.previousElementSibling.value,
                'effect'        : true
            }

            cmtxRefreshComments(options);
        }
    });

    /* Average rating */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_average_rating_can_rate label')) {
            e.preventDefault();

            var element = e.target;

            var rating = element.querySelector('input').value;

            var request = cmtxFetch(cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=part/average_rating/rate', {
                body: 'cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id) + '&cmtx_rating=' + encodeURIComponent(rating)
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                if (data['success']) {
                    document.querySelectorAll('.cmtx_average_rating input').forEach(function(element) {
                        element.checked = false;
                    });

                    document.querySelector('.cmtx_average_rating input[value="' + data['average_rating'] + '"]').checked = true;

                    document.querySelector('.cmtx_average_rating_stat_rating').textContent = data['average_rating'];
                    document.querySelector('.cmtx_average_rating_stat_number').textContent = data['num_of_ratings'];

                    document.querySelector('.cmtx_action_message_success').innerHTML = data['success'];
                    cmtxFadeInOut('.cmtx_action_message_success', 500, 2000, 500);

                    var destination = element.getBoundingClientRect();

                    document.querySelector('.cmtx_action_message_success').style.position = 'absolute';
                    document.querySelector('.cmtx_action_message_success').style.top = (destination.top + cmtxGetScrollTop() - 25) + 'px';
                    document.querySelector('.cmtx_action_message_success').style.left = (destination.left + 5) + 'px';
                }

                if (data['error']) {
                    document.querySelector('.cmtx_action_message_error').innerHTML = data['error'];
                    cmtxFadeInOut('.cmtx_action_message_error', 500, 2000, 500);

                    var destination = element.getBoundingClientRect();

                    document.querySelector('.cmtx_action_message_error').style.position = 'absolute';
                    document.querySelector('.cmtx_action_message_error').style.top = (destination.top + cmtxGetScrollTop() - 25) + 'px';
                    document.querySelector('.cmtx_action_message_error').style.left = (destination.left + 5) + 'px';
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    });

    /* Prevent users from clicking the stars if guest rating is disabled */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_average_rating_cannot_rate label')) {
            e.preventDefault();
        }
    });

    /* Pagination */
    document.addEventListener('click', function(e) {
        var pagination_link = e.target.closest('.cmtx_pagination_url');

        if (pagination_link) {
            e.preventDefault();

            // This is to stop multiple calls to this event.
            // Occurs when pagination links shown twice (e.g. above and below comments).
            e.stopImmediatePropagation();

            var options = {
                'commentics_url': cmtx_js_settings_comments.commentics_url,
                'page_id'       : cmtx_js_settings_comments.page_id,
                'page_number'   : pagination_link.querySelector('span').getAttribute('data-cmtx-page'),
                'sort_by'       : cmtxGetSortByValue(),
                'search'        : cmtxGetSearchValue(),
                'effect'        : true
            }

            cmtxRefreshComments(options);
        }
    });

    /* Notify */
    document.addEventListener('click', function(e) {
        var notify_link = e.target.closest('.cmtx_notify_block a');

        if (notify_link) {
            e.preventDefault();

            document.querySelectorAll('.cmtx_message, .cmtx_error, .cmtx_subscribe_row').forEach(function(element) {
                element.remove();
            });

            document.querySelectorAll('.cmtx_field, .cmtx_rating').forEach(function(element) {
                element.classList.remove('cmtx_field_error');
            });

            cmtxShow('.cmtx_wait_for_user');

            cmtxHide('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_headline_row, .cmtx_upload_row, .cmtx_image_row, .cmtx_rating_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_checkbox_container, .cmtx_button_row, .cmtx_extra_row');

            cmtxShow('.cmtx_question_row, .cmtx_captcha_row');

            if (document.querySelector('input[name="cmtx_subscribe"]').value == '') {
                cmtx_heading_text = document.querySelector('.cmtx_form_heading').textContent;
            }

            document.querySelector('.cmtx_form_heading').textContent = cmtx_js_settings_notify.lang_heading_notify;

            var notify_button = '';

            notify_button += '<div class="cmtx_row cmtx_button_row cmtx_subscribe_row cmtx_clear">';

                notify_button += '<div class="cmtx_col_2">';

                    notify_button += '<div class="cmtx_container cmtx_submit_button_container">';

                        notify_button += '<input type="button" id="cmtx_notify_button" class="cmtx_button cmtx_button_primary" value="' + cmtx_js_settings_notify.lang_button_notify + '" title="' + cmtx_js_settings_notify.lang_button_notify + '">';

                    notify_button += '</div>';

                notify_button += '</div>';

                notify_button += '<div class="cmtx_col_10"></div>';

            notify_button += '</div>';

            document.querySelector('.cmtx_button_row').insertAdjacentHTML('afterend', notify_button);

            document.querySelector('input[name="cmtx_subscribe"]').value = 1;

            document.querySelector('#cmtx_form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_info cmtx_message_notify">' + cmtx_js_settings_notify.lang_text_notify_info + ' ' + '<a href="#" title="' + cmtx_js_settings_notify.lang_title_cancel_notify + '">' + cmtx_js_settings_notify.lang_link_cancel + '</a></div>');

            cmtxAutoScroll(document.querySelector('#cmtx_form_container'));

            cmtxFadeIn('.cmtx_message_notify', 1000);
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_message_notify a')) {
            e.preventDefault();

            cmtx_cancel_notify();
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('#cmtx_notify_button')) {
            e.preventDefault();

            // Find any disabled inputs and remove the "disabled" attribute
            var disabled = document.querySelector('#cmtx_form').querySelectorAll('input:disabled').forEach(function(element) {
                element.removeAttribute('disabled');
            });

            // Serialize the form
            var serialized = new URLSearchParams(new FormData(document.querySelector('#cmtx_form')));

            // Re-disable the set of inputs that were originally disabled
            if (disabled) {
                disabled.forEach(function(element) {
                    element.setAttribute('disabled', 'disabled');
                });
            }

            document.querySelector('#cmtx_notify_button').value = cmtx_js_settings_notify.lang_button_processing;

            document.querySelector('#cmtx_notify_button').disabled = true;

            document.querySelector('#cmtx_notify_button').classList.add('cmtx_button_disabled');

            var request = cmtxFetch(cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=part/notify/notify', {
                body: serialized + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id) + document.querySelector('#cmtx_hidden_data').value
            });

            request.then(function(response) {
                document.querySelector('#cmtx_notify_button').value = cmtx_js_settings_notify.lang_button_notify;

                document.querySelector('#cmtx_notify_button').disabled = false;

                document.querySelector('#cmtx_notify_button').classList.remove('cmtx_button_disabled');

                return response.json();
            }).then(function(data) {
                cmtxRemoveIfExists('.cmtx_message:not(.cmtx_message_notify');

                document.querySelectorAll('.cmtx_field, .cmtx_rating').forEach(function(element) {
                    element.classList.remove('cmtx_field_error');
                });

                if (data['result']['success']) {
                    document.querySelector('#cmtx_answer').value = '';
                    document.querySelector('#cmtx_captcha').value = '';

                    document.querySelector('#cmtx_captcha_refresh').click();

                    if (typeof(grecaptcha) != 'undefined') {
                        grecaptcha.reset();
                    }

                    cmtx_cancel_notify();

                    document.querySelector('#cmtx_form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_success">' + data['result']['success'] + '</div>');

                    cmtxFadeIn('.cmtx_message_success', 1500);
                }

                if (data['result']['error']) {
                    if (data['error']) {
                        if (data['error']['name']) {
                            document.querySelector('#cmtx_name').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_name').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['name'] + '</span>');
                        }

                        if (data['error']['email']) {
                            document.querySelector('#cmtx_email').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_email').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['email'] + '</span>');
                        }

                        if (data['error']['answer']) {
                            document.querySelector('#cmtx_answer').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_answer').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['answer'] + '</span>');
                        }

                        if (data['error']['recaptcha']) {
                            document.querySelector('#g-recaptcha').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['recaptcha'] + '</span>');

                            grecaptcha.reset();
                        }

                        if (data['error']['captcha']) {
                            document.querySelector('#cmtx_captcha').classList.add('cmtx_field_error');

                            document.querySelector('#cmtx_captcha').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['captcha'] + '</span>');

                            document.querySelector('#cmtx_captcha_refresh').click();

                            document.querySelector('#cmtx_captcha').value = '';
                        }
                    }

                    document.querySelector('#cmtx_form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_error">' + data['result']['error'] + '</div>');

                    cmtxFadeIn('.cmtx_message_error, .cmtx_error', 2000);
                }

                if (data['question']) {
                    document.querySelector('#cmtx_question').textContent = data['question'];
                }

                cmtxAutoScroll(document.querySelector('#cmtx_form_container'));
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    });

    function cmtx_cancel_notify() {
        cmtxRemoveIfExists('.cmtx_message, .cmtx_error, .cmtx_subscribe_row');

        document.querySelectorAll('.cmtx_field, .cmtx_rating').forEach(function(element) {
            element.classList.remove('cmtx_field_error');
        });

        cmtxShow('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_headline_row, .cmtx_upload_row, .cmtx_rating_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_question_row, .cmtx_captcha_row, .cmtx_checkbox_container, .cmtx_button_row, .cmtx_extra_row');

        document.querySelector('#cmtx_comment').classList.add('cmtx_comment_field_active');

        document.querySelector('.cmtx_comment_container').classList.add('cmtx_comment_container_active');

        document.querySelector('.cmtx_form_heading').textContent = cmtx_heading_text;

        document.querySelector('input[name="cmtx_subscribe"]').value = '';
    }

    /* Like or dislike a comment */
    document.addEventListener('click', function(e) {
        var vote_link = e.target.closest('.cmtx_vote_link');

        if (vote_link) {
            e.preventDefault();

            if (vote_link.classList.contains('cmtx_like_link')) {
                var type = 'like';
            } else {
                var type = 'dislike';
            }

            var request = cmtxFetch(cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/vote', {
                body: 'cmtx_comment_id=' + encodeURIComponent(vote_link.closest('.cmtx_comment_box').getAttribute('data-cmtx-comment-id')) + '&cmtx_type=' + encodeURIComponent(type)
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                if (data['success']) {
                    vote_link.querySelector('.cmtx_vote_count').textContent = (parseInt(vote_link.querySelector('.cmtx_vote_count').textContent, 10) + 1);

                    if (type == 'like') {
                        vote_link.querySelector('.cmtx_vote_count').classList.add('like_animation');

                        setTimeout(function() {
                            vote_link.querySelector('.cmtx_vote_count').classList.remove('like_animation');
                        }, 2000);
                    } else {
                        vote_link.querySelector('.cmtx_vote_count').classList.add('dislike_animation');

                        setTimeout(function() {
                            vote_link.querySelector('.cmtx_vote_count').classList.remove('dislike_animation');
                        }, 2000);
                    }
                }

                if (data['error']) {
                    document.querySelector('.cmtx_action_message_error').innerHTML = data['error'];
                    cmtxFadeInOut('.cmtx_action_message_error', 1000, 2000, 1000);

                    var destination = vote_link.getBoundingClientRect();

                    document.querySelector('.cmtx_action_message_error').style.position = 'absolute';
                    document.querySelector('.cmtx_action_message_error').style.top = (destination.top + cmtxGetScrollTop() - 25) + 'px';
                    document.querySelector('.cmtx_action_message_error').style.left = (destination.left + 5) + 'px';
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    });

    /* Share a comment */
    document.addEventListener('click', function(e) {
        var share_link = e.target.closest('.cmtx_share_link');

        if (share_link) {
            e.preventDefault();

            cmtxHide('.cmtx_share_box');

            var permalink = encodeURIComponent(share_link.getAttribute('data-cmtx-sharelink'));

            var reference = encodeURIComponent(document.querySelector('.cmtx_share_box').getAttribute('data-cmtx-reference'));

            cmtxSetShareBoxHref('.cmtx_share_digg', 'http://digg.com/submit?url=' + permalink + '&title=' + reference);
            cmtxSetShareBoxHref('.cmtx_share_facebook', 'https://www.facebook.com/sharer.php?u=' + permalink);
            cmtxSetShareBoxHref('.cmtx_share_linkedin', 'https://www.linkedin.com/shareArticle?mini=true&url=' + permalink + '&title=' + reference);
            cmtxSetShareBoxHref('.cmtx_share_reddit', 'https://reddit.com/submit?url=' + permalink + '&title=' + reference);
            cmtxSetShareBoxHref('.cmtx_share_twitter', 'https://twitter.com/intent/tweet?url=' + permalink + '&text=' + reference);
            cmtxSetShareBoxHref('.cmtx_share_weibo', 'http://service.weibo.com/share/share.php?url=' + permalink + '&title=' + reference);

            cmtxFadeIn('.cmtx_share_box', 400);

            var destination = share_link.getBoundingClientRect();

            document.querySelector('.cmtx_share_box').style.position = 'absolute';
            document.querySelector('.cmtx_share_box').style.top = (destination.top + cmtxGetScrollTop() - 30) + 'px';
            document.querySelector('.cmtx_share_box').style.left = (destination.left - 55) + 'px';
        }
    });

    /* Flag modal */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('#cmtx_flag_modal_yes')) {
            e.preventDefault();

            var comment_id = e.target.getAttribute('data-cmtx-comment-id');

            var flag_link = document.querySelector('.cmtx_comment_box[data-cmtx-comment-id="' + comment_id + '"] .cmtx_flag_link');

            var request = cmtxFetch(cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/flag', {
                body: 'cmtx_comment_id=' + encodeURIComponent(comment_id) + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id)
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                if (data['success']) {
                    document.querySelector('.cmtx_action_message_success').innerHTML = data['success'];
                    cmtxFadeInOut('.cmtx_action_message_success', 500, 2000, 500);

                    var destination = flag_link.getBoundingClientRect();

                    document.querySelector('.cmtx_action_message_success').style.position = 'absolute';
                    document.querySelector('.cmtx_action_message_success').style.top = (destination.top + cmtxGetScrollTop() - 25) + 'px';
                    document.querySelector('.cmtx_action_message_success').style.left = (destination.left - 100) + 'px';
                }

                if (data['error']) {
                    document.querySelector('.cmtx_action_message_error').innerHTML = data['error'];
                    cmtxFadeInOut('.cmtx_action_message_error', 500, 2000, 500);

                    var destination = flag_link.getBoundingClientRect();

                    document.querySelector('.cmtx_action_message_error').style.position = 'absolute';
                    document.querySelector('.cmtx_action_message_error').style.top = (destination.top + cmtxGetScrollTop() - 25) + 'px';
                    document.querySelector('.cmtx_action_message_error').style.left = (destination.left - 100) + 'px';
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });

            cmtxCloseModal();
        }
    });

    /* Original comment */
    document.addEventListener('click', function(e) {
        var edit_link = e.target.closest('.cmtx_edit_link');

        if (edit_link) {
            e.preventDefault();

            var comment_id = edit_link.closest('.cmtx_comment_box').getAttribute('data-cmtx-comment-id');

            var request = cmtxFetch(cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/original', {
                body: 'cmtx_comment_id=' + encodeURIComponent(comment_id) + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id)
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                cmtxRemoveIfExists('.cmtx_message:not(.cmtx_message_reply), .cmtx_error, .quick_reply, .edit_comment');

                var view_replies_link = edit_link.closest('.cmtx_comment_box').querySelector('.cmtx_view_replies_link');
                if (view_replies_link) {
                    view_replies_link.click();
                }

                if (data['success']) {
                    html =  '<div class="edit_comment">';
                    html += '  <div class="cmtx_edit_comment_comment_holder"><textarea name="cmtx_edit_comment" class="cmtx_field cmtx_textarea_field cmtx_comment_field cmtx_comment_field_active" placeholder="' + document.querySelector('#cmtx_comment').getAttribute('placeholder') + '" title="' + document.querySelector('#cmtx_comment').getAttribute('title') + '" maxlength="' + document.querySelector('#cmtx_comment').getAttribute('maxlength') + '">' + data['original_comment'] + '</textarea></div>';

                    var lang_text_agree = cmtx_js_settings_comments.lang_text_agree;
                    lang_text_agree = lang_text_agree.replace('[1]', '<a href="#" data-cmtx-target-modal="#cmtx_privacy_modal">' + cmtx_js_settings_comments.lang_text_privacy + '</a>');
                    lang_text_agree = lang_text_agree.replace('[2]', '<a href="#" data-cmtx-target-modal="#cmtx_terms_modal">' + cmtx_js_settings_comments.lang_text_terms + '</a>');

                    html += '  <div class="cmtx_edit_comment_lower">';
                    html += '    <div class="cmtx_edit_comment_link"></div>';
                    html += '    <div class="cmtx_edit_comment_agree">' + lang_text_agree + '</div>';
                    html += '    <div class="cmtx_edit_comment_button"><input type="button" class="' + document.querySelector('#cmtx_submit_button').getAttribute('class') + ' cmtx_button_edit_comment" value="' + cmtx_js_settings_comments.lang_button_edit + '" title="' + cmtx_js_settings_comments.lang_button_edit + '"></div>';
                    html += '  </div>';
                    html += '</div>';

                    edit_link.closest('.cmtx_main_area').insertAdjacentHTML('afterend', html);

                    cmtxCommentResize();
                }

                if (data['error']) {
                    document.querySelector('.edit_comment').insertAdjacentHTML('afterbegin', '<div class="cmtx_message cmtx_message_error">' + data['error'] + '</div>');

                    cmtxFadeIn('.cmtx_message_error, .cmtx_error', 2000);
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    });

    /* Edit Comment */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_button_edit_comment')) {
            e.preventDefault();

            var edit_comment = e.target.closest('.cmtx_comment_box').querySelector('.edit_comment');

            edit_comment.querySelector('.cmtx_button_edit_comment').value = cmtx_js_settings_form.lang_button_processing;

            edit_comment.querySelector('.cmtx_button_edit_comment').disabled = true;

            edit_comment.querySelector('.cmtx_button_edit_comment').classList.add('cmtx_button_disabled');

            var comment_id = edit_comment.closest('.cmtx_comment_box').getAttribute('data-cmtx-comment-id');

            var request = cmtxFetch(cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/form/edit', {
                body: 'cmtx_comment=' + encodeURIComponent(edit_comment.querySelector('textarea[name="cmtx_edit_comment"]').value.replace(/(\r\n|\n|\r)/gm, "\r\n")) + '&cmtx_comment_id=' + encodeURIComponent(comment_id) + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_form.page_id)
            });

            request.then(function(response) {
                edit_comment.querySelector('.cmtx_button_edit_comment').value = cmtx_js_settings_comments.lang_button_edit;

                edit_comment.querySelector('.cmtx_button_edit_comment').disabled = false;

                edit_comment.querySelector('.cmtx_button_edit_comment').classList.remove('cmtx_button_disabled');

                return response.json();
            }).then(function(data) {
                cmtxRemoveIfExists('.cmtx_message:not(.cmtx_message_reply), .cmtx_error');

                document.querySelectorAll('.cmtx_field').forEach(function(element) {
                    element.classList.remove('cmtx_field_error');
                });

                if (data['result']['success']) {
                    cmtxRemoveIfExists('.cmtx_message');

                    if (data['result']['approve']) {
                        edit_comment.innerHTML = ('<div class="cmtx_message cmtx_message_success cmtx_m-0">' + data['result']['success'] + '</div>');
                    } else {
                        edit_comment.innerHTML = ('<div class="cmtx_message cmtx_message_success cmtx_m-0">' + data['result']['success'] + ' <a href="#" class="cmtx_edit_comment_refresh">' + cmtx_js_settings_comments.lang_link_refresh + '</a>' + '</div>');
                    }

                    cmtxFadeIn('.cmtx_message_success', 1500);
                }

                if (data['result']['error']) {
                    if (data['error']) {
                        if (data['error']['comment']) {
                            edit_comment.querySelector('textarea[name="cmtx_edit_comment"]').classList.add('cmtx_field_error');

                            edit_comment.querySelector('textarea[name="cmtx_edit_comment"]').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['comment'] + '</span>');
                        }
                    }

                    edit_comment.insertAdjacentHTML('afterbegin', '<div class="cmtx_message cmtx_message_error">' + data['result']['error'] + '</div>');

                    cmtxFadeIn('.cmtx_message_error, .cmtx_error', 2000);
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    });

    /* Delete modal */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('#cmtx_delete_modal_yes')) {
            e.preventDefault();

            var comment_id = e.target.getAttribute('data-cmtx-comment-id');

            var delete_link = document.querySelector('.cmtx_comment_box[data-cmtx-comment-id="' + comment_id + '"] .cmtx_delete_link');

            var request = cmtxFetch(cmtx_js_settings_comments.commentics_url + 'frontend/index.php?route=main/comments/delete', {
                body: 'cmtx_comment_id=' + encodeURIComponent(comment_id) + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_comments.page_id)
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                if (data['success']) {
                    var options = {
                        'commentics_url': cmtx_js_settings_comments.commentics_url,
                        'page_id'       : cmtx_js_settings_comments.page_id,
                        'page_number'   : '',
                        'sort_by'       : '',
                        'search'        : '',
                        'effect'        : true
                    }

                    cmtxRefreshComments(options);
                }

                if (data['error']) {
                    document.querySelector('.cmtx_action_message_error').innerHTML = data['error'];
                    cmtxFadeInOut('.cmtx_action_message_error', 500, 2000, 500);

                    var destination = delete_link.getBoundingClientRect();

                    document.querySelector('.cmtx_action_message_error').style.position = 'absolute';
                    document.querySelector('.cmtx_action_message_error').style.top = (destination.top + cmtxGetScrollTop() - 25) + 'px';
                    document.querySelector('.cmtx_action_message_error').style.left = (destination.left - 100) + 'px';
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });

            cmtxCloseModal();
        }
    });

    /* Permalink for a comment */
    document.addEventListener('click', function(e) {
        var permalink_link = e.target.closest('.cmtx_permalink_link');

        if (permalink_link) {
            e.preventDefault();

            cmtxHide('.cmtx_permalink_box');

            var permalink = permalink_link.getAttribute('data-cmtx-permalink');

            document.querySelector('#cmtx_permalink').value = permalink;

            cmtxFadeIn('.cmtx_permalink_box', 400);

            var box_width = document.querySelector('.cmtx_permalink_box').clientWidth;

            var destination = permalink_link.getBoundingClientRect();

            document.querySelector('.cmtx_permalink_box').style.position = 'absolute';
            document.querySelector('.cmtx_permalink_box').style.top = (destination.top + cmtxGetScrollTop() - 70) + 'px';
            document.querySelector('.cmtx_permalink_box').style.left = (destination.left - box_width) + 'px';

            document.querySelector('#cmtx_permalink').select();
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_permalink_box a')) {
            e.preventDefault();

            cmtxFadeOut('.cmtx_permalink_box', 400);
        }
    });

    /* If element exists, get value, otherwise return '' */
    function cmtxGetValue(element) {
        if (element) {
            return element.value;
        } else {
            return '';
        }
    }

    /* Reply to a comment */
    document.addEventListener('click', function(e) {
        if (e.target && (e.target.matches('.cmtx_reply_icon') || e.target.matches('.cmtx_reply_link'))) {
            e.preventDefault();

            if (e.target.closest('.quick_reply')) {
                var is_quick_reply = false;
            } else {
                var is_quick_reply = true;
            }

            var comment_id = e.target.closest('.cmtx_comment_box').getAttribute('data-cmtx-comment-id');

            document.querySelector('input[name="cmtx_reply_to"]').value = comment_id;

            var name = e.target.closest('.cmtx_comment_box').querySelector('.cmtx_name_text').textContent;

            var quick_reply_name = cmtxGetValue(e.target.closest('.cmtx_comment_box').querySelector('input[name="cmtx_quick_reply_name"]'));
            var quick_reply_email = cmtxGetValue(e.target.closest('.cmtx_comment_box').querySelector('input[name="cmtx_quick_reply_email"]'));
            var quick_reply_comment = cmtxGetValue(e.target.closest('.cmtx_comment_box').querySelector('textarea[name="cmtx_quick_reply_comment"]'));

            cmtxRemoveIfExists('.quick_reply, .edit_comment');

            if (cmtx_js_settings_comments.quick_reply && is_quick_reply) {
                cmtxRemoveIfExists('.cmtx_message:not(.cmtx_message_reply), .cmtx_error');

                var view_replies_link = e.target.closest('.cmtx_comment_box').querySelector('.cmtx_view_replies_link');
                if (view_replies_link) {
                    view_replies_link.click();
                }

                html =  '<div class="quick_reply">';
                html += '  <div class="cmtx_quick_reply_comment_holder"><textarea name="cmtx_quick_reply_comment" class="cmtx_field cmtx_textarea_field cmtx_comment_field cmtx_comment_field_active" placeholder="' + document.querySelector('#cmtx_comment').getAttribute('placeholder') + '" title="' + document.querySelector('#cmtx_comment').getAttribute('title') + '" maxlength="' + document.querySelector('#cmtx_comment').getAttribute('maxlength') + '"></textarea></div>';

                if (document.querySelector('#cmtx_name') || document.querySelector('#cmtx_email')) {
                    html += '  <div class="cmtx_quick_reply_user">';

                    if (document.querySelector('#cmtx_name')) {
                        html += '<div class="cmtx_quick_reply_name_holder"><input type="text" name="cmtx_quick_reply_name" class="' + document.querySelector('#cmtx_name').getAttribute('class') + '" value="' + document.querySelector('#cmtx_name').value + '" placeholder="' + document.querySelector('#cmtx_name').getAttribute('placeholder') + '" title="' + document.querySelector('#cmtx_name').getAttribute('title') + '" maxlength="' + document.querySelector('#cmtx_name').getAttribute('maxlength') + '" ' + (document.querySelector('#cmtx_name').hasAttribute('readonly') ? 'readonly' : '') + '></div>';
                    }

                    if (document.querySelector('#cmtx_email')) {
                        html += '<div class="cmtx_quick_reply_email_holder"><input type="email" name="cmtx_quick_reply_email" class="' + document.querySelector('#cmtx_email').getAttribute('class') + '" value="' + document.querySelector('#cmtx_email').value + '" placeholder="' + document.querySelector('#cmtx_email').getAttribute('placeholder') + '" title="' + document.querySelector('#cmtx_email').getAttribute('title') + '" maxlength="' + document.querySelector('#cmtx_email').getAttribute('maxlength') + '" ' + (document.querySelector('#cmtx_email').hasAttribute('readonly') ? 'readonly' : '') + '></div>';
                    }

                    html += '  </div>';
                }

                var lang_text_agree = cmtx_js_settings_comments.lang_text_agree;
                lang_text_agree = lang_text_agree.replace('[1]', '<a href="#" data-cmtx-target-modal="#cmtx_privacy_modal">' + cmtx_js_settings_comments.lang_text_privacy + '</a>');
                lang_text_agree = lang_text_agree.replace('[2]', '<a href="#" data-cmtx-target-modal="#cmtx_terms_modal">' + cmtx_js_settings_comments.lang_text_terms + '</a>');

                html += '  <div class="cmtx_quick_reply_lower">';
                html += '    <div class="cmtx_quick_reply_link"><a href="#" class="cmtx_reply_link">' + cmtx_js_settings_comments.lang_link_reply + '</a></div>';
                html += '    <div class="cmtx_quick_reply_agree">' + lang_text_agree + '</div>';
                html += '    <div class="cmtx_quick_reply_button"><input type="button" class="' + document.querySelector('#cmtx_submit_button').getAttribute('class') + ' cmtx_button_quick_reply" value="' + cmtx_js_settings_comments.lang_button_reply + '" title="' + cmtx_js_settings_comments.lang_button_reply + '"></div>';
                html += '  </div>';
                html += '</div>';

                e.target.closest('.cmtx_main_area').insertAdjacentHTML('afterend', html);

                cmtxCommentResize();
            } else {
                /* Copy quick reply values to main form */
                if (quick_reply_name) {
                    document.querySelector('#cmtx_name').value = quick_reply_name;
                }

                if (quick_reply_email) {
                    document.querySelector('#cmtx_email').value = quick_reply_email;
                }

                if (quick_reply_comment) {
                    document.querySelector('#cmtx_comment').value = quick_reply_comment;
                    cmtxUpdateCommentCounter();
                }
                /* End of copying values */

                if (document.querySelector('input[name="cmtx_subscribe"]').value == 1) {
                    cmtx_cancel_notify();
                }

                cmtxRemoveIfExists('.cmtx_message_info');

                cmtxShow('.cmtx_icons_row, .cmtx_comment_row, .cmtx_counter_row, .cmtx_upload_row, .cmtx_website_row, .cmtx_geo_row, .cmtx_question_row, .cmtx_captcha_row, .cmtx_checkbox_container, .cmtx_button_row, .cmtx_extra_row');

                cmtxHide('.cmtx_headline_row, .cmtx_rating_row');

                document.querySelector('#cmtx_comment').classList.add('cmtx_comment_field_active');

                document.querySelector('.cmtx_comment_container').classList.add('cmtx_comment_container_active');

                document.querySelector('#cmtx_form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_info cmtx_message_reply">' + cmtx_js_settings_comments.lang_text_replying_to + ' ' + name + ' <a href="#" title="' + cmtx_js_settings_comments.lang_title_cancel_reply + '">' + cmtx_js_settings_comments.lang_link_cancel + '</a></div>');

                cmtxAutoScroll(document.querySelector('#cmtx_form_container'));

                cmtxFadeIn('.cmtx_message_reply', 2000);
            }
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_message_reply a')) {
            e.preventDefault();

            cmtxShow('.cmtx_headline_row, .cmtx_rating_row');

            document.querySelector('input[name="cmtx_reply_to"]').value = '';

            document.querySelector('.cmtx_message_reply').textContent = cmtx_js_settings_comments.lang_text_not_replying;
        }
    });

    /* Lightbox for comment uploads */
    function cmtxLightbox() {
        document.addEventListener('click', function(e) {
            if (e.target && e.target.matches('.cmtx_comments_container .cmtx_upload_area img')) {
                var src = e.target.getAttribute('src');

                if (isInIframe) {
                    e.target.parentElement.setAttribute('href', src);
                } else {
                    e.preventDefault();

                    document.querySelector('#cmtx_lightbox_modal .cmtx_modal_body').innerHTML = ('<img src="' + src + '" class="cmtx_lightbox_image">');

                    document.body.appendChild(document.querySelector('#cmtx_lightbox_modal'));

                    document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

                    cmtxFadeIn('.cmtx_overlay', 200);

                    cmtxFadeIn('#cmtx_lightbox_modal', 200);
                }
            }
        });
    }

    /* Load more comments button */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('#cmtx_more_button')) {
            e.preventDefault();

            document.querySelector('#cmtx_more_button').value = cmtx_js_settings_comments.lang_button_loading;

            document.querySelector('#cmtx_more_button').disabled = true;

            document.querySelector('#cmtx_more_button').classList.add('cmtx_button_disabled');

            var next_page = parseInt(document.querySelector('#cmtx_next_page').value);

            document.querySelector('#cmtx_next_page').value = (next_page + 1);

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
        }
    });

    /* Return to comments link */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_no_results a, .cmtx_return a')) {
            e.preventDefault();

            document.querySelectorAll('.cmtx_search').forEach(function(element) {
                element.value = '';
            });

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
        }
    });

    /* Refresh comments link */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_edit_comment_refresh, .cmtx_quick_reply_refresh')) {
            e.preventDefault();

            var options = {
                'commentics_url': cmtx_js_settings_comments.commentics_url,
                'page_id'       : cmtx_js_settings_comments.page_id,
                'page_number'   : '',
                'sort_by'       : cmtxGetSortByValue(),
                'search'        : cmtxGetSearchValue(),
                'effect'        : true
            }

            cmtxRefreshComments(options);
        }
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
                // Remove the event listener (if it exists)
                window.removeEventListener('scroll', cmtxInfiniteScroll);

                // Add the event listener
                window.addEventListener('scroll', cmtxInfiniteScroll);
            }
        }
    }

    /* Admin Detect modal */

    if (typeof(cmtx_js_settings_form) != 'undefined') {
        if (document.querySelector('#cmtx_admindetect_modal')) {
            document.body.appendChild(document.querySelector('#cmtx_admindetect_modal'));

            document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

            if (isInIframe) {
                var destination = document.querySelector('#cmtx_container').getBoundingClientRect();

                document.querySelector('#cmtx_admindetect_modal').style.top = destination.top + 130 + 'px';

                document.querySelector('.cmtx_overlay').style.backgroundColor = 'transparent';
            }

            cmtxFadeIn('.cmtx_overlay', 200);

            cmtxFadeIn('#cmtx_admindetect_modal', 200);
        }

        document.addEventListener('click', function(e) {
            if (e.target && e.target.matches('#cmtx_admindetect_modal_stop')) {
                e.preventDefault();

                var request = cmtxFetch(cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/page/adminDetect', {
                    body: ''
                });

                request.then(function(response) {
                    return response.json();
                }).then(function(data) {
                }).catch(function(error) {
                    if (console && console.log) {
                        console.log(error);
                    }
                });

                cmtxCloseModal();
            }
        });
    }

    /* Quick reply */
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.cmtx_button_quick_reply')) {
            e.preventDefault();

            var quick_reply = e.target.closest('.cmtx_comment_box').querySelector('.quick_reply');

            // Find any disabled inputs and remove the "disabled" attribute
            var disabled = document.querySelector('#cmtx_form').querySelectorAll('input:disabled').forEach(function(element) {
                element.removeAttribute('disabled');
            });

            // Serialize the form
            var serialized = new URLSearchParams(new FormData(document.querySelector('#cmtx_form')));

            // Re-disable the set of inputs that were originally disabled
            if (disabled) {
                disabled.forEach(function(element) {
                    element.setAttribute('disabled', 'disabled');
                });
            }

            quick_reply.querySelector('.cmtx_button_quick_reply').value = cmtx_js_settings_form.lang_button_processing;

            quick_reply.querySelector('.cmtx_button_quick_reply').disabled = true;

            quick_reply.querySelector('.cmtx_button_quick_reply').classList.add('cmtx_button_disabled');

            if (quick_reply.querySelector('input[name="cmtx_quick_reply_email"]')) {
                var quick_reply_email = quick_reply.querySelector('input[name="cmtx_quick_reply_email"]').value;
            } else {
                var quick_reply_email = '';
            }

            if (quick_reply.querySelector('input[name="cmtx_quick_reply_name"]')) {
                var quick_reply_name = quick_reply.querySelector('input[name="cmtx_quick_reply_name"]').value;
            } else {
                var quick_reply_name = '';
            }

            var request = cmtxFetch(cmtx_js_settings_form.commentics_url + 'frontend/index.php?route=main/form/reply', {
                body: serialized + '&cmtx_comment=' + encodeURIComponent(quick_reply.querySelector('textarea[name="cmtx_quick_reply_comment"]').value.replace(/(\r\n|\n|\r)/gm, "\r\n")) + '&cmtx_email=' + encodeURIComponent(quick_reply_email) + '&cmtx_name=' + encodeURIComponent(quick_reply_name) + '&cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_form.page_id) + document.querySelector('#cmtx_hidden_data').value
            });

            request.then(function(response) {
                quick_reply.querySelector('.cmtx_button_quick_reply').value = cmtx_js_settings_comments.lang_button_reply;

                quick_reply.querySelector('.cmtx_button_quick_reply').disabled = false;

                quick_reply.querySelector('.cmtx_button_quick_reply').classList.remove('cmtx_button_disabled');

                return response.json();
            }).then(function(data) {
                cmtxRemoveIfExists('.cmtx_message:not(.cmtx_message_reply), .cmtx_error');

                document.querySelectorAll('.cmtx_field').forEach(function(element) {
                    element.classList.remove('cmtx_field_error');
                });

                if (data['result']['success']) {
                    cmtxRemoveIfExists('.cmtx_message');

                    document.querySelector('input[name="cmtx_reply_to"]').value = '';

                    if (data['result']['approve']) {
                        quick_reply.innerHTML = ('<div class="cmtx_message cmtx_message_success cmtx_m-0">' + data['result']['success'] + '</div>');
                    } else {
                        quick_reply.innerHTML = ('<div class="cmtx_message cmtx_message_success cmtx_m-0">' + data['result']['success'] + ' <a href="#" class="cmtx_quick_reply_refresh">' + cmtx_js_settings_comments.lang_link_refresh + '</a>' + '</div>');
                    }

                    cmtxFadeIn('.cmtx_message_success', 1500);
                }

                if (data['result']['error']) {
                    if (data['error']) {
                        if (data['error']['comment']) {
                            quick_reply.querySelector('textarea[name="cmtx_quick_reply_comment"]').classList.add('cmtx_field_error');

                            quick_reply.querySelector('textarea[name="cmtx_quick_reply_comment"]').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['comment'] + '</span>');
                        }

                        if (data['error']['name']) {
                            quick_reply.querySelector('input[name="cmtx_quick_reply_name"]').classList.add('cmtx_field_error');

                            quick_reply.querySelector('input[name="cmtx_quick_reply_name"]').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['name'] + '</span>');
                        }

                        if (data['error']['email']) {
                            quick_reply.querySelector('input[name="cmtx_quick_reply_email"]').classList.add('cmtx_field_error');

                            quick_reply.querySelector('input[name="cmtx_quick_reply_email"]').insertAdjacentHTML('afterend', '<span class="cmtx_error">' + data['error']['email'] + '</span>');
                        }
                    }

                    quick_reply.insertAdjacentHTML('afterbegin', '<div class="cmtx_message cmtx_message_error">' + data['result']['error'] + '</div>');

                    cmtxFadeIn('.cmtx_message_error, .cmtx_error', 2000);
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        }
    });

    /* Function to refresh the comments using ajax */
    function cmtxRefreshComments(options) {
        if (options.effect) {
            cmtxShow('.cmtx_loading_icon');

            document.querySelector('body').classList.add('cmtx_loading_body');
        }

        var request = cmtxFetch(options.commentics_url + 'frontend/index.php?route=main/comments/getComments', {
            body: 'cmtx_page_id=' + encodeURIComponent(options.page_id) + '&cmtx_sort_by=' + encodeURIComponent(options.sort_by) + '&cmtx_search=' + encodeURIComponent(options.search) + '&cmtx_page=' + encodeURIComponent(options.page_number)
        });

        request.then(function(response) {
            if (options.effect) {
                cmtxHide('.cmtx_loading_icon');

                document.body.classList.remove('cmtx_loading_body');
            }

            return response.json();
        }).then(function(data) {
            if (data['result']) {
                if (options.pagination == 'button' || options.pagination == 'infinite') {
                    var response_html = new DOMParser().parseFromString(data['result'], 'text/html');

                    if (response_html.querySelector('.cmtx_comment_boxes')) {
                        var comments = response_html.querySelector('.cmtx_comment_boxes').innerHTML;

                        document.querySelector('.cmtx_comment_boxes').insertAdjacentHTML('beforeend', comments);
                    }

                    if (document.querySelector('#cmtx_more_button')) {
                        document.querySelector('#cmtx_more_button').value = cmtx_js_settings_comments.lang_button_more;

                        document.querySelector('#cmtx_more_button').disabled = false;

                        document.querySelector('#cmtx_more_button').classList.remove('cmtx_button_disabled');
                    }

                    var total_comments = parseInt(document.querySelector('#cmtx_loading_helper').getAttribute('data-cmtx-total-comments'));

                    if (total_comments > document.querySelectorAll('.cmtx_comment_section').length) {
                        // there are more comments that can be loaded
                    } else {
                        cmtxRemoveIfExists('#cmtx_more_button');

                        document.querySelector('#cmtx_loading_helper').setAttribute('data-cmtx-load', '0');
                    }
                } else {
                    document.querySelector('.cmtx_comments_section').innerHTML = data['result'];
                }

                document.querySelectorAll('.cmtx_search').forEach(function(element) {
                    if (element.value != '') {
                        element.classList.add('cmtx_search_focus');
                    }
                });

                cmtxRemoveIfExists('body > #cmtx_flag_modal, body > #cmtx_delete_modal');

                /* Load the comment settings in case they weren't already loaded (if there were no comments) */
                if (document.querySelector('#cmtx_js_settings_comments')) {
                    cmtx_js_settings_comments = JSON.parse(document.querySelector('#cmtx_js_settings_comments').innerText);
                }

                /* Load the notify settings in case they weren't already loaded (if there were no comments) */
                if (document.querySelector('#cmtx_js_settings_notify')) {
                    cmtx_js_settings_notify = JSON.parse(document.querySelector('#cmtx_js_settings_notify').innerText);
                }

                /* Load the online settings in case they weren't already loaded (if there were no comments) */
                if (document.querySelector('#cmtx_js_settings_online')) {
                    cmtx_js_settings_online = JSON.parse(document.querySelector('#cmtx_js_settings_online').innerText);
                }

                /* Re-initialise */
                cmtxInit();

                /* Serves as an event which can be listened to for after comments are loaded */
                document.querySelector('#cmtx_loading_helper').click();
            }
        }).catch(function(error) {
            if (console && console.log) {
                console.log(error);
            }
        });
    }

    /* Infinite scroll */
    var scroll_timeout = null;

    function cmtxInfiniteScroll() {
        if (document.querySelector('#cmtx_loading_helper').getAttribute('data-cmtx-load') == '1') {
            clearTimeout(scroll_timeout);

            scroll_timeout = setTimeout(function() {
                var element_distance = Math.ceil(document.querySelector('#cmtx_loading_helper').getBoundingClientRect().top + window.scrollY);

                // if the sum of the window height and scroll distance from the top is greater than the target element's distance from the top
                if ((window.innerHeight + cmtxGetScrollTop()) > element_distance) {
                    var next_page = parseInt(document.querySelector('#cmtx_next_page').value);

                    document.querySelector('#cmtx_next_page').value = (next_page + 1);

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
        if (document.querySelector('#cmtx_loading_helper').getAttribute('data-cmtx-load') == '1') {
            var next_page = parseInt(document.querySelector('#cmtx_next_page').value);

            document.querySelector('#cmtx_next_page').value = (next_page + 1);

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
                console.log(message);
            }
        };
    }

    /* Viewers Online */
    function cmtxViewersOnline() {
        if (typeof(cmtx_js_settings_online) != 'undefined') {
            if (cmtx_js_settings_online.online_refresh_enabled) {
                setInterval(function() {
                    var request = cmtxFetch(cmtx_js_settings_online.commentics_url + 'frontend/index.php?route=part/online/refresh', {
                        body: 'cmtx_page_id=' + encodeURIComponent(cmtx_js_settings_online.page_id)
                    });

                    request.then(function(response) {
                        return response.json();
                    }).then(function(data) {
                        if (data['online'] != 'undefined') { // may be zero
                            document.querySelectorAll('.cmtx_online_num').forEach(function(element) {
                                element.textContent = data['online'];
                            });
                        }
                    }).catch(function(error) {
                        if (console && console.log) {
                            console.log(error);
                        }
                    });
                }, cmtx_js_settings_online.online_refresh_interval);
            }
        }
    }

    /* Initialise */
    cmtxInit();

    /* User Page */

    if (typeof(cmtx_js_settings_user) != 'undefined') {
        cmtxTimeago();

        /* Show an avatar selection modal */
        if (document.querySelector('#cmtx_avatar_selection_link')) {
            document.querySelector('#cmtx_avatar_selection_link').addEventListener('click', function(e) {
                e.preventDefault();

                document.body.insertAdjacentHTML('beforeend', '<div class="cmtx_overlay"></div>');

                cmtxFadeIn('.cmtx_overlay', 200);

                cmtxFadeIn('#cmtx_avatar_selection_modal', 200);
            });
        }

        document.querySelectorAll('.cmtx_avatar_selection_img').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();

                var src = this.getAttribute('src');

                document.querySelector('.cmtx_avatar_image').setAttribute('src', src);

                cmtxShow('.cmtx_avatar_image_links');

                cmtxCloseModal();
            });
        });

        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.querySelector('.cmtx_avatar_image').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);

                cmtxShow('.cmtx_avatar_image_links');
            }
        }

        if (document.querySelector('#cmtx_avatar_image_input')) {
            document.querySelector('#cmtx_avatar_image_input').addEventListener('change', function() {
                readURL(this);
            });
        }

        if (document.querySelector('#cmtx_avatar_upload_link')) {
            document.querySelector('#cmtx_avatar_upload_link').addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector('#cmtx_avatar_image_input').click();
            });
        }

        if (document.querySelector('#cmtx_avatar_save_link')) {
            document.querySelector('#cmtx_avatar_save_link').addEventListener('click', function(e) {
                e.preventDefault();

                var avatar_type = document.querySelector('.cmtx_avatar_image').getAttribute('data-type');

                var formData = new FormData();

                if (avatar_type == 'selection') {
                    formData.append('avatar', document.querySelector('.cmtx_avatar_image').getAttribute('src'));
                    var method = 'saveSelectedAvatar';
                } else { // upload
                    formData.append('avatar', document.querySelector('#cmtx_avatar_image_input').files[0]);
                    var method = 'saveUploadedAvatar';
                }

                cmtxRemoveIfExists('.cmtx_message');

                document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_info">' + cmtx_js_settings_user.lang_text_saving + '</div>');

                cmtxShow('.cmtx_message');

                var request = cmtxFetch(cmtx_js_settings_user.commentics_url + 'frontend/index.php?route=main/user/' + method + '&u-t=' + encodeURIComponent(cmtx_js_settings_user.token), {
                    body: formData,
                    file_upload: true
                });

                request.then(function(response) {
                    return response.json();
                }).then(function(data) {
                    cmtxAutoScroll(document.querySelector('.cmtx_user_container'));

                    setTimeout(function() {
                        cmtxRemoveIfExists('.cmtx_message');

                        if (data['success']) {
                            document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_success">' + data['success'] + '</div>');

                            cmtxShow('.cmtx_message');

                            cmtxHide('.cmtx_avatar_image_links');
                        }

                        if (data['error']) {
                            document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_error">' + data['error'] + '</div>');

                            cmtxShow('.cmtx_message');
                        }
                    }, 1000);
                }).catch(function(error) {
                    if (console && console.log) {
                        console.log(error);
                    }
                });
            });
        }

        if (cmtx_js_settings_user.to_all) {
            cmtxHide('#cmtx_user_container .cmtx_notifications_area_custom');
        } else {
            cmtxShow('#cmtx_user_container .cmtx_notifications_area_custom');
        }

        document.querySelectorAll('#cmtx_user_container input[name="to_all"]').forEach(function(element) {
            element.addEventListener('change', function(e) {
                if (e.target.value == '1') {
                    cmtxFadeOut('#cmtx_user_container .cmtx_notifications_area_custom', 500);
                } else {
                    cmtxFadeIn('#cmtx_user_container .cmtx_notifications_area_custom', 500);
                }
            });
        });

        document.querySelectorAll('#cmtx_user_container .cmtx_settings_container input').forEach(function(element) {
            element.addEventListener('change', function() {
                cmtxRemoveIfExists('.cmtx_message');

                document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_info">' + cmtx_js_settings_user.lang_text_saving + '</div>');

                cmtxShow('.cmtx_message');

                // Serialize the form
                var serialized = new URLSearchParams(new FormData(document.querySelector('form')));

                var request = cmtxFetch(cmtx_js_settings_user.commentics_url + 'frontend/index.php?route=main/user/save', {
                    body: serialized + '&u-t=' + encodeURIComponent(cmtx_js_settings_user.token)
                });

                request.then(function(response) {
                    return response.json();
                }).then(function(data) {
                    cmtxAutoScroll(document.querySelector('.cmtx_user_container'));

                    setTimeout(function() {
                        cmtxRemoveIfExists('.cmtx_message');

                        if (data['success']) {
                            document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_success">' + data['success'] + '</div>');

                            cmtxShow('.cmtx_message');
                        }

                        if (data['error']) {
                            document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_error">' + data['error'] + '</div>');

                            cmtxShow('.cmtx_message');
                        }
                    }, 1000);
                }).catch(function(error) {
                    if (console && console.log) {
                        console.log(error);
                    }
                });
            });
        });

        document.querySelectorAll('#cmtx_user_container .cmtx_trash_icon').forEach(function(element) {
            element.addEventListener('click', function(e) {
                var trash_icon = e.target;

                var request = cmtxFetch(cmtx_js_settings_user.commentics_url + 'frontend/index.php?route=main/user/deleteSubscription', {
                    body: '&u-t=' + encodeURIComponent(cmtx_js_settings_user.token) + '&s-t=' + encodeURIComponent(trash_icon.getAttribute('data-sub-token'))
                });

                request.then(function(response) {
                    return response.json();
                }).then(function(data) {
                    cmtxRemoveIfExists('.cmtx_message');

                    if (data['success']) {
                        trash_icon.parentElement.parentElement.remove();

                        document.querySelector('.count').textContent = data['count'];

                        if (data['count'] == '0') {
                            document.querySelector('tbody').insertAdjacentHTML('afterend', '<tr><td class="cmtx_no_results" colspan="4">' + cmtx_js_settings_user.lang_text_no_results + '</td></tr>');
                        } else {
                            var i = 1;

                            document.querySelectorAll('tbody tr td:first-child').forEach(function(element) {
                                element.textContent = i;

                                i++;
                            });
                        }
                    }

                    if (data['error']) {
                        cmtxAutoScroll(document.querySelector('.cmtx_user_container'));

                        document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_error">' + data['error'] + '</div>');

                        cmtxShow('.cmtx_message');
                    }
                }).catch(function(error) {
                    if (console && console.log) {
                        console.log(error);
                    }
                });
            });
        });

        document.querySelector('#cmtx_user_container .cmtx_delete_all').addEventListener('click', function(e) {
            e.preventDefault();

            var request = cmtxFetch(cmtx_js_settings_user.commentics_url + 'frontend/index.php?route=main/user/deleteAllSubscriptions', {
                body: '&u-t=' + encodeURIComponent(cmtx_js_settings_user.token)
            });

            request.then(function(response) {
                return response.json();
            }).then(function(data) {
                cmtxRemoveIfExists('.cmtx_message');

                if (data['success']) {
                    document.querySelector('.count').textContent = '0';

                    document.querySelector('tbody').innerHTML = ('<tr><td class="cmtx_no_results" colspan="4">' + cmtx_js_settings_user.lang_text_no_results + '</td></tr>');
                }

                if (data['error']) {
                    cmtxAutoScroll(document.querySelector('.cmtx_user_container'));

                    document.querySelector('form').insertAdjacentHTML('beforebegin', '<div class="cmtx_message cmtx_message_error">' + data['error'] + '</div>');

                    cmtxShow('.cmtx_message');
                }
            }).catch(function(error) {
                if (console && console.log) {
                    console.log(error);
                }
            });
        });
    }
});

/* Get the value from the sort by field */
function cmtxGetSortByValue() {
    var sort_by = '';

    if (document.querySelector('select[name="cmtx_sort_by"]')) {
        sort_by = document.querySelector('select[name="cmtx_sort_by"]').value;
    }

    return sort_by;
}

/* Get the value from the search field */
function cmtxGetSearchValue() {
    var search = '';

    if (document.querySelector('input[name="cmtx_search"]')) {
        search = document.querySelector('input[name="cmtx_search"]').value;
    }

    return search;
}

/* Get the current page number */
function cmtxGetCurrentPage() {
    if (document.querySelector('.cmtx_pagination_box_active')) {
        return parseInt(document.querySelector('.cmtx_pagination_box_active').getAttribute('data-cmtx-page'));
    } else if (document.querySelector('#cmtx_next_page')) {
        return parseInt(document.querySelector('#cmtx_next_page').value - 1);
    } else {
        return 1;
    }
}

/* Auto update the time with e.g. '2 minutes ago' */
function cmtxTimeago() {
    if (typeof(cmtx_js_settings_comments) != 'undefined') {
        var settings = cmtx_js_settings_comments;
    } else if (typeof(cmtx_js_settings_user) != 'undefined') {
        var settings = cmtx_js_settings_user;
    } else {
        return;
    }

    if (settings.date_auto) {
        document.querySelectorAll('.cmtx_timeago').forEach(function(element) {
            var timestamp = new Date(element.getAttribute('datetime'));

            var now = new Date();
            var diff = now - timestamp;

            var seconds = Math.floor(diff / 1000);
            var minutes = Math.floor(seconds / 60);
            var hours = Math.floor(minutes / 60);
            var days = Math.floor(hours / 24);
            var months = Math.floor(days / 30);
            var years = Math.floor(months / 12);

            if (years > 0) {
                if (years == 1) {
                    timestamp = settings.timeago_year;
                } else {
                    timestamp = settings.timeago_years.replace('%d', years);
                }
            } else if (months > 0) {
                if (months == 1) {
                    timestamp = settings.timeago_month;
                } else {
                    timestamp = settings.timeago_months.replace('%d', months);
                }
            } else if (days > 0) {
                if (days == 1) {
                    timestamp = settings.timeago_day;
                } else {
                    timestamp = settings.timeago_days.replace('%d', days);
                }
            } else if (hours > 0) {
                if (hours == 1) {
                    timestamp = settings.timeago_hour;
                } else {
                    timestamp = settings.timeago_hours.replace('%d', hours);
                }
            } else if (minutes > 0) {
                if (minutes == 1) {
                    timestamp = settings.timeago_minute;
                } else {
                    timestamp = settings.timeago_minutes.replace('%d', minutes);
                }
            } else {
                timestamp = settings.timeago_now;
            }

            element.innerText = timestamp;
        });

        setInterval(cmtxTimeago, 60000);
    }
}

/* Highlight any user-entered code */
function cmtxHighlightCode() {
    if (typeof(hljs) != 'undefined' && typeof(hljs.highlightElement) != 'undefined') {
        document.querySelectorAll('.cmtx_code_box, .cmtx_php_box').forEach(function(element) {
            hljs.highlightElement(element);
        });
    }
}

/* Show the 'View x replies' link */
function cmtxViewReplies() {
    if (typeof(cmtx_js_settings_comments) != 'undefined') {
        document.querySelectorAll('.cmtx_reply_counter').forEach(function(element) {
            var reply_counter = element.textContent;

            if (reply_counter) {
                if (reply_counter == 1) {
                    var view_replies = '<span class="cmtx_reply_view">' + cmtx_js_settings_comments.lang_text_view + '</span> <span class="cmtx_reply_num">1</span> <span class="cmtx_reply_replies">' + cmtx_js_settings_comments.lang_text_reply + '</span>';
                } else {
                    var view_replies = '<span class="cmtx_reply_view">' + cmtx_js_settings_comments.lang_text_view + '</span> <span class="cmtx_reply_num">' + reply_counter + '</span> <span class="cmtx_reply_replies">' + cmtx_js_settings_comments.lang_text_replies + '</span>';
                }

                var comment_section = element.closest('.cmtx_comment_section');

                var replies_link = comment_section.querySelector('.cmtx_view_replies_link');

                if (replies_link) {
                    replies_link.innerHTML = ('<i class="fa fa-commenting-o" aria-hidden="true"></i> ' + view_replies);
                }
            }
        });
    }
}

/* Set the href attribute for the Share Box */
function cmtxSetShareBoxHref(selector, href) {
    var share_box = document.querySelector(selector);

    if (share_box) {
        share_box.parentElement.setAttribute('href', href);
    }
}

/* Close the share box when clicking off it */
function cmtxCloseShareBox() {
    if (document.querySelector('.cmtx_share_box')) {
        document.addEventListener('mouseup', function(e) {
            var container = document.querySelector('.cmtx_share_box');

            if (container !== e.target && !container.contains(e.target) && !e.target.classList.contains('cmtx_share_icon')) {
                cmtxFadeOut('.cmtx_share_box', 400);
            }
        });
    }
}

/* Close the permalink box when clicking off it */
function cmtxClosePermalinkBox() {
    if (document.querySelector('.cmtx_permalink_box')) {
        document.addEventListener('mouseup', function(e) {
            var container = document.querySelector('.cmtx_permalink_box');

            if (container !== e.target && !container.contains(e.target) && !e.target.classList.contains('cmtx_permalink_icon')) {
                cmtxFadeOut('.cmtx_permalink_box', 400);
            }
        });
    }
}

/* Close any open modals */
function cmtxCloseModal() {
    document.querySelectorAll('.cmtx_modal_close').forEach(function(element) {
        element.click();
    });
}

function cmtxHide(selectorOrElement) {
    var elements;

    if (typeof selectorOrElement === 'string') {
        // If it's a selector, use querySelectorAll
        elements = document.querySelectorAll(selectorOrElement);
    } else if (selectorOrElement instanceof Element) {
        // If it's a DOM element, create an array with that element
        elements = [selectorOrElement];
    } else {
        console.error('Invalid parameter type. Expected selector or DOM element.');
        return;
    }

    elements.forEach(function(element) {
        element.style.display = 'none';
    });
}

function cmtxShow(selectorOrElement) {
    var elements;

    if (typeof selectorOrElement === 'string') {
        // If it's a selector, use querySelectorAll
        elements = document.querySelectorAll(selectorOrElement);
    } else if (selectorOrElement instanceof Element) {
        // If it's a DOM element, create an array with that element
        elements = [selectorOrElement];
    } else {
        console.error('Invalid parameter type. Expected selector or DOM element.');
        return;
    }

    elements.forEach(function(element) {
        element.style.display = 'block';
    });
}

function cmtxFadeIn(selectorOrElement, duration, not = '') {
    var elements;

    if (typeof selectorOrElement === 'string') {
        // If it's a selector, use querySelectorAll
        elements = document.querySelectorAll(selectorOrElement);
    } else if (selectorOrElement instanceof Element) {
        // If it's a DOM element, create an array with that element
        elements = [selectorOrElement];
    } else {
        console.error('Invalid parameter type. Expected selector or DOM element.');
        return;
    }

    elements.forEach(function(element) {
        if (not == '' || !element.matches(not)) {
            // Set the initial opacity to 0
            element.style.opacity = 0;
            element.style.display = 'block';

            // Apply the transition
            element.style.transition = `opacity ${duration}ms ease-in-out`;

            // Trigger a reflow to make sure the transition starts from the initial state
            void element.offsetWidth;

            // Set the final opacity to 1 to start the transition
            element.style.opacity = 1;
        }
    });
}

function cmtxFadeOut(selectorOrElement, duration, not = '') {
    var elements;

    if (typeof selectorOrElement === 'string') {
        // If it's a selector, use querySelectorAll
        elements = document.querySelectorAll(selectorOrElement);
    } else if (selectorOrElement instanceof Element) {
        // If it's a DOM element, create an array with that element
        elements = [selectorOrElement];
    } else {
        console.error('Invalid parameter type. Expected selector or DOM element.');
        return;
    }

    elements.forEach(function(element) {
        if (not == '' || !element.matches(not)) {
            // Set the initial opacity to 1
            element.style.opacity = 1;

            // Apply the transition
            element.style.transition = `opacity ${duration}ms ease-in-out`;

            // Trigger a reflow to make sure the transition starts from the initial state
            void element.offsetWidth;

            // Set the final opacity to 0 to start the transition
            element.style.opacity = 0;

            setTimeout(function() {
                element.style.display = 'none';
            }, duration);
        }
    });
}

var timeoutId; // used in cmtxFadeInOut() function below

function cmtxFadeInOut(selectorOrElement, durationIn, delay, durationOut) {
    var elements;

    if (typeof selectorOrElement === 'string') {
        // If it's a selector, use querySelectorAll
        elements = document.querySelectorAll(selectorOrElement);
    } else if (selectorOrElement instanceof Element) {
        // If it's a DOM element, create an array with that element
        elements = [selectorOrElement];
    } else {
        console.error('Invalid parameter type. Expected selector or DOM element.');
        return;
    }

    // Clear any existing timeout
    clearTimeout(timeoutId);

    elements.forEach(function(element) {
        // Fade in
        element.style.opacity = 0;
        element.style.display = 'block';
        element.style.transition = `opacity ${durationIn}ms ease-in-out`;
        void element.offsetWidth;
        element.style.opacity = 1;

        // Delay
        timeoutId = setTimeout(function() {
            // Fade out
            element.style.transition = `opacity ${durationOut}ms ease-in-out`;
            element.style.opacity = 0;
        }, delay);
    });
}

/* Remove element if it exists */
function cmtxRemoveIfExists(selector) {
    document.querySelectorAll(selector).forEach(function(element) {
        element.remove();
    });
}

/* Auto scroll to element */
function cmtxAutoScroll(element) {
    try {
       element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } catch (error) {
       // fallback for browsers like Edge that don't yet support the options parameter
       element.scrollIntoView(true);
    }
}

/* Update the comment counter */
function cmtxUpdateCommentCounter() {
    if (document.querySelector('#cmtx_comment') && document.querySelector('#cmtx_counter')) {
        var length = document.querySelector('#cmtx_comment').value.length;

        var maximum = document.querySelector('#cmtx_comment').getAttribute('maxlength');

        document.querySelector('#cmtx_counter').textContent = maximum - length;
    }
}

/* Adds a tag (BB Code or Smiley) to the comment field */
function cmtxAddTag(start, end) {
    var obj = document.querySelector('#cmtx_comment');

    if (document.selection && document.selection.createRange) { // Internet Explorer
        selection = document.selection.createRange();

        if (selection.parentElement() == obj) {
            selection.text = start + selection.text + end;
        }
    } else if (typeof(obj) != 'undefined') { // Firefox
        var length = document.querySelector('#cmtx_comment').value.length;
        var selection_start = obj.selectionStart;
        var selection_end = obj.selectionEnd;

        document.querySelector('#cmtx_comment').value = (obj.value.substring(0, selection_start) + start + obj.value.substring(selection_start, selection_end) + end + obj.value.substring(selection_end, length));
    } else {
        document.querySelector('#cmtx_comment').value = (start + end);
    }

    cmtxUpdateCommentCounter();

    obj.focus();
}

/* Get the scroll position from the top of the page */
function cmtxGetScrollTop() {
    return window.scrollY || document.documentElement.scrollTop;
}

/* Trims a string */
function cmtxTrim(string) {
    return string.trim(string);
}