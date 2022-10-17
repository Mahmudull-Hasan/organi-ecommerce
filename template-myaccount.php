<?php 
/*
* Template Name: My Account page
*/
get_header();?>
    <section class="breadcrumb-section" style="background-image: url(<?php echo get_template_directory_uri();?>/assets/img/breadcrumb.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>My Account</h2>
                            <div class="breadcrumb__option">
                                <a href="./index.html">Home</a>
                                <span>My Account</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
  
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                <?php echo do_shortcode('[woocommerce_my_account]');?>
                </div>
            </div>
        </div>
    </section>
   
<?php get_footer();?>