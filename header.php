<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" >
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

<title><?php wp_title( '-', true, 'right' ); ?></title>

<?php if(get_option('mvp_favicon')) { ?><link rel="shortcut icon" href="<?php echo get_option('mvp_favicon'); ?>" /><?php } ?>
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
<meta property="og:image" content="<?php echo esc_url( $thumb['0'] ); ?>" />
<?php } ?>

<?php if ( is_single() ) { ?>
<meta property="og:type" content="article" />
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
<link rel="author" href="<?php the_author_meta('googleplus'); ?>"/>
<?php endwhile; endif; ?>
<?php } else { ?>
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<?php } ?>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php $analytics = get_option('mvp_tracking'); if ($analytics) { echo stripslashes($analytics); } ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(''); ?>>
<?php if(get_option('mvp_wall_ad')) { ?>
	<div id="wallpaper">
		<?php if(get_option('mvp_wall_url')) { ?>
			<a href="<?php echo get_option('mvp_wall_url'); ?>" class="wallpaper-link" target="_blank"></a>
		<?php } ?>
	</div><!--wallpaper-->
<?php } ?>
<div id="site">
	<header>
		<div id="nav-wrap" class="left relative">
			<div class="content-out">
				<div class="content-in">
					<div id="nav-contain" class="left">
						<div id="nav-contain-out">
							<div id="nav-logo" class="left" itemscope itemtype="http://schema.org/Organization">
								<?php if(get_option('mvp_logo')) { ?>
									<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_option('mvp_logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php } else { ?>
									<a itemprop="url" href="<?php echo home_url(); ?>"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-small.png" alt="<?php bloginfo( 'name' ); ?>" /></a>
								<?php } ?>
							</div><!--nav-logo-->
							<div id="nav-contain-in">
								<div id="main-nav-out">
									<div id="main-nav-in">
								<nav>
									<?php get_template_part( ABSPATH . 'wp-admin/includes/plugin.php' ); ?>
									<?php if (is_plugin_active('menufication/menufication.php')) { ?>
										<div class="mobile-menu-hide">
											<?php wp_nav_menu(array('theme_location' => 'mobile-menu')); ?>
										</div><!--mobile-menu-hide-->
									<?php } else { ?>
										<div id="mobile-menu-wrap" class="left relative">
											<i class="fa fa-bars fa-3"></i>
											<div id="mobile-nav">
												<?php wp_nav_menu(array( 'theme_location' => 'mobile-menu', 'items_wrap' => '<select><option value="#">'.__('Menu', 'mvp-text').'</option>%3$s</select>', 'walker' => new select_menu_walker() )); ?>
											</div><!--mobile-nav-->
										</div><!--mobile-menu-wrap-->
									<?php } ?>
									<div id="nav-out">
										<div id="nav-in">
											<div class="main-nav left main-nav-contain">
												<div class="main-nav-in left">
													<?php if ( is_category() ) { ?>
														<div id="category-header-wrap" class="left relative">
															<h1><?php single_cat_title(); ?></h1>
														</div><!--category-header-wrap-->
													<?php } ?>
													<?php wp_nav_menu(array('theme_location' => 'main-menu')); ?>
												</div><!--main-nav-in-->
											</div><!--main-nav-->
										</div><!--nav-in-->
										<?php if ( has_nav_menu( 'more-menu' ) ) { ?>
											<div class="main-nav more-nav-contain">
												<?php wp_nav_menu(array('theme_location' => 'more-menu')); ?>
											</div><!--more-nav-->
										<?php } ?>
									</div><!--nav-out-->
								</nav>
							</div><!--main-nav-in-->
						<div class="nav-spacer"></div>
						<div id="nav-right">
							<div id="search-button">
								<i class="fa fa-search fa-2"></i>
							</div><!--search-button-->
							<div id="social-nav" class="relative">
								<?php if(get_option('mvp_facebook')) { ?>
									<span class="fb-nav"><i class="fa fa-facebook fa-2"></i></span>
								<?php } ?>
								<?php if(get_option('mvp_twitter')) { ?>
									<span class="twit-nav"><i class="fa fa-twitter fa-2"></i></span>
								<?php } ?>
								<span class="plus-nav"><i class="fa fa-plus fa-2"></i></span>
								<div id="social-dropdown">
									<ul class="social-drop-list relative">
										<?php if(get_option('mvp_facebook')) { ?>
											<a href="<?php echo get_option('mvp_facebook'); ?>" alt="Facebook" target="_blank">
											<li class="fb-drop">
												<i class="fa fa-facebook-square fa-2"></i>
												<p>Facebook</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_twitter')) { ?>
											<a href="<?php echo get_option('mvp_twitter'); ?>" alt="Twitter" target="_blank">
											<li class="twit-drop">
												<i class="fa fa-twitter fa-2"></i>
												<p>Twitter</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_pinterest')) { ?>
											<a href="<?php echo get_option('mvp_pinterest'); ?>" alt="Pinterest" target="_blank">
											<li class="pin-drop">
												<i class="fa fa-pinterest fa-2"></i>
												<p>Pinterest</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_instagram')) { ?>
											<a href="<?php echo get_option('mvp_instagram'); ?>" alt="Instagram" target="_blank">
											<li class="inst-drop">
												<i class="fa fa-instagram fa-2"></i>
												<p>Instagram</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_google')) { ?>
											<a href="<?php echo get_option('mvp_google'); ?>" alt="Google Plus" target="_blank">
											<li class="goog-drop">
												<i class="fa fa-google-plus fa-2"></i>
												<p>Google+</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_youtube')) { ?>
											<a href="<?php echo get_option('mvp_youtube'); ?>" alt="Youtube" target="_blank">
											<li class="yt-drop">
												<i class="fa fa-youtube-play fa-2"></i>
												<p>YouTube</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_linkedin')) { ?>
											<a href="<?php echo get_option('mvp_linkedin'); ?>" alt="LinkedIn" target="_blank">
											<li class="link-drop">
												<i class="fa fa-linkedin fa-2"></i>
												<p>LinkedIn</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_tumblr')) { ?>
											<a href="<?php echo get_option('mvp_tumblr'); ?>" alt="Tumblr" target="_blank">
											<li class="tum-drop">
												<i class="fa fa-tumblr fa-2"></i>
												<p>Tumblr</p>
											</li>
											</a>
										<?php } ?>
										<?php if(get_option('mvp_rss')) { ?>
											<a href="<?php echo get_option('mvp_rss'); ?>" target="_blank">
											<li class="rss-drop">
												<i class="fa fa-rss fa-2"></i>
												<p>RSS</p>
											</li>
											</a>
										<?php } else { ?>
											<a href="<?php bloginfo('rss_url'); ?>" target="_blank">
											<li class="rss-drop">
												<i class="fa fa-rss fa-2"></i>
												<p>RSS</p>
											</li>
											</a>
										<?php } ?>
									</ul>
								</div><!--social-dropdown-->
							</div><!--social-nav-->
						</div><!--nav-right-->
						<div id="search-bar">
							<?php get_search_form(); ?>
						</div><!--search-bar-->
								</div><!--main-nav-out-->
							</div><!--nav-contain-in-->
						</div><!--nav-contain-out-->
					</div><!--nav-contain-->
				</div><!--content-in-->
			</div><!--content-out-->
		</div><!--nav-wrap-->
	</header>
	<div id="head-wrap" class="left relative">
		<div class="head-wrap-out">
			<div class="head-wrap-in">
		<?php if ( is_page_template('page-home.php') ) { ?>
			<?php $mvp_feat_posts = get_option('mvp_feat_posts'); if ($mvp_feat_posts == "true") { ?>
			<div id="featured-multi-wrap" class="left relative">
				<?php global $do_not_duplicate; global $post; $recent = new WP_Query(array( 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '1'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
					<div id="featured-multi-main" class="left relative">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
						<div id="featured-multi-main-img" class="left relative">
							<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
								<?php the_post_thumbnail('post-thumb', array( 'class' => 'unlazy reg-img' )); ?>
								<?php the_post_thumbnail('medium-thumb', array( 'class' => 'unlazy mob-img' )); ?>
							<?php } ?>
							<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
								<div class="video-but-contain">
									<i class="fa fa-play-circle-o fa-4"></i>
								</div><!--video-but-contain-->
							<?php endif; ?>
						</div><!--featured-multi-main-img-->
						<div id="featured-multi-main-text">
							<div class="img-cat-contain left">
								<span class="img-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
							</div><!--img-cat-contain-->
							<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
								<h2><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h2>
							<?php else: ?>
								<h2 class="standard-headline"><?php the_title(); ?></h2>
							<?php endif; ?>
							<p><?php echo excerpt(25); ?></p>
							<div class="text-info-contain left relative">
								<span class="home-text-author left"><?php the_author(); ?></span><span class="home-text-date left"><?php the_time(get_option('date_format')); ?></span>
							</div><!--text-info-contain-->
						</div><!--featured-multi-main-text-->
						</a>
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
					</div><!--featured-multi-main-->
				<?php } endwhile; wp_reset_postdata(); ?>
				<div id="featured-multi-sub-wrap" class="left relative">
					<?php if (isset($do_not_duplicate)) { $recent = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'tag' => get_option('mvp_feat_posts_tags'), 'posts_per_page' => '4'  )); while($recent->have_posts()) : $recent->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
						<div class="featured-multi-sub left relative">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
								<div class="featured-multi-sub-img relative">
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<?php the_post_thumbnail('medium-thumb', array( 'class' => 'unlazy' )); ?>
									<?php } ?>
									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
										<div class="video-but-contain">
											<i class="fa fa-play-circle-o fa-4"></i>
										</div><!--video-but-contain-->
									<?php endif; ?>
								</div><!--featured-multi-sub-img-->
								<div class="featured-multi-sub-text">
									<div class="img-cat-contain left">
										<span class="img-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
									</div><!--img-cat-contain-->
									<h2><?php the_title(); ?></h2>
									<div class="text-info-contain left relative">
										<span class="home-text-author left"><?php the_author(); ?></span><span class="home-text-date left"><?php the_time(get_option('date_format')); ?></span>
									</div><!--text-info-contain-->
								</div><!--featured-multi-sub-text-->
								</a>
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
							</div><!--featured-multi-sub-->
						<?php } endwhile; wp_reset_postdata(); } ?>
					</div><!--featured-multi-sub-wrap-->
				</div><!--featured-multi-wrap-->
				<?php } ?>
			<?php } else if ( is_category() ) { ?>
				<?php $mvp_featured_cat = get_option('mvp_featured_cat'); if ($mvp_featured_cat == "true") { ?>
					<?php if ( $paged < 2 ) : ?>
						<div id="featured-multi-wrap" class="left relative">
							<?php global $do_not_duplicate; global $post; $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '1'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; if (isset($do_not_duplicate)) { ?>
								<div id="featured-multi-main" class="left relative">
									<a href="<?php the_permalink(); ?>" rel="bookmark">
									<div id="featured-multi-main-img" class="left relative">
										<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
											<?php the_post_thumbnail('post-thumb', array( 'class' => 'unlazy reg-img' )); ?>
											<?php the_post_thumbnail('medium-thumb', array( 'class' => 'unlazy mob-img' )); ?>
										<?php } ?>
										<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
											<div class="video-but-contain">
												<i class="fa fa-play-circle-o fa-4"></i>
											</div><!--video-but-contain-->
										<?php endif; ?>
									</div><!--featured-multi-main-img-->
									<div id="featured-multi-main-text">
										<?php if(get_post_meta($post->ID, "mvp_featured_headline", true)): ?>
											<h2><?php echo get_post_meta($post->ID, "mvp_featured_headline", true); ?></h2>
										<?php else: ?>
											<h2 class="standard-headline"><?php the_title(); ?></h2>
										<?php endif; ?>
										<p><?php echo excerpt(25); ?></p>
										<div class="text-info-contain left relative">
											<span class="home-text-author left"><?php the_author(); ?></span><span class="home-text-date left"><?php the_time(get_option('date_format')); ?></span>
										</div><!--text-info-contain-->
									</div><!--featured-multi-main-text-->
									</a>
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
								</div><!--featured-multi-main-->
							<?php } endwhile; wp_reset_postdata(); ?>
							<div id="featured-multi-sub-wrap" class="left relative">
								<?php global $do_not_duplicate; global $post; if (isset($do_not_duplicate)) { $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'post__not_in' => $do_not_duplicate, 'cat' => $category_id, 'posts_per_page' => '4'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; ?>
									<div class="featured-multi-sub left relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="featured-multi-sub-img relative">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<?php the_post_thumbnail('medium-thumb', array( 'class' => 'unlazy' )); ?>
											<?php } ?>
											<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
												<div class="video-but-contain">
													<i class="fa fa-play-circle-o fa-4"></i>
												</div><!--video-but-contain-->
											<?php endif; ?>
										</div><!--featured-multi-sub-img-->
										<div class="featured-multi-sub-text">
											<h2><?php the_title(); ?></h2>
											<div class="text-info-contain left relative">
												<span class="home-text-author left"><?php the_author(); ?></span><span class="home-text-date left"><?php the_time(get_option('date_format')); ?></span>
											</div><!--text-info-contain-->
										</div><!--featured-multi-sub-text-->
										</a>
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
									</div><!--featured-multi-sub-->
								<?php endwhile; wp_reset_postdata(); } else { ?>
									<?php $current_category = single_cat_title("", false); $category_id = get_cat_ID($current_category); $cat_posts = new WP_Query(array( 'cat' => $category_id, 'posts_per_page' => '4'  )); while($cat_posts->have_posts()) : $cat_posts->the_post(); $do_not_duplicate[] = $post->ID; ?>
									<div class="featured-multi-sub left relative">
										<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="featured-multi-sub-img relative">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<?php the_post_thumbnail('medium-thumb', array( 'class' => 'unlazy' )); ?>
											<?php } ?>
											<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
												<div class="video-but-contain">
													<i class="fa fa-play-circle-o fa-4"></i>
												</div><!--video-but-contain-->
											<?php endif; ?>
										</div><!--featured-multi-sub-img-->
										<div class="featured-multi-sub-text">
											<h2><?php the_title(); ?></h2>
											<div class="text-info-contain left relative">
												<span class="home-text-author left"><?php the_author(); ?></span><span class="home-text-date left"><?php the_time(get_option('date_format')); ?></span>
											</div><!--text-info-contain-->
										</div><!--featured-multi-sub-text-->
										</a>
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
									</div><!--featured-multi-sub-->
									<?php endwhile; wp_reset_postdata(); ?>
								<?php } ?>
							</div><!--featured-multi-sub-wrap-->
						</div><!--featured-multi-wrap-->
					<?php endif; ?>
				<?php } ?>
			<?php } ?>
			<?php if(get_option('mvp_header_leader')) { ?>
				<div class="content-out">
					<div class="content-in">
						<div id="leader-wrapper" class="left relative">
							<?php $ad970 = get_option('mvp_header_leader'); if ($ad970) { echo stripslashes($ad970); } ?>
						</div><!--leaderboard-wrapper-->
					</div><!--content-in-->
				</div><!--content-out-->
			<?php } ?>