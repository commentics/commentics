<!DOCTYPE html>
<html>
<head>
<title>Installer</title>
<meta name="robots" content="noindex">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="<?php echo $common; ?>"></script>
<?php foreach ($autoload_javascript as $autoload) { ?>
    <script src="<?php echo $autoload; ?>"></script>
<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>">
<?php foreach ($autoload_stylesheet as $autoload) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $autoload; ?>">
<?php } ?>
<?php if ($custom) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $custom; ?>">
<?php } ?>
</head>
<body>
<header>
    <img src="<?php echo $logo; ?>" class="logo" title="Commentics" alt="Commentics">

    <div class="steps">
        <div class="step <?php if ($page == '1') { echo 'active'; } ?>"><?php echo $lang_heading_welcome; ?></div>
        <div class="step <?php if ($page == '2') { echo 'active'; } ?>"><?php echo $lang_heading_database; ?></div>
        <div class="step <?php if ($page == '3') { echo 'active'; } ?>"><?php echo $lang_heading_system; ?></div>
        <div class="step <?php if ($page == '4') { echo 'active'; } ?>"><?php echo $lang_heading_menu; ?></div>
        <div class="step <?php if ($page == '5') { echo 'active'; } ?>"><?php echo $lang_heading_action; ?></div>
        <div class="step <?php if ($page == '6') { echo 'active'; } ?>"><?php echo $lang_heading_done; ?></div>
    </div>
</header>
<main>