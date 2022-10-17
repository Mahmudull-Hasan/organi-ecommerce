<?php

if ( site_url() == "http://localhost/ecommerce-site") {
    define( "VERSION", time());
} else {
    define( "VERSION", wp_get_theme()->get( "Version" ) );
}

function organi_theme_setup() {

    load_theme_textdomain('organi', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');

    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'organi')
    ));

}
add_action('after_setup_theme', 'organi_theme_setup');

function organi_ecommerce_assets(){

    wp_enqueue_style( 'font-poppins', '//fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap', array(), '1.0.0', 'all' );

    wp_enqueue_style('font-awesome-css', get_theme_file_uri('/assets/css/font-awesome.min.css'), array(), '1.0', 'all');
    wp_enqueue_style('bootstrap-min-css', get_theme_file_uri('/assets/css/bootstrap.min.css'), array(), '1.0', 'all');
    wp_enqueue_style('elegant-icons-css', get_theme_file_uri('/assets/css/elegant-icons.css'), array(), '1.0', 'all');
    wp_enqueue_style('nice-select-css', get_theme_file_uri('/assets/css/nice-select.css'), array(), '1.0', 'all');
    wp_enqueue_style('jquery-ui-min-css', get_theme_file_uri('/assets/css/jquery-ui.min.css'), array(), '1.0', 'all');
    wp_enqueue_style('owl-carousel-min-css', get_theme_file_uri('/assets/css/owl.carousel.min.css'), array(), '1.0', 'all');
    wp_enqueue_style('slicknav-min-css', get_theme_file_uri('/assets/css/slicknav.min.css'), array(), '1.0', 'all');
    wp_enqueue_style('style-css', get_theme_file_uri('/assets/css/style.css'), array(), VERSION, 'all');
    wp_enqueue_style( "main-css", get_stylesheet_uri(), null, VERSION );


    //wp js scripts//

    wp_enqueue_script('jquery-min-js', get_theme_file_uri('/assets/js/jquery-3.3.1.min.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('bootstrap-min-js', get_theme_file_uri('/assets/js/bootstrap.min.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery-nice-select-min-js', get_theme_file_uri('/assets/js/jquery.nice-select.min.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery-ui-min-js', get_theme_file_uri('/assets/js/jquery-ui.min.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('jquery-slicknav-js', get_theme_file_uri('/assets/js/jquery.slicknav.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('mixitup-min-js', get_theme_file_uri('/assets/js/mixitup.min.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('owl-carousel-min-js', get_theme_file_uri('/assets/js/owl.carousel.min.js'), array('jquery'), '1.0.0', true);
    wp_enqueue_script('main-js', get_theme_file_uri('/assets/js/main.js'), array('jquery'), VERSION, true);
}
add_action('wp_enqueue_scripts', 'organi_ecommerce_assets');

/**
 * Change number or products per row to 3
 */

if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}
add_filter('loop_shop_columns', 'loop_columns', 999);


// Display the Woocommerce Discount Percentage on the Sale Badge for variable products and single products
add_filter( 'woocommerce_sale_flash', 'display_percentage_on_sale_badge', 20, 3 );
function display_percentage_on_sale_badge( $html, $post, $product ) {

  if( $product->is_type('variable')){
      $percentages = array();

      // This will get all the variation prices and loop throughout them
      $prices = $product->get_variation_prices();

      foreach( $prices['price'] as $key => $price ){
          // Only on sale variations
          if( $prices['regular_price'][$key] !== $price ){
              // Calculate and set in the array the percentage for each variation on sale
              $percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
          }
      }
      // Displays maximum discount value
      $percentage = max($percentages) . '%';

  } elseif( $product->is_type('grouped') ){
      $percentages = array();

       // This will get all the variation prices and loop throughout them
      $children_ids = $product->get_children();

      foreach( $children_ids as $child_id ){
          $child_product = wc_get_product($child_id);

          $regular_price = (float) $child_product->get_regular_price();
          $sale_price    = (float) $child_product->get_sale_price();

          if ( $sale_price != 0 || ! empty($sale_price) ) {
              // Calculate and set in the array the percentage for each child on sale
              $percentages[] = round(100 - ($sale_price / $regular_price * 100));
          }
      }
     // Displays maximum discount value
      $percentage = max($percentages) . '%';

  } else {
      $regular_price = (float) $product->get_regular_price();
      $sale_price    = (float) $product->get_sale_price();

      if ( $sale_price != 0 || ! empty($sale_price) ) {
          $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
      } else {
          return $html;
      }
  }
  return '<div class="product__discount__percent">' . esc_html__( '-', 'woocommerce' ) . $percentage . '</div>'; // If needed then change or remove "up to -" text
}


// Quantity button//
add_action( 'woocommerce_after_add_to_cart_quantity', 'ts_quantity_plus_sign' );
 
function ts_quantity_plus_sign() {
   echo '<button type="button" class="plus" >+</button>';
}
 
add_action( 'woocommerce_before_add_to_cart_quantity', 'ts_quantity_minus_sign' );

function ts_quantity_minus_sign() {
   echo '<button type="button" class="minus" >-</button>';
}
 
add_action( 'wp_footer', 'ts_quantity_plus_minus' );
 
function ts_quantity_plus_minus() {
   // To run this on the single product page
   if ( ! is_product() ) return;
   ?>
   <script type="text/javascript">
          
      jQuery(document).ready(function($){   
          
            $('form.cart').on( 'click', 'button.plus, button.minus', function() {
 
            // Get current quantity values
            var qty = $( this ).closest( 'form.cart' ).find( '.qty' );
            var val   = parseFloat(qty.val());
            var max = parseFloat(qty.attr( 'max' ));
            var min = parseFloat(qty.attr( 'min' ));
            var step = parseFloat(qty.attr( 'step' ));
 
            // Change the value if plus or minus
            if ( $( this ).is( '.plus' ) ) {
               if ( max && ( max <= val ) ) {
                  qty.val( max );
               } 
            else {
               qty.val( val + step );
                 }
            } 
            else {
               if ( min && ( min >= val ) ) {
                  qty.val( min );
               } 
               else if ( val > 1 ) {
                  qty.val( val - step );
               }
            }
             
         });
          
      });
          
   </script>
   <?php
}

// ACF Options Page Settings//

// Organi Theme options page start here//

function acf_option_init() {

    // Check function exists.
    if( function_exists('acf_add_options_page') ) {
        // Register options page.
        $parent = acf_add_options_page(array(
            'page_title'    => __('Theme Options', 'organi'),
            'menu_title'    => __('Theme Options', 'organi'),
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));

        // Add Header setting page.
        $child = acf_add_options_page(array(
            'page_title'  => __('Header Options ', 'organi'),
            'menu_title'  => __('Header settings', 'organi'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add footer settings page.
        $child = acf_add_options_page(array(
            'page_title'  => __('Footer Options ', 'organi'),
            'menu_title'  => __('Footer settings', 'organi'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add Home page settings.
        $child = acf_add_options_page(array(
            'page_title'  => __('Home Page ', 'organi'),
            'menu_title'  => __('Home page settings', 'organi'),
            'parent_slug' => $parent['menu_slug'],
        ));

        // Add Contact page settings.
        $child = acf_add_options_page(array(
            'page_title'  => __('Contact Page ', 'organi'),
            'menu_title'  => __('Contact page settings', 'organi'),
            'parent_slug' => $parent['menu_slug'],
        ));
    }
}
add_action('acf/init', 'acf_option_init');


// Sidebar Register
function organi_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Recent Post Widget', 'organi' ),
        'id'            => 'recent-post',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'organi' ),
        'before_widget' => '<ul id="%1$s" class="widget %2$s">',
        'after_widget'  => '</ul>',
        'before_title'  => '<h4 class="blog__sidebar__recent__item__text">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Woocommerce Widget', 'organi' ),
        'id'            => 'woocommerce',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'organi' ),
        'before_widget' => '<ul id="%1$s" class="widget %2$s">',
        'after_widget'  => '</ul>',
        'before_title'  => '<h6>',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'organi' ),
        'id'            => 'footer-1',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'organi' ),
        'before_widget' => '<ul id="%1$s" class="widget %2$s">',
        'after_widget'  => '</ul>',
        'before_title'  => '<h6>',
        'after_title'   => '</h6>',
    ) );
}
add_action( 'widgets_init', 'organi_widgets_init' );

// Disables the block editor from managing widgets in the Gutenberg plugin.
// add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
//  Disables the block editor from managing widgets.
// add_filter( 'use_widgets_block_editor', '__return_false' );


//Letest Posts Widget part//

class Recent_Post_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'recent-post-widget',  // Base ID
            __('Recent Post Widget')   // Name
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'Recent_Post_Widget' );
        });
 
    }
 
    public function widget( $args, $instance ) {

        $widget_id = 'widget_'. $args['widget_id'];
        $post_show_count = get_field('post_show_count', $widget_id);
        $post_order = get_field('post_order', $widget_id);
        $post_show_date = get_field('post_show_date', $widget_id);

        echo $args['before_widget'];
 
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>
            <div class="blog__sidebar__item">
                <div class="blog__sidebar__recent">
                <?php 
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $post_show_count,
                        'order' => $post_order
                    );
                    $query = new WP_Query($args);
                    while($query->have_posts()){
                        $query->the_post();
                ?>
                    <a href="<?php the_permalink();?>" class="blog__sidebar__recent__item">
                        <div class="blog__sidebar__recent__item__pic">
                            <img src="<?php the_post_thumbnail_url();?>" alt="">
                        </div>
                        <div class="blog__sidebar__recent__item__text">
                            <h6><?php the_title();?></h6>
                            
                            <?php
                                if($post_show_date){
                            ?>
                                <span><?php echo get_the_date(); ?></span>
                            <?php
                                }
                            ?>
                            
                        </div>
                    </a>
                    
                    <?php
                        }
                    ?>
                </div>
            </div>

        <?php
 
    }
 
    public function form( $instance ) {
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'bealfast' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'text_domain' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
       
 
        return $instance;
    }
 
}
$recent_post_widget = new Recent_Post_Widget();
