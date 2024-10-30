<?php
/**
 * Plugin Name: LH Browser Shots
 * Plugin URI: https://lhero.org/portfolio/lh-browser-shots/
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 * Version: 2.00
 * Description: This plugin allows you to take browser screenshots of remote sites, via wp-admin or bookmarklet.
 * Text Domain: lh_browser_shots
 * Domain Path: /languages
*/


if (!class_exists('LH_browser_shots_plugin')) {

class LH_browser_shots_plugin {

    private static $instance;
    var $upload_result = false;

    static function return_plugin_namespace(){

        return 'lh_browser_shots';

    }

    static function return_file_name(){
        
        return plugin_basename( __FILE__ );    
        
    }

    static function return_service_url(){
        
        return apply_filters(self::return_plugin_namespace().'_return_service_url', 'https://s0.wordpress.com/mshots/v1/');    
    
    }



    static function reconstruct_url($url){
        
        $url_parts = parse_url($url);
        $constructed_url = $url_parts['scheme'] . '://' . $url_parts['hostname'] . $url_parts['path'];
    
        return $constructed_url;
    }


    static function return_bookmarklet_string(){
    
        $return = "javascript: (function() { window.location.href='";
        $return .= admin_url( 'upload.php?page='.self::return_file_name());
        $return .="&lh_browser_shots-file_url=' + encodeURIComponent(location.href) +";
        $return .="'&lh_browser_shots-file_width=' + window.innerWidth +";
        $return .="'&lh_browser_shots-file_height=' + window.innerHeight;";
        $return .="})();";
        
        return $return;
    
    }

    static function handle_upload($upload_url, $original_url){

        if (current_user_can('upload_files')){

            if (empty($_POST['lh_browser_shots-nonce']) or !wp_verify_nonce( $_POST['lh_browser_shots-nonce'], "lh_browser_shots-file_url")) {
                
		        return new WP_Error(self::return_plugin_namespace(), 'Could not verify request nonce');
		        
	        }

            $response = wp_remote_get($upload_url);

            //Neeed to sleep the script to give the api time to generate the image
            
            sleep(6);

            $desc = "Browser shot of ".$original_url;

            if (!class_exists('LH_copy_from_url_class')) {
            
                include_once("includes/lh-copy-from-url-class.php");
            
            }


            $attachment_id = LH_copy_from_url_class::save_external_file($upload_url,0, $desc);

            return $attachment_id;


        } else {

            return new WP_Error(self::return_plugin_namespace(), __('User does not have permission', self::return_plugin_namespace()));

        }

    }


    /**
	* Get Browser Screenshot
	*
	* Get a screenshot of a website using WordPress
	*
	* @param string $url Url of screenshot.
	* @param int    $width Width of screenshot.
	* @param int    $height Height of screenshot.
	* @return string
	*/
		 
	static function get_shot( $url = '', $width = 600, $height = 450 ) {

			// Image found.
			if ( '' !== $url ) {

				$query_args = array(
					'w' => intval( $width ),
					'h' => intval( $height ),
				);

				return add_query_arg( $query_args, self::return_service_url() . urlencode( esc_url( $url ) ) );

			}

			return '';

		}



    public function add_browser_shot() {

        global $pagenow;

        //Check to make sure we're on the right page and performing the right action
        if( 'upload.php' != $pagenow ){
	
	       return false;

        } elseif ( empty( $_POST[ 'lh_browser_shots-file_url' ] ) ){

            return false;
		
        } else {

            $original_url = esc_url(sanitize_text_field($_POST['lh_browser_shots-file_url']));
            $width = sanitize_text_field($_POST['lh_browser_shots-file_width']);
            $height = sanitize_text_field($_POST['lh_browser_shots-file_height']);
    
            $upload_url = self::get_shot( $original_url, $width, $height);
            
    
            $return = self::handle_upload($upload_url, $original_url);

            if ( is_wp_error( $return ) ) {

                $this->upload_result = $return;

            } else {

                //Upload has succeeded, redirect to mediapage

                wp_safe_redirect( admin_url( 'post.php?post='.$return.'&action=edit') );
                exit();

            }

        }
	
    }

    public function plugin_menu() {
    
        add_media_page(__('LH Add Browser Shot', self::return_plugin_namespace()), __('Add browser shot', self::return_plugin_namespace()), 'upload_files', self::return_file_name(), array($this,"plugin_options"));
    
    }

    public function plugin_options() {
    
        if (!current_user_can('upload_files')){
        
            wp_die( __('You do not have sufficient permissions to access this page.', self::return_plugin_namespace()) );
        
        }

        include ('partials/upload.php');

    }

    public function plugin_init(){
    
        add_action('admin_menu', array($this,"plugin_menu"));
        add_action( 'admin_init', array($this,"add_browser_shot"));    
        
    }


    /**
     * Gets an instance of our plugin.
     *
     * using the singleton pattern
     */
     
    public static function get_instance(){
        
        if (null === self::$instance) {
            
            self::$instance = new self();
            
        }
 
        return self::$instance;
        
    }




    public function __construct() {
    
        //run our hooks on plugins loaded to as we may need checks       
        add_action( 'plugins_loaded', array($this,'plugin_init'));
    
    }

}

$lh_browser_shots_instance = LH_browser_shots_plugin::get_instance();

}


?>