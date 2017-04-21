<?php if ($jquery) { ?>
	<script src="<?php echo $jquery; ?>"></script>
<?php } ?>

<?php if ($jquery_ui) { ?>
	<script src="<?php echo $jquery_ui; ?>"></script>
<?php } ?>

<?php if ($read_more) { ?>
	<script src="<?php echo $read_more; ?>"></script>
<?php } ?>

<?php if ($filer) { ?>
	<script src="<?php echo $filer; ?>"></script>
<?php } ?>

<?php if ($timeago) { ?>
	<script src="<?php echo $timeago; ?>"></script>
<?php } ?>

<?php if ($recaptcha_api) { ?>
	<script src="<?php echo $recaptcha_api; ?>" async defer></script>
<?php } ?>

<script src="<?php echo $common; ?>"></script>

<?php if ($jquery_theme) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $jquery_theme; ?>">
<?php } ?>

<?php if ($font_awesome) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $font_awesome; ?>">
<?php } ?>

<?php if ($colorbox) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $commentics_url; ?>3rdparty/colorbox/colorbox.css">

	<script src="<?php echo $commentics_url; ?>3rdparty/colorbox/jquery.colorbox-min.js"></script>
<?php } ?>

<?php if ($highlight) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $commentics_url; ?>3rdparty/highlight/styles/default.css">

	<script src="<?php echo $commentics_url; ?>3rdparty/highlight/highlight.pack.js"></script>
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>">

<?php if ($extra) { ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $extra; ?>">
<?php } ?>