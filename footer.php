 <!-- Footer Section Begin -->
 <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <?php 
                                $footer_logo = get_field('footer_logo', 'option');
                            ?>
                            <a href="<?php echo site_url();?>"><img src="<?php echo $footer_logo['url'];?>" alt=""></a>
                        </div>
                        <ul>
                            <?php echo the_field('footer_address', 'option');?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <?php 
                            if(is_active_sidebar('footer-1')){
                             dynamic_sidebar('footer-1');
                            }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6><?php the_field('newsletter_title', 'option');?></h6>
                        <p><?php the_field('newsletter_description', 'option');?></p>
                        <div >
                            <?php echo do_shortcode('[contact-form-7 id="157" title="Contact form 1"]');?>
                        </div>
                        <div class="footer__widget__social">
                            <?php 
                                $footer_socials = get_field('footer_socials', 'option');
                                foreach($footer_socials as $social){
                            ?>
                                <a href="<?php echo $social['url'];?>"><i class="fa <?php echo $social['icon'];?>"></i></a>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <?php the_field('copyright_text', 'option');?>
                            </p>
                        </div>
                        <div class="footer__copyright__payment">
                            <?php 
                                $payment_img = get_field('payment_image', 'option');
                            ?>
                            <img src="<?php echo $payment_img['url'];?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->


<?php wp_footer();?>

</body>

</html>