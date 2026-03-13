<?php

?>
<html>
    <head>
        <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header class="container main_header">
            <h1 class="header-logo"><?php bloginfo('name'); ?></h1>
            <p><?php bloginfo('description'); ?></p>
            <nav>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main_menu',
                ));
                ?>
            </nav>
        </header>
        <main class="container">