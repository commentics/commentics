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