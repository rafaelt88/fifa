<?php
require_once Yii::getPathOfAlias('application.vendors.facebook.*') . '/facebook.php';

$facebook = new Facebook(array(
    'appId'  => '1443690775881934',
    'secret' => '4fbef9592451293925756ca72ecc5fa8',
));

$user = $facebook->getUser();
/*
if ($user) {
    try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $statusUrl = $facebook->getLoginStatusUrl();
    $loginUrl = $facebook->getLoginUrl();
}

// This call will always work since we are fetching public data.
$naitik = $facebook->api('/naitik');
*/
?>

<!DOCTYPE html>
<html>
<?php require_once dirname(__FILE__) . '/head.php';?>
<body>
    <div class="container-fluid contenido">
        <?php require_once dirname(__FILE__) . '/navbar.php';?>
        <?php require_once dirname(__FILE__) . '/noscript.php';?>
        <?php $this->widget('application.widgets.notify.Notify');?>
        <?php echo $content;?>
        <?php require_once dirname(__FILE__) . '/footer.php';?>
    </div>
</body>
</html>
