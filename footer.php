<?php
$settings = (array) get_option('mywpdev-settings');
$copyright = 'Stuff';
if (isset($settings['copyright'])) {
    $copyright = esc_html($settings['copyright']);
}

$twitter = get_theme_mod('mywpdev_twitter_profile', '');

?>

</main>
<footer class="container">
    <nav>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer_menu',
        ));
        ?>
    </nav>
    <p><?php echo $copyright?> </p>
    <p>
        <?php
        if ( ! empty( $twitter)) {
            ?>
            <a href="https://twitter.com/<?php echo esc_attr($twitter); ?>" class="twitter-stuff">@<?php echo esc_html($twitter); ?></a><?php
        }
        ?>
    </p>
</footer>
<?php wp_footer(); ?>
</body>

</html>