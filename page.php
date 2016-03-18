<?php get_header(); ?>
		</div><!--head-wrap-in-->
	</div><!--head-wrap-out-->
</div><!--head-wrap-->
<div id="content-wrapper" class="left relative">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="content-out" class="relative">
			<div class="content-in">
				<div id="post-social-out" class="relative">
					<?php $mvp_social_page = get_option('mvp_social_page'); if ($mvp_social_page == "true") { ?>
						<div id="post-social-wrap">
							<ul class="post-social-list left relative">
								<?php mvp_share_count(); ?>
								<li class="post-social-fb">
									<a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>', 'facebookShare', 'width=626,height=436'); return false;" title="Share on Facebook"><i class="fa fa-facebook fa-2"></i></a>
								</li>
								<li class="post-social-twit">
									<a href="#" onclick="window.open('http://twitter.com/share?text=<?php the_title(); ?> -&amp;url=<?php the_permalink() ?>', 'twitterShare', 'width=626,height=436'); return false;" title="Tweet This Post"><i class="fa fa-twitter fa-2"></i></a>	
								</li>
								<li class="post-social-pin">
									<a href="#" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); echo esc_url( $thumb['0'] ); ?>&amp;description=<?php the_title(); ?>', 'pinterestShare', 'width=750,height=350'); return false;" title="Pin This Post"><i class="fa fa-pinterest fa-2"></i></a>
								</li>
								<li class="post-social-goog">
									<a href="#" onclick="window.open('https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink() ?>', 'googleShare', 'width=626,height=436'); return false;" title="Share on Google+" target="_blank"><i class="fa fa-google-plus fa-2"></i></a>	
								</li>
								<?php $mvp_comments_page = get_option('mvp_comments_page'); if ($mvp_comments_page == "true") { ?>
									<?php if ( ! is_plugin_active('disqus-comment-system/disqus.php')) { ?>
										<li class="post-social-comm">
											<a href="<?php comments_link(); ?>" class="comment-click"><i class="fa fa-comments fa-2"></i></a>
										</li>
									<?php } ?>
								<?php } ?>
							</ul>
						</div><!--post-social-wrap-->
					<?php } ?>
					<div id="post-social-in">
						<div id="post-content-out">
							<div id="post-content-in">
								<div id="post-content-contain" class="left relative">
								<div id="post-content-wrapper" class="relative" <?php post_class(); ?>>
									<div id="post-area" class="left relative">
										<h1 class="story-title entry-title" itemprop="name headline"><?php the_title(); ?></h1>
										<div id="content-area" class="left relative" itemprop="articleBody">
											<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
												<div id="feat-img-reg" class="left relative">
													<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumb' ); ?>
													<img itemprop="image" src="<?php echo esc_url( $thumb['0'] ); ?>" />
												</div><!--feat-img-reg-->
											<?php } ?>
											<?php the_content(); ?>
											<?php wp_link_pages(); ?>
										</div><!--content-area-->
										<?php $mvp_comments_page = get_option('mvp_comments_page'); if ($mvp_comments_page == "true") { ?>
											<?php if ( comments_open() ) { ?>
												<?php if ( ! is_plugin_active('disqus-comment-system/disqus.php')) { ?>
													<div id="comments-button" class="left relative comment-click">
														<span class="comment-but-text"><i class="fa fa-comments fa-2"></i> <?php comments_number(__( 'Click to add a comment', 'mvp-text'), __('View Comments (1)', 'mvp-text'), __('View Comments (%)', 'mvp-text'));?></span>
													</div><!-comments-button-->
												<?php } ?>
												<?php comments_template(); ?>
											<?php } ?>
										<?php } ?>
									</div><!--post-area-->
								</div><!--post-content-wrapper-->
								<?php get_sidebar(); ?>
								<?php get_footer('section'); ?>
							</div><!--post-content-contain-->
						</div><!--post-content-in-->
					</div><!--post-content-out-->
				</div><!--post-social-in-->
			</div><!--post-social-out-->
		</div><!--content-in-->
	</div><!--content-out-->
	<?php endwhile; endif; ?>
</div><!--content-wrapper-->
<?php get_footer(); ?>