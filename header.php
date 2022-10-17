<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    

  <?php wp_head();?>
  <?php global $woocommerce;?>
</head>

<body <?php body_class();?> >
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <?php  $img = get_field('logo', 'options');?>
            <a href="<?php echo site_url();?>"><img src="<?php echo $img['url'] ?>" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li>
                    <a href="<?php echo get_page_link(106);?>"><i class="fa fa-heart"></i> 
                        <span>
                            <?php
                                $count = 0;
                                    if( function_exists( 'yith_wcwl_count_products' ) ){
                                        echo $count = yith_wcwl_count_products();
                                    }
                                ?>                                      
                        </span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo wc_get_cart_url();?>"><i class="fa fa-shopping-bag"></i> 
                        <span>
                            <?php 
                                $total = $woocommerce->cart->get_cart_contents_count();
                                if($total){
                                    echo $total;
                                }else{
                                    echo '0';
                                }
                            ?>
                        </span>
                    </a>
                </li>
            </ul>
            <div class="header__cart__price">item:
                <?php 
                    $total_ammount = $woocommerce->cart->get_cart_total();
                    if($total_ammount){
                ?>
                    <span><?php echo $total_ammount;?></span>
                <?php                                   
                    }else{
                        echo '0';
                    }
                ?>
            </div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>
            <div class="header__top__right__auth">
                <a href="#"><i class="fa fa-user"></i> 
                    <?php
                        if ( is_user_logged_in() ) {
                            $current_user = wp_get_current_user();
                            echo $current_user->display_name ;
                        } else {
                    ?>
                        <a href="<?php echo esc_url( wp_login_url() ); ?>">
                            <?php _e( 'Login', 'organi' );?>
                        </a>
                    <?php
                        }
                    ?>
                </a>
            </div>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu'
                ));
            ?>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <?php 
                $header_socials = get_field('header_socials', 'option');
                foreach ($header_socials as $social) {
            ?>
                <a href="<?php echo $social['icon_url'];?>"><i class="fa <?php echo $social['icon'];?>"></i></a>
            <?php
                }
            ?>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> <?php the_field('email', 'option');?></li>
                <li><?php the_field('message', 'option');?></li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <?php the_field('email', 'option');?></li>
                                <li><?php the_field('message', 'option');?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <?php 
                                    $header_socials = get_field('header_socials', 'option');
                                    foreach ($header_socials as $social) {
                                ?>
                                    <a href="<?php echo $social['icon_url'];?>"><i class="fa <?php echo $social['icon'];?>"></i></a>
                                <?php
                                    }
                                ?>
                            </div>
                            <div class="header__top__right__language">
                                <img src="img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                
                                <?php
                                    if ( is_user_logged_in() ) {
                                        $current_user = wp_get_current_user();
                                        echo $current_user->display_name ;
                                    } else {
                                ?>
                                    <a href="<?php echo esc_url( wp_login_url() ); ?>">
                                        <?php _e( 'Login', 'organi' );?>
                                    </a>
                                <?php
                                    }
                                ?>
                                
                                <!-- <a href="#"><i class="fa fa-user"></i> Login</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                            <?php  $img = get_field('logo', 'option');?>
                            <a href="<?php echo site_url();?>"><img src="<?php echo $img['url'] ?>" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <?php 
                                wp_nav_menu(array(
                                    'theme_location' => 'primary-menu',
                                ))
                            ?>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="<?php echo get_page_link(106);?>"><i class="fa fa-heart"></i> 
                                    <span>
                                        <?php
                                            $count = 0;
                                                if( function_exists( 'yith_wcwl_count_products' ) ){
                                                   echo $count = yith_wcwl_count_products();
                                                }
                                            ?>                                      
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo wc_get_cart_url();?>"><i class="fa fa-shopping-bag"></i> 
                                    <span>
                                        <?php 
                                            $total = $woocommerce->cart->get_cart_contents_count();
                                            if($total){
                                                echo $total;
                                            }else{
                                                echo '0';
                                            }
                                        ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="header__cart__price">item:
                            <?php 
                                $total_ammount = $woocommerce->cart->get_cart_total();
                                if($total_ammount){
                            ?>
                                <span><?php echo $total_ammount;?></span>
                            <?php                                   
                                }else{
                                    echo '0';
                                }
                            ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->