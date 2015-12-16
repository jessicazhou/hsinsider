<?php
/**
 * This file holds configuration settings for comments
 */

function hsinsider_get_comments( $comment, $args, $depth ) { ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="thecomment">	
			<div class="author-img">
				<?php echo get_avatar( $comment, $args[ 'avatar_size' ] ); ?>
			</div>
			<div class="comment-text">
				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __('Reply', 'manna'), 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ), $comment->comment_ID ); ?>
					<?php edit_comment_link(__('Edit', 'manna')); ?>
				</span>
				<span class="author"><?php comment_author_link(); ?></span>
				<span class="date"><?php printf( __( '%1$s at %2$s', 'manna' ), get_comment_date(),  get_comment_time() ); ?></span>
				<?php if( 0 == $comment->comment_approved ) { ?>
					<em><i class="icon-info-sign"></i> Comment awaiting approval</em>
					<br />
				<?php } ?>
				<?php comment_text(); ?>
			</div>	
		</div>	
	</li>
<?php }