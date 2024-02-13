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