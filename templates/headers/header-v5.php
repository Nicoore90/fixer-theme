<?php
$druco_theme_options = druco_get_theme_options();

$header_classes = array();
if( $druco_theme_options['ts_enable_sticky_header'] ){
	$header_classes[] = 'has-sticky';
}

if( !$druco_theme_options['ts_enable_tiny_shopping_cart'] ){
	$header_classes[] = 'hidden-cart';
}

if( !$druco_theme_options['ts_enable_tiny_wishlist'] || !class_exists('WooCommerce') || !class_exists('YITH_WCWL') ){
	$header_classes[] = 'hidden-wishlist';
}

if( !$druco_theme_options['ts_header_currency'] ){
	$header_classes[] = 'hidden-currency';
}

if( !$druco_theme_options['ts_header_language'] ){
	$header_classes[] = 'hidden-language';
}

if( !$druco_theme_options['ts_enable_search'] ){
	$header_classes[] = 'hidden-search';
}
?>

<header class="ts-header <?php echo esc_attr(implode(' ', $header_classes)); ?>">
	<div class="header-container">
		<div class="header-template">
		
			<?php if( $druco_theme_options['ts_header_contact_info'] || $druco_theme_options['ts_header_store_notice'] || $druco_theme_options['ts_header_currency'] || $druco_theme_options['ts_header_language'] || has_nav_menu( 'top_header' ) ): ?>
			<div class="header-top">
				<div class="container">
				
					<div class="header-left hidden-phone">
						<?php druco_top_header_menu(); ?>
					</div>
					
					<?php if( $druco_theme_options['ts_header_store_notice'] ): ?>
					<div class="header-store-notice"><?php echo wp_kses($druco_theme_options['ts_header_store_notice'], 'druco_header_text'); ?></div>
					<?php endif; ?>
					
					<?php if( $druco_theme_options['ts_header_contact_info'] ): ?>
					<div class="header-contact-info visible-ipad hidden-phone"><?php echo wp_kses($druco_theme_options['ts_header_contact_info'], 'druco_header_text'); ?></div>
					<?php endif; ?>
					
					<div class="header-right">
						<?php if( $druco_theme_options['ts_header_currency'] || $druco_theme_options['ts_header_language'] ): ?>
						<div class="language-currency hidden-phone">
							
							<?php if( $druco_theme_options['ts_header_language'] ): ?>
							<div class="header-language"><?php druco_wpml_language_selector(); ?></div>
							<?php endif; ?>
							
							<?php if( $druco_theme_options['ts_header_currency'] ): ?>
							<div class="header-currency"><?php druco_woocommerce_multilingual_currency_switcher(); ?></div>
							<?php endif; ?>
							
						</div>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
			<?php endif; ?>
			
			<div class="header-sticky">
				<div class="header-middle">
					<div class="container">
					
						<div class="header-left">
							<div class="logo-wrapper"><?php druco_theme_logo(); ?></div>
						</div>
						
						<!-- Menu Icon -->
						<div class="icon-menu-sticky-header hidden-phone">
							<span class="icon"></span>
						</div>
						<?php if( $druco_theme_options['ts_enable_search'] ): ?>
							<?php druco_get_search_form_by_category_fixer(); ?>
						<?php endif; ?>
						
						<?php if( $druco_theme_options['ts_header_contact_info'] ): ?>
						<div class="header-contact-info has-icon hidden-ipad"><?php echo wp_kses($druco_theme_options['ts_header_contact_info'], 'druco_header_text'); ?></div>
						<?php endif; ?>
						
						<div class="header-right">
						
							<?php if( !$druco_theme_options['ts_enable_mobile_app_style'] ): ?>
							<!-- Menu Icon -->
							<div class="ts-mobile-icon-toggle visible-phone">
								<span class="icon"></span>
							</div>
							<?php endif; ?>
							
							<?php if( $druco_theme_options['ts_enable_search'] ): ?>
							<div class="search-button search-icon visible-phone">
								<span class="icon"></span>
							</div>
							<?php endif; ?>
							
							<?php if( $druco_theme_options['ts_enable_tiny_account'] ): ?>
							<div class="my-account-wrapper hidden-phone">							
								<?php echo druco_tiny_account(); ?>
							</div>
							<?php endif; ?>
							
							<?php if( class_exists('YITH_WCWL') && $druco_theme_options['ts_enable_tiny_wishlist'] ): ?>
								<div class="my-wishlist-wrapper hidden-phone"><?php echo druco_tini_wishlist(); ?></div>
							<?php endif; ?>
							
							<?php if( $druco_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
							<div class="shopping-cart-wrapper hidden-phone">
								<?php echo druco_tiny_cart(); ?>
							</div>
							<?php endif; ?>
							
						</div>

					</div>					
				</div>
				
				<div class="header-bottom hidden-phone">
					<div class="container">
						<div class="menu-wrapper">
							<div class="ts-menu">
								<?php 
									if ( has_nav_menu( 'primary' ) ) {
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'primary','walker' => new Druco_Walker_Nav_Menu() ) );
									}
									else{
										wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'main-menu pc-menu ts-mega-menu-wrapper' ) );
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>	
	</div>
</header>