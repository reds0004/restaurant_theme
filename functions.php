<?php
function my_theme_enqueue_scripts() {
    wp_enqueue_style('style', get_stylesheet_uri());

    // enqeue Vina Sans font
    wp_enqueue_style('google-fonts-display', 'https://fonts.googleapis.com/css2?family=Vina+Sans&display=swap', false);

    // enqeue Poiret One and Open Sans
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans&family=Poiret+One&display=swap', false);

    // Enqueue Owl Carousel CSS
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');

    // font awesome styles
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

    wp_register_script('menunav', get_template_directory_uri() . '/js/menunav.js', array('jquery'), null, true);

    // Enqueue the script
    wp_enqueue_script('menunav');

    // Enqueue Owl Carousel JavaScript
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), null, true);

    // Enqueue Your Custom JS for initializing the carousel
    wp_enqueue_script('/js/my-custom-owl', get_template_directory_uri() . '/js/my-custom-owl.js', array('jquery', 'owl-carousel-js'), null, true);
 }

add_action('wp_enqueue_scripts', 'my_theme_enqueue_scripts');

// default list food menus
function mytheme_default_serialized_categories() {
    $default_categories = [
        'dinner-app' => 'Dinner Appetizers',
        'dinner-main' => 'Dinner Mains',
        'dinner-dessert' => 'Dinner Desserts',
        'brunch-app' => 'Brunch Appetizers',
        'brunch-main' => 'Brunch Mains',
        'brunch-dessert' => 'Brunch Desserts',
        'lunch-app' => 'Lunch Appetizers',
        'lunch-main' => 'Lunch Mains',
        'lunch-dessert' => 'Lunch Desserts',
        'cocktail' => 'Cocktails',
        'wine' => 'Wines',
        'beer' => 'Beers',
        'whisky' => 'Whiskies'
    ];

    $default_value = '';
    foreach ($default_categories as $key => $value) {
        $default_value .= "$key:$value,";
    }

    // Trim the trailing comma
    $default_value = rtrim($default_value, ',');

    return $default_value;
}

function mytheme_display_menus() {
    $serialized_categories = get_theme_mod('mytheme_serialized_categories', mytheme_default_serialized_categories());
    $categories_array = explode(',', $serialized_categories);

    $categories = [];
    foreach ($categories_array as $category) {
        list($key, $label) = explode(':', $category);
        $categories[$key] = $label;
    }

    $menu_nav = [];
    foreach ($categories as $category_slug => $menu_title) {
        display_menu_section($category_slug, $menu_title, $menu_nav);
    }

    echo '<div class="menus"><nav>';
    foreach ($menu_nav as $item) {
        echo '<button class="menu-button" data-target="' . esc_attr($item['slug']) . '">' . esc_html($item['title']) . '</button>';
    }
    echo '</nav></div>';
}

// Define other necessary functions and WordPress hooks here...


function register_my_menus() {
    register_nav_menus(
        array(
            // underscore is related to a translatin fuction 'heder-menu' => __( 'Header Menu' ),
            'header-menu' => 'Header Menu',
        )
    );
}
add_action( 'init', 'register_my_menus' );

// registering widget area
// https://developer.wordpress.org/themes/functionality/sidebars/
add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	register_sidebar(
		array(
			'id'            => 'footer',
			'name'          => 'footer',
			'description'   => 'Plancement for footer widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	// hero-1 sidebar
    register_sidebar(
		array(
			'id'            => 'hero-1',
			'name'          => 'Hero One',
			'description'   => 'Plancement for header widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
    // hero-2 sidebar
    register_sidebar(
		array(
			'id'            => 'hero-2',
			'name'          => 'Hero Two',
			'description'   => 'Plancement for header widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
    // hero-3 sidebar
    register_sidebar(
		array(
			'id'            => 'hero-3',
			'name'          => 'Hero Three',
			'description'   => 'Plancement for header widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
    register_sidebar(
		array(
			'id'            => 'menu-left',
			'name'          => 'menu-left',
			'description'   => 'Plancement for menu-left widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}


// customizer
function mytheme_customize_register( $wp_customize ) {
    
    // customizer area for hero images
    $wp_customize->add_section( 'hero_carousel_images', array(
        'title'    => __( 'Hero Carousel Images', 'mytheme' ),
        'priority' => 30,
    ));

    $wp_customize->add_section('mytheme_footer', array(
        'title'    => __('Footer', 'mytheme'),
        'priority' => 120,
    ));

    // Hero Image 1 Setting
    $wp_customize->add_setting( 'custom_hero_image_1', array(
    'default'   => get_theme_file_uri('/imgs/cheers-hero.jpg'),
    'transport' => 'refresh',
    ));

    // Hero Image 2 Setting
    $wp_customize->add_setting( 'custom_hero_image_2', array(
    'default'   => get_theme_file_uri('/imgs/charcuterie-hero.jpg'),
    'transport' => 'refresh',
    ));

    // Hero Image 3 Setting
    $wp_customize->add_setting( 'custom_hero_image_3', array(
    'default'   => get_theme_file_uri('/imgs/patio-hero.jpg'),
    'transport' => 'refresh',
    ));

    // Hero Image 1 Control
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_hero_image_control_1', array(
    'label'    => __( 'Hero Image 1', 'mytheme' ),
    'section'  => 'hero_carousel_images',
    'settings' => 'custom_hero_image_1',
    )));

    // Hero Image 2 Control
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_hero_image_control_2', array(
    'label'    => __( 'Hero Image 2', 'mytheme' ),
    'section'  => 'hero_carousel_images',
    'settings' => 'custom_hero_image_2',
    )));

    // Hero Image 3 Control
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'custom_hero_image_control_3', array(
    'label'    => __( 'Hero Image 3', 'mytheme' ),
    'section'  => 'hero_carousel_images',
    'settings' => 'custom_hero_image_3',
    )));

    // Name link Heading Text Setting
    $wp_customize->add_setting( 'top_left_heading_text', array(
        'default'   => 'Restaurant Name',
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_text_field', // Ensures safe text input
    ));

    // h1 in nav Heading Text Control
    $wp_customize->add_control( 'top_left_heading_text_control', array(
        'label'    => __( 'Hero Heading Text', 'mytheme' ),
        'section'  => 'restaurant_name',
        'settings' => 'top_left_heading_text',
        'type'     => 'text', // Text input control
    ));

    // sidebar to left of menu
    $wp_customize->add_section( 'sidebar_menu_left', array(
        'title'    => __( 'Sidebar Menu Left', 'mytheme' ),
        'priority' => 35,
    ));

    // Sidebar Menu Left Background Image Setting
    $wp_customize->add_setting( 'sidebar_menu_left_bg_image', array(
        'default'   => get_theme_file_uri('/imgs/sidebar-whisky.jpg'), // Default image
        'transport' => 'refresh',
    ));

    // Sidebar Menu Left Background Image Control
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'sidebar_menu_left_bg_image_control', array(
        'label'    => __( 'Sidebar Background Image', 'mytheme' ),
        'section'  => 'sidebar_menu_left',
        'settings' => 'sidebar_menu_left_bg_image',
    )));

    // Primary Color
    $wp_customize->add_setting( 'primary_color', array(
        'default'   => '#f0ebe5', // Default color
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // primary color control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color_control', array(
        'label'    => __( 'Primary Color', 'mytheme' ),
        'section'  => 'colors', // Default colors section or your custom section
        'settings' => 'primary_color',
    )));

    // Secondary Color
    $wp_customize->add_setting( 'secondary_color', array(
        'default'   => '#343a40', // Default color
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    // seconary color control
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color_control', array(
        'label'    => __( 'Secondary Color', 'mytheme' ),
        'section'  => 'colors', // Default colors section or your custom section
        'settings' => 'secondary_color',
    )));

    // Button Active Color
    $wp_customize->add_setting( 'button_color', array(
        'default'   => '#457b9d', // Default color
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'button_active_color_control', array(
        'label'    => __( 'Button Color', 'mytheme' ),
        'section'  => 'colors', // Default colors section or your custom section
        'settings' => 'button_color',
    )));

    // Social Media Section
    $wp_customize->add_section('mytheme_social_media', array(
        'title'    => __('Social Media', 'mytheme'),
        'priority' => 30,
    ));

    // Define social media platforms
    $social_platforms = array('instagram', 'facebook', 'twitter', 'tiktok', 'youtube');
    foreach ($social_platforms as $platform) {
    // URL Setting
    $wp_customize->add_setting("mytheme_{$platform}_url", array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    // URL Control
    $wp_customize->add_control("mytheme_{$platform}_url_control", array(
        'label'    => ucfirst($platform) . ' URL',
        'section'  => 'mytheme_social_media',
        'settings' => "mytheme_{$platform}_url",
        'type'     => 'url',
    ));
    }

    // Add Copyright Text Setting
    $wp_customize->add_setting('mytheme_footer_text', array(
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add Copyright Text Control
    $wp_customize->add_control('mytheme_footer_text_control', array(
        'label'    => __('Copyright Text', 'mytheme'),
        'section'  => 'mytheme_footer',
        'settings' => 'mytheme_footer_text',
        'type'     => 'text',
    ));

    // Add the section
    $wp_customize->add_section('mytheme_menu_categories', array(
        'title'    => __('Menu Categories', 'mytheme'),
        'priority' => 30,
    ));

    // Add the setting with the default serialized array
    global $default_value; // Make sure to use the global variable
    $wp_customize->add_setting('mytheme_serialized_categories', array(
        'default'   => mytheme_default_serialized_categories(),
        'transport' => 'refresh',
        'sanitize_callback' => 'sanitize_textarea_field', // Sanitize the input
    ));

    // Add the control
    $wp_customize->add_control('mytheme_serialized_categories_control', array(
        'label'    => __('Edit Menu Categories', 'mytheme'),
        'section'  => 'mytheme_menu_categories',
        'settings' => 'mytheme_serialized_categories',
        'type'     => 'textarea',
    ));
}
add_action( 'customize_register', 'mytheme_customize_register' );



// customizable css
function mytheme_customize_css() {
    ?>
    <style type="text/css">
        body { 
            background-color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
            color: <?php echo get_theme_mod('secondary_color', '#343a40'); ?>;
        }
        header, footer {
            background-color: <?php echo get_theme_mod('secondary_color', '#343a40'); ?>;
            color: <?php echo get_theme_mod('header_footer_text_color', '#f0ebe5'); ?>;
        }
        button, .button {
            background-color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
            color: <?php echo get_theme_mod('secondary_color', '#343a40'); ?>;
        }

        button.menu-button {
            background-image: linear-gradient(to right, <?php echo get_theme_mod('button_color', '#457b9d'); ?> 50%, transparent 50%);
        }

        button.menu-button:hover {
            color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
        }

        button.menu-button.active {
            background-color: <?php echo get_theme_mod('button_color', '#457b9d'); ?>;
            color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
        }

        .hero-text {
            color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
        }

        .menu-left-overlay {
            color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
        }

        ul.menu li a,
        .header-nav h1 {
            color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
            border: 1px solid <?php echo get_theme_mod('secondary_color', '#343a40'); ?>;
        }
       
        .header-nav h1 a{
            color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
        }


        ul.menu li a:hover,
        .header-nav h1:hover {
            color: <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
            border: 1px solid <?php echo get_theme_mod('primary_color', '#f0ebe5'); ?>;
        }
        /* Add more custom styles based on your theme customizer settings here */
    </style>
    <?php
}
add_action('wp_head', 'mytheme_customize_css');