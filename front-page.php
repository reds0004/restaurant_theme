
<!-- Include the header -->
<?php get_header(); ?>
<div class="main-container">
<!-- hero -->
<?php
$hero_image = get_theme_mod('custom_hero_image-1', get_theme_file_uri('/imgs/cheers-hero.jpg'));
$hero_image2 = get_theme_mod('custom_hero_image-2', get_theme_file_uri('/imgs/charcuterie-hero.jpg'));
$hero_image3 = get_theme_mod('custom_hero_image-3', get_theme_file_uri('/imgs/patio-hero.jpg'));
?>

<div class="owl-carousel">
    <div class="item">
        <div class="hero-banner" style="background-image: url('<?php echo esc_url($hero_image); ?>');">
            <div class="hero-text">
                <?php get_sidebar( 'hero-1' ); ?>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="hero-banner" style="background-image: url('<?php echo esc_url($hero_image2); ?>');">
            <div class="hero-text">
                <?php get_sidebar( 'hero-2' ); ?>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="hero-banner" style="background-image: url('<?php echo esc_url($hero_image3); ?>');">
            <div class="hero-text">
                <?php get_sidebar( 'hero-3' ); ?>
            </div>
        </div>
    </div>
    <!-- Add more items as needed -->
</div>

<div class="loop-container">
<?php
// Start the WP loop for the main page content
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    the_content(); ?>
<?php 
endwhile; endif; 
?>
</div>
   
<!-- begin menus-sidebar-container -->
<div class="menu-sidebar-container">
    <?php get_sidebar( 'menu-left' ); ?>
<!-- begin menus container (holds all menus) -->
<div class="menus-container">
<?php
// Function to query and display posts by category
function display_menu_section($category_slug, $menu_title, &$menu_nav, ) {
    $args = array(
        'category_name' => $category_slug,
        'posts_per_page' => -1,
    );
    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) : 
        $menu_nav[] = array('title' => $menu_title, 'slug' => $category_slug); // Add to navigation menu
        // begin menu-section (holds one menu) toggles active
        echo '<div id="' . esc_attr($category_slug) . '" class="menu-section">';
        // menu title
        echo '<h3>' . esc_html($menu_title) . '</h3>';
        // begin posts section to hold and style all menu items
        echo '<div class="menu-section-posts"';
        // loop to make menu items
        while ($the_query->have_posts()) : $the_query->the_post(); 
            
            get_template_part('template-parts/content', get_post_format());
            
        endwhile;
        // end menu-section-posts
        echo '</div>';
        // end menu-section
        echo '</div>';

        return true; // Posts found
    else :
        return false; // No posts found
    endif;

    wp_reset_postdata();
}

// Initialize menu navigation array

mytheme_display_menus(); ?>

<h2 id="menus-skip">Menus</h2>
<!-- end of menus-container -->
</div>

<!-- end of menu_sidebar grid -->
</div>

<!-- close main content container -->
</div>
<!-- Include the footer -->
<?php get_footer(); ?>
