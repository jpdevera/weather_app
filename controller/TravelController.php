<?php
require_once 'Services.php';
class TravelController extends Services{

    private $config = NULL;
    public function __construct($config) {
        $this->config = $config;
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
        include 'view/travel/index.php';
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
    public function getTravelInformation($params=[])
    {
        try {
            if( !empty($params) ){

                $error = "";

                if( empty($params['location'])){
                    $error = "Location is required.";
                    echo json_encode(array('meta'=>array('code'=>0, 'error'=>$error)));
                    return;
                }else{
                    if( $this->config['isDefault'] === TRUE ){
                        if( in_array(strtolower($params['location']), $this->config['locations']) === FALSE ){
                            $defloc = implode(", ", $this->config['locations']);
                            $error = "Please enter a valid location ($defloc). ";
                            echo json_encode(array('meta'=>array('code'=>0, 'error'=>$error)));
                            return;
                        }
                    }
                }

               // Construct api url
                $apiUrl  = $this->config['uriFs'];
                $apiUrl .= '&client_id='.$this->config['clientId'];
                $apiUrl .= '&client_secret='.$this->config['clientSecret'];
                $apiUrl .= '&limit='.$this->config['limit'];
                $apiUrl .= '&near='.$params['location'];
                $apiUrl .= '&v='.$this->config['version'];

                 // Get the api response
                $response   = parent::curlRequest($apiUrl);
                $response = json_decode($response);
                $response = json_decode(json_encode($response), true);
                echo json_encode($response);
            }
        } catch (Exception $e) {
            echo json_encode(array('meta'=>array('code'=>0, 'error'=>$e->getMessage())));
        }
    }
   
}
