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
			
			<?php if( $druco_theme_options['ts_header_note'] || $druco_theme_options['ts_header_store_notice'] || $druco_theme_options['ts_header_currency'] || $druco_theme_options['ts_header_language'] || $druco_theme_options['ts_header_delivery_note'] ): ?>
			<div class="header-top">
				<div class="container">
				
					<?php if( $druco_theme_options['ts_header_note'] ): ?>
					<div class="header-note visible-ipad hidden-phone"><?php echo wp_kses($druco_theme_options['ts_header_note'], 'druco_header_text'); ?></div>
					<?php endif; ?>
				
					<?php if( $druco_theme_options['ts_header_delivery_note'] ): ?>
					<div class="header-delivery-note hidden-phone"><?php echo wp_kses($druco_theme_options['ts_header_delivery_note'], 'druco_header_text'); ?></div>
					<?php endif; ?>
					
					<?php if( $druco_theme_options['ts_header_store_notice'] ): ?>
					<div class="header-store-notice"><?php echo wp_kses($druco_theme_options['ts_header_store_notice'], 'druco_header_text'); ?></div>
					<?php endif; ?>
					
					<div class="header-right hidden-phone">
						<?php if( $druco_theme_options['ts_header_currency'] || $druco_theme_options['ts_header_language'] ): ?>
						<div class="language-currency">
							
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
						
						<div class="menu-wrapper hidden-phone">
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
						
						<?php if( $druco_theme_options['ts_header_note'] ): ?>
						<div class="header-note hidden-ipad"><?php echo wp_kses($druco_theme_options['ts_header_note'], 'druco_header_text'); ?></div>
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
								<?php echo fixer_tiny_account(); ?>
							</div>
							<?php endif; ?>
							
							<?php if( class_exists('YITH_WCWL') && $druco_theme_options['ts_enable_tiny_wishlist'] ): ?>
								<div class="my-wishlist-wrapper hidden-phone"><?php echo druco_tini_wishlist(); ?></div>
							<?php endif; ?>
							
							<?php if( $druco_theme_options['ts_enable_tiny_shopping_cart'] ): ?>
							<div class="shopping-cart-wrapper hidden-phone">
								<?php echo fixer_tiny_cart(); ?>
							</div>
							<?php endif; ?>
							
						</div>

					</div>					
				</div>
				
				<div class="header-bottom">
					<div class="container">
						<?php if ( has_nav_menu( 'vertical' ) ): ?>
							<div class="vertical-menu-wrapper hidden-phone">			
								<div class="vertical-menu-heading"><?php echo druco_get_vertical_menu_heading(); ?></div>
								<?php 
									wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'vertical-menu pc-menu ts-mega-menu-wrapper','theme_location' => 'vertical','walker' => new Druco_Walker_Nav_Menu() ) );
								?>
							</div>
							<?php endif; ?>
						
						<?php if( $druco_theme_options['ts_enable_search'] ): ?>
							<?php druco_get_search_form_by_category_fixer(); ?>
						<?php endif; ?>
						
						<?php if( $druco_theme_options['ts_header_contact_info'] ): ?>
						<div class="header-contact-info has-icon hidden-phone hidden-phone"><?php echo wp_kses($druco_theme_options['ts_header_contact_info'], 'druco_header_text'); ?></div>
						<?php endif; ?>
						
					</div>
				</div>
			</div>			
		</div>	
	</div>
</header>