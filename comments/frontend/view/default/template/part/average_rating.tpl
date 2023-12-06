<div class="cmtx_average_rating_block">
    <div class="cmtx_average_rating {{ average_rating_guest }}">
        <label class="{{ rating_5_label }}" title="{{ lang_title_avg_rating_5 }}"><input type="radio" name="cmtx_rating" value="5" {{ rating_5_checked }}></label>
        <label class="{{ rating_4_label }}" title="{{ lang_title_avg_rating_4 }}"><input type="radio" name="cmtx_rating" value="4" {{ rating_4_checked }}></label>
        <label class="{{ rating_3_label }}" title="{{ lang_title_avg_rating_3 }}"><input type="radio" name="cmtx_rating" value="3" {{ rating_3_checked }}></label>
        <label class="{{ rating_2_label }}" title="{{ lang_title_avg_rating_2 }}"><input type="radio" name="cmtx_rating" value="2" {{ rating_2_checked }}></label>
        <label class="{{ rating_1_label }}" title="{{ lang_title_avg_rating_1 }}"><input type="radio" name="cmtx_rating" value="1" {{ rating_1_checked }}></label>
    </div>
    @if rich_snippets_enabled
        <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
            <span class="cmtx_average_rating_stats"><span class="cmtx_average_rating_stat_rating" itemprop="ratingValue">{{ average_rating }}</span>/<span class="cmtx_average_rating_stat_maximum" itemprop="bestRating">5</span> (<span class="cmtx_average_rating_stat_number" itemprop="reviewCount">{{ num_of_ratings }}</span>)</span>
        </div>

        @foreach rich_snippets_properties as rich_snippets_property
            <meta itemprop="{{ rich_snippets_property.name }}" content="{{ rich_snippets_property.value }}">
        @endforeach
    @else
        <span class="cmtx_average_rating_stats"><span class="cmtx_average_rating_stat_rating">{{ average_rating }}</span>/<span class="cmtx_average_rating_stat_maximum">5</span> (<span class="cmtx_average_rating_stat_number">{{ num_of_ratings }}</span>)</span>
    @endif
</div>