<?php
require_once 'Services.php';
class WeatherController extends Services{

    private $config = NULL;
    public function __construct($config) {
        $this->config = $config;
        // set other menus here
    }
    
    public function redirect($location) {
        header('Location: '.$location);
    }
    
    public function handleRequest() {
        $action   = isset($_GET['action'])?$_GET['action']:NULL;
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
        include 'view/weather/index.php';
    }
    
   /**
    * show the error
    */
    public function showError($title, $message) {
        include 'view/error.php';
    }

    /**
    * Returns json_encode object from api response
    * 
    * @see /config/config.php for the configuration of api request
    * @param array $params data from form submitted
    * @return object value from api response
    */
    public function getWeatherInformation($params=[])
    {
        try {
            $error = "";
            if( !empty($params) ){

                if( empty($params['location'])){
                    $error = "Location is required.";
                    echo json_encode(array('message'=>$error));
                    return;
                }else{
                    if( $this->config['isDefault'] === TRUE ){
                        if( in_array(strtolower($params['location']), $this->config['locations']) === FALSE ){
                            $defloc = implode(", ", $this->config['locations']);
                            $error = "Please enter a valid location ($defloc). ";
                            echo json_encode(array('message'=>$error));
                            return;
                        }
                    }
                }

                // Construct api url
                $apiUrl  = $this->config['uriOpm'];
                $apiUrl .= '&q='.$params['location'];
                $apiUrl .= "&units=metric";
                $apiUrl .= '&cnt='.$this->config['cnt'];
                $apiUrl .= '&appid='.$this->config['appId'];

                // Get the api response
                $response = parent::curlRequest($apiUrl);
                $response = json_decode($response);
                $response = json_decode(json_encode($response), true);
                echo json_encode($response);
            }
        } catch (Exception $e) {
            echo json_encode(array('message'=>$e->getMessage()));
        }
    }
    
}

