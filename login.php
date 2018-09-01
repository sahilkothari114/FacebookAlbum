<?php
require_once './config.php';
if (($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['login'])) || isset($_GET['code'])) {
    $helper = $fb->getRedirectLoginHelper();
    if (isset($_GET['state'])) {
        $helper->getPersistentDataHandler()->set('state', $_GET['state']);
    }
    if (!isset($_GET['code'])) {
        $permissions = ['email', 'user_photos'];
        $loginUrl    = $helper->getLoginUrl(FB_APP_CALLBACK_URL, $permissions);
        header("location:".$loginUrl);
    } else {
        try {
            $accessToken = $helper->getAccessToken();
            $_SESSION['facebook_access_token'] = (string) $accessToken;
            header('location:home.php');
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}
