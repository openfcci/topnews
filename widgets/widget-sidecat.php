<?php
/**
 * Plugin Name: Sidebar Category Widget
 */

add_action( 'widgets_init', 'mvp_sidecat_load_widgets' );

function mvp_sidecat_load_widgets() {
	register_widget( 'mvp_sidecat_widget' );
}

class mvp_sidecat_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_sidecat_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_sidecat_widget', 'description' => __('A widget that displays a list of posts from a category of your choice.', 'mvp_sidecat_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_sidecat_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'mvp_sidecat_widget', __('Top News: Sidebar Category Widget', 'mvp_sidecat_widget'), $widget_ops, $control_ops );
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
		$number = $instance['number'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
				<ul class="sidebar-list left relative">
					<?php $recent = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number )); while($recent->have_posts()) : $recent->the_post(); ?>
						<li>
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<div class="sidebar-list-img left relative">
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail('small-thumb', array( 'class' => 'unlazy' )); ?>
									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
										<div class="video-but-contain-small">
											<i class="fa fa-play-circle-o fa-4"></i>
										</div><!--video-but-contain-small-->
									<?php endif; ?>
									</a>
								</div><!--sidebar-list-img-->
								<div class="sidebar-list-text left relative">
									<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
									<div class="widget-post-info left">
										<span class="widget-post-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span><span class="widget-post-date"><?php the_time(get_option('date_format')); ?></span>
									</div><!--widget-post-info-->
								</div><!--sidebar-list-text-->
							<?php } else { ?>
								<div class="sidebar-list-text left relative w100">
									<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
									<div class="widget-post-info left">
										<span class="widget-post-cat"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span><span class="widget-post-date"><?php the_time(get_option('date_format')); ?></span>
									</div><!--widget-post-info-->
								</div><!--sidebar-list-text-->
							<?php } ?>
						</li>
					<?php endwhile; wp_reset_postdata(); ?>
				</ul>

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
		$instance['number'] = strip_tags( $new_instance['number'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Title', 'number' => 4);
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

		<!-- Number of links -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>">Number of links to display:</label>
			<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>