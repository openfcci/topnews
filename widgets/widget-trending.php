<?php
/**
 * Plugin Name: Trending Topics Widget
 */

add_action( 'widgets_init', 'mvp_trend_load_widgets' );

function mvp_trend_load_widgets() {
	register_widget( 'mvp_trend_widget' );
}

class mvp_trend_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_trend_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_trend_widget', 'description' => __('A widget that displays a list of trending topics.', 'mvp_trend_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_trend_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'mvp_trend_widget', __('Top News: Trending Topics Widget', 'mvp_trend_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$title = apply_filters('widget_title', $instance['title'] );
		$popular_days = $instance['popular_days'];
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		?>

		<div class="trending-wrap left relative">
			<ul class="trending-list left relative">
				<li class="trending-head"><?php echo esc_html( $title ); ?></li>
				<?php if ( is_category() ) { ?>
					<?php $popular_days_ago = "$popular_days days ago"; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $recent = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => $number, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
						<li>
							<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
								<a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></a>
							<?php else: ?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<?php endif; ?>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php } else { ?>
						<?php $popular_days_ago = "$popular_days days ago"; $recent = new WP_Query(array( 'posts_per_page' => $number, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
							<li>
								<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
									<a href="<?php the_permalink(); ?>"><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></a>
								<?php else: ?>
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<?php endif; ?>
							</li>
					<?php endwhile; wp_reset_postdata(); ?>
				<?php } ?>
			</ul>
		</div><!--trending-wrap-->


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
		$instance['popular_days'] = strip_tags( $new_instance['popular_days'] );
		$instance['number'] = strip_tags( $new_instance['number'] );

		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'showcat' => 'off', 'number' => 10, 'popular_days' => 30);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:90%;" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_days' ); ?>">Number of days to use for Trending topics:</label>
			<input id="<?php echo $this->get_field_id( 'popular_days' ); ?>" name="<?php echo $this->get_field_name( 'popular_days' ); ?>" value="<?php echo $instance['popular_days']; ?>" size="3" />
		</p>

		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Maximum number of topics to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>