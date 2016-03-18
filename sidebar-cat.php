<div id="sidebar-contain">
	<div id="sidebar-scroll-wrap">
		<span class="sidebar-scroll"><?php _e( 'Scroll for more', 'mvp-text' ); ?> <i class="fa fa-caret-down fa-2"></i></span>
	</div><!--sidebar-scroll-wrap-->
	<div id="sidebar-mobi-tab">
		<span class="mobi-tab-but"><?php _e( 'Tap', 'mvp-text' ); ?></span>
	</div><!--sidebar-mobi-tab-->
	<div id="sidebar-main-wrap" class="left relative">
		<?php if(get_option('mvp_static_sidebar')) { ?>
			<div id="sidebar-main-ad">
				<div class="widget-ad left relative">
					<?php $static_ad = get_option('mvp_static_sidebar'); if ($static_ad) { echo stripslashes($static_ad); } ?>
				</div><!--widget-ad-->
			</div><!--sidebar-main-ad-->
		<?php } ?>
		<div id="sidebar-widget-wrap" class="left relative">
			<div id="sidebar-widget-in" class="left relative">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Category Sidebar Widget Area')): endif; ?>
			</div><!--sidebar-widget-in-->
		</div><!--sidebar-widget-wrap-->
	</div><!--sidebar-main-wrap-->
</div><!--sidebar-contain-->