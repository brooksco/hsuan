<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package hsuan
 */

get_header(); ?>

<div class="row">
	<div id="sidebarContainer" class="small-12 medium-3 columns">
		<?php get_sidebar(); ?>
	</div>
	<div id="mainContainer" class="small-12 medium-9 columns">

		<div id="primary" class="content-area">


			<?php
			while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			endwhile; // End of the loop.
			?>


		</div><!-- #primary -->
	</div>
</div>

<?php
get_footer();
