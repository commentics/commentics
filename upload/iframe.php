<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Commentics</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="frontend/view/default/javascript/iframe.js"></script>
</head>
<body class="cmtx_iframe_body" style="margin:0">
<?php
if (isset($_GET['identifier']) && isset($_GET['reference']) && isset($_GET['url'])) {
    $cmtx_identifier = $_GET['identifier'];
    $cmtx_reference  = $_GET['reference'];
    $cmtx_page_url   = $_GET['url'];
    require('frontend/index.php');
}
?>
</body>
</html>