<?php
// Get the custom background image URL from the theme mod
$sidebar_bg_image = get_theme_mod('sidebar_menu_left_bg_image', get_theme_file_uri('/imgs/sidebar-whisky.jpg'));

// Apply the background image to the sidebar div
if ($sidebar_bg_image) : ?>
    <div id="sidebar-menu-left" class="sidebar-menu-left" style="background-image: url('<?php echo esc_url($sidebar_bg_image); ?>');">
		<div class="menu-left-overlay">
        	<?php dynamic_sidebar( 'menu-left' ); ?>
		</div>
    </div>
<?php endif; ?>
