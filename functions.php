<?php

add_action('wp_enqueue_scripts', 'mywpdev_enqueue_style', 20);

/**
 * Enqueues our sytles and scripts
 */
function mywpdev_enqueue_style()
{
    wp_enqueue_style('mywpdev_style', get_stylesheet_uri());
}

function mywpdev_theme_register_menus()
{
    register_nav_menus(array(
        'main_menu' => 'Primary Menu',
        'footer_menu' => 'Footer Menu'
    ));
}
add_action('after_setup_theme', 'mywpdev_theme_register_menus');

function mywpdev_theme_register_sidebars()
{
    register_sidebar(array(
        'name' => 'Main Sidebar',
        'id' => 'main_sidebar',
        'description' => 'Add Widgets here to appear everywhere',
        'before_widget' => '<div class="Widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>'
    ));
}
add_action('widgets_init', 'mywpdev_theme_register_sidebars');

function mywpdev_register_types()
{
    // Prepares post type array
    $args = array(
        'public' => true,
        'label' => 'Product',
        'has_archive' => true,
        'rewrite' => array('slug' => 'products'),
    );
    // Registers Post Type
    register_post_type('product', $args);
}

add_action('init', 'mywpdev_register_types');
add_action('admin_init', 'mywpdev_register_settings');

function mywpdev_register_settings()
{
    register_setting('mywpdev-settings-group', 'mywpdev-settings');
    add_settings_section('mywpdev-setting-section', 'Main Settings', 'mywpdev_generate_main_section', 'mywpdev_theme_options');
    add_settings_field(
        'mywpdev-footer-setting-field',
        'Copyright Stuff',
        'mywpdev_generate_setting_field',
        'mywpdev_theme_options',
        'mywpdev-setting-section',
    );
}

function mywpdev_generate_main_section()
{
    ?>
    <p>This section lets you customize staff</p>
    <?php
}

function mywpdev_generate_setting_field()
{
    $settings = (array) get_option('mywpdev-settings');
    $copyright = 'Stuff';
    if (isset($settings['copyright'])) {
        $copyright = esc_attr($settings['copyright']);
    }
    echo "<input type='text' name='mywpdev-settings[copyright]' id='mywpdev-settings[copyright]' value='$copyright' />";
}

function mywpdev_register_menus()
{
    add_theme_page('Theme Options', 'Theme Options', 'manage_options', 'mywpdev_theme_options', 'mywpdev_generate_options_page');
}

add_action('admin_menu', 'mywpdev_register_menus');

function mywpdev_generate_options_page()
{
    ?>
    <h1>Our Theme Options</h1>
    <form action="options.php" method="POST">
        <?php settings_fields('mywpdev-settings-group');
        do_settings_sections('mywpdev_theme_options');
        submit_button(); ?>
    </form>
    <?php
}

add_action('customize_register', 'mywpdev_customizer_setup');
function mywpdev_customizer_setup($wp_customize)
{
    $wp_customize->add_setting('mywpdev_twitter_profile', array(
        'default'   => '',
        'transport' => 'refresh',
        'type'      => 'theme_mod'
    ));
    $wp_customize->add_section('mywpdev_social_section', array(
        'title'    => 'footer',
        'priority' => 160,
    ));
    $wp_customize->add_control('mywpdev_twitter_profile', array(
        'label'=> 'Twitter Handle',
        'type' => 'text',
        'section' => 'mywpdev_social_section',
    ));
}

?>