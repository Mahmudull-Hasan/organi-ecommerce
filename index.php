<?php get_header();?>

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <?php
                                $args = array(
                                    'taxonomy'=> 'product_cat',
                                    'hide_empty'=> true,
                                );
                                $cats = get_categories($args);
                                foreach ($cats as $cat) {
                            ?>
                                <li><a href="<?php echo get_term_link($cat->slug, 'product_cat');?>"><?php echo $cat->cat_name;?></a></li>
                            <?php
                                }
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5><?php the_field('number', 'option');?></h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="<?php echo get_template_directory_uri();?>/assets/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?php _e('Blog', 'organi')?></h2>
                        <div class="breadcrumb__option">
                            <a href="<?php echo site_url();?>">Home</a>
                            <span><?php _e('Blog', 'organi')?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <?php 
                                    foreach ($cats as $cat) {
                                ?>
                                    <li><a href="<?php echo $cat->slug;?>"><?php echo $cat->name;?></a></li>
                                <?php
                                        
                                    }
                                ?>
                            </ul>
                        </div>
                        <?php if(is_active_sidebar('recent-post')){
                            dynamic_sidebar('recent-post');
                        };?>
                        <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <?php if($tags = get_the_tags()){
                                    foreach($tags as $tag) {
                                ?>
                                    <a href="<?php echo $tag->slug;?>"><?php echo $tag->name;?></a>
                                <?php
                                                                   
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="row">
                        <?php
                            $args = array(
                                'post_type' =>'post',
                                'posts_per_page'=> 6
                            );
                            $query = new WP_Query($args);
                            while($query->have_posts()){
                                $query->the_post();
                        ?>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="blog__item">
                                <div class="blog__item__pic">
                                    <img src="<?php the_post_thumbnail_url();?>" alt="">
                                </div>
                                <div class="blog__item__text">
                                    <ul>
                                        <li><i class="fa fa-calendar-o"></i><?php echo get_the_date('F j, Y');?></li>
                                        <li><i class="fa fa-comment-o"></i><?php echo get_comments_number();?></li>
                                    </ul>
                                    <h5><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
                                    <p><?php the_excerpt();?> </p>
                                    <a href="<?php the_permalink();?>" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            wp_reset_postdata();
                        ?>
                        <div class="col-lg-12">
                            <div class="product__pagination blog__pagination">
                                <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <?php get_footer();?>