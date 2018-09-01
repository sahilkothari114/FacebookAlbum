<?php
/**
 * Configuration file
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    require_once './vendor/autoload.php';
    define('FB_APP_ID', 'your_fb_app_id');
    define('FB_APP_SECRET', 'your_fb_app_secret');
    define('FB_APP_GRAPH_VERSION', 'v3.1');
    define('FB_APP_CALLBACK_URL', 'your_app_callback_url');
  
    $fb = new \Facebook\Facebook(
        [
        'app_id' => FB_APP_ID,
        'app_secret' => FB_APP_SECRET,
        'default_graph_version' => FB_APP_GRAPH_VERSION,
        ]
    );
