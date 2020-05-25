<?php
require_once 'config/config.php';
require_once 'controller/HomeController.php';
require_once 'controller/TravelController.php';
require_once 'controller/WeatherController.php';
$module = isset($_GET['module'])?$_GET['module']:NULL;
try {

        if ( !$module ) {
            $controller = new HomeController($config);
            $controller->handleRequest();
        } elseif ( $module == 'weather' ) {
            $controller = new WeatherController($config);
            $controller->handleRequest();
        } elseif ( $module == 'travel' ) {
            $controller = new TravelController($config);
            $controller->handleRequest();
        } elseif ( $module == 'home' ) {
            $controller = new HomeController($config);
            $controller->handleRequest();
        } else {
             $this->showError("Page not found", "Page for operation ".$module." was not found!");
        }
} catch ( Exception $e ) {
    // some unknown Exception got through here, use application error page to display it
    $this->showError("Application error", $e->getMessage());
}
?>