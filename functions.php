<?php 

require_once 'inc/shortcodes.php';

function druco_child_register_scripts(){
    $parent_style = 'druco-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('font-awesome-5', 'druco-reset'), druco_get_theme_version() );
    wp_enqueue_style( 'druco-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
    
}
add_action( 'wp_enqueue_scripts', 'druco_child_register_scripts', 99 );

function fixer_scripts() {
	wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js' );
}

add_action( 'wp_enqueue_scripts', 'fixer_scripts', 99 );

add_action('wp_footer', function() {
    ?>

    <a href='https://wa.me/543492643820' class="whatsapp-button"><i class="fa-brands fa-whatsapp"></i></a>

    <?php
});
add_filter('woocommerce_rest_orders_prepare_object_query', function(array $args, \WP_REST_Request $request) {
    $modified_after = $request->get_param('modified_after');    if (!$modified_after) {
        return $args;
    }    $args['date_query'][0]['column'] = 'post_modified';
    $args['date_query'][0]['after']  = $modified_after;    return $args;}, 10, 2);add_filter('woocommerce_rest_product_object_query', function(array $args, \WP_REST_Request $request) {
    $modified_after = $request->get_param('modified_after');    if (!$modified_after) {
        return $args;
    }    $args['date_query'][0]['column'] = 'post_modified';
    $args['date_query'][0]['after']  = $modified_after;    return $args;}, 10, 2);

add_action('admin_menu', 'agregar_pagina_crm_al_menu');

function agregar_pagina_crm_al_menu()
{
	add_menu_page(
		'Título del CRM',   // Título de la página
		'CRM',             // Texto en el menú
		'manage_options',  // Capacidad requerida para ver este menú
		'crm.php', // Ruta a tu archivo crm.php
		'',                // Función (puedes dejarlo vacío o poner una función para mostrar contenido)
		'dashicons-analytics', // Icono del menú (puedes cambiarlo)
		29.9                 // Posición en el menú
	);
}

/*function register_custom_order_statuses(){
    register_post_status( 'Pagado', array(
        'label'                     => 'Pagado',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'Pagado <span class="count">(%s)</span>', 'Pagado <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'piezas-pedidas', array(
        'label'                     => 'Piezas Pedidas',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'piezas-pedidas <span class="count">(%s)</span>', 'Piezas Pedidas <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'piezas-recibidas', array(
        'label'                     => 'Piezas Recibidas',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'piezas-recibidas <span class="count">(%s)</span>', 'Piezas Recibidas <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'piezas-despachadas', array(
        'label'                     => 'Piezas Despachadas',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'piezas-despachadas <span class="count">(%s)</span>', 'Piezas Despachadas <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'opinion-google', array(
        'label'                     => 'Opinion en Google',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'opinion-google <span class="count">(%s)</span>', 'Opinion en Google <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'devuelto', array(
        'label'                     => 'Devuelto',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'devuelto <span class="count">(%s)</span>', 'Devuelto <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'devolucion-recibida', array(
        'label'                     => 'Devolucion Recibida',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'devolucion-recibida <span class="count">(%s)</span>', 'Devolucion Recibida <span class="count">(%s)</span>' )
    ) );

    register_post_status( 'reembolsado', array(
        'label'                     => 'Reembolsado',
        'public'                    => true,
        'show_in_admin_status_list' => true,
        'show_in_admin_all_list'    => true,
        'exclude_from_search'       => false,
        'label_count'               => _n_noop( 'reembolsado <span class="count">(%s)</span>', 'Reembolsado <span class="count">(%s)</span>' )
    ) );
 }

 function add_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['Pagado'] = 'Pagado';
            $new_order_statuses['piezas-pedidas'] = 'Piezas Pedidas';
            $new_order_statuses['piezas-recibidas'] = 'Piezas Recibidas';
            $new_order_statuses['piezas-despachadas'] = 'Piezas Despachadas';
            $new_order_statuses['opinion-google'] = 'Opinion en Google';
            $new_order_statuses['devuelto'] = 'Devuelto';
            $new_order_statuses['devolucion-recibida'] = 'Devolucion Recibida';
            $new_order_statuses['reembolsado'] = 'Reembolsado';
        }
    }
    return $new_order_statuses;
 }

function custom_email_actions ( $action ) {
	$actions[] = 'woocommerce_order_status_wc-pagado';
	$actions[] = 'woocommerce_order_status_wc-piezas-pedidas';
	$actions[] = 'woocommerce_order_status_wc-piezas-recibidas';
	$actions[] = 'woocommerce_order_status_wc-piezas-despachadas';
	$actions[] = 'woocommerce_order_status_wc-opinion-google';
	$actions[] = 'woocommerce_order_status_wc-devuelto';
	$actions[] = 'woocommerce_order_status_wc-devolucion-recibida';
	$actions[] = 'woocommerce_order_status_wc-reembolsado';
	return $actions;
}

function piezas_pedidas_mail ( $order_id, $order){
	$to = 'nicoaleore@gmail.com';
	$subject = 'Piezas Pedidas';
	$message = 'Tus piezas estan pedidas';
	
	wp_mail($to, $subject, $message);
}

add_action( 'woocommerce_order_status_wc-pagado', array( WC(), 'send_transactional_email' ), 10, 1 );
add_action( 'woocommerce_order_status_wc-piezas-pedidas', array( WC(), 'send_transactional_email' ), 10, 1 );
add_action( 'woocommerce_order_status_wc-piezas-recibidas', array( WC(), 'send_transactional_email' ), 10, 1 );
add_action( 'woocommerce_order_status_wc-piezas-despachadas', array( WC(), 'send_transactional_email' ), 10, 1 );
add_action( 'woocommerce_order_status_wc-opinion-google', array( WC(), 'send_transactional_email' ), 10, 1 );
add_action( 'woocommerce_order_status_wc-devuelto', array( WC(), 'send_transactional_email' ), 10, 1 );
add_action( 'woocommerce_order_status_wc-devolucion-recibida', array( WC(), 'send_transactional_email' ), 10, 1 );
add_action( 'woocommerce_order_status_wc-reembolsado', array( WC(), 'send_transactional_email' ), 10, 1 );

 add_action( 'init', 'register_custom_order_statuses' );
 add_filter( 'wc_order_statuses', 'add_order_statuses' );

add_action('woocommerce_order_status_wc-piezas-pedidas', 'piezas_pedidas_mail', 10, 2);*/

function shortcode_my_orders( $atts ) {
    extract( shortcode_atts( array(
        'order_count' => -1
    ), $atts ) );

    ob_start();
    wc_get_template( 'myaccount/my-orders.php', array(
        'current_user'  => get_user_by( 'id', get_current_user_id() ),
        'order_count'   => $order_count
    ) );
    return ob_get_clean();
}
add_shortcode('my_orders', 'shortcode_my_orders');

add_action( 'woocommerce_email_customer_details', 'name_to_processing_customer_email', 9999, 2 );
function name_to_processing_customer_email( $order, $is_admin_email ) {
    echo '<p>Hola, ' . $order->get_billing_first_name() . '</p>';
}

/*** Product Search Form by Category ***/
if( !function_exists( 'druco_get_search_form_by_category_fixer' ) ){
	function druco_get_search_form_by_category_fixer(){
		$enable_category = druco_get_theme_options( 'ts_search_by_category' );

		$search_for_product = class_exists('WooCommerce');
		if( $search_for_product ){
			$taxonomy = 'product_cat';
			$post_type = 'product';
			$placeholder_text = __('Buscar Productos', 'druco'); 
		} else {
			$taxonomy = 'category';
			$post_type = 'post';
			$placeholder_text = __('Search', 'druco');
		}
		?>
		<div class="ts-search-by-category <?php echo esc_attr($enable_category?'':'no-category'); ?>">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
				<?php if( $enable_category ): ?>
					<select name="term" class="select-category"><?php echo druco_search_by_category_get_option_html_fixer( $taxonomy, 0, 0 ); ?></select>
				<?php endif; ?>
				<div class="search-table">
					<div class="search-field search-content">
						<input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php echo esc_attr( $placeholder_text ); ?>" autocomplete="off" />
						<input type="hidden" name="post_type" value="<?php echo esc_attr($post_type); ?>" />
						<div class="search-button">
							<input type="submit" title="<?php esc_attr_e( 'Buscar', 'druco' );?>" value="<?php esc_attr_e('Buscar', 'druco'); ?>" />
						</div>
						<?php if( $enable_category ): ?>
							<input type="hidden" name="taxonomy" value="<?php echo esc_attr($taxonomy); ?>" />
						<?php endif; ?>
					</div>
				</div>
			</form>
		</div>
		<?php
	}
}

if( !function_exists('druco_search_by_category_get_option_html_fixer') ){
	function druco_search_by_category_get_option_html_fixer( $taxonomy = 'product_cat', $parent = 0, $level = 0 ){
		$options = '';
		$spacing = '';

		if( $level == 0 ){
			$options = '<option value="">'.esc_html__( 'Todas las categorías', 'druco' ).'</option>';
		}

		for( $i = 0; $i < $level * 3; $i ++ ) {
			$spacing .= '&nbsp;';
		}

		$args = array(
			'taxonomy'		=> $taxonomy
			,'number'		=> ''
			,'hide_empty'	=> 1
			,'orderby'		=> 'name'
			,'order'		=> 'asc'
			,'parent'		=> $parent
		);

		$select = '';
		$categories = get_terms( $args );
		if( is_search() && isset($_GET['term']) && $_GET['term'] != '' ){
			$select = $_GET['term'];
		}
		$level++;
		if( is_array($categories) ){
			foreach( $categories as $cat ){
				$options .= '<option value="'. $cat->slug .'" '. selected($select, $cat->slug, false) .'>'. $spacing . $cat->name .'</option>';
				$options .= druco_search_by_category_get_option_html_fixer( $taxonomy, $cat->term_id, $level );
			}
		}

		return $options;
	}
}

add_action('user_register', 'update_custom_meta', 10, 2);

function update_custom_meta($user_id, $userdata){
	
	$tipoDeCliente = $_POST['tipoCliente'];
	
	$user = wp_insert_user( $userdata );
	
	update_field('tipo_de_cliente', $tipoDeCliente, 'user_' . $user_id);
	
}

//Descuento para usuarios taller
//

function taller_discount(){
	$user_id = get_current_user_id();
	
	$tipoDeCliente = get_field('tipo_de_cliente', 'user_' . $user_id);
	
	if($tipoDeCliente == 'taller'){
		WC()->cart->apply_coupon($this->taller_fixer);
	} else {
		WC()->cart->remove_coupon($this->taller_fixer);
	}
}

//add_action('woocommerce_before_cart',  'taller_discount');
//add_action('woocommerce_before_checkout_form', 'taller_discount');


function fixer_tiny_cart( $show_cart_control = true, $show_cart_dropdown = true ){
		if( !class_exists('WooCommerce') ){
			return '';
		}
		$cart_empty = WC()->cart->is_empty();
		$cart_url = wc_get_cart_url();
		$checkout_url = wc_get_checkout_url();
		$cart_number = WC()->cart->get_cart_contents_count();
		ob_start();
		?>
			<div class="ts-tiny-cart-wrapper">
				<?php if( $show_cart_control ): ?>
				<div class="cart-icon">
					<a class="cart-control" href="<?php echo esc_url($cart_url); ?>" title="<?php esc_attr_e('Ver tu carrito', 'druco'); ?>">
						<span class="ic-cart"></span>
						<span class="cart-number"><?php echo esc_html($cart_number) ?></span>
						<span class="cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
					</a>
				</div>
				<?php endif; ?>
				
				<?php if( $show_cart_dropdown ): ?>
				<div class="cart-dropdown-form dropdown-container woocommerce">
					<div class="form-content">
						<?php if( $cart_empty ): ?>
							<label><svg width="150" height="150" viewBox="0 0 150 150" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M150 0H0V150H150V0Z" fill="white"/>
							<path d="M34.5824 74.3272L33.4081 68.3582C32.1926 62.179 36.9225 56.428 43.2201 56.428H131.802C138.025 56.428 142.737 62.0523 141.647 68.1798L130.534 130.633C129.685 135.406 125.536 138.882 120.689 138.882H56.6221C51.9655 138.882 47.9253 135.668 46.8782 131.13L45.1458 123.623" stroke="#808080" stroke-width="3" stroke-linecap="round"/>
							<path d="M83.5444 17.835C84.4678 16.4594 84.1013 14.5956 82.7257 13.6721C81.35 12.7486 79.4862 13.1152 78.5628 14.4908L47.3503 60.9858C46.4268 62.3614 46.7934 64.2252 48.169 65.1487C49.5446 66.0721 51.4084 65.7056 52.3319 64.33L83.5444 17.835Z" fill="#808080"/>
							<path d="M122.755 64.0173C124.189 64.8469 126.024 64.3569 126.854 62.9227C127.683 61.4885 127.193 59.6533 125.759 58.8237L87.6729 36.7911C86.2387 35.9614 84.4035 36.4515 83.5739 37.8857C82.7442 39.3198 83.2343 41.155 84.6684 41.9847L122.755 64.0173Z" fill="#808080"/>
							<path d="M34.9955 126.991C49.3524 126.991 60.991 115.352 60.991 100.995C60.991 86.6386 49.3524 75 34.9955 75C20.6386 75 9 86.6386 9 100.995C9 115.352 20.6386 126.991 34.9955 126.991Z" stroke="#808080" stroke-width="2" stroke-linejoin="round" stroke-dasharray="5 5"/>
							<path d="M30.7 100.2C30.7 99.3867 30.78 98.64 30.94 97.96C31.1 97.2667 31.3333 96.6734 31.64 96.18C31.9467 95.6734 32.3133 95.2867 32.74 95.02C33.18 94.74 33.6667 94.6 34.2 94.6C34.7467 94.6 35.2333 94.74 35.66 95.02C36.0867 95.2867 36.4533 95.6734 36.76 96.18C37.0667 96.6734 37.3 97.2667 37.46 97.96C37.62 98.64 37.7 99.3867 37.7 100.2C37.7 101.013 37.62 101.767 37.46 102.46C37.3 103.14 37.0667 103.733 36.76 104.24C36.4533 104.733 36.0867 105.12 35.66 105.4C35.2333 105.667 34.7467 105.8 34.2 105.8C33.6667 105.8 33.18 105.667 32.74 105.4C32.3133 105.12 31.9467 104.733 31.64 104.24C31.3333 103.733 31.1 103.14 30.94 102.46C30.78 101.767 30.7 101.013 30.7 100.2ZM29 100.2C29 101.6 29.22 102.84 29.66 103.92C30.1 105 30.7067 105.853 31.48 106.48C32.2667 107.093 33.1733 107.4 34.2 107.4C35.2267 107.4 36.1267 107.093 36.9 106.48C37.6867 105.853 38.3 105 38.74 103.92C39.18 102.84 39.4 101.6 39.4 100.2C39.4 98.8 39.18 97.56 38.74 96.48C38.3 95.4 37.6867 94.5534 36.9 93.94C36.1267 93.3134 35.2267 93 34.2 93C33.1733 93 32.2667 93.3134 31.48 93.94C30.7067 94.5534 30.1 95.4 29.66 96.48C29.22 97.56 29 98.8 29 100.2Z" fill="#808080"/>
							<path d="M84.6121 101.029C85.8347 99.6106 88.8961 97.625 91.3609 101.029" stroke="#808080" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M74.1953 92.2265C75.8158 92.2265 77.1296 90.9128 77.1296 89.2922C77.1296 87.6716 75.8158 86.3579 74.1953 86.3579C72.5747 86.3579 71.261 87.6716 71.261 89.2922C71.261 90.9128 72.5747 92.2265 74.1953 92.2265Z" fill="#808080"/>
							<path d="M103.538 92.226C105.159 92.226 106.472 90.9123 106.472 89.2917C106.472 87.6711 105.159 86.3574 103.538 86.3574C101.917 86.3574 100.604 87.6711 100.604 89.2917C100.604 90.9123 101.917 92.226 103.538 92.226Z" fill="#808080"/>
							</svg>
							<span><?php esc_html_e('Tu carrito está vacío', 'druco'); ?></span></label>
						<?php else: ?>
							<h3 class="theme-title"><?php echo sprintf( '%s <span>%d</span>', esc_html__('Shopping Cart', 'druco'), $cart_number ) ?></h3>
							<div class="cart-wrapper">
								<div class="cart-content">
									<ul class="cart_list">
										<?php 
										foreach( WC()->cart->get_cart() as $cart_item_key => $cart_item ):
											$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
											if ( !( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) ){
												continue;
											}
											$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
										?>
											<li class="woocommerce-mini-cart-item">
												<a class="thumbnail" href="<?php echo esc_url($product_permalink); ?>">
													<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
												</a>
												<div class="cart-item-wrapper">	
													<h3 class="product-name">
														<a href="<?php echo esc_url($product_permalink); ?>">
															<?php echo apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key); ?>
														</a>
													</h3>
													
													<span class="price"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></span>
													
													<?php 
													if( $_product->is_sold_individually() ){
														$product_quantity = '<span class="quantity">1</span>';
													}else{
														$product_quantity = woocommerce_quantity_input( array(
															'input_name'  	=> "cart[{$cart_item_key}][qty]",
															'input_value' 	=> $cart_item['quantity'],
															'max_value'   	=> $_product->get_max_purchase_quantity(),
															'min_value'   	=> '0',
															'product_name'  => $_product->get_name()
														), $_product, false );
													}

													echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
													
													echo '<div class="subtotal">'. apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) . '</div>';
													?>
													
													<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-cart_item_key="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'druco' ), $cart_item_key ), $cart_item_key ); ?>
												</div>
											</li>
										
										<?php endforeach; ?>
									</ul>
									<div class="dropdown-footer">
										<div class="total"><span class="total-title primary-text"><?php esc_html_e('Subtotal', 'druco');?></span><?php echo WC()->cart->get_cart_subtotal(); ?></div>
										
										<a href="<?php echo esc_url($cart_url); ?>" class="button view-cart">Ver Carrito</a>
										<a href="<?php echo esc_url($checkout_url); ?>" class="button checkout-button">Finalizar Compra</a>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		<?php
		return ob_get_clean();
	}
	
	function fixer_tiny_account( $show_dropdown = true ){
		$login_url = '#';
		$register_url = '#';
		$profile_url = '#';
		$logout_url = wp_logout_url(get_permalink());
		
		if( class_exists('WooCommerce') ){
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $myaccount_page_id ) {
			  $login_url = get_permalink( $myaccount_page_id );
			  $register_url = $login_url;
			  $profile_url = $login_url;
			}		
		}
		else{
			$login_url = wp_login_url();
			$register_url = wp_registration_url();
			$profile_url = admin_url( 'profile.php' );
		}
		
		$_user_logged = is_user_logged_in();
		ob_start();
		
		?>
		<div class="ts-tiny-account-wrapper">
			<div class="account-control">
			
				<?php if( !$_user_logged ): ?>
					<a class="login" href="<?php echo esc_url($login_url); ?>" title="<?php esc_attr_e('Mi cuenta', 'druco'); ?>"><?php echo esc_html__( 'Ingresar/Registrarse', 'druco' ); ?></a>
				<?php else: ?>
					<a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php esc_attr_e('Mi Cuenta', 'druco'); ?>"><?php echo esc_html__( 'Mi Cuenta', 'druco' ); ?></a>
				<?php endif; ?>
				
				<?php if( $show_dropdown ): ?>
				<div class="account-dropdown-form dropdown-container">
					<div class="form-content">
						
						<?php if( !$_user_logged ): ?>
							<?php wp_login_form( array(
								'form_id' 			=> 'ts-login-form',
								'label_username' 	=> '',
								'label_password'	=> '',
								'label_log_in'		=> esc_html__( 'Ingresar', 'druco')
							) ); ?>
						<?php else: ?>
							<ul>
								<?php do_action('druco_before_my_account_dropdown_list'); ?>
								<li><a class="my-account" href="<?php echo esc_url($profile_url); ?>"><?php esc_html_e( 'Mi Cuenta', 'druco' ); ?></a></li>
								<li><a class="log-out" href="<?php echo esc_url($logout_url); ?>"><?php esc_html_e( 'Salir', 'druco' ); ?></a></li>
							</ul>
						<?php endif; ?>
						
					</div>
				</div>
				<?php endif; ?>
				
			</div>
		</div>
		
		<?php
		return ob_get_clean();
}

function fixer_apply_coupon_empresa(){
	$user_id = get_current_user_id();
	
	$user_type = get_field('tipo_de_cliente', 'user_' . $user_id);
	
	//$user_type = get_field('tipo_de_cliente', $user_id);
	
	$coupon_code = 'taller_fixer';
	
	var_dump('LLALALALALALALALALALA');
	
	if($user_type && $user_type == 'Empresa'){
		
        WC()->cart->apply_coupon( $coupon_code );
        wc_print_notices();
	}
}

add_action( 'woocommerce_before_cart', 'fixer_apply_coupon_empresa' );