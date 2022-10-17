<?php 
/*
* Template Name: Wishlist page
*/
get_header();?>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php echo do_shortcode('[yith_wcwl_wishlist]');?>
                </div>
            </div>
        </div>
    </section>
  
   
<?php get_footer();?>