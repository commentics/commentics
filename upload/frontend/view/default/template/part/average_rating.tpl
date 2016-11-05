<div class="cmtx_average_rating_block">
	<div class="cmtx_average_rating">
		<input type="radio" id="cmtx_avg_star_5" name="cmtx_rating" value="5" <?php if ($average_rating == '5') { echo 'checked'; } ?>><label for="cmtx_avg_star_5" title="<?php echo $lang_title_avg_rating_5; ?>"></label>
		<input type="radio" id="cmtx_avg_star_4" name="cmtx_rating" value="4" <?php if ($average_rating == '4') { echo 'checked'; } ?>><label for="cmtx_avg_star_4" title="<?php echo $lang_title_avg_rating_4; ?>"></label>
		<input type="radio" id="cmtx_avg_star_3" name="cmtx_rating" value="3" <?php if ($average_rating == '3') { echo 'checked'; } ?>><label for="cmtx_avg_star_3" title="<?php echo $lang_title_avg_rating_3; ?>"></label>
		<input type="radio" id="cmtx_avg_star_2" name="cmtx_rating" value="2" <?php if ($average_rating == '2') { echo 'checked'; } ?>><label for="cmtx_avg_star_2" title="<?php echo $lang_title_avg_rating_2; ?>"></label>
		<input type="radio" id="cmtx_avg_star_1" name="cmtx_rating" value="1" <?php if ($average_rating == '1') { echo 'checked'; } ?>><label for="cmtx_avg_star_1" title="<?php echo $lang_title_avg_rating_1; ?>"></label>
	</div>
	<?php if ($rich_snippets_enabled) { ?>
		<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" style="line-height:0">
			<span class="cmtx_average_rating_stats"><span class="cmtx_average_rating_stat_rating" itemprop="ratingValue"><?php echo $average_rating; ?></span>/<span class="cmtx_average_rating_stat_maximum" itemprop="bestRating">5</span> (<span class="cmtx_average_rating_stat_number" itemprop="reviewCount"><?php echo $num_of_ratings; ?></span>)</span>
		</div>
	<?php } else { ?>
		<span class="cmtx_average_rating_stats"><span class="cmtx_average_rating_stat_rating"><?php echo $average_rating; ?></span>/<span class="cmtx_average_rating_stat_maximum">5</span> (<span class="cmtx_average_rating_stat_number"><?php echo $num_of_ratings; ?></span>)</span>
	<?php } ?>
</div>

<script>
// <![CDATA[
$(document).ready(function() {
	$('.cmtx_average_rating label').click(function(e) {
		e.preventDefault();

		var rating = $(this).prev().val();

		var request = $.ajax({
			type: 'POST',
			cache: false,
			url: '<?php echo $commentics_url; ?>frontend/index.php?route=part/average_rating/rate',
			data: 'cmtx_page_id=' + encodeURIComponent('<?php echo $page_id; ?>') + '&cmtx_rating=' + encodeURIComponent(rating),
			dataType: 'json',
			beforeSend: function() {
			}
		});

		request.always(function() {
		});

		request.done(function(response) {
			if (response['success']) {
				$('.cmtx_average_rating input').prop('checked', false);

				$(".cmtx_average_rating input[value=" + response['average_rating'] + "]").prop('checked', true);

				$('.cmtx_average_rating_stat_rating, .cmtx_average_rating_stat_number').fadeOut(250, function() {
					$('.cmtx_average_rating_stat_rating').text(response['average_rating']).fadeIn(2000);

					$('.cmtx_average_rating_stat_number').text(response['num_of_ratings']).fadeIn(2000);
				});

				$('.cmtx_action_message_success').clearQueue();
				$('.cmtx_action_message_success').html(response['success']);
				$('.cmtx_action_message_success').css('top', e.pageY);
				$('.cmtx_action_message_success').css('left', e.pageX);
				$('.cmtx_action_message_success').fadeIn(500).delay(2000).fadeOut(500);
			}

			if (response['error']) {
				$('.cmtx_action_message_error').clearQueue();
				$('.cmtx_action_message_error').html(response['error']);
				$('.cmtx_action_message_error').css('top', e.pageY);
				$('.cmtx_action_message_error').css('left', e.pageX);
				$('.cmtx_action_message_error').fadeIn(500).delay(2000).fadeOut(500);
			}
		});

		request.fail(function(jqXHR, textStatus, errorThrown) {
			if (console && console.log) {
				console.log(jqXHR.responseText);
			}
		});
	});
});
// ]]>
</script>