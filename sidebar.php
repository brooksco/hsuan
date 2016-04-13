<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hsuan
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<!-- <?php bloginfo( 'name' ); ?> -->
<h1 id="siteTitle"><a href="<?php echo esc_url( home_url() ); ?>"><?php 

// Set it so that blog title gets split to new lines for each word
$title = get_bloginfo('name');
$titleArray = explode(" ", $title);

if (count($titleArray) > 1) {

	foreach ($titleArray as $word) {
		echo $word;
		echo " <br>";
	}

} else {
	bloginfo('name'); 
}

?></a></h1>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
		<?php esc_html_e( 'Primary Menu', 'hsuan' ); ?>
	</button> -->
	
	<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primaryMenu' ) ); ?>

	<ul id="categoryList">
		<li class="categoryFilter" data-slug="all-works">All Works</li>
		<?php

		$allPortfolios = new WP_Query( array(
					'post_type' => 'portfolio', 
					'orderby' => 'menu_order',
            		'order' => 'ASC'
					) );

		echo '<li id="allChildCategoryContainer" class="childCategoryContainer"><ul class="childCategoryList">';
			while ( $allPortfolios->have_posts() ) : $allPortfolios->the_post(); ?>

			<li><a class='allCategoryA' href='<?php the_permalink(); ?>'><?php the_title(); ?></a></li>

			<?php endwhile;
		echo '</ul></li>';


		$categories = get_categories(); 
		foreach ($categories as $value) {

			if ($value->name != "Uncategorized") {
				echo "<li class='categoryFilter' data-slug='" . $value->slug . "'>" . $value->name . "</li>";

				$portfolios = new WP_Query( array(
					'post_type' => 'portfolio', 
					'category_name' => $value->slug,
					'orderby' => 'menu_order',
            		'order' => 'ASC'
					) );

				echo '<li class="childCategoryContainer"><ul class="childCategoryList">';
				while ( $portfolios->have_posts() ) : $portfolios->the_post(); ?>

				<li><a href='<?php the_permalink(); ?>'><?php the_title(); ?></a></li>

				<?php endwhile;
				echo '</ul></li>';
			}
		}

		?>
	</ul>

</nav><!-- #site-navigation -->
