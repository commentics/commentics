<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Example 2</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h1>Example 2</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere sodales condimentum. Vestibulum ut felis nec tortor pharetra blandit et vel nunc. Sed nec ligula ac orci scelerisque lobortis quis et velit. Pellentesque tristique ligula mattis neque dignissim aliquam. Duis suscipit accumsan libero, nec fringilla urna consequat non. Fusce consequat eros vitae nunc eleifend cursus. Etiam ornare rhoncus ligula, ac pretium ipsum blandit eu. Duis mattis dapibus lorem, ut euismod lorem semper id. Aenean dapibus dapibus odio eget ullamcorper. Pellentesque non tincidunt est. Pellentesque ultricies, nisl id dictum blandit, augue dolor dictum lorem, vel lobortis urna magna nec lorem. Aenean dignissim turpis sit amet mi ultricies tempus. Phasellus vel ante in tortor hendrerit aliquam sit amet sed urna. Ut pharetra odio quis dui vestibulum facilisis et a lectus.</p>

<?php
$cmtx_identifier = '2';
$cmtx_reference  = 'Page Two';
$cmtx_folder     = '/upload/';
require($_SERVER['DOCUMENT_ROOT'] . $cmtx_folder . 'frontend/index.php');
?>

</body>
</html>