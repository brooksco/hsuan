<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
		<!-- <main id="main" class="site-main" role="main"> -->


		<?php
		$portfolios = new WP_Query( array(
			'post_type' => 'portfolio', 
			'orderby' => 'menu_order',
            'order' => 'ASC') 
		);
		if ( $portfolios->have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif; ?>

			<div class="grid">
  				<div class="grid-sizer"></div>

			<?php
			/* Start the Loop */
			while ( $portfolios->have_posts() ) : $portfolios->the_post(); ?>
			<div class="grid-item <?php 
					$categories = get_the_category(); 
						foreach ($categories as $value) {
							$name = str_replace(' ', '', $value->name);
							echo $name;
						}
					?>">
					<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
				<div class="grid-content">
					<h3><?php the_title(); ?></h3>
					<p><?php the_excerpt(); ?></p>
				</div>
				</a>
				</div>

				<?php/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				// get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			</div>

			<?php
			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		<!-- </main> -->
	</div><!-- #primary -->

  </div>
</div>

<?php
// get_sidebar();
get_footer();
