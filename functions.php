<?php
/*
Plugin Name:  Smart
Plugin URI:   https://smart.com/
Description:  smart Description 
Version:      1.0
Author:       smart
Text Domain:  smart
*/
/*----------------ADD CUSTOM STYLE AND SCRIPT--------------*/

function add_my_custom_scripts()
{
    wp_enqueue_style('google-fonts-style',"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");

    wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('responsive-style', get_stylesheet_directory_uri() . '/assets/css/responsive.css');
    wp_enqueue_style('owl.carousel.min-style', get_stylesheet_directory_uri() . '/assets/css/owl.carousel.min.css');

    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'));
    wp_enqueue_script('carousel-js', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'));
    wp_enqueue_style('blog-style', get_stylesheet_directory_uri() . '/assets/css/blog.css');


}
add_action('wp_enqueue_scripts', 'add_my_custom_scripts');

/*----------------THEME PANEL--------------*/
function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Theme panel</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("Theme-panel");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}

function add_theme_menu_item()
{
	add_menu_page("Theme panel", "Theme panel", "manage_options", "theme-panel", "theme_settings_page", null, 99);
    
}

add_action("admin_menu", "add_theme_menu_item");


function display_facebook_element()
{
	?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_youtube_element()
{
	?>
    	<input type="text" name="youtube_url" id="youtube_url" value="<?php echo get_option('youtube_url'); ?>" />
    <?php
}

function display_instagram_element()
{
	?>
    	<input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" />
    <?php
}

function display_twitter_element()
{
	?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_address_element()
{
	?>
    	<input type="text" name="address" id="address" value="<?php echo get_option('address'); ?>" />
    <?php
}
function display_phoneno_element()
{
	?>
    	<input type="text" name="phoneno" id="phoneno" value="<?php echo get_option('phoneno'); ?>" />
    <?php
}
function display_email_element()
{
	?>
    	<input type="text" name="email" id="email" value="<?php echo get_option('email'); ?>" />
    <?php
}
function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "Theme-panel");
	add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "Theme-panel", "section");
    add_settings_field("youtube_url", "youtube Profile Url", "display_youtube_element", "Theme-panel", "section");
    add_settings_field("instagram_url", "instagram Profile Url", "display_instagram_element", "Theme-panel", "section");
    add_settings_field("twitter_url", "twitter Profile Url", "display_twitter_element", "Theme-panel", "section");   
    add_settings_field("phoneno", "phoneno", "display_phoneno_element", "Theme-panel", "section");
	add_settings_field("email", "email", "display_email_element", "Theme-panel", "section");
	add_settings_field("address", "address", "display_address_element", "Theme-panel", "section");
   
    
    register_setting("section", "facebook_url");
    register_setting("section", "youtube_url");
    register_setting("section", "instagram_url");
    register_setting("section", "twitter_url");  
    register_setting("section", "address");
    register_setting("section", "phoneno");
	register_setting("section", "email");
 
    
}

add_action("admin_init", "display_theme_panel_fields");


/*----------shortcode for social link---------*/

function my_sociallink()
{
    ob_start();
	?>
	<ul class="socialicon-link" >
		<?php
			if(!get_option('facebook_url')=='')
			{
		?>
		<li class="facebook" ><a href="<?php echo esc_attr( get_option('facebook_url') ); ?>" target="_blank" ><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
		<?php
	         }
		?>

        <?php
            if(!get_option('youtube_url')=='')
            {
        ?>
        <li class="youtube" ><a href="<?php echo esc_attr( get_option('youtube_url') ); ?>" target="_blank" ><i class="fa fa-youtube"></i><span>Youtube</span></a></li>
        <?php
            }
        ?>
		
        <?php
			if(!get_option('instagram_url')=='')
			{
		?>
		<li class="instagram" ><a href="<?php echo esc_attr( get_option('instagram_url') ); ?>" target="_blank" ><i class="fa fa-instagram"></i><span>Instagram</span></a></li>
		<?php
	        }
		?>
		
        <?php
            if(!get_option('twitter_url')=='')
            {
        ?>
        <li class="twitter" ><a href="<?php echo esc_attr( get_option('twitter_url') ); ?>" target="_blank" ><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
        <?php
            }
        ?>      
        
	</ul>
	<?php
    return ob_get_clean();
}


add_shortcode('sociallink','my_sociallink');

/*------------SHORTCODE FOR CONTACT DETAILS-----------*/

function my_contact()
{
    ?>
    <ul class='contact'>
    <?php

            if(!get_option('address')=='')
            {
            ?>
            <li class="address" > <i class="fa fa-map-marker" ><p>ADDRESS</p></i><p>
            <?php  echo esc_attr( get_option('address') );?></p></li>
            <?php
            }?>

        <?php
            if(!get_option('phoneno')=='')
            {
        ?>
        <li class="phoneno" ><i class="fa-solid fa-phone-volume"><p>PHONE</p></i><a href="tel:<?php  echo esc_attr( get_option('phoneno') );?>">
       <p> <?php  echo esc_attr( get_option('phoneno') );?></a></p></li>
        <?php
            }?>
        
            <?php        
            if(!get_option('email')=='')
            {
        ?>
        <li class="email" ><i class="fa fa-envelope"><p>EMAIL</p></i><a href="mailto:<?php  echo esc_attr( get_option('email') );?>">
       <p> <?php  echo esc_attr( get_option('email') );?></a></p></li>
        <?php
            }
        ?>
        
       
        </ul>
        <?php
        
}

add_shortcode('contactlink','my_contact');

/*------------SHORTCODE FOR CONTACT---------------*/
function my_contact1()
{
    ?>
    <div class='contact'>
        <p>WE ARE AVAILABLE 18 HRS. A DAY, SEVEN DAYS A WEEK, 365 DAYS A YEAR.</p>
    </div>
    

        <?php
            if(!get_option('phoneno')=='')
            {
        ?>
        <div class="fa-solid fa-phone-volume">
            </div>
        <div class="phone-wrap">
        <div class="call-phone">
            <p>PHONE</p></div>
            <div class="phone-no">
            <a href="tel:<?php  echo esc_attr( get_option('phoneno') );?>">
        <?php  echo esc_attr( get_option('phoneno') );?></a>
    </div>
        <?php
            }?>
            </div>
        
            <?php        
            if(!get_option('email')=='')
            {
        ?>
        <div class="fa fa-envelope">
            </div>
        <div class="email-wrap">
        <div class="e-mail">    
            <p>EMAIL</p></div>
        <div class="email-link">
            <a href="mailto:<?php  echo esc_attr( get_option('email') );?>">
        <?php  echo esc_attr( get_option('email') );?></a>
            </div>
        <?php
            }
        ?>
              
        
        <?php
        
}

add_shortcode('contactdetails','my_contact1');

/*-----------SERVICE CPT-----------------*/
function create_service_posttype()
{
    register_post_type(
        'service',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Services'),
                'singular_name' => __('Service')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Service'),
            'show_in_rest' => true,
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_service_posttype');

/*Creating a function to create our CPT*/
function custom_post_type1()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Service', 'Post Type General Name', 'neve-child'),
        'singular_name'       => _x('Service', 'Post Type Singular Name', 'neve-child'),
        'menu_name'           => __('Service', 'neve-child'),
        'parent_item_colon'   => __('Service', 'neve-child'),
        'all_items'           => __('All Our Service', 'neve-child'),
        'view_item'           => __('View Our Service', 'neve-child'),
        'add_new_item'        => __('Add New Service', 'neve-child'),
        'add_new'             => __('Add New', 'neve-child'),
        'edit_item'           => __('Edit Our Service', 'neve-child'),
        'update_item'         => __('Update OurService', 'neve-child'),
        'search_items'        => __('Search Our Service', 'neve-child'),
        'not_found'           => __('Not Found', 'neve-child'),
        'not_found_in_trash'  => __('Not found in Trash', 'neve-child'),
    );

    // Set other options for Custom Post Type 
    $args = array(
        'label'               => __('Service', 'neve-child'),
        'description'         => __('our service reviews', 'neve-child'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'custom-fields', 'thumbnail', 'excerpt'),
        'taxonomies'          => array('genres'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );
    register_post_type('Service', $args);
}
add_action('init', 'custom_post_type1', 0);

/*----------GET SERVICE POST TYPE---------------*/
function get_our_service()
{
    $args = array('post_type' => 'service', 'posts_per_page' => '5', 'publish_status' => 'published',);
        $result = "";

    $query = new WP_Query($args);
    if ($query->have_posts()):
        $result .= "<div class='service-release owl-carousel'>";
        while ($query->have_posts()):
            $query->the_post();
            //$content = wp_trim_words(get_the_content(), 80);

            $result .= '<div class="service-release-section">';

            //$result .= '<div class="service-thumbnail">' . get_the_post_thumbnail() . '</div>';
           //$result .= '<div class="service-title"><h2>' . get_the_title() . '</h2></div>';
           $result .='<div><a href="' .get_the_permalink() . '">'. get_the_post_thumbnail().'</div>';
           $result .='<div class = service-content>';
           $result .= '<div><a href="' .get_the_permalink() . '"><h2>'. get_the_title() .'</h2></a></div>';
           $result .= '<div> '. get_field('title') .' </div>';    
           $result .= '</div>';
       
            //$result .= '<div class="service-title">' . get_field('title'). '</div>';
            //$result .= '<div class="service-content">' . $content . '</div>';
           
            $result .= '</div>';

        endwhile;
        wp_reset_postdata();
        $result .= "</div>";

    endif;
    return $result;
}
add_shortcode('get_our_service', 'get_our_service');


function my_phone()
{
    ob_start();
    ?>
        <?php
            if(!get_option('phoneno')=='')
            {
        ?>
        <div class="fa-solid fa-phone-volume">
            </div>
        <div class="phone-wrap" >
        <div class="call-now">
            <p>CALL NOW</p></div>
        <div class="phone-no" >
            <a href="tel:<?php  echo esc_attr( get_option('phoneno') );?>">
        <?php  echo esc_attr( get_option('phoneno') );?></a>
    </div>
        <?php
            }?>
        </div>
        
        <?php
        return ob_get_clean();
}
add_shortcode('my_phone','my_phone');

/*----------------------TESTIMONIAL CPT--------------------*/
function create_testimonial_posttype()
{
    register_post_type(
        'testimonial',
        // CPT Options
        array(
            'labels' => array(
                'name' => __('Testimonial'),
                'singular_name' => __('Testimonial')
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Testimonial'),
            'show_in_rest' => true,
        )
    );
}
// Hooking up our function to theme setup
add_action('init', 'create_testimonial_posttype');

/*Creating a function to create our CPT*/
function custom_post_type2()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Testimonial', 'Post Type General Name', 'neve-child'),
        'singular_name'       => _x('Testimonial', 'Post Type Singular Name', 'neve-child'),
        'menu_name'           => __('Testimonial', 'neve-child'),
        'parent_item_colon'   => __('Testimonial', 'neve-child'),
        'all_items'           => __('All Our Testimonial', 'neve-child'),
        'view_item'           => __('View Our Testimonial', 'neve-child'),
        'add_new_item'        => __('Add New Testimonial', 'neve-child'),
        'add_new'             => __('Add New', 'neve-child'),
        'edit_item'           => __('Edit Our Testimonial', 'neve-child'),
        'update_item'         => __('Update Our Testimonial', 'neve-child'),
        'search_items'        => __('Search Our Testimonial', 'neve-child'),
        'not_found'           => __('Not Found', 'neve-child'),
        'not_found_in_trash'  => __('Not found in Trash', 'neve-child'),
    );

    // Set other options for Custom Post Type 
    $args = array(
        'label'               => __('Testimonial', 'neve-child'),
        'description'         => __('our testimonial reviews', 'neve-child'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'custom-fields', 'thumbnail', 'excerpt'),
        'taxonomies'          => array('genres'),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,

    );
    register_post_type('Testimonial', $args);
}
add_action('init', 'custom_post_type2', 0);

/*********************GET TESTIMONIALS*************/

function get_our_testimonial()
{
    $args = array('post_type' => 'testimonial', 'posts_per_page' => '-1', 'publish_status' => 'published',);
       $result = "";

    $query = new WP_Query($args);
    if ($query->have_posts()):
         $result .= "<div class='testimonial-release owl-carousel'>";
        while ($query->have_posts()):
            $query->the_post();
            $content = wp_trim_words(get_the_content(), 80);

            $result .= '<div class="testimonial-release-section">';
            $rating = get_field('rating');
            $html = '';
            for ($x = 0; $x < $rating; $x++) {
                $html .= '<i class="fa fa-star" aria-hidden="true"></i>';
            }
            for ($x = 0; $x < 5-$rating; $x++) {
                $html .=  '<i class="fa fa-star-o" aria-hidden="true"></i>';
            }
            $result .= '<div class="testimonial-rating">' . $html. '</div>';
            $result .= '<div class="testimonial-content">' . $content . '</div>';           
            
            $result .='<div class="testimonial-wrap">';
            
            $result .= '<div class="testimonial-thumbnail">' . get_the_post_thumbnail() . '</div>'; 
            $result .='<div class="testimonial-review">';           
            $result .= '<div class="testimonial-title"><h2>' . get_the_title() . '</h2></div>';
            $result .= '<div class="testimonial-designation">' . get_field('designation'). '</div>';
            $result .='</div>';
            $result .='</div>';         
            $result .='</div>';
                        
        endwhile;
        wp_reset_postdata();
        $result .= "</div>";

    endif;
    return $result;
}
add_shortcode('get_our_testimonial', 'get_our_testimonial');

/*---------------Breadcrumb uppercase to lower----------------*/

add_filter( 'wpseo_breadcrumb_links' ,'wpseo_remove_breadcrumb_link');
function wpseo_remove_breadcrumb_link( $links ){
    global $post;   
    //print_r($links);
    foreach($links as $k=>$link){
        $new_v = ucwords(strtolower($link['text']));
        $links[$k]['text']= $new_v;
        if(basename($links[$k]['url'])=='Service'){
			$links[$k]['url']="#";
		}
    }    
        return $links;
}

/*-----Theme panel for blog banner--------------*/

function theme_settings_page_blog()
{
    ?>
<div class="wrap">
    <h1>Theme Panel</h1>
    <form method="post" action="options.php" enctype="multipart/form-data">
        <?php
	            settings_fields("section_blog");
	            do_settings_sections("theme-options_blog");      
	            submit_button(); 
	    ?>
    </form>
</div>
<?php
}
function add_theme_menu_item_blog()
{
    add_menu_page("Theme Panel Blog", "Theme Panel - Blog", "manage_options", "theme-panel_blog", "theme_settings_page_blog", null, 99);
}
add_action("admin_menu", "add_theme_menu_item_blog");

function site_logo_image_display()
{
    ?>
    <input type="hidden" name="ocopy_card_image" value="<?php echo get_option('copy_card_image'); ?>" readonly />
    <input type="file" name="copy_card_image" id="copy_card_image" />
    <label>Current selected image</label>
    <img src="<?php echo get_option('copy_card_image'); ?>" alt="No image selected" />
<?php
}

function handle_site_logo_image()
{
    if(isset($_FILES["copy_card_image"]) && !empty($_FILES['copy_card_image']['name']))
    {
        $urls = wp_handle_upload($_FILES["copy_card_image"], array('test_form' => FALSE));
        $temp = $urls["url"];
       return $temp;
    }
 elseif(isset($_FILES["copy_card_image"]) && empty($_FILES['copy_card_image']['name'])){
  $urls = $_POST["ocopy_card_image"];
  return $urls;
 }
   return $option;
}

function display_theme_panel_fields_blog()
{
    add_settings_section("section_blog", "All Settings", null, "theme-options_blog");
    
    add_settings_field("copy_card_image", "Card Image", "site_logo_image_display", "theme-options_blog", "section_blog");  
    
    
    register_setting("section_blog", "copy_card_image", "handle_site_logo_image");
}
add_action("admin_init", "display_theme_panel_fields_blog");


