<?php
   $job = get_post_meta( get_the_ID(), 'apus_testimonial_job', true );
   $link = get_post_meta( get_the_ID(), 'apus_testimonial_link', true );
   $rating = get_post_meta( get_the_ID(), 'apus_testimonial_star', true );
?>
<div class="testimonial-version3" data-testimonial="content">
  <div class="testimonial-body style_big">
    <div class="clearfix top-inner flex-middle">
      <div class="image">
        <?php
         if ( has_post_thumbnail() ) {
            the_post_thumbnail('230x295');
          } 
        ?>
      </div>
      <div class="info">
        <div class="description clearfix">
          <?php echo entaro_substring(get_the_excerpt(),25,'...'); ?>      
        </div>
        <div class="info-meta">
          <div class="review-stars-rated">
            <ul class="review-stars">
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
                <li><span class="fa fa-star-o"></span></li>
            </ul>
            
            <ul class="review-stars filled"  style="<?php echo esc_attr( 'width: ' . ( (int)$rating * 20 ) . '%' ) ?>" >
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
                <li><span class="fa fa-star"></span></li>
            </ul>
          </div>
          <?php if (!empty($link)) { ?>
            <h3 class="name-client"> - <a href="<?php echo esc_url_raw($link); ?>"><?php the_title(); ?></a></h3>
          <?php } else { ?>
            <h3 class="name-client"> - <?php the_title(); ?></h3>
          <?php } ?>
          <span class="job text-second"> <?php echo sprintf(__('(%s)', 'entaro'), $job); ?></span>
        </div>
      </div>
    </div>
  </div>
</div>