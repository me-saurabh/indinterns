<?php
$GLOBALS['comment'] = $comment;
$add_below = '';
$child = $comment->get_children();
$class = !empty($child) ? ' parent' : '';
?>
<li <?php comment_class($class); ?> id="comment-<?php comment_ID() ?>">
	<div class="the-comment media">
		<?php if(get_avatar($comment, 80)){ ?>
			<div class="avatar media-left">
				<?php echo get_avatar($comment, 80); ?>
			</div>
		<?php } ?>
		<div class="comment-box media-body">
			<div class="comment-author meta">
				<span class="author text-theme"><i class="fa fa-user text-second" aria-hidden="true"></i><?php echo get_comment_author_link() ?></span>
				<span class="date"><i class="fa fa-calendar-times-o text-second" aria-hidden="true"></i> <?php printf(esc_html__('%1$s', 'entaro'), the_time( get_option('date_format', 'd M, Y') )) ?></span>
				<?php comment_reply_link(array_merge( $args, array( 'reply_text' => esc_html__(' Reply', 'entaro'), 'add_below' => 'comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				<?php edit_comment_link(esc_html__('Edit', 'entaro'),' ','') ?>
			</div>
			<div class="comment-text">
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php esc_html_e('Your comment is awaiting moderation.', 'entaro') ?></em>
				<br />
				<?php endif; ?>
				<?php comment_text() ?>
			</div>
		</div>
	</div>
</li>