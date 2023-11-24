<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header>
        <div class="container">
        <?php $hero_heading_text = get_theme_mod('hero_heading_text', 'Restauraunt Name'); ?>
            <nav class="header-nav">
                <h1><a href="<?php echo home_url(); ?>"><?php echo esc_html($hero_heading_text); ?></a></h1>
                <?php wp_nav_menu(['theme_location' => 'header-menu']); ?>
            </nav>
        </div>
    </header>
    </main>
    <!-- Main content starts here -->
