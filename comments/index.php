<?php
if (file_exists('install/')) {
    header('Location: ' . 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/install/');
    exit;
} else {
    header('HTTP/1.0 403 Forbidden');
    header('Content-Type: text/html; charset=UTF-8');
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Commentics</title>
        <meta charset="UTF-8">
        <meta name="robots" content="noindex">
        <link rel="stylesheet" href="403.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="content">
                <p class="heading">Commentics</p>
                <p class="message">There's nothing to see here</p>
                <p class="link"><a href="https://commentics.com/faq/general/no-frontend" target="_blank">Learn More</a></p>
            </div>
        </div>
    </body>
    </html>
    <?php
}
