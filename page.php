<!-- function to get header.php -->
<?php get_header(); ?>

<div cless="loop-container">
<!-- WP loop required code gets the page content -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <!-- gets page title -->
    <h2><?php the_title(); ?></h2>
    <!-- gets page content -->
    <?php the_content(); ?>
    <!-- end of while WP loop-->
    <?php endwhile; ?>
    <!-- end if of WP loop -->
<?php endif; ?>
</div>

<!-- function to get footer.php -->
<?php get_footer(); ?>