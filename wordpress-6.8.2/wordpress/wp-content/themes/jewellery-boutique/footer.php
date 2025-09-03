</div>
<?php
    $jewellery_boutique_footer_bg_color = get_theme_mod('jewellery_boutique_footer_bg_color');
    $jewellery_boutique_footer_bg_image = get_theme_mod('jewellery_boutique_footer_bg_image');
    $jewellery_boutique_footer_opacity = get_theme_mod('jewellery_boutique_footer_bg_image_opacity', 50);
    $jewellery_boutique_opacity_decimal = $jewellery_boutique_footer_opacity / 100;

    // Compose inline styles for footer background
    $jewellery_boutique_footer_styles = 'background-color: ' . esc_attr($jewellery_boutique_footer_bg_color) . ';';
    if ($jewellery_boutique_footer_bg_image) {
        $jewellery_boutique_footer_styles .= ' background-image: linear-gradient(rgba(0,0,0,' . (1 - $jewellery_boutique_opacity_decimal) . '), rgba(0,0,0,' . (1 - $jewellery_boutique_opacity_decimal) . ')), url(' . esc_url($jewellery_boutique_footer_bg_image) . ');';
    }
?>
<footer class="footer-area" style="<?php echo esc_attr($jewellery_boutique_footer_styles); ?>">  
	<div class="container"> 
		<?php 
		$jewellery_boutique_footer_widgets_setting = get_theme_mod('jewellery_boutique_footer_widgets_setting', '1');

		do_action('jewellery_boutique_footer_above'); 
		
		if ($jewellery_boutique_footer_widgets_setting != '') { 
			if (is_active_sidebar('jewellery-boutique-footer-widget-area')) { ?>
				<div class="row footer-row"> 
					<?php dynamic_sidebar('jewellery-boutique-footer-widget-area'); ?>
				</div>  
			<?php 
			} else { ?>
				<div class="row footer-row">
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="search-3" class="widget widget_search default_footer_search">
							<h2 class="widget-title w-title"><?php esc_html_e('Search', 'jewellery-boutique'); ?></h2>
							<?php get_search_form(); ?>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="archives-2" class="widget widget_archive">
							<h2 class="widget-title w-title"><?php esc_html_e('Recent Posts', 'jewellery-boutique'); ?></h2>
							<ul>
								<?php
								wp_get_archives(array(
									'type' => 'postbypost',
									'format' => 'html',
									'limit'  => 5,
								));
								?>
							</ul>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="pages-2" class="widget widget_pages">
							<h2 class="widget-title w-title"><?php esc_html_e('Pages', 'jewellery-boutique'); ?></h2>
							<ul>
								<?php
								wp_list_pages(array(
									'title_li' => '',
								));
								?>
							</ul>
						</aside>
					</div>
					<div class="footer-widget col-lg-3 col-sm-6 wow fadeIn" data-wow-delay="0.2s">
						<aside id="categories-2" class="widget widget_categories">
							<h2 class="widget-title w-title"><?php esc_html_e('Categories', 'jewellery-boutique'); ?></h2>
							<ul>
								<?php
								wp_list_categories(array(
									'title_li' => '',
								));
								?>
							</ul>
						</aside>
					</div>
				</div>
			<?php } 
		} ?>
	</div>
	
	<?php 
		$jewellery_boutique_footer_copyright = get_theme_mod('jewellery_boutique_footer_copyright','');
	?>
	<?php $jewellery_boutique_footer_copyright_setting = get_theme_mod('jewellery_boutique_footer_copyright_setting','1');
	 if( $jewellery_boutique_footer_copyright_setting != ''){?> 
	<div class="copy-right"> 
		<div class="container">
			<p class="copyright-text">
				<?php
					echo esc_html( apply_filters('jewellery_boutique_footer_copyright',($jewellery_boutique_footer_copyright)));
			    ?>
				<?php if (empty($jewellery_boutique_footer_copyright)) { ?>
				    <?php echo esc_html__('Copyright &copy; 2025,', 'jewellery-boutique'); ?>
				    <a href="<?php echo esc_url('https://www.seothemesexpert.com/products/jewellery-boutique-theme'); ?>" target="_blank">
				    <?php echo esc_html__('Jewellery Boutique', 'jewellery-boutique'); ?></a>
				    <span> | </span>
				    <a href="<?php echo esc_url('https://wordpress.org/'); ?>" target="_blank">
				        <?php echo esc_html__('WordPress Theme', 'jewellery-boutique'); ?>
				    </a>
				<?php } ?>
			</p>
		</div>
	</div>
	<?php }?>
	<?php $jewellery_boutique_scroll_top = get_theme_mod('jewellery_boutique_scroll_top_setting','1');
      if($jewellery_boutique_scroll_top == '1') { ?>
		<a id="scrolltop"><span><?php esc_html_e('TOP','jewellery-boutique'); ?><span></a>
	<?php } ?>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>