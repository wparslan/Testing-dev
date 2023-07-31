<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$description = get_the_archive_description();
$args = array(
    'post_type' => 'project', // Change 'post' to your custom post type if needed
    'posts_per_page' => 6, // Number of items to display per page (change this value)
    'paged' => $paged,
);

$archive_query = new WP_Query($args);

if ($archive_query->have_posts()) : ?>

	<header class="page-header alignwide">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>
	</header><!-- .page-header -->

	<?php while ( $archive_query->have_posts() ) : ?>
		<?php $archive_query->the_post(); ?>
		<?php get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) ); ?>
	<?php endwhile; ?>

	<?php twenty_twenty_one_the_posts_navigation(); ?>

<?php else : ?>
	<?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php
wp_reset_postdata();
get_footer();
