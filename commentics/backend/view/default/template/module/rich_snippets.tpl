<?php echo $header; ?>

<div class="module_rich_snippets_page">

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

    <form action="index.php?route=module/rich_snippets" class="controls" method="post">
        <div class="fieldset">
            <label><?php echo $lang_entry_enabled; ?></label>
            <input type="checkbox" name="rich_snippets_enabled" value="1" <?php if ($rich_snippets_enabled) { echo 'checked'; } ?>>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_type; ?></label>
            <select name="rich_snippets_type">
                <option value="Brand" <?php if ($rich_snippets_type == 'Brand') { echo 'selected'; } ?>><?php echo $lang_select_brand; ?></option>
                <option value="CreativeWork" <?php if ($rich_snippets_type == 'CreativeWork') { echo 'selected'; } ?>><?php echo $lang_select_creative; ?></option>
                <option value="Event" <?php if ($rich_snippets_type == 'Event') { echo 'selected'; } ?>><?php echo $lang_select_event; ?></option>
                <option value="Offer" <?php if ($rich_snippets_type == 'Offer') { echo 'selected'; } ?>><?php echo $lang_select_offer; ?></option>
                <option value="Organization" <?php if ($rich_snippets_type == 'Organization') { echo 'selected'; } ?>><?php echo $lang_select_organization; ?></option>
                <option value="Place" <?php if ($rich_snippets_type == 'Place') { echo 'selected'; } ?>><?php echo $lang_select_place; ?></option>
                <option value="Product" <?php if ($rich_snippets_type == 'Product') { echo 'selected'; } ?>><?php echo $lang_select_product; ?></option>
                <option value="Service" <?php if ($rich_snippets_type == 'Service') { echo 'selected'; } ?>><?php echo $lang_select_service; ?></option>
                <option value="other" <?php if ($rich_snippets_type == 'other') { echo 'selected'; } ?>><?php echo $lang_select_other; ?></option>
            </select>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_type; ?>', this, event, '')">[?]</a>
            <?php if ($error_rich_snippets_type) { ?>
                <span class="error"><?php echo $error_rich_snippets_type; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset other_section">
            <label><?php echo $lang_entry_other; ?></label>
            <div>https://schema.org/</div> <input type="text" name="rich_snippets_other" class="medium" value="<?php echo $rich_snippets_other; ?>" maxlength="100">
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_other; ?>', this, event, '')">[?]</a>
            <?php if ($error_rich_snippets_other) { ?>
                <span class="error"><?php echo $error_rich_snippets_other; ?></span>
            <?php } ?>
        </div>

        <div class="fieldset">
            <label><?php echo $lang_entry_property; ?></label>
            <a id="add_property"><?php echo $lang_link_add; ?></a>
            <a class="hint" onmouseover="showhint('<?php echo $lang_hint_property; ?>', this, event, '')">[?]</a>
        </div>

        <?php $property_row = 0; ?>

        <?php foreach ($rich_snippets_properties as $rich_snippets_property) { ?>
            <div id="property-row<?php echo $property_row; ?>" class="fieldset">
                <label><?php echo $lang_entry_property; ?></label>
                <input type="text" name="rich_snippets_property[<?php echo $property_row; ?>][name]" class="medium_plus" value="<?php echo $rich_snippets_property['name']; ?>" placeholder="<?php echo $lang_placeholder_name; ?>" maxlength="250">
                <input type="text" name="rich_snippets_property[<?php echo $property_row; ?>][value]" class="medium_plus" value="<?php echo $rich_snippets_property['value']; ?>" placeholder="<?php echo $lang_placeholder_value; ?>" maxlength="250">
                <a onclick="$('#property-row<?php echo $property_row; ?>').remove();" style="margin-left:5px"><?php echo $lang_link_remove; ?></a>
            </div>
            <?php $property_row++; ?>
        <?php } ?>

        <input type="hidden" name="csrf_key" value="<?php echo $csrf_key; ?>">

        <div class="buttons"><input type="submit" class="button" value="<?php echo $lang_button_update; ?>" title="<?php echo $lang_button_update; ?>"></div>

        <div class="links"><a href="<?php echo $link_back; ?>"><?php echo $lang_link_back; ?></a></div>
    </form>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        <?php if ($rich_snippets_type == 'other' || $error_rich_snippets_other) { ?>
            $('.other_section').show();
        <?php } else { ?>
            $('.other_section').hide();
        <?php } ?>
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        $('select[name="rich_snippets_type"]').on('change', function() {
            var rich_snippets_type = $(this).val();

            if (rich_snippets_type == 'other') {
                $('.other_section').show();
            } else {
                $('.other_section').hide();
            }
        });
    });
    // ]]>
    </script>

    <script>
    // <![CDATA[
    $(document).ready(function() {
        var property_row = <?php echo $property_row; ?>;

        $('#add_property').click(function(e) {
            e.preventDefault();

            html =  '<div id="property-row' + property_row + '" class="fieldset">';
            html += '   <label><?php echo $lang_entry_property; ?></label>';
            html += '   <input type="text" name="rich_snippets_property[' + property_row + '][name]" class="medium_plus" value="" placeholder="<?php echo $lang_placeholder_name; ?>" maxlength="255">';
            html += '   <input type="text" name="rich_snippets_property[' + property_row + '][value]" class="medium_plus" value="" placeholder="<?php echo $lang_placeholder_value; ?>" maxlength="255">';
            html += '   <a onclick="$(\'#property-row' + property_row + '\').remove();" style="margin-left:5px"><?php echo $lang_link_remove; ?></a>';
            html += '</div>';

            $('input[name="csrf_key"]').before(html);

            property_row++;
        });
    });
    // ]]>
    </script>
</div>

<?php echo $footer; ?>