<?php
/**
 * Plugin Name: Home Category Featured Widget
 */

add_action( 'widgets_init', 'mvp_catfeat_load_widgets' );

function mvp_catfeat_load_widgets() {
	register_widget( 'mvp_catfeat_widget' );
}

class mvp_catfeat_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_catfeat_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_catfeat_widget', 'description' => __('A widget that features the most recent post from a category of your choice.', 'mvp_catfeat_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_catfeat_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'mvp_catfeat_widget', __('Top News: Home Category Featured Widget', 'mvp_catfeat_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$showcat = $instance['showcat'];
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?>

							<?php if ( $title ) { ?>
								<h3 class="widget-header-wrap left relative">
									<span class="widget-header-title"><?php echo esc_html( $title ); ?></span>
									<?php $cat_empty = get_category_link($categories); if( !empty( $cat_empty ) ): ?>
										<span class="widget-header-more"><a href="<?php echo get_category_link($categories); ?>"><?php _e( 'More', 'mvp-text' ); ?> <?php echo esc_html( $title ); ?></a></span>
									<?php endif; ?>
								</h3>
							<?php } ?>
							<?php $recent = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => '1' )); while($recent->have_posts()) : $recent->the_post(); ?>
								<div class="widget-full-wide left relative">
									<div class="full-wide-img left relative">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark">
												<?php the_post_thumbnail(); ?>
											</a>
										<?php } ?>
										<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
											<div class="video-but-contain-med">
												<i class="fa fa-play-circle-o fa-4"></i>
											</div><!--video-but-contain-med-->
										<?php endif; ?>
										<div class="read-share-overlay">
											<div class="read-more-box-wrapper">
												<a href="<?php the_permalink(); ?>" rel="bookmark"><span class="read-more-box"><?php _e( 'Read More', 'mvp-text' ); ?></span></a>
											</div><!--read-more-box-wrapper-->
											<div class="share-box-wrapper">
												<div class="read-more-fb">
													<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><i class="fa fa-facebook fa-2"></i></a>
												</div><!--read-more-fb-->
												<div class="read-more-twit">
													<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><i class="fa fa-twitter fa-2"></i></a>
													</div><!--read-more-twit-->
												<div class="read-more-comment">
													<a href="<?php the_permalink(); ?>#comments"><i class="fa fa-comments fa-2"></i></a>
												</div><!--read-more-comment-->
											</div><!--share-box-wrapper-->
										</div><!--read-share-overlay-->
									</div><!--full-wide-img-->
									<div class="full-wide-text">
										<?php if($showcat) { ?>
											<div class="img-cat-contain left">
												<span class="img-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
											</div><!--home-category-contain-->
										<?php } ?>
										<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
										<p><?php echo excerpt(18); ?></p>
										<div class="widget-post-info left">
											<span class="widget-post-author"><?php the_author(); ?> </span><span class="widget-post-date"><?php the_time(get_option('date_format')); ?></span>
										</div><!--widget-post-info-->
									</div><!--full-wide-text-->
								</div><!--widget-full-wide-->
							<?php endwhile; wp_reset_postdata(); ?>


		<?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = strip_tags( $new_instance['categories'] );
		$instance['showcat'] = strip_tags( $new_instance['showcat'] );
		$instance['number'] = strip_tags( $new_instance['number'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'showcat' => 'on', 'number' => 1);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Select category:</label>
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All Categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) {  ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Show Categories -->
		<p>
			<label for="<?php echo $this->get_field_id( 'showcat' ); ?>">Show categories on posts:</label>
			<input type="checkbox" id="<?php echo $this->get_field_id( 'showcat' ); ?>" name="<?php echo $this->get_field_name( 'showcat' ); ?>" <?php checked( (bool) $instance['showcat'], true ); ?> />
		</p>


	<?php
	}
}

?>