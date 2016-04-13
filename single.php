<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package hsuan
 */

get_header(); ?>

<div class="row">
	<div id="sidebarContainer" class="small-12 medium-3 columns">
		<?php get_sidebar(); ?>
	</div>


	<div id="mainContainer" class="small-12 medium-9 columns">

		<?php while ( have_posts() ) : the_post(); ?>
				
			<div class="titleContainer">
				<header class="titleSticky">
				<?php echo get_the_post_navigation(array(
						'prev_text' => '< prev', 
						'next_text' => 'next >'
						));
						?>
					<h1 id="portfolioTitle"><?php the_title(); ?></h1>

					</header>
				</div>

		<div id="pageContainer" class="content-area">



				<?php the_content();

		endwhile; // End of the loop.
		?>

	</div><!-- #primary -->
</div>
</div>


<?php
get_sidebar();
get_footer();
