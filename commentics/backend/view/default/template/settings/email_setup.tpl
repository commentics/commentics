<?php echo $header; ?>

<div class="settings_email_setup_page">

    <div class='page_help_block'><?php echo $page_help_link; ?></div>

    <h1><?php echo $lang_heading; ?></h1>

    <hr>

    <?php if ($success) { ?>
        <div class="success"><?php echo $success; ?></div>
    <?php } ?>

    <?php if ($info) { ?>
        <div class="info"><?php echo $info; ?></div>
    <?php } ?>

    <?php if ($error) { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <?php if ($warning) { ?>
        <div class="warning"><?php echo $warning; ?></div>
    <?php } ?>

    <div class="description"><?php echo $lang_description; ?></div>

    <form action="index.php?route=settings/email_setup" class="controls" method="post">
        <div id="tabs">
            <ul>
                <li><a href="#tab-method"><?php echo $lang_tab_method; ?></a></li>
                <li><a href="#tab-sender"><?php echo $lang_tab_sender; ?></a></li>
                <li><a href="#tab-signature"><?php echo $lang_tab_signature; ?></a></li>
                <li><a href="#tab-test"><?php echo $lang_tab_test; ?></a></li>
            </ul>

            <div id="tab-method">
                <div class="description"><?php echo $lang_description_method; ?></div>

                <div class="fieldset">
                    <label><?php echo $lang_entry_method; ?></label>
                    <select name="transport_method">
                        <option value="php-basic" <?php if ($transport_method == 'php-basic') { echo 'selected'; } ?>><?php echo $lang_select_php_basic; ?></option>
                        <option value="php" <?php if ($transport_method == 'php') { echo 'selected'; } ?>><?php echo $lang_select_php; ?></option>
                        <option value="smtp" <?php if ($transport_method == 'smtp') { echo 'selected'; } ?>><?php echo $lang_select_smtp; ?></option>
                        <option value="sendmail" <?php if ($transport_method == 'sendmail') { echo 'selected'; } ?>><?php echo $lang_select_sendmail; ?></option>
                    </select>
                    <?php if ($error_transport_method) { ?>
                        <span class="error"><?php echo $error_transport_method; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset smtp_section">
                    <label><?php echo $lang_entry_host; ?></label>
                    <input type="text" required name="smtp_host" class="large" value="<?php echo $smtp_host; ?>" maxlength="250">
                    <?php if ($error_smtp_host) { ?>
                        <span class="error"><?php echo $error_smtp_host; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset smtp_section">
                    <label><?php echo $lang_entry_port; ?></label>
                    <input type="text" required name="smtp_port" class="small" value="<?php echo $smtp_port; ?>" maxlength="4">
                    <?php if ($error_smtp_port) { ?>
                        <span class="error"><?php echo $error_smtp_port; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset smtp_section">
                    <label><?php echo $lang_entry_encrypt; ?></label>
                    <select name="smtp_encrypt">
                        <option value="Off" <?php if ($smtp_encrypt == 'Off') { echo 'selected'; } ?>><?php echo $lang_select_off; ?></option>
                        <option value="SSL" <?php if ($smtp_encrypt == 'SSL') { echo 'selected'; } ?>><?php echo $lang_select_ssl; ?></option>
                        <option value="TLS" <?php if ($smtp_encrypt == 'TLS') { echo 'selected'; } ?>><?php echo $lang_select_tls; ?></option>
                    </select>
                    <?php if ($error_smtp_encrypt) { ?>
                        <span class="error"><?php echo $error_smtp_encrypt; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset smtp_section">
                    <label><?php echo $lang_entry_username; ?></label>
                    <input type="text" name="smtp_username" class="large" value="<?php echo $smtp_username; ?>" maxlength="250">
                    <?php if ($error_smtp_username) { ?>
                        <span class="error"><?php echo $error_smtp_username; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset smtp_section">
                    <label><?php echo $lang_entry_password; ?></label>
                    <input type="password" name="smtp_password" class="large" value="<?php echo $smtp_password; ?>" maxlength="250">
                    <?php if ($error_smtp_password) { ?>
                        <span class="error"><?php echo $error_smtp_password; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset sendmail_section">
                    <label><?php echo $lang_entry_path; ?></label>
                    <input type="text" required name="sendmail_path" class="large" value="<?php echo $sendmail_path; ?>" maxlength="250">
                    <?php if ($error_sendmail_path) { ?>
                        <span class="error"><?php echo $error_sendmail_path; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div id="tab-sender">
                <div class="description"><?php echo $lang_description_sender; ?></div>

                <div class="fieldset">
                    <label><?php echo $lang_entry_from_name; ?></label>
                    <input type="text" required name="from_name" class="large" value="<?php echo $from_name; ?>" maxlength="250">
                    <?php if ($error_from_name) { ?>
                        <span class="error"><?php echo $error_from_name; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset">
                    <label><?php echo $lang_entry_from_email; ?></label>
                    <input type="text" required name="from_email" class="large" value="<?php echo $from_email; ?>" maxlength="250">
                    <?php if ($error_from_email) { ?>
                        <span class="error"><?php echo $error_from_email; ?></span>
                    <?php } ?>
                </div>

                <div class="fieldset">
                    <label><?php echo $lang_entry_reply_email; ?></label>
                    <input type="text" required name="reply_email" class="large" value="<?php echo $reply_email; ?>" maxlength="250">
                    <?php if ($error_reply_email) { ?>
                        <span class="error"><?php echo $error_reply_email; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div id="tab-signature">
                <div class="description"><?php echo $lang_description_signature; ?></div>

                <div class="section_keywords">
                    <div><?php echo $lang_entry_keywords; ?></div>
                    <div class="keywords"><span>site name</span> <span>site domain</span> <span>site url</span></div>
                </div>

                <div class="section_text">
                    <div><?php echo $lang_entry_text; ?></div>
                    <textarea name="signature_text"><?php echo $signature_text; ?></textarea>
                    <?php if ($error_signature_text) { ?>
                        <span class="error"><?php echo $error_signature_text; ?></span>
                    <?php } ?>
                </div>

                <div class="section_html">
                    <div><?php echo $lang_entry_html; ?></div>
                    <textarea name="signature_html"><?php echo $signature_html; ?></textarea>
                    <?php if ($error_signature_html) { ?>
                        <span class="error"><?php echo $error_signature_html; ?></span>
                    <?php } ?>
                </div>
            </div>

            <div id="tab-test">
                <div class="description"><?php echo $lang_description_test; ?></div>

                <div class="fieldset">
                    <label><?php echo $lang_entry_send; ?></label>
                    <input type="checkbox" name="send" value="1">
                </div>
            </div>
        </div>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($transport_method == 'smtp') { ?>
            $('.smtp_section').show();
        <?php } else { ?>
            $('.smtp_section').hide();
        <?php } ?>

        <?php if ($transport_method == 'sendmail') { ?>
            $('.sendmail_section').show();
        <?php } else { ?>
            $('.sendmail_section').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="transport_method"]').on('change', function() {
            var method = $(this).val();

            if (method == 'php-basic' || method == 'php') {
                $('.smtp_section').hide();
                $('.sendmail_section').hide();
            } else if (method == 'smtp') {
                $('.smtp_section').show();
                $('.sendmail_section').hide();
            } else {
                $('.smtp_section').hide();
                $('.sendmail_section').show();
            }
        });
    });
    // ]]>
    </script>

</div>

<?php echo $footer; ?>