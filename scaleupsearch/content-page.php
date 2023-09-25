<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked in to ogeko_page action
	 *
	 * @see ogeko_page_header          - 10
	 * @see ogeko_page_content         - 20
	 *
	 */
	do_action( 'ogeko_page' );
	?>
</article><!-- #post-## -->
