<?php
/**
 * Plugin Name: Sidebar Category Widget
 */

add_action( 'widgets_init', 'mvp_sidetab_load_widgets' );

function mvp_sidetab_load_widgets() {
	register_widget( 'mvp_sidetab_widget' );
}

class mvp_sidetab_widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function mvp_sidetab_widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mvp_sidetab_widget', 'description' => __('A tabber widget that displays recent headlines, popular posts and recent comments.', 'mvp_sidetab_widget') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'mvp_sidetab_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'mvp_sidetab_widget', __('Top News: Sidebar Tabs Widget', 'mvp_sidetab_widget'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		global $post;
		$latest_title = $instance['latest_title'];
		$latest_number = $instance['latest_number'];
		$categories = $instance['categories'];
		$popular_number = $instance['popular_number'];
		$popular_days = $instance['popular_days'];
		$comment_number = $instance['comment_number'];

		/* Before widget (defined by themes). */
		echo $before_widget;


		?>

		<div class="sidebar-widget-content">
			<div class="tabber-contain left relative">
				<ul class="tabs tabber-header left relative">
					<li><h4><a href="#tab1"><i class="fa fa-line-chart fa-2"></i><?php _e( 'Popular', 'mvp-text' ); ?></a></h4></li>
					<li><h4><a href="#tab2"><i class="fa fa-clock-o fa-2"></i><?php echo esc_html( $latest_title ); ?></a></h4></li>
					<li><h4><a href="#tab3"><i class="fa fa-comments fa-2"></i><?php _e( 'Comments', 'mvp-text' ); ?></a></h4></li>
				</ul>
				<div id="tab1" class="tabber-content">
					<ul class="sidebar-list-tabs left relative">
						<?php $popular_days_ago = "$popular_days days ago"; $recent = new WP_Query(array( 'posts_per_page' => $popular_number, 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'post_views_count', 'ignore_sticky_posts' => 1, 'date_query' => array( array( 'after' => $popular_days_ago )) )); while($recent->have_posts()) : $recent->the_post(); ?>
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
				</div><!--tab1-->
				<div id="tab2" class="tabber-content">
					<ul class="sidebar-list-tabs left relative">
						<?php $recent = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $latest_number )); while($recent->have_posts()) : $recent->the_post(); ?>
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
						<?php endwhile; wp_reset_query(); ?>
					</ul>
				</div><!--tab2-->
				<div id="tab3" class="tabber-content">
					<ul class="sidebar-list-tabs left relative">
						<?php $args = array( 'number' => $comment_number ); $comments_query = new WP_Comment_Query; $comments = $comments_query->query( $args ); if ( $comments ) { foreach ( $comments as $comment ) { ?>
							<li>
								<div class="sidebar-list-img left relative">
									<?php echo get_avatar( $comment, '60' ); ?>
								</div><!--sidebar-list-img-->
								<div class="sidebar-list-text left relative">
									<span class="comment-tab-head"><?php echo strip_tags($comment->comment_author); ?> <?php _e( 'says', 'mvp-text' ); ?>:</span><br />
									<p class="comment-tab-text"><a href="<?php echo get_permalink($comment->ID); ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php

$com_trim = strip_tags($comment->comment_content);
$trimmed_content = wp_trim_words( $com_trim, 10 );
echo $trimmed_content;

?></a></p>
								</div><!--sidebar-list-text-->
							</li>
						<?php } } ?>
					</ul>
				</div><!--tab3-->
			</div><!--tabber-contain-->


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
		$instance['latest_title'] = strip_tags( $new_instance['latest_title'] );
		$instance['latest_number'] = strip_tags( $new_instance['latest_number'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['popular_number'] = strip_tags( $new_instance['popular_number'] );
		$instance['popular_days'] = strip_tags( $new_instance['popular_days'] );
		$instance['comment_number'] = strip_tags( $new_instance['comment_number'] );


		return $instance;
	}


	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'latest_title' => 'Latest', 'popular_number' => 4, 'popular_days' => 30, 'latest_number' => 4, 'comment_number' => 4);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Number of "Popular" posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_number' ); ?>">Number of Popular posts to show:</label>
			<input id="<?php echo $this->get_field_id( 'popular_number' ); ?>" name="<?php echo $this->get_field_name( 'popular_number' ); ?>" value="<?php echo $instance['popular_number']; ?>" size="3" />
		</p>

		<!-- Days for "Popular" posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_days' ); ?>">Number of days to use for Popular posts:</label>
			<input id="<?php echo $this->get_field_id( 'popular_days' ); ?>" name="<?php echo $this->get_field_name( 'popular_days' ); ?>" value="<?php echo $instance['popular_days']; ?>" size="3" />
		</p>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'latest_title' ); ?>">Latest Title:</label>
			<input id="<?php echo $this->get_field_id( 'latest_title' ); ?>" name="<?php echo $this->get_field_name( 'latest_title' ); ?>" value="<?php echo $instance['latest_title']; ?>" style="width:70%;" />
		</p>

		<!-- Number of "Latest" posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'latest_number' ); ?>">Number of "Latest" posts to show:</label>
			<input id="<?php echo $this->get_field_id( 'latest_number' ); ?>" name="<?php echo $this->get_field_name( 'latest_number' ); ?>" value="<?php echo $instance['latest_number']; ?>" size="3" />
		</p>

		<!-- Category -->
		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>">Select Category:</label>
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" style="width:70%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>All Categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>

		<!-- Number of "Comments" posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_number' ); ?>">Number of "Comments" to show:</label>
			<input id="<?php echo $this->get_field_id( 'comment_number' ); ?>" name="<?php echo $this->get_field_name( 'comment_number' ); ?>" value="<?php echo $instance['comment_number']; ?>" size="3" />
		</p>


	<?php
	}
}

?>