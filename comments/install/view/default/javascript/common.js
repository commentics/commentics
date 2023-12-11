/* The document (excluding images) has finished loading */
document.addEventListener('DOMContentLoaded', function() {
    /* Show a password strength indicator for better security */
    if (document.querySelector('input[name="password_1"]')) {
        document.querySelector('input[name="password_1"]').addEventListener('keyup', function() {
            var password = cmtxTrim(document.querySelector('input[name="password_1"]').value);

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

            document.querySelector('#password_description').innerHTML = description[score];

            document.querySelector('#password_strength').className = '';

            document.querySelector('#password_strength').classList.add('strength_' + score);
        });
    }

    if (document.querySelector('#cmtx_js_settings_install_1')) {
        cmtx_js_settings_install_1 = JSON.parse(document.querySelector('#cmtx_js_settings_install_1').innerText);

        document.querySelector('#install_1_page .form').addEventListener('submit', function(e) {
            document.querySelectorAll('.field_error').forEach(function(element) {
                element.remove();
            });

            var password_1 = document.querySelector('.password_1').value;
            var password_2 = document.querySelector('.password_2').value;
            var site_name = document.querySelector('.site_name').value;

            if (password_1.length < 5) {
                document.querySelector('.password_1').nextElementSibling.insertAdjacentHTML('afterend', '<div class="field_error">' + cmtx_js_settings_install_1.lang_error_password_length + '</div>');
            } else if (password_1 != password_2) {
                document.querySelector('.password_1').nextElementSibling.insertAdjacentHTML('afterend', '<div class="field_error">' + cmtx_js_settings_install_1.lang_error_password_mismatch + '</div>');
                document.querySelector('.password_2').nextElementSibling.insertAdjacentHTML('afterend', '<div class="field_error">' + cmtx_js_settings_install_1.lang_error_password_mismatch + '</div>');
            }

            if (site_name == 'My Site') {
                document.querySelector('.site_name').nextElementSibling.insertAdjacentHTML('afterend', '<div class="field_error">' + cmtx_js_settings_install_1.lang_error_site_name + '</div>');
            }

            if (document.querySelector('.field_error')) {
                e.preventDefault();
            } else {
                this.submit();
            }
        });
    }
});

/* Trims a string */
function cmtxTrim(string) {
    return string.trim(string);
}