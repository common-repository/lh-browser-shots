<h1><?php _e( 'Browser Shots', self::return_plugin_namespace() ); ?></h1>

<?php
        if (!empty($this->upload_result)){

            if ( is_wp_error( $this->upload_result) ) {

                foreach ( $this->upload_result->get_error_messages() as $error ) {

                    echo '<strong>ERROR</strong>: ';
                    echo $error . '<br/>';

                }

            } 

        }

        if (!empty($_POST[ 'lh_browser_shots-file_url' ])){

            $url = $_POST['lh_browser_shots-file_url'];

        } elseif (isset($_GET['lh_browser_shots-file_url'])){

            $url = $_GET['lh_browser_shots-file_url'];
        
        }

        if (!empty($_POST[ 'lh_browser_shots-file_width' ])){

            $width = $_POST['lh_browser_shots-file_width'];

        } elseif (isset($_GET['lh_browser_shots-file_width'])){

            $width = $_GET['lh_browser_shots-file_width'];

        } else {

            $width = "600";

        }

        if (!empty($_POST[ 'lh_browser_shots-file_height' ])){

            $height = $_POST['lh_browser_shots-file_height'];

        } elseif (isset($_GET['lh_browser_shots-file_height'])){

            $height = $_GET['lh_browser_shots-file_height'];

        } else {

            $height = "450";

        }

?>

<form method="post">
<p>
<label for="lh_browser_shots-file_url"><?php echo __( 'URL', self::return_plugin_namespace() );  ?>: </label>
  <input type="url" name="lh_browser_shots-file_url" id="lh_browser_shots-file_url" value="<?php if (isset($url)){ echo $url; } ?>" size="50" required="required" />
<label for="lh_browser_shots-file_width"><?php echo __( 'Width', self::return_plugin_namespace() );  ?>: </label>
<input type="number" name="lh_browser_shots-file_width" id="lh_browser_shots-file_width" value="<?php echo $width; ?>" size="4" required="required" />
<label for="lh_browser_shots-file_height"><?php  echo __( 'Height', self::return_plugin_namespace() );  ?>: </label>
<input type="number" name="lh_browser_shots-file_height" id="lh_browser_shots-file_height" value="<?php echo $height; ?>" size="4" required="required" />
<input type="submit" value="Submit" /> 
</p>
<input type="hidden" value="<?php echo wp_create_nonce("lh_browser_shots-file_url"); ?>" name="lh_browser_shots-nonce" id="lh_browser_shots-nonce" />

</form>

<?php if (!isset($value)){  ?>

<h4><?php echo __( 'Bookmarklet', self::return_plugin_namespace() );  ?></h4>
<p><?php echo __( 'Drag the bookmarklet below to your bookmarks bar. Then, when you find a file online you want to upload, simply Upload it.', self::return_plugin_namespace() );  ?></p>


<a title="<?php _e('Bookmark this link', self::return_plugin_namespace()); ?>" href="<?php  echo self::return_bookmarklet_string(); ?>"><?php echo __( 'Upload Browser Shot to', self::return_plugin_namespace() );  ?> <?php echo bloginfo("name"); ?></a>


<br/><?php echo __( 'or edit your bookmarks and paste the below code', self::return_plugin_namespace() );  ?><br/>

<?php echo self::return_bookmarklet_string(); ?>
<?php } ?>