<?php
// Check if the function 'earth_theme_support' has already been defined to prevent it from being redefined.
// This ensures that the function is only defined once, even if a child theme or plugin attempts to declare it.
if (!function_exists('earth_theme_support')):

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * This function is executed during the 'after_setup_theme' hook, which runs after the theme is initialized.
     * It's an ideal place to declare support for various WordPress features such as custom headers, post thumbnails, and more.
     *
     * Features:
     * 1. Adds support for Gutenberg block styles, allowing the theme to style Gutenberg blocks according to its design.
     * 2. Enqueues an editor stylesheet, so the editor (Gutenberg or Classic) reflects the front-end theme's styles.
     *
     * @since Earth Theme 1.0
     *
     * @return void
     */
    function earth_theme_support()
{
        // Enable support for block styles in the Gutenberg editor.
        // This allows the default block styling provided by WordPress to be applied in the editor and front-end.
        add_theme_support('wp-block-styles');

        // Load the theme's main stylesheet for the editor.
        // This ensures that when editing content in Gutenberg, the styles applied match those on the front-end.
        // The 'style.css' file is located in the theme's root directory.
        add_editor_style('style.css');
    }

    /**
     * Enqueues theme styles and scripts for the front-end of the website.
     *
     * This function runs during the 'wp_enqueue_scripts' hook, which is triggered when WordPress is loading
     * all styles and scripts for the front-end. It ensures that the necessary CSS files are included when rendering the page.
     *
     * The function:
     * 1. Enqueues the main theme stylesheet (style.css), ensuring it's loaded for the front-end.
     * 2. Enqueues a custom stylesheet (block.css) for additional styling related to blocks or other theme-specific elements.
     *
     * @since Earth Theme 1.0
     *
     * @return void
     */
    function earth_enqueue_styles()
{
        // Enqueue the main stylesheet (style.css) located in the root of the theme.
        // 'get_stylesheet_uri()' returns the URL of the theme's 'style.css' file.
        // This ensures the theme's base styles are loaded on every page.
        wp_enqueue_style('earth-style', get_stylesheet_uri(), array(), '1.0', 'all');

        // Explanation of parameters:
        // 'earth-style'      -> A unique handle for this stylesheet, used by WordPress to reference it.
        // 'get_stylesheet_uri()' -> The function returns the full URL to the 'style.css' file in the theme's root directory.
        // array()            -> No dependencies for this stylesheet, hence an empty array.
        // '1.0'              -> Version number of the stylesheet. Important for cache-busting. Increment when you update the file.
        // 'all'              -> Media query specifying the styles apply to all types of devices (screen, print, etc.).

        // Enqueue a custom stylesheet 'block.css' from the 'assets/css' directory in the theme.
        // This stylesheet can be used to add additional custom styles for Gutenberg blocks or any other components.
        wp_enqueue_style(
            "block_style", // Handle for the custom 'block.css' stylesheet.

            get_template_directory_uri() . "/assets/css/block.css", // The full URL to the 'block.css' file located in 'assets/css/'.

            [], // No dependencies for this stylesheet.

            '1.0', // Version number of the stylesheet. Change this value when the CSS file is updated to force the browser to reload the new version.

            "all" // Media query indicating this stylesheet applies to all types of devices (screen, print, etc.).
        );
    }

endif;

// Hook the 'earth_theme_support' function into the 'after_setup_theme' action.
// This ensures the theme's features (such as block styles and editor styles) are registered and initialized after the theme is set up.
add_action('after_setup_theme', 'earth_theme_support');

// Hook the 'earth_enqueue_styles' function into the 'wp_enqueue_scripts' action.
// This ensures that the theme's styles (including 'style.css' and 'block.css') are loaded on the front-end when scripts and styles are being enqueued.
add_action('wp_enqueue_scripts', 'earth_enqueue_styles');
