    			<?php 

    			global 	$custom_footer_sticky,
                        $custom_back_to_top,
                        $custom_footer_copyright;

    			?>

                <div class="site-content-overlay"></div>

                </div><!-- .site-content -->

                <?php if ( 0 == $custom_footer_sticky ) : ?>
    			<?php get_template_part( 'footer', 'default' ); ?>
    			<?php endif; ?>

    		</div><!-- .page-wrapper -->

    	</div><!-- .offcanvas_main_content -->

        <!-- OffCanvas Aside Content Left -->
        <div class="offcanvas_aside offcanvas_aside_left">
            <div class="offcanvas_aside_content">
            	<?php get_template_part( 'offcanvas', 'left' ); ?>
            </div>
        </div>

        <!-- OffCanvas Aside Content Right -->
        <div class="offcanvas_aside offcanvas_aside_right">        
            <div class="offcanvas_aside_content">
            	<?php get_template_part( 'offcanvas', 'right' ); ?>
            </div>
        </div>

        <?php if ( 1 == $custom_footer_sticky ) : ?>
    	<?php get_template_part( 'footer', 'default' ); ?>
    	<?php endif; ?>

        <div class="offcanvas_overlay"></div>

    </div><!-- .offcanvas_container -->
	
	<a href="https://api.whatsapp.com/send?phone=573133838727" target="_blank" id="solicitar-cotizacion">Solicitar Cotización</a>

    <!-- ******************************************************************** -->
    <!-- * Back To Top Button *********************************************** -->
    <!-- ******************************************************************** -->

    <?php if ($custom_back_to_top == 1) :?>
        <a href="#0" class="cd-top"></a>
    <?php endif; ?>

    <?php wp_footer(); ?>
	
	<!-- FancyApps - Fancybox -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</body>
</html>