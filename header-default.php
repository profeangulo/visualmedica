<?php

    global  $custom_header_layout,
            $custom_header_navigation_style,
            $custom_header_navigation_alignment,
            $custom_header_logo,
            $custom_header_search,
            $custom_header_search_icon,
            $custom_header_cart,
            $custom_header_cart_icon,
            $custom_header_user_account,
            $custom_header_user_account_icon,
            $custom_header_wishlist,
            $custom_header_wishlist_icon,
            $custom_header_transparent,
            $custom_header_transparent_scheme,
            $custom_header_transparent_light_logo,
            $custom_header_transparent_dark_logo,
            $custom_shop_category_transparency,
            $yith_wcwl;



            /*******************************************/
            /********** Header Transparency Logo *******/
            /*******************************************/

            $original_logo = $custom_header_logo; // preserve original logo in case we need to switch back to it

            if ($custom_header_transparent == 1)
            {
                if ($custom_header_transparent_scheme == 'light')
                {
                    $custom_header_logo = $custom_header_transparent_light_logo;
                }
                else 
                {
                    $custom_header_logo = $custom_header_transparent_dark_logo;
                }
            }

            if (GETBOWTIED_WOOCOMMERCE_IS_ACTIVE && is_product_category())
            {
                switch ($custom_shop_category_transparency) {
                    case 'inherit':
                        // Do nothing
                        break;

                    case 'no_transparency':
                        $custom_header_logo = $original_logo;
                        break;
                    
                    case 'transparency_light':
                        $custom_header_logo = $custom_header_transparent_light_logo;
                        break;
                    
                    case 'transparency_dark':
                        $custom_header_logo = $custom_header_transparent_dark_logo;
                        break;
                }
            }

            $page_header_transparency = get_post_meta( getbowtied_page_id(), 'page_header_transparency', true );

            switch ( $page_header_transparency ) {        
                case "inherit":
                    // do nothing
                    break;
                case "transparency_light":
                    $custom_header_logo = $custom_header_transparent_light_logo;
                    break;
                case "transparency_dark":
                    $custom_header_logo = $custom_header_transparent_dark_logo;
                    break;
                case "no_transparency":
                    $custom_header_logo = $original_logo;
                    break;
                default:

                    break;
            }
?>

<?php

$header_navigation_alignment = "align_left";

if ( $custom_header_layout == "header_1" ) :
    $header_navigation_alignment = $custom_header_navigation_alignment;
endif;

?>

<header class="site-header"> 
        
    <div class="header-wrapper">

        <?php ob_start(); ?>

        <div class="nav">

            <?php
            if ( $custom_header_navigation_style == "flyout" ) :
            ?>

                <nav class="main-navigation-flyout <?php echo ent2ncr($header_navigation_alignment); ?>" >                    
                    <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'fallback_cb'    => false,
                            'container'      => false,
                            'items_wrap'     => '<ul class="%1$s">%3$s</ul>',
                        ));
                    ?>
                </nav>

            <?php
            elseif ( $custom_header_navigation_style == "slices" ) :
            ?>

                <nav class="main-navigation-slices" >                    
                    <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'fallback_cb'    => false,
                            'container'      => false,
                            'items_wrap'     => '<ul class="%1$s">%3$s</ul>',
                        ));
                    ?>
                </nav>

            <?php 
            endif;
            ?>

        </div>

        <?php
		$col_navigation = ob_get_clean();
		?>

        <?php ob_start(); ?>

        <div class="site-branding">

            <?php if ( ! empty( $custom_header_logo ) ) : ?>

                <div class="site-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <img src="<?php echo esc_url( $custom_header_logo ); ?>" alt="<?php echo bloginfo('name'); ?>">
                    </a>

                    <?php if ( ! empty( $original_logo ) ): ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="sticky-header-logo">
                            <img src="<?php echo esc_url( $original_logo ); ?>" alt="<?php echo bloginfo('name'); ?>">
                        </a>
                    <?php else: ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="sticky-header-logo">
                            <img src="<?php echo esc_url( $custom_header_logo ); ?>" alt="<?php echo bloginfo('name'); ?>">
                        </a>
                    <?php endif; ?>
                </div>

            <?php else : ?>

                <div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>

            <?php endif; ?>

        </div>

        <?php
		$col_branding = ob_get_clean();
		?>

		<?php

		switch ( $custom_header_layout ) {
			               
            case "header_1":
                echo ent2ncr($col_branding);
                echo ent2ncr($col_navigation);                
                break;
            case "header_2":
                echo ent2ncr($col_navigation);
                echo ent2ncr($col_branding);
                break;

        }

		?>

        <div class="tools">
            
            <ul>

            	<!-- Wishlist Button -->
                <?php if ( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) : ?>
                <?php if ( GETBOWTIED_WISHLIST_IS_ACTIVE ) : ?>
                <?php if ( $custom_header_wishlist == '1' ) : ?>
                
                <li class="wishlist-button">
                    <a class="tools_button" href="<?php echo esc_url($yith_wcwl->get_wishlist_url()); ?>">
                        
                        <?php if ( $custom_header_wishlist_icon != "" ) : ?>
                            <?php $ext = explode('.', $custom_header_wishlist_icon); ?>
                           
                            <?php if (in_array('svg', $ext)): ?>
                                <span class="tools_button_icon uploaded_icon">
                                    <?php echo getbowtied_get_local_file_contents($custom_header_wishlist_icon); ?>
                                </span>
                            <?php else: ?>
                                <span class="tools_button_icon uploaded_icon">
                                    <img src="<?php echo esc_url($custom_header_wishlist_icon); ?>">
                                </span>                                
                            <?php endif; ?>
                        
                        <?php else : ?>
                            
                            <span class="tools_button_icon wishlist-icon"></span>

                        <?php endif; ?>
                        
                        <span class="wishlist_items_number"><?php echo yith_wcwl_count_products(); ?></span>

                    </a>
                </li>

                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>
                
                <!-- Search Button -->
                <?php if ( $custom_header_search == '1' ) : ?>
                
                <li class="search-button">
                    <a class="tools_button">
                        
                            
                            <?php if ( $custom_header_search_icon != "" ) : ?> 
                                <?php $ext = explode('.', $custom_header_search_icon); ?>
                           
                                <?php if (in_array('svg', $ext)): ?>
                                    <span class="tools_button_icon uploaded_icon">
                                        <?php echo getbowtied_get_local_file_contents($custom_header_search_icon); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="tools_button_icon uploaded_icon">
                                        <img src="<?php echo esc_url($custom_header_search_icon); ?>">
                                    </span>                                
                                <?php endif; ?>

                        
                            <?php else: ?>
                                
                                <span class="tools_button_icon search-icon"></span>

                            <?php endif; ?>

                        
                    </a>
                </li>

                <?php endif; ?>

                <!-- Shopping Bag Button -->
                <?php if ( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) : ?>
                <?php if ( $custom_header_cart == '1' ) : ?>
                
                <li class="shopping-bag-button">
                    <a class="tools_button" href="<?php echo esc_url(wc_get_cart_url()); ?>">
                        
                        <?php if ( $custom_header_cart_icon != "" ) : ?>
                            <?php $ext = explode('.', $custom_header_cart_icon); ?>
                           
                            <?php if (in_array('svg', $ext)): ?>
                                <span class="tools_button_icon uploaded_icon">
                                    <?php echo getbowtied_get_local_file_contents($custom_header_cart_icon); ?>
                                </span>
                            <?php else: ?>
                                <span class="tools_button_icon uploaded_icon">
                                    <img src="<?php echo esc_url($custom_header_cart_icon); ?>">
                                </span>                                
                            <?php endif; ?>
                        
                        <?php else : ?>
                            
                            <span class="tools_button_icon shopping-cart-icon"></span>

                        <?php endif; ?>
                        
                        <span class="shopping_bag_items_number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>

                    </a>
                </li>

                <?php endif; ?>
                <?php endif; ?>

                <!-- My Account -->
                <?php if ( GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ) : ?>
                <?php if ( $custom_header_user_account == '1' ) : ?>
                
                <li class="my-account-button">
                    
                    <?php if ( is_user_logged_in() ) : ?>
                        <div class="myaccount-dropdown">
                            <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="tools_button">
                                
                                <?php if ( $custom_header_user_account_icon != "" ) : ?>
                                
                                    <?php $ext = explode('.', $custom_header_user_account_icon); ?>
                           
                                    <?php if (in_array('svg', $ext)): ?>
                                        <span class="tools_button_icon uploaded_icon">
                                            <?php echo getbowtied_get_local_file_contents($custom_header_user_account_icon); ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="tools_button_icon uploaded_icon">
                                            <img src="<?php echo esc_url($custom_header_user_account_icon); ?>">
                                        </span>                                
                                    <?php endif; ?>
                                
                                <?php else : ?>
                                    
                                    <span class="tools_button_icon account-icon"></span>

                                <?php endif; ?>
                                
                            </a>
                            <ul>
                                <li class="avatar">
                                <?php 
                                    $id = get_current_user_id( ); 
                                    echo get_avatar($id, '40');
                                ?>
                                </li>
                                <?php 
                                    wp_nav_menu(array(
                                        'theme_location' => 'my-account',
                                        'fallback_cb'    => false,
                                        'container'      => false,
                                        'items_wrap'     => '%3$s'
                                    ));
                                ?>
                                <li>
                                    <a href="<?php echo wp_logout_url( home_url() ); ?>" class="logout">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                            width="16" height="16"
                                            viewBox="0 0 24 24">    
                                            <path d="<?php echo GBT_MC_Icons::getIcon('logout'); ?>"></path>
                                        </svg>
                                        <?php esc_html_e('Logout', 'woocommerce'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a class="tools_button my-account-login-button" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                            
                            <?php if ( $custom_header_user_account_icon != "" ) : ?>
                            
                                <?php $ext = explode('.', $custom_header_user_account_icon); ?>
                       
                                <?php if (in_array('svg', $ext)): ?>
                                    <span class="tools_button_icon uploaded_icon">
                                        <?php echo getbowtied_get_local_file_contents($custom_header_user_account_icon); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="tools_button_icon uploaded_icon">
                                        <img src="<?php echo esc_url($custom_header_user_account_icon); ?>">
                                    </span>                                
                                <?php endif; ?>
                            
                            <?php else : ?>
                                
                                <span class="tools_button_icon account-icon"></span>

                            <?php endif; ?>
                            
                        </a>
                    <?php endif; ?>

                </li>
                
                <?php endif; ?>
                <?php endif; ?>

            </ul>

        </div>

    </div>

    <div class="search_wrapper">

	    <div class="getbowtied_search_bar">
	        <?php 
	            GETBOWTIED_WOOCOMMERCE_IS_ACTIVE ? get_product_search_form() : get_search_form(true); 
	        ?>
	    </div>

	    <ul class="search-widget-area widget-area adjust_cols_height">
	        <?php dynamic_sidebar( 'search-widget-area' ); ?>
	    </ul>

    </div>

    <?php if ( ! is_user_logged_in() && GETBOWTIED_WOOCOMMERCE_IS_ACTIVE && !(is_account_page()) && !(is_checkout()) ) : ?>
        <?php remove_action( 'woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10 ); ?>
        <div class="myaccount-popup">
            <div class="woocommerce-account">
                <div class="woocommerce">
                <?php wc_get_template( 'myaccount/form-login.php' ); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

</header>