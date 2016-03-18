<?php get_header(); ?>
		</div><!--head-wrap-in-->
	</div><!--head-wrap-out-->
</div><!--head-wrap-->
<div id="content-wrapper" class="left relative">
	<div class="content-out">
		<div class="content-in">
			<div id="post-content-out" class="post-full">
				<div id="post-content-in" class="post-full">
					<div id="post-content-wrapper" class="relative" <?php post_class(); ?>>
						<div id="post-area" class="left relative">
							<div id="content-area" class="left relative" itemprop="articleBody">
								<div id="post-404" class="left relative">
									<h1><?php _e( 'Error', 'mvp-text' ); ?> 404!</h1>
									<?php _e( 'The page you requested does not exist or has moved.', 'mvp-text' ); ?>
								</div><!--post-404-->
							</div><!--content-area-->
						</div><!--post-area-->
					</div><!--post-content-wrapper-->
					<?php get_footer('section'); ?>
				</div><!--post-content-in-->
			</div><!--post-content-out-->
		</div><!--content-in-->
	</div><!--content-out-->
</div><!--content-wrapper-->
<?php get_footer(); ?>