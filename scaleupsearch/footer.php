
		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'ogeko_before_footer' );
    if (ogeko_is_elementor_activated() && function_exists('hfe_init') && (hfe_footer_enabled() || hfe_is_before_footer_enabled())) {
        do_action('hfe_footer_before');
        do_action('hfe_footer');
    } else {
        ?>

        <footer id="colophon" class="site-footer" role="contentinfo">
            <?php
            /**
             * Functions hooked in to ogeko_footer action
             *
             * @see ogeko_footer_default - 20
             *
             *
             */
            do_action('ogeko_footer');

            ?>

        </footer><!-- #colophon -->

        <?php
    }

		/**
		 * Functions hooked in to ogeko_after_footer action
		 * @see ogeko_sticky_single_add_to_cart 	- 999 - woo
		 */
		do_action( 'ogeko_after_footer' );
	?>

</div><!-- #page -->

<?php

/**
 * Functions hooked in to wp_footer action
 * @see ogeko_template_account_dropdown 	- 1
 * @see ogeko_mobile_nav - 1
 */

wp_footer();
?>
</body>
</html>
