<?php
/**
* This is the default render of application
*/
class HomeController {

    public function __construct() {
    }
    
    public function redirect($location) {
        header('Location: '.$location);
    }
    
    /**
    * Handle the request from get method
    * render the specified function
    */
    public function handleRequest() {
        $action   = isset($_GET['action']) ? $_GET['action']:NULL;
        try {
            if ( !$action || $action == 'list' ) {
                $this->index();
            }else {
                $this->showError("Page not found", "Page for operation ".$action." was not found!");
            }
        } catch ( Exception $e ) {
            // some unknown Exception got through here, use application error page to display it
            $this->showError("Application error", $e->getMessage());
        }
    }

    /**
    * Render the main view of the page
    */
    private function index(){
        include 'view/home/index.php';
    }
    
    /**
    * show the error
    */
    public function showError($title, $message) {
        include 'view/error.php';
    }

}
