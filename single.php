<?php get_header(); ?>
	<div class="content-out">
		<div class="content-in">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "def-wide" || $mvp_post_temp == "full-wide") { ?>
					<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
						<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
							<div id="video-embed" class="left relative">
								<?php echo get_post_meta($post->ID, "mvp_video_embed", true); ?>
							</div><!--video-embed-->
						<?php else: ?>
							<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide == "hide") { ?>
							<?php } else { ?>
								<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
									<div id="feat-img-wide" class="left relative" itemscope itemtype="http://schema.org/Article">
										<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '' ); ?>
										<img itemprop="image" src="<?php echo esc_url( $thumb['0'] ); ?>" />
										<div id="feat-img-wide-text">
											<?php if ($mvp_post_temp == "def-wide" || $mvp_post_temp == "full-wide") { ?>
												<div class="post-cat-contain left relative post-cat-mob">
													<span class="img-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
												</div><!--post-cat-contain-->
											<?php } ?>
											<h1 class="story-title entry-title" itemprop="name headline"><?php the_title(); ?></h1>
											<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "def-wide" || $mvp_post_temp == "full-wide") { ?>
												<?php if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
													<span class="feat-caption-wide"><?php echo get_post_meta($post->ID, "mvp_photo_credit", true); ?></span>
												<?php endif; ?>
											<?php } ?>
										</div><!--feat-img-wide-text-->
									</div><!--feat-img-wide-->
								<?php } ?>
							<?php } ?>
						<?php endif; ?>
					<?php } ?>
				<?php } else { } ?>
			<?php endwhile; endif; ?>
		</div><!--content-in-->
	</div><!--content-out-->
		</div><!--head-wrap-in-->
	</div><!--head-wrap-out-->
</div><!--head-wrap-->
<div id="content-wrapper" class="left relative social-bottom">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="content-out" class="relative">
			<div class="content-in" itemscope itemtype="http://schema.org/Article">
			<div id="post-social-out" class="relative">
				<?php $mvp_social_box = get_option('mvp_social_box'); if ($mvp_social_box == "true") { ?>
				<div id="post-social-wrap">
					<ul class="post-social-list left relative">
						<?php mvp_share_count(); ?>
						<li class="post-social-fb">
							<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><i class="fa fa-facebook fa-2"></i></a>
						</li>
						<li class="post-social-twit">
							<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?>&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><i class="fa fa-twitter fa-2"></i></a>	
						</li>
						<li class="post-social-pin">
							<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><i class="fa fa-pinterest fa-2"></i></a>
						</li>
						<li class="post-social-goog">
							<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" title="Share on Google+" target="_blank"><i class="fa fa-google-plus fa-2"></i></a>	
						</li>
						<?php if ( ! is_plugin_active('disqus-comment-system/disqus.php')) { ?>
							<li class="post-social-comm">
								<a href="<?php comments_link(); ?>" class="comment-click"><i class="fa fa-comments fa-2"></i></a>
							</li>
						<?php } ?>
					</ul>
				</div><!--post-social-wrap-->
				<?php } ?>
				<div id="post-social-in">
					<?php $mvp_post_temp = get_post_meta( $post->ID, 'mvp_post_template', true); if ( $mvp_post_temp == "def" || $mvp_post_temp == "def-wide" ) { ?>
						<div id="post-content-out">
							<div id="post-content-in">
					<?php } else if ( $mvp_post_temp == "full-def" || $mvp_post_temp == "full-wide" ) { ?>
						<div id="post-content-out" class="post-full">
							<div id="post-content-in" class="post-full">
					<?php } else { ?>
						<div id="post-content-out">
							<div id="post-content-in">
					<?php } ?>
							<div id="post-content-contain" class="left relative">
					<article <?php post_class(); ?>>
						<div id="post-content-wrapper" class="relative">
							<div id="post-area" class="left relative">
								<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ($mvp_post_temp == "def" || $mvp_post_temp == "full-def") { ?>
									<div class="post-cat-contain left relative post-cat-mob">
										<span class="img-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
									</div><!--post-cat-contain-->
									<h1 class="story-title entry-title" itemprop="name headline"><?php the_title(); ?></h1>
								<?php } else if ($mvp_post_temp == "def-wide" || $mvp_post_temp == "full-wide") { ?>
									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
										<h1 class="story-title entry-title" itemprop="name headline"><?php the_title(); ?></h1>
									<?php endif; ?>
								<?php } else { ?>
									<div class="post-cat-contain left relative post-cat-mob">
										<span class="img-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
									</div><!--post-cat-contain-->
									<h1 class="story-title entry-title" itemprop="name headline"><?php the_title(); ?></h1>
								<?php } ?>

								<div id="right-content" class="relative">
									<div id="content-area" class="left relative" itemprop="articleBody">
										<?php $mvp_featured_img = get_option('mvp_featured_img'); if ($mvp_featured_img == "true") { ?>
											<?php $mvp_post_temp = get_post_meta($post->ID, "mvp_post_template", true); if ( $mvp_post_temp == "def" || $mvp_post_temp == "full-def") { ?>
												<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
													<div id="video-embed" class="left relative">
														<?php echo get_post_meta($post->ID, "mvp_video_embed", true); ?>
													</div><!--video-embed-->
												<?php else: ?>
													<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide == "hide") { ?>
													<?php } else { ?>
														<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
															<div id="feat-img-reg" class="relative">
																<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
																<img itemprop="image" src="<?php echo esc_url( $thumb['0'] ); ?>" />
															</div><!--feat-img-reg-->
															<?php if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
																<span class="feat-caption-reg"><?php echo get_post_meta($post->ID, "mvp_photo_credit", true); ?></span>
															<?php endif; ?>
														<?php } ?>
													<?php } ?>
												<?php endif; ?>
											<?php } else if ($mvp_post_temp == "def-wide" || $mvp_post_temp == "full-wide") { } else { ?>
												<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
													<div id="video-embed" class="left relative">
														<?php echo get_post_meta($post->ID, "mvp_video_embed", true); ?>
													</div><!--video-embed-->
												<?php else: ?>
													<?php $mvp_show_hide = get_post_meta($post->ID, "mvp_featured_image", true); if ($mvp_show_hide == "hide") { ?>
													<?php } else { ?>
														<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
															<div id="feat-img-reg" class="relative">
																<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
																<img itemprop="image" src="<?php echo esc_url( $thumb['0'] ); ?>" />
															</div><!--feat-img-reg-->
															<?php if(get_post_meta($post->ID, "mvp_photo_credit", true)): ?>
																<span class="feat-caption-reg"><?php echo get_post_meta($post->ID, "mvp_photo_credit", true); ?></span>
															<?php endif; ?>
														<?php } ?>
													<?php } ?>
												<?php endif; ?>
											<?php } ?>
										<?php } ?>
										<div class="hide-title">
											<span class="entry-title" itemprop="name headline"><?php the_title(); ?></span>
										</div><!--hide-title-->
										<div id="left-content-mobi">
											<?php $author = get_option('mvp_author_box'); if ($author == "true") { ?>
												<div class="author-img left">
													<?php echo get_avatar( get_the_author_meta('email'), '120' ); ?>
												</div><!--author-img-->
											<?php } ?>
											<div class="author-info-mob-wrap">
												<span class="vcard author">
													<span class="author-name left fn" itemprop="author"><?php the_author_posts_link(); ?></span>
												</span>
												<div class="post-date-wrap left relative post-date-mob">
													<span class="post-date"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></span>
												</div><!--post-date-wrap-->
											</div><!--author-info-mob-wrap-->
										</div><!--left-content-mobi-->
										<?php the_content(); ?>
										<?php wp_link_pages(); ?>
										<?php if(get_option('mvp_article_ad')) { ?>
											<div id="article-ad">
												<?php $articlead = get_option('mvp_article_ad'); if ($articlead) { echo stripslashes($articlead); } ?>
											</div><!--article-ad-->
										<?php } ?>
										<div class="post-tags post-tags-mobi">
											<span class="post-tags-header"><?php _e( 'Related Items', 'mvp-text' ); ?></span><span itemprop="keywords"><?php the_tags('','','') ?></span>
										</div><!--post-tags-->
									</div><!--content-area-->
									<?php if ( comments_open() ) { ?>
										<?php if ( ! is_plugin_active('disqus-comment-system/disqus.php')) { ?>
											<div id="comments-button" class="left relative comment-click">
												<span class="comment-but-text"><i class="fa fa-comments fa-2"></i> <?php comments_number(__( 'Click to add a comment', 'mvp-text'), __('View Comments (1)', 'mvp-text'), __('View Comments (%)', 'mvp-text'));?></span>
											</div><!-comments-button-->
										<?php } ?>
										<?php comments_template(); ?>
									<?php } ?>
								</div><!--right-content-->
								<div id="left-content" class="left relative">
									<div class="post-cat-contain left relative">
										<span class="img-cat left"><?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
									</div><!--post-cat-contain-->
									<div class="post-date-wrap left relative post-date-reg">
										<span class="post-date"><time class="post-date updated" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></span>
									</div><!--post-date-wrap-->
									<div class="author-info-wrap left relative">
										<?php $author = get_option('mvp_author_box'); if ($author == "true") { ?>
											<div class="author-img left">
												<?php echo get_avatar( get_the_author_meta('email'), '120' ); ?>
											</div><!--author-img-->
										<?php } ?>
										<span class="vcard author">
											<span class="author-name left fn" itemprop="author"><?php the_author_posts_link(); ?></span>
										</span>
										<?php $author = get_option('mvp_author_box'); if ($author == "true") { ?>
											<?php $authordesc = get_the_author_meta( 'twitter' ); if ( ! empty ( $authordesc ) ) { ?>
											<span class="author-twit left"><i class="fa fa-twitter"></i> <a href="http://www.twitter.com/<?php the_author_meta('twitter'); ?>" target="blank">@<?php the_author_meta('twitter'); ?></a></span>
											<?php } ?>
											<p class="author-desc left"><?php the_author_meta('description'); ?></p>
										<?php } ?>
									</div><!--author-info-wrap-->
									<div class="post-tags">
										<span class="post-tags-header"><?php _e( 'Related Items', 'mvp-text' ); ?></span><span itemprop="keywords"><?php the_tags('','','') ?></span>
									</div><!--post-tags-->
								</div><!--left-content-->
							</div><!--post-area-->
						</div><!--post-content-wrapper-->
					</article>
					<?php $mvp_show_more = get_option('mvp_show_more'); if ($mvp_show_more == "true") { ?>
						<?php if(get_option('mvp_more_posts_layout') == 'wide') { ?>
					<div id="post-latest-header" class="left relative">
						<h4 class="post-latest left relative"><?php _e( 'More in', 'mvp-text' ); ?> <?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></h4>
					</div><!--post-latest-header-->
					<div id="post-latest-wrap" class="left relative infinite-content">
						<?php $mvp_related_num = get_option('mvp_related_num'); $category = get_the_category(); $current_cat = $category[0]->cat_ID; $recent = new WP_Query(array( 'cat' => $current_cat, 'posts_per_page' => $mvp_related_num, 'post__not_in' => array( $post->ID ) )); while($recent->have_posts()) : $recent->the_post(); ?>
							<div class="story-contain left relative infinite-post">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
								<div class="story-contain-img left">
									<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
										<?php the_post_thumbnail('medium-thumb'); ?>
									<?php } ?>
									<?php if(get_post_meta($post->ID, "mvp_video_embed", true)): ?>
										<div class="video-but-contain">
											<i class="fa fa-play-circle-o fa-4"></i>
										</div><!--video-but-contain-->
									<?php endif; ?>
								</div><!--story-contain-img-->
								<div class="story-contain-text">
									<h2><?php the_title(); ?></h2>
									<div class="text-info-contain left relative">
										<span class="home-text-author left"><?php the_author(); ?></span><span class="home-text-date left"><?php the_time(get_option('date_format')); ?></span>
									</div><!--text-info-contain-->
								</div><!--story-contain-text-->
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
											<a href="<?php the_permalink(); ?>/#comments-button"><i class="fa fa-comments fa-2"></i></a>
										</div><!--read-more-comment-->
									</div><!--share-box-wrapper-->
								</div><!--read-share-overlay-->
							</div><!--story-contain-->
						<?php endwhile; wp_reset_query(); ?>
					</div><!--post-latest-wrap-->

						<?php } else { ?>
							<div id="home-widget-wrap" class="left relative gray-border-top">
								<div class="home-widget">
									<h3 class="widget-header-wrap left relative">
										<span class="widget-header-title"><?php _e( 'More in', 'mvp-text' ); ?> <?php $category = get_the_category(); echo esc_html( $category[0]->cat_name ); ?></span>
									</h3>
									<ul class="widget-full1 left relative infinite-content">
										<?php $mvp_related_num = get_option('mvp_related_num'); $category = get_the_category(); $current_cat = $category[0]->cat_ID; $recent = new WP_Query(array( 'cat' => $current_cat, 'posts_per_page' => $mvp_related_num, 'post__not_in' => array( $post->ID ) )); while($recent->have_posts()) : $recent->the_post(); ?>
												<li class="infinite-post">
													<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
														<div class="widget-full-list-img left relative">
															<a href="<?php the_permalink(); ?>" rel="bookmark">
																<?php the_post_thumbnail('medium-thumb'); ?>
															</a>
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
																		<a href="<?php the_permalink(); ?>/#comments-button"><i class="fa fa-comments fa-2"></i></a>
																	</div><!--read-more-comment-->
																</div><!--share-box-wrapper-->
															</div><!--read-share-overlay-->
														</div><!--widget-full-list-img-->
														<div class="widget-full-list-text left relative">
															<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
															<p><?php echo excerpt(18); ?></p>
														</div><!--widget-full-list-text-->
														<div class="widget-post-info left">
															<span class="widget-post-author"><?php the_author(); ?> </span><span class="widget-post-date"><?php the_time(get_option('date_format')); ?></span>
														</div><!--widget-post-info-->
													<?php } else { ?>
														<div class="widget-full-list-text left relative">
															<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
															<p><?php echo excerpt(53); ?></p>
														</div><!--widget-full-list-text-->
														<div class="widget-post-info left">
															<span class="widget-post-author"><?php the_author(); ?> </span><span class="widget-post-date"><?php the_time(get_option('date_format')); ?></span>
														</div><!--widget-post-info-->
													<?php } ?>
												</li>
										<?php endwhile; wp_reset_query(); ?>
									</ul>
								</div><!--home-widget-->
							</div><!--home-widgets-wrap-->
						<?php } ?>
					<?php } ?>
					<?php $mvp_post_temp = get_post_meta( $post->ID, 'mvp_post_template', true); if ( $mvp_post_temp == "full-def" || $mvp_post_temp == "full-wide" ) { } else { ?>
						<?php get_sidebar(); ?>
					<?php } ?>
					<?php get_footer('section'); ?>
							</div><!--post-content-contain-->
						</div><!--post-content-in-->
					</div><!--post-content-out-->
				</div><!--post-social-in-->
			</div><!--post-social-out-->
		</div><!--content-in-->
	</div><!--content-out-->
	<?php $prev_next = get_option('mvp_prev_next'); if ($prev_next == "true") { ?>
		<div id="prev-next-wrap">
			<?php $prev_post = get_previous_post(TRUE, ''); if (!empty( $prev_post )) { ?>
				<div id="prev-post-wrap">
					<div id="prev-post-arrow" class="relative">
						<i class="fa fa-angle-left fa-4"></i>
					</div><!--prev-post-arrow-->
					<div class="prev-next-text">
						<?php previous_post_link('%link', '%title', TRUE); ?>
					</div><!--prev-post-text-->
				</div><!--prev-post-wrap-->
			<?php } ?>
			<?php $next_post = get_next_post(TRUE, ''); if (!empty( $next_post )) { ?>
				<div id="next-post-wrap">
					<div id="next-post-arrow" class="relative">
						<i class="fa fa-angle-right fa-4"></i>
					</div><!--prev-post-arrow-->
					<div class="prev-next-text">
						<?php next_post_link('%link', '%title', TRUE); ?>
					</div><!--prev-next-text-->
				</div><!--next-post-wrap-->
			<?php } ?>
		</div><!--prev-next-wrap-->
	<?php } ?>
	<?php setCrunchifyPostViews(get_the_ID()); ?>
	<?php endwhile; endif; ?>
</div><!--content-wrapper-->
<?php get_footer(); ?>