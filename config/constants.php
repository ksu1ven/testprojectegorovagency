<?php

// Theme directory
define( 'THEME_DIR', dirname( __DIR__, 1 ) . DIRECTORY_SEPARATOR );

// Theme brand colors
define( 'THEME_BRAND_COLOR_MAIN', '#0f7f13' );
define( 'THEME_BRAND_COLOR_SECONDARY', '#333333' );
define( 'THEME_BRAND_COLOR_TERTIARY', '#0f7f13' );

// Theme textdomain
define( 'THEME_TEXTDOMAIN', 'bnt' );

// Assets and assets cache paths/URLs
define( 'THEME_ASSETS_PATH', STYLESHEETPATH . '/resources' );
define( 'THEME_DIST_PATH', STYLESHEETPATH . '/dist' );
define( 'THEME_ASSETS_URL', get_bloginfo('stylesheet_directory') . '/dist' );
define( 'THEME_CACHE_PATH', THEME_ASSETS_PATH . '/cache' );
define( 'THEME_CACHE_URL', THEME_ASSETS_URL . '/cache' );

// PDFs cache path
define( 'THEME_PDFS_CACHE_PATH', WP_CONTENT_DIR . '/cache/pdfs' );

// Email & PDF templates paths
define( 'THEME_EMAIL_TEMPLATES_PATH', STYLESHEETPATH . '/lib/emails/email-templates' );
define( 'THEME_PDF_TEMPLATES_PATH', STYLESHEETPATH . '/lib/emails/pdf-templates' );
