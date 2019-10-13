<?php
/** 
* Sample code of plugin
* @package Plugin-mk2n
*/
/* 
* Plugin Name:mk2n
* Version: 1.0.0
* Author: ABDUL RIYAS
 */
 
 if(! defined('ABSPATH'))
 {
	 die ;
 }
 
 class mk2n
	{
		function __construct()
		{
			
		}
		
		public static function init() {
			static $instance = false;
			if ( ! $instance ) {
				$instance = new mk2n();
			}
			return $instance;
		}
			
		function register()
		{	
			add_action( 'woocommerce_loaded',array(  $this, 'mk2n_load' ) );
			add_action( 'admin_menu',array( $this , 'mk2n_admin_menu' ));
			add_action( 'admin_menu', array( $this, 'settings_menu' ), 50 );
			
			add_filter( 'dokan_query_var_filter',array( $this, 'dokan_load_document_menu' ) );
			add_filter( 'dokan_get_dashboard_nav', array( $this, 'dokan_add_customize_menu' ) );
			add_action( 'dokan_load_custom_template',array( $this,'dokan_load_template' ));	
			add_action( 'mk2n_customize_content', array( $this, 'load_customize_content' ), 10 );
			add_action( 'dokan_store_profile_saved', array( $this, 'save_customized_data' ), 10, 2 );





.........
.........
.........
.........
.........
.........










		//executes after woocommerce load
		function mk2n_load(){
			if ( class_exists('Woocommerce')) {
				require_once  __DIR__ . '/functions.php';
				remove_action( 'woocommerce_view_order','woocommerce_order_details_table' ,10 ) ;
				//remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
			}
		}
		// save grapesjs editor_html_data and product ID
		function insert_html_info(){
			
			$store_id 	   = dokan_get_current_user_id();
			$profile_info  = dokan_get_store_info($store_id);
			
			$mk2n_settings 	= stripslashes(isset( $_POST['html'] )? $_POST['html'] : '');
								/* 'gjs-css'   		=> isset( $_POST['gjs-css'] )? $_POST['gjs-css'] : '',
								'gjs-html'          => isset( $_POST['gjs-html'] )? $_POST['gjs-html'] : '',
								'gjs-assets'   		=> isset( $_POST['gjs-assets'] )? $_POST['gjs-assets'] : '',
								'gjs-components'   	=> isset( $_POST['gjs-components'] )? $_POST['gjs-components'] : '',
								'gjs-styles'   		=> isset( $_POST['gjs-styles'] )? $_POST['gjs-styles'] : '');
								  */  
			$pid 		   	=  isset( $_POST['product'] )? $_POST['product'] : '';		
			
			update_user_meta( $store_id, 'editor_html_data', $mk2n_settings );
			update_user_meta( $store_id, 'editor_pid', $pid );
			
		}
		//add service option for products in product edit form
		function service_product_edit_form( $post, $post_id ){
			$product_options 		= get_post_meta( $post_id, 'product_options',true );	?>
			
			<script>
			
				var insert	= 	'<div class="dokan-form-group dokan-product-type-container show_if_simple">\
									<div class="content-half-part downloadable-checkbox">\
										<label>\
											<input type="radio"  class="_is_downloadable" id="normal" name="product_options" value="normal" ' + `<?php echo ($product_options == 'normal')?'checked':'' ?>` + ' > ' + `<?php _e( 'Normal Product', 'mk2n' ); ?>` + '\
										</label>\
									</div>\
									<div class="content-half-part virtual-checkbox">\
										<label>\
											<input type="radio"  class="_is_virtual" id="service" name="product_options" value="service" ' + ` <?php echo ($product_options == 'service')?'checked':'' ?>` + ' > ' + `<?php _e( 'Service Product', 'mk2n' ); ?>` + '\
										</label>\
									</div>\
									<div class="dokan-clearfix"></div>\
								</div>'
				$( insert ).insertAfter( ".dokan-product-type-container" );
				
			</script>	
  <?php	}
		
		//save product choice value of product edit page
		function mk2n_save_edit_product(){
			if ( isset( $_POST['product_options'] ) && !empty( $_POST['product_options'] ) ) {
				update_post_meta( $product_id, 'product_options', $product_option);
			}	
		}



........
........
........
........
........








	function enqueue()
		{
			wp_enqueue_style('mystyle',plugins_url('/assets/mystyle.css',__FILE__));
			wp_enqueue_script('myscript',plugins_url('/assets/myscript.js',__FILE__));
		}
	}
	
 if(class_exists('mk2n'))
	{
		$mk2n = new mk2n("new parameter");
		$mk2n-> register();
		
		add_action('init', array($mk2n, 'initialize'));
	}
	
	//activation
	register_activation_hook(__FILE__,array($mk2n,'activate'));
	
	//deactivation
	register_deactivation_hook(__FILE__,array($mk2n,'deactivate'));
?>
