<?php
// ================================== //
// ========= CORE FUNCTIONS ========= //
// ================================== //


// SVG Icons
function svgi($icon){
  return '<svg class="svgi svgi-' . $icon . '"><use xlink:href="' . get_bloginfo('template_url') . '/svg/icons.svg#' . $icon . '"></use></svg>';
}

function e_svgi($icon){
  echo svgi($icon);
}



// Clean up phone numbers for links
function cleanPhoneNum($phone){
  $phone = preg_replace('/[-|(|)| |+]/', '', $phone);
  $phone = str_replace('ext.', ',', $phone);
  $phone = str_replace('ext', ',', $phone);

  return $phone;
}



// Yoast SEO - Add title tag support (needed!)
add_theme_support('title-tag');


// Yoast SEO - Keep Yoast metabox at the bottom when editing pages
function yoasttobottom(){return 'low';}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


// WP Super Cache - Add "Delete Cache" button in toolbar
function only_show_option_if_wp_super_cache_is_active() {
    if (is_plugin_active('wp-super-cache/wp-cache.php')) {
        function clear_all_cached_files_wpsupercache() {
            global $wp_admin_bar;
            if (!is_super_admin() || !is_admin_bar_showing())
                return;
      $args = array(
        'id' => 'delete-cache-completly',
        'title' => 'Clear Cache',
        'href' => wp_nonce_url(admin_url('options-general.php?page=wpsupercache&wp_delete_cache=1&tab=contents'), 'wp-cache'),
        'parent' => '',
        'meta' => array(
            'title' => 'Clear all cached files of WP Super Cache'
         )
      );
            $wp_admin_bar->add_menu($args);
        }
        add_action('wp_before_admin_bar_render', 'clear_all_cached_files_wpsupercache', 999);
    }
}
add_action('admin_init', 'only_show_option_if_wp_super_cache_is_active');


// Add menus capability
function register_my_menus(){register_nav_menus(array('my-menu'=>'Main Menu'));}
add_action( 'init', 'register_my_menus' );


// Add thumbnail support for posts
add_theme_support( 'post-thumbnails', array( 'post' ) );


// Add Editor Style
add_editor_style( get_stylesheet_directory_uri() . '/build/css/styles.min.css' );
add_editor_style( get_stylesheet_directory_uri() . '/build/css/editor.min.css' );


// Remove emoji code from header
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );


// Disable automatic updates email notification
apply_filters( 'auto_core_update_send_email', '__return_false');


// Set default admin theme for new users
function set_default_admin_color($user_id){ $args = array( 'ID' => $user_id, 'admin_color' => 'midnight' ); wp_update_user( $args ); }
add_action('user_register', 'set_default_admin_color');


// Add taxonomy filters for all CPTs in admin
add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {
    global $typenow, $post, $post_id;

    if( $typenow != "page" && $typenow != "post" ){
        // get post type
        $post_type = get_query_var('post_type');

        // get taxonomy associated with current post type
        $taxonomies = get_object_taxonomies($post_type);

        // in next loop add filter for tax
        if ($taxonomies) {
            foreach ($taxonomies as $tax_slug) {
                $tax_obj = get_taxonomy($tax_slug);
                $tax_name = $tax_obj->labels->name;
                $terms = get_terms($tax_slug);
                echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                echo "<option value=''>Show All $tax_name</option>";
                foreach ($terms as $term) {
                    $label = (isset($_GET[$tax_slug])) ? $_GET[$tax_slug] : '';
                    echo '<option value='. $term->slug, $label == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
                }
                echo "</select>";
            }
        }
    }
}


// Show page templates in page list
add_filter( 'manage_pages_columns', 'page_column_views' );
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );
function page_column_views( $defaults )
{
   $defaults['page-layout'] = __('Template');
   return $defaults;
}
function page_custom_column_views( $column_name, $id )
{
   if ( $column_name === 'page-layout' ) {
       $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
       if ( $set_template == 'default' ) {
           echo 'Default';
       }
       $templates = get_page_templates();
       ksort( $templates );
       foreach ( array_keys( $templates ) as $template ) :
           if ( $set_template == $templates[$template] ) echo $template;
       endforeach;
   }
}


// Replace howdy with "Logged in as" in the WP bar
function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', 'Logged in as', $my_account->title );
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );


// Keep categories in meta box box in hierarchical order
function taxonomy_checklist_checked_ontop_filter ($args){
    $args['checked_ontop'] = false;
    return $args;
}
add_filter('wp_terms_checklist_args','taxonomy_checklist_checked_ontop_filter');


// Remove WP icon from admin bar
function annointed_admin_bar_remove(){
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
  $wp_admin_bar->remove_menu('comments');
  $wp_admin_bar->remove_menu('wpseo-menu');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);


// Remove empty <p> tags from the_content()
add_filter('the_content', 'remove_empty_p', 20, 1);
function remove_empty_p($content){
    $content = force_balance_tags($content);
    return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}

// Remove <p> tag wraps for images
function remove_img_ptags($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'remove_img_ptags');
?>
