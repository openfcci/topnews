<?php get_header(); ?>
		</div><!--head-wrap-in-->
	</div><!--head-wrap-out-->
</div><!--head-wrap-->
<div id="content-wrapper" class="left relative">
		<div class="content-out" class="relative">
			<div class="content-in">
			<div id="post-social-out" class="relative">
				<div id="post-social-in">
					<div id="post-content-out">
						<div id="post-content-in">
							<div id="post-content-contain" class="left relative">
								<div id="post-content-wrapper" class="relative" <?php post_class(); ?>>
									<div id="post-area" class="left relative">
										<?php if(is_single()) { if (have_posts()) : while (have_posts()) : the_post(); ?>
											<?php woocommerce_breadcrumb(); ?>
										<?php endwhile; endif; } else { ?>
											<?php woocommerce_breadcrumb(); ?>
										<?php } ?>
										<div id="woo-content">
											<?php woocommerce_content(); ?>
											<?php wp_link_pages(); ?>
										</div><!--woo-content-->
									</div><!--post-area-->
								</div><!--post-content-wrapper-->
								<?php get_sidebar('woo'); ?>
								<?php get_footer('section'); ?>
							</div><!--post-content-contain-->
						</div><!--post-content-in-->
					</div><!--post-content-out-->
				</div><!--post-social-in-->
			</div><!--post-social-out-->
		</div><!--content-in-->
	</div><!--content-out-->
</div><!--content-wrapper-->
<?php get_footer(); ?>