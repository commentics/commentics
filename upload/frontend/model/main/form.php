<?php
namespace Commentics;

class MainFormModel extends Model
{
    /* Checks if the comment contains repeating characters */
    public function hasRepeats($comment)
    {
        if (preg_match('/(.)\\1{' . ($this->setting->get('check_repeats_amount') - 1) . '}/u', $comment)) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if the comment contains too many capital letters */
    public function hasCapitals($comment)
    {
        $comment = preg_replace('/[^a-z]/i', '', $comment); // remove non-letters

        $number_of_letters = $this->validation->length($comment); // number of letters

        $number_of_capitals = $this->validation->length(preg_replace('/[^A-Z]/', '', $comment)); // number of capitals

        if ($number_of_letters > 3 && $number_of_capitals != 0) { // if check is appropriate
            $percentage_of_capitals = ($number_of_capitals / $number_of_letters) * 100; // percentage of capitals

            if ($percentage_of_capitals >= $this->setting->get('check_capitals_percentage')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /* Checks if the comment contains a long word */
    public function hasLongWord($comment)
    {
        $comment = str_replace("\r\n", ' ', $comment);

        $words = explode(' ', $comment);

        foreach ($words as $word) {
            if ($this->validation->length($word) >= $this->setting->get('comment_long_word')) { // if word length is longer than allowed length
                return true;
            }
        }

        return false;
    }

    /* Get the length of the comment */
    public function getCommentLength($comment)
    {
        return $this->validation->length($comment);
    }

    /* Get the approx length of the comment as it appears on the screen */
    public function getCommentDisplayLength($comment)
    {
        $comment = preg_replace('/:[A-Z]+:/i', '', $comment); // remove smilies
        $comment = $this->security->decode($comment); // decode HTML entities
        $comment = strip_tags($comment); // strip any tags
        $comment = trim($comment); // remove any space at beginning and end

        return $this->validation->length($comment);
    }

    /* Count the number of lines */
    public function countLines($comment)
    {
        return substr_count($comment, "\r\n") + 1;
    }

    /* Count the number of words */
    public function countWords($comment)
    {
        return count(explode(' ', $comment));
    }

    /* Count the number of smilies */
    public function countSmilies($comment)
    {
        return preg_match_all('/:[A-Z]+:/i', $comment, $matches);
    }

    /* Convert new line endings to line breaks */
    public function addLineBreaks($comment)
    {
        $paragraphs = '';

        foreach (explode("\r\n", $comment) as $line) {
            if (trim($line)) {
                $paragraphs .= '<p>' . $line . '</p>';
            }
        }

        return $paragraphs;
    }

    /* Remove new line endings */
    public function removeLineBreaks($comment)
    {
        return str_replace("\r\n", ' ', $comment);
    }

    /* Convert BB code to HTML */
    public function addBBCode($comment)
    {
        $tags = $this->loadWord('main/form');

        if ($this->setting->get('enabled_bb_code_bold')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_bold_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_bold_end'], '/') . '/is', '', $comment); // remove bold tags with nothing visible inside

            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_bold_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_bold_end'], '/') . '/is', '<b>$1</b>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_italic')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_italic_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_italic_end'], '/') . '/is', '', $comment);

            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_italic_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_italic_end'], '/') . '/is', '<i>$1</i>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_underline')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_underline_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_underline_end'], '/') . '/is', '', $comment);

            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_underline_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_underline_end'], '/') . '/is', '<u>$1</u>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_strike')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_strike_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_strike_end'], '/') . '/is', '', $comment);

            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_strike_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_strike_end'], '/') . '/is', '<del>$1</del>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_superscript')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_superscript_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_superscript_end'], '/') . '/is', '', $comment);

            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_superscript_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_superscript_end'], '/') . '/is', '<sup>$1</sup>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_subscript')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_subscript_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_subscript_end'], '/') . '/is', '', $comment);

            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_subscript_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_subscript_end'], '/') . '/is', '<sub>$1</sub>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_code')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_code_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_code_end'], '/') . '/is', '', $comment);

            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_code_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_code_end'], '/') . '/is', array($this, 'callbackCode'), $comment);
        }

        if ($this->setting->get('enabled_bb_code_php')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_php_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_php_end'], '/') . '/is', '', $comment);

            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_php_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_php_end'], '/') . '/is', array($this, 'callbackPhp'), $comment);
        }

        if ($this->setting->get('enabled_bb_code_quote')) {
            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_quote_start'], '/') . '\s*' . preg_quote($tags['lang_tag_bb_code_quote_end'], '/') . '/is', '', $comment);

            $comment = preg_replace('/' . preg_quote($tags['lang_tag_bb_code_quote_start'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_quote_end'], '/') . '/is', '<div class="cmtx_quote_box">$1</div>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_line')) {
            $comment = str_ireplace($tags['lang_tag_bb_code_line'], '<hr>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_bullet')) {
            $comment = str_ireplace($tags['lang_tag_bb_code_bullet_1'] . "\r\n", '<ul>', $comment);
            $comment = str_ireplace($tags['lang_tag_bb_code_bullet_2'], '<li>', $comment);
            $comment = str_ireplace($tags['lang_tag_bb_code_bullet_3'] . "\r\n", '</li>', $comment);
            $comment = str_ireplace($tags['lang_tag_bb_code_bullet_4'], '</ul>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_numeric')) {
            $comment = str_ireplace($tags['lang_tag_bb_code_numeric_1'] . "\r\n", '<ol>', $comment);
            $comment = str_ireplace($tags['lang_tag_bb_code_numeric_2'], '<li>', $comment);
            $comment = str_ireplace($tags['lang_tag_bb_code_numeric_3'] . "\r\n", '</li>', $comment);
            $comment = str_ireplace($tags['lang_tag_bb_code_numeric_4'], '</ol>', $comment);
        }

        if ($this->setting->get('enabled_bb_code_link')) {
            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_link_1'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_link_4'], '/') . '/is', array($this, 'callbackLinkOne'), $comment);

            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_link_2'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_link_3'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_link_4'], '/') . '/is', array($this, 'callbackLinkTwo'), $comment);
        }

        if ($this->setting->get('enabled_bb_code_email')) {
            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_email_1'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_email_4'], '/') . '/is', array($this, 'callbackEmailOne'), $comment);

            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_email_2'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_email_3'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_email_4'], '/') . '/is', array($this, 'callbackEmailTwo'), $comment);
        }

        if ($this->setting->get('enabled_bb_code_image')) {
            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_image_1'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_image_2'], '/') . '/is', array($this, 'callbackImage'), $comment);
        }

        if ($this->setting->get('enabled_bb_code_youtube')) {
            $comment = preg_replace_callback('/' . preg_quote($tags['lang_tag_bb_code_youtube_1'], '/') . '(.*?)' . preg_quote($tags['lang_tag_bb_code_youtube_2'], '/') . '/is', array($this, 'callbackYouTube'), $comment);
        }

        return $comment;
    }

    /* Build attributes for links */
    public function getLinkAttributes()
    {
        $link_attributes = '';

        if ($this->setting->get('comment_links_new_window')) { // if links should open in a new window
            $link_attributes .= ' target="_blank"';
        }

        if ($this->setting->get('comment_links_nofollow')) { // if links should contain nofollow attribute
            $link_attributes .= ' rel="nofollow"';
        }

        return $link_attributes;
    }

    public function callbackCode(array $matches)
    {
        $code = $matches[1];

        $code = preg_replace("/(\r\n){2,}/", '<br><br>', $code); // replace instances of 2 or more \r\n with <br>s

        $code = str_ireplace("\r\n", '<br>', $code); // replace remaining line breaks with <br>s

        $code = '<div class="cmtx_code_box">' . $code . '</div>';

        return $code;
    }

    public function callbackPhp(array $matches)
    {
        $php = $matches[1];

        $php = preg_replace("/(\r\n){2,}/", '<br><br>', $php); // replace instances of 2 or more \r\n with <br>s

        $php = str_ireplace("\r\n", '<br>', $php); // replace remaining line breaks with <br>s

        $php = '<div class="cmtx_php_box lang-php">' . $php . '</div>';

        return $php;
    }

    public function callbackLinkOne(array $matches)
    {
        if (filter_var($matches[1], FILTER_VALIDATE_URL)) {
            return '<a href="' . $matches[1] . '"' . $this->getLinkAttributes() . '>' . $matches[1] . '</a>';
        } else {
            return 'cmtx-invalid-bb-code-link';
        }
    }

    public function callbackLinkTwo(array $matches)
    {
        if (filter_var($matches[1], FILTER_VALIDATE_URL)) {
            return '<a href="' . $matches[1] . '"' . $this->getLinkAttributes() . '>' . $matches[2] . '</a>';
        } else {
            return 'cmtx-invalid-bb-code-link';
        }
    }

    public function callbackEmailOne(array $matches)
    {
        if (filter_var($matches[1], FILTER_VALIDATE_EMAIL)) {
            return '<a href="mailto:' . $matches[1] . '"' . $this->getLinkAttributes() . '>' . $matches[1] . '</a>';
        } else {
            return 'cmtx-invalid-bb-code-link';
        }
    }

    public function callbackEmailTwo(array $matches)
    {
        if (filter_var($matches[1], FILTER_VALIDATE_EMAIL)) {
            return '<a href="mailto:' . $matches[1] . '"' . $this->getLinkAttributes() . '>' . $matches[2] . '</a>';
        } else {
            return 'cmtx-invalid-bb-code-link';
        }
    }

    public function callbackImage(array $matches)
    {
        if (filter_var($matches[1], FILTER_VALIDATE_URL)) {
            return '<img src="' . $matches[1] . '">';
        } else {
            return 'cmtx-invalid-bb-code-link';
        }
    }

    public function callbackYouTube(array $matches)
    {
        $url = $matches[1];

        if (filter_var($url, FILTER_VALIDATE_URL)) {
            if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
                $video_id = $match[1];

                return '<div class="cmtx_youtube_container"><iframe src="//www.youtube.com/embed/' . $video_id . '" frameborder="0" allowfullscreen></iframe></div>';
            } else {
                return 'cmtx-invalid-bb-code-link';
            }
        } else {
            return 'cmtx-invalid-bb-code-link';
        }
    }

    /* Convert web links (non-BB code) to HTML */
    public function convertLinks($comment)
    {
        $comment = preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a href=\"$3\"" . $this->getLinkAttributes() . ">$3</a>", $comment);

        $comment = preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a href=\"http://$3\"" . $this->getLinkAttributes() . ">$3</a>", $comment);

        return $comment;
    }

    /* Convert email links (non-BB code) to HTML */
    public function convertEmails($comment)
    {
        $comment = preg_replace('/([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})/im', '<a href="mailto:\\1" ' . $this->getLinkAttributes() . '>\\1</a>', $comment);

        return $comment;
    }

    /* Purify the comment. Ensures properly balanced tags and neutralizes attacks. */
    public function purifyComment($comment)
    {
        if (!function_exists('htmLawed')) {
            require_once CMTX_DIR_3RDPARTY . 'htmlawed/htmlawed.php';
        }

        $comment = htmLawed($comment);

        return $comment;
    }

    /* Gets a random question to verify the user is human */
    public function getQuestion()
    {
        $questions = $this->getQuestions();

        if ($questions) {
            $random_key = array_rand($questions, 1);

            return $questions[$random_key];
        } else {
            return false;
        }
    }

    /* Gets all questions */
    private function getQuestions()
    {
        $questions = $this->cache->get('getquestions_' . $this->setting->get('language'));

        if ($questions !== false) {
            return $questions;
        }

        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "questions` WHERE `language` = '" . $this->db->escape($this->setting->get('language')) . "'");

        $questions = $this->db->rows($query);

        $this->cache->set('getquestions_' . $this->setting->get('language'), $questions);

        return $questions;
    }

    /*
     * Checks if the name contains only valid characters
     * Letters, ampersand, hyphen, apostrophe, period, space, numbers
     * \p{L} (any kind of letter from any language)
     */
    public function isNameValid($name)
    {
        if (preg_match('/^[\p{L}&\-\'. 0-9]+$/u', $name)) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if the rating is valid */
    public function isRatingValid($rating)
    {
        if (in_array($rating, array('1', '2', '3', '4', '5'))) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Checks if the town contains only valid characters
     * Letters, ampersand, hyphen, apostrophe, period, space
     * \p{L} (any kind of letter from any language)
     */
    public function isTownValid($town)
    {
        if (preg_match('/^[\p{L}&\-\'. ]+$/u', $town)) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if the answer is valid */
    public function isAnswerValid($question_id, $answer)
    {
        $query = $this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "questions` WHERE `id` = '" . (int) $question_id . "'");

        $result = $this->db->row($query);

        if ($result) {
            $user_answer = $this->variable->strtolower($answer);

            $real_answer = $this->variable->strtolower($result['answer']);

            if (in_array($user_answer, explode('|', $real_answer))) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
     * Checks if the website exists and isn't simply made up
     * Gets the HTTP status code of the website
     */
    public function canPingWebsite($website)
    {
        if (extension_loaded('curl')) {
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Commentics');
            curl_setopt($ch, CURLOPT_URL, $website);

            curl_exec($ch);

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if (!in_array($http_code, array(200, 301, 302))) {
                return false;
            }
        }

        return true;
    }

    /*
     * Checks if the entry starts with a letter
     * \p{L} (any kind of letter from any language)
     */
    public function startsWithLetter($entry)
    {
        if (preg_match('/^[\p{L}]+/u', $entry)) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if the entry is only one word */
    public function isOneWord($entry)
    {
        if (count(explode(' ', $entry)) == 1) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if the entry contains a link */
    public function hasLink($entry)
    {
        $list = $this->getList('detect_links');

        $line = strtok($list, "\r\n");

        while ($line !== false) {
            $link = preg_quote($line, '/'); // escape any special characters

            $regexp = "/$link/i"; // i = case-insensitive

            /* Exclude images and YouTube videos */
            if (preg_match($regexp, $entry) && !preg_match('/.*\[IMAGE\].*' . $link . '.*\[\/IMAGE\].*/i', $entry) && !preg_match('/.*\[YOUTUBE\].*' . $link . '.*\[\/YOUTUBE\].*/i', $entry)) {
                return true;
            }

            $line = strtok("\r\n");
        }

        return false;
    }

    /* Checks if the comment contains an image */
    public function hasImage($comment)
    {
        $tag = $this->loadWord('main/form', 'lang_tag_bb_code_image_1');

        $found = stripos($comment, $tag);

        if ($found !== false) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if the comment contains a video */
    public function hasVideo($comment)
    {
        $tag = $this->loadWord('main/form', 'lang_tag_bb_code_youtube_1');

        $found = stripos($comment, $tag);

        if ($found !== false) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if the entry contains a word */
    public function hasWord($entry, $list, $boundary = true)
    {
        $list = $this->getList($list);

        $line = strtok($list, "\r\n");

        while ($line !== false) {
            $word = preg_quote($line, '/'); // escape any special characters

            $word = str_ireplace('\*', '[^ .,]*', $word); // allow use of wildcard symbol

            if ($boundary) {
                $regexp = "/\b$word\b/i"; // pattern (b = word boundary, i = case-insensitive)
            } else {
                $regexp = "/$word/i"; // pattern (i = case-insensitive)
            }

            if (preg_match($regexp, $entry)) {
                return true;
            }

            $line = strtok("\r\n");
        }

        return false;
    }

    /* Masks swear words in the entry */
    public function maskWord($entry, $list, $boundary = true)
    {
        $list = $this->getList($list);

        $line = strtok($list, "\r\n");

        while ($line !== false) {
            $word = preg_quote($line, '/'); // escape any special characters

            $word = str_ireplace('\*', '[^ .,]*', $word); // allow use of wildcard symbol

            if ($boundary) {
                $regexp = "/\b$word\b/i"; // pattern (b = word boundary, i = case-insensitive)
            } else {
                $regexp = "/$word/i"; // pattern (i = case-insensitive)
            }

            $entry = preg_replace($regexp, $this->setting->get('swear_word_masking'), $entry);

            $line = strtok("\r\n");
        }

        return $entry;
    }

    /* Gets a list from the database */
    public function getList($type)
    {
        $query = $this->db->query("SELECT `text` FROM `" . CMTX_DB_PREFIX . "data` WHERE `type` = '" . $this->db->escape($type) . "'");

        $result = $this->db->row($query);

        return $result['text'];
    }

    /* Checks if the user has a confirmed subscription for this page */
    public function subscriptionExists($user_id, $page_id)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `user_id` = '" . (int) $user_id . "' AND `page_id` = '" . (int) $page_id . "' AND `is_confirmed` = '1'"))) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks whether the user has any unconfirmed subscriptions */
    public function userHasSubscriptionAttempt($user_id)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `user_id` = '" . (int) $user_id . "' AND `is_confirmed` = '0'"))) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks whether the IP address has any unconfirmed subscriptions */
    public function ipHasSubscriptionAttempt($ip_address)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "subscriptions` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' AND `is_confirmed` = '0'"))) {
            return true;
        } else {
            return false;
        }
    }

    /* Adds a new subscription in the database */
    public function addSubscription($user_id, $page_id, $token, $ip_address)
    {
        $this->db->query("INSERT INTO `" . CMTX_DB_PREFIX . "subscriptions` SET `user_id` = '" . (int) $user_id . "', `page_id` = '" . (int) $page_id . "', `token` = '" . $this->db->escape($token) . "', `is_confirmed` = '0', `ip_address` = '" . $this->db->escape($ip_address) . "', `date_modified` = NOW(), `date_added` = NOW()");

        return $this->db->insertId();
    }

    /* Checks if the time since the user's last comment is less than the minimum delay */
    public function isFloodingDelay($ip_address, $page_id)
    {
        /* Get the time of the last comment (if any) by the current user */
        if ($this->setting->get('flood_control_delay_all_pages')) { // for all the pages
            $query = $this->db->query("SELECT `date_added` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' ORDER BY `date_added` DESC LIMIT 1");
        } else { // for the current page
            $query = $this->db->query("SELECT `date_added` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' AND `page_id` = '" . (int) $page_id . "' ORDER BY `date_added` DESC LIMIT 1");
        }

        $result = $this->db->row($query);

        /* If a previous comment by the current user was found */
        if ($result) {
            $time = strtotime($result['date_added']);

            $difference = time() - $time;

            /* If the time since the last comment is less than the minimum waiting time */
            if ($difference < $this->setting->get('flood_control_delay_time')) {
                return true;
            }
        }

        return false;
    }

    /* Checks if the number of recent comments by the user exceeds the maximum amount */
    public function isFloodingMaximum($ip_address, $page_id)
    {
        $earlier = date('Y-m-d H:i:s', time() - (3600 * $this->setting->get('flood_control_maximum_period')));

        /* Count the number of comments (if any) within past period by the current user */
        if ($this->setting->get('flood_control_maximum_all_pages')) { // for all the pages
            $query = $this->db->query("SELECT COUNT(*) AS `amount` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' AND `date_added` > '" . $this->db->escape($earlier) . "'");
        } else { // for the current page
            $query = $this->db->query("SELECT COUNT(*) AS `amount` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `ip_address` = '" . $this->db->escape($ip_address) . "' AND `page_id` = '" . (int) $page_id . "' AND `date_added` > '" . $this->db->escape($earlier) . "'");
        }

        $result = $this->db->row($query);

        /* If the number of comments exceeds the maximum amount */
        if ($result['amount'] >= $this->setting->get('flood_control_maximum_amount')) {
            return true;
        }

        return false;
    }

    /* Checks if the user has previously rated the page */
    public function hasUserRated($page_id, $ip_address)
    {
        if ($this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "comments` WHERE `page_id` = '" . (int) $page_id . "' AND `ip_address` = '" . $this->db->escape($ip_address) . "' AND `rating` != '0'"))) {
            return true;
        }

        if ($this->db->numRows($this->db->query("SELECT `id` FROM `" . CMTX_DB_PREFIX . "ratings` WHERE `page_id` = '" . (int) $page_id . "' AND `ip_address` = '" . $this->db->escape($ip_address) . "'"))) {
            return true;
        }

        return false;
    }

    /* Checks if the user has previously posted a comment which has been approved by the administrator */
    public function hasUserPreviouslyPostedApprovedComment($user_id)
    {
        if ($this->db->numRows($this->db->query("SELECT * FROM `" . CMTX_DB_PREFIX . "comments` WHERE `user_id` = '" . (int) $user_id . "' AND `is_approved` = '1'"))) {
            return true;
        } else {
            return false;
        }
    }

    /* Checks if Akismet reports the comment as spam */
    public function isAkismetSpam($ip_address, $page_url, $name, $email, $website, $comment)
    {
        $url = 'https://' . $this->setting->get('akismet_key') . '.rest.akismet.com/1.1/comment-check';

        ini_set('user_agent', 'Commentics');

        $data = array(
            'blog'                 => $this->setting->get('site_url'),
            'user_ip'              => $ip_address,
            'user_agent'           => $this->security->decode($this->user->getUserAgent()),
            'referrer'             => (isset($this->request->server['HTTP_REFERER']) ? $this->security->decode($this->request->server['HTTP_REFERER']) : ''),
            'permalink'            => $this->security->decode($page_url),
            'comment_type'         => 'comment',
            'comment_author'       => $this->security->decode($name),
            'comment_author_email' => $this->security->decode($email),
            'comment_author_url'   => $this->security->decode($website),
            'comment_content'      => $this->security->decode($comment),
            'blog_charset'         => 'UTF-8'
        );

        if ($this->setting->get('akismet_logging')) {
            $this->log->setFilename('akismet');

            $this->log->write('Posting to Akismet');

            $this->log->write('URL: ' . $url);

            $this->log->write($data);
        }

        $data = http_build_query($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Commentics');
        curl_setopt($ch, CURLOPT_URL, $url);

        $response = curl_exec($ch);

        if ($this->setting->get('akismet_logging')) {
            if (curl_errno($ch)) {
                $this->log->write('cURL error: ' . curl_errno($ch));
            }

            $this->log->write($response);
        }

        curl_close($ch);

        if ($response != 'false') {
            return true;
        } else {
            return false;
        }
    }

    public function createImageFromBase64($base64)
    {
        $responses = $this->loadWord('main/form');

        /* Perform a very rough check for if the image is over 100 MB */
        if (($this->estimateSizeFromBase64($base64) / pow(1024, 2)) > 100) {
            return $responses['lang_error_image_size'];
        }

        if (!is_writable(CMTX_DIR_UPLOAD)) {
            return $responses['lang_error_upload_writable'];
        }

        $folder = date('Y_m');

        if (!is_dir(CMTX_DIR_UPLOAD . $folder)) {
            if (!mkdir(CMTX_DIR_UPLOAD . $folder)) {
                return $responses['lang_error_folder_create'];
            }
        }

        $image_data = base64_decode(preg_replace('/^data:image\/[^;]+;base64,/', '', $base64));

        if (!$image_data) {
            return $responses['lang_error_image_data'];
        }

        $image_info = getimagesizefromstring($image_data);

        if (!$image_info) {
            return $responses['lang_error_image_info'];
        }

        $allowed_mime_types = array(
            'image/jpeg',
            'image/png',
            'image/gif'
        );

        if (!in_array($image_info['mime'], $allowed_mime_types)) {
            return $responses['lang_error_image_type'];
        }

        $filename = $this->variable->random();

        switch ($image_info['mime']) {
            case 'image/jpeg':
                $extension = 'jpg';
                break;
            case 'image/png':
                $extension = 'png';
                break;
            case 'image/gif':
                $extension = 'gif';
                break;
            default:
                $extension = 'jpg';
        }

        $location = CMTX_DIR_UPLOAD . $folder . '/' . $filename . '.' . $extension;

        if (file_put_contents($location, $image_data)) {
            if (filesize($location) > ($this->setting->get('maximum_upload_size') * pow(1024, 2))) {
                unlink($location);

                return $responses['lang_error_image_size'];
            } else {
                return array(
                    'folder'    => $folder,
                    'filename'  => $filename,
                    'extension' => $extension,
                    'mime_type' => $image_info['mime'],
                    'file_size' => filesize($location)
                );
            }
        } else {
            return $responses['lang_error_image_create'];
        }
    }

    public function estimateSizeFromBase64($base64)
    {
        return (int) (strlen(rtrim($base64, '=')) * 3 / 4);
    }
}
