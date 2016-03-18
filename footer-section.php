<footer id="foot-wrap" class="left relative">
	<?php if(get_option('mvp_footer_leader')) { ?>
		<div id="foot-leader" class="left relative">
			<?php $ad970 = get_option('mvp_footer_leader'); if ($ad970) { echo stripslashes($ad970); } ?>
		</div><!--foot-leader-->
	<?php } ?>
	<div id="foot-top" class="left relative">
		<?php $footer_info = get_option('mvp_footer_info'); if ($footer_info == "true") { ?>
			<div class="foot-widget">
				<?php if(get_option('mvp_logo_footer')) { ?>
					<div id="foot-logo" class="left realtive">
						<img src="<?php echo get_option('mvp_logo_footer'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
					</div><!--foot-logo-->
				<?php } else { ?>
					<div id="foot-logo" class="left realtive">
						<img src="<?php echo get_template_directory_uri(); ?>/images/logos/logo-foot.png" alt="<?php bloginfo( 'name' ); ?>" />
					</div><!--foot-logo-->
				<?php } ?>
				<div class="foot-info-text">
					<?php echo get_option('mvp_footer_text'); ?>
				</div><!--footer-info-text-->
			</div><!--foot-widget-->
		<?php } ?>
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget Area')): endif; ?>
	</div><!--foot-top-->
	<div id="foot-bottom" class="left relative">
		<div id="foot-copy" class="left relative">
			<p><?php echo get_option('mvp_copyright'); ?></p>
		</div><!--foot-copy-->
		<div id="foot-soc" class="relative">
			<ul class="foot-soc-list relative">
				<?php if(get_option('mvp_facebook')) { ?>
					<li class="foot-soc-fb">
						<a href="<?php echo get_option('mvp_facebook'); ?>" alt="Facebook" target="_blank"><i class="fa fa-facebook-square fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_twitter')) { ?>
					<li class="foot-soc-twit">
						<a href="<?php echo get_option('mvp_twitter'); ?>" alt="Twitter" target="_blank"><i class="fa fa-twitter-square fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_pinterest')) { ?>
					<li class="foot-soc-pin">
						<a href="<?php echo get_option('mvp_pinterest'); ?>" alt="Pinterest" target="_blank"><i class="fa fa-pinterest-square fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_insagram')) { ?>
					<li class="foot-soc-inst">
						<a href="<?php echo get_option('mvp_instagram'); ?>" alt="Instagram" target="_blank"><i class="fa fa-instagram fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_google')) { ?>
					<li class="foot-soc-goog">
						<a href="<?php echo get_option('mvp_google'); ?>" alt="Google Plus" target="_blank"><i class="fa fa-google-plus-square fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_youtube')) { ?>
					<li class="foot-soc-yt">
						<a href="<?php echo get_option('mvp_youtube'); ?>" alt="Youtube" target="_blank"><i class="fa fa-youtube-play fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_linkedin')) { ?>
					<li class="foot-soc-link">
						<a href="<?php echo get_option('mvp_linkedin'); ?>" alt="LinkedIn" target="_blank"><i class="fa fa-linkedin-square fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_tumblr')) { ?>
					<li class="foot-soc-tumb">
						<a href="<?php echo get_option('mvp_tumblr'); ?>" alt="Tumblr" target="_blank"><i class="fa fa-tumblr-square fa-2"></i></a>
					</li>
				<?php } ?>
				<?php if(get_option('mvp_rss')) { ?>
					<li class="foot-soc-rss">
						<a href="<?php echo get_option('mvp_rss'); ?>" target="_blank"><i class="fa fa-rss-square fa-2"></i></a>
					</li>
				<?php } else { ?>
					<li class="foot-soc-rss">
						<a href="<?php bloginfo('rss_url'); ?>" target="_blank"><i class="fa fa-rss-square fa-2"></i></a>
					</li>
				<?php } ?>
			</ul>
		</div><!--foot-social-->
	</div><!--foot-bottom-->
</footer>