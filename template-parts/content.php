<section id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>
    <!-- Menu item post content -->
    <div class="menu-content">
        <?php
        the_content();
        // You can add code for 'Read More' button or link here
        ?>
    </div>
</section>
