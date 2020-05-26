<?php
$config = [];

/**
*
* openweathermap configuration and parameters, you can change appId by your own
* uriOpm - uri Open Weather Map the default url api
* appId - the generated client id
* cnt - list|count of weather to be search, can be change
*/
$config['uriOpm']		= 'https://api.openweathermap.org/data/2.5/forecast?';
$config['appId'] 	 	= '9745a39875905ff4f703ea327fe4a814';
$config['cnt']			= 8;

/**
*
* foursquare configuration and parameters, you can change clientId, ClientSecret and version by your own
* uriFS - uri Four Square the default url of api
* clientId - fs generated CLIENT ID
* clientSecret - fs generated CLIENT KEY
* limit - list|count of near places to be search, can be change
* version - required param when calling api default to YYYYMMDD
*/ 
$config['uriFs']		= 'https://api.foursquare.com/v2/venues/search?';
$config['clientId'] 	= 'XMGGFX0SRGORXN4ZM1J2TG1WYES05VV05UEBHDENMVKO22VD';
$config['clientSecret'] = '1OKRFJ4EGZSBUU3WYSLYZGLITYM4YNNG5QJJ00IEJ5VQQMKF';
$config['limit']		= 8;
$config['version'] 		= date("Ymd");

/*
* 
* isDefault - set to true if the search string should be (Tokyo, Yokohama, Kyoto, Osaka, Sapporo, Nagoya) only, otherwise FALSE
* locations - list of default cities 
*/
$config['isDefault'] 	= TRUE;
$config['locations']	= ['tokyo', 'yokohama', 'kyoto', 'osaka', 'sapporo', 'nagoya'];