<?php
require_once 'WeatherController.php';
require_once 'TravelController.php';
require_once dirname(__FILE__).'/../config/config.php';

/**
 * Parent class of controllers
 * should extend|inherit when calling api
 */
class Services
{
	public $getConfig=[];
	public function __construct($config){
		$this->getConfig = $config;
	}

	/**
	* Set the configuration
	*
	* @see /config/config.php
	* @return array from config file
	*/
	public function setConfig(){
		return $this->getConfig;
	}

	/**
	* Curl the url pass 
	*
	* @param string the url to curl e.g (https://api.openweathermap.org)
	* @return return result from curl 
	*/
	protected function curlRequest($apiUrl) {
		try {
	            $curl = curl_init($apiUrl);
	            curl_setopt($curl, CURLOPT_FAILONERROR, true);
	            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	            $result = curl_exec($curl);

	            if( !$result ){
	                throw new Exception("Error Processing Request", 1);
	            }

	            return $result;
	        } catch (Exception $e) {
            
        }
	}
}


// Used this code for request or ajax call
if( isset($_POST['form-submitted']) AND isset($_POST['travel']) ){
	$model 	  = new TravelController($config);
	$response = $model->getTravelInformation($_POST);
	echo $response;
}if( isset($_POST['form-submitted']) AND isset($_POST['weather']) ){
	$model    = new WeatherController($config);
	$response = $model->getWeatherInformation($_POST);
	echo $response;
}
