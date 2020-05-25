<?php
$config = [];

// openweathermap 
$config['uriOpm']		= 'https://api.openweathermap.org/data/2.5/forecast?';
$config['appId'] 	 	= '9745a39875905ff4f703ea327fe4a814';
$config['cnt']			= 8;

// foursquare
$config['uriFs']		= 'https://api.foursquare.com/v2/venues/search?';
$config['clientId'] 	= 'XMGGFX0SRGORXN4ZM1J2TG1WYES05VV05UEBHDENMVKO22VD';
$config['clientSecret'] = '1OKRFJ4EGZSBUU3WYSLYZGLITYM4YNNG5QJJ00IEJ5VQQMKF';
$config['limit']		= 8;
$config['version'] 		= date("Ymd"); // Required param when calling api

// Default location 
// set to true if the search string shpuld be (Tokyo, Yokohama, Kyoto, Osaka, Sapporo, Nagoya) only
// otherwise false
$config['isDefault'] 	= TRUE;
$config['locations']	= ['tokyo', 'yokohama', 'kyoto', 'osaka', 'sapporo', 'nagoya'];