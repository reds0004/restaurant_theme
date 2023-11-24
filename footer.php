    </main>
    <!-- Main content ends here -->
    <footer>
        <div class="container">
            <div class="footer-widget-iframe">
                <?php get_sidebar( 'footer' ); ?>
                <?php get_template_part('/template-parts/part-map'); ?>
            </div>
            <div class="social-copyright">
                <div class="social-media-icons">
                    <?php
                    $social_platforms = array('instagram', 'facebook', 'twitter', 'tiktok', 'youtube');
                    foreach ($social_platforms as $platform) {
                        $url = get_theme_mod("mytheme_{$platform}_url");
                        if ($url) {
                            echo "<a href='" . esc_url($url) . "' target='_blank'><i class='fab fa-{$platform}'></i></a> ";
                        }
                    }
                    ?>
                </div>
                <small class="copyright">
                    &copy; <?php echo get_theme_mod('mytheme_footer_text', 'Default copyright text here'); ?>
                </small>
                </div>
        </div>
    </footer>
    <?php wp_footer(); ?> <!-- Essential for WordPress to include additional scripts, etc. -->
</body>
</html>
