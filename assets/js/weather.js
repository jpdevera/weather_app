/**
* When page is ready
* load all events here
*/
$(document).ready(function(){
	const base_path = $("#base_url").val();

	// submit form
	$("#form-weather").off('submit.add').on('submit.add', function(e){
		e.preventDefault();
		var $url = `${base_path}controller/services.php`;
	 	$.ajax({
	        url: $url,
	        type: "post",
	        data: $(this).serialize()+'&weather=1',
	        success: function (data) {
	        	if( data == 'null'){
	        		$(".lbl-error").text('Please check your internet connection or either wrong configuration.');
          			$(".lbl-error").show();
          			return false;
	        	}
          		var result = JSON.parse(data);
          		if( result.message!=0 ){
          			$(".lbl-error").text(result.message);
          			$(".lbl-error").show();
   					return false;
          		}else{
          			$(".lbl-error").hide();
          			setWeatherInformation(result);
          		}

          		
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	        }
	    });
	});

	// btn-search click
	$(".main-weather #btn-search").on('click', function(e){
		$("#form-weather").submit();
	});

});


/**
* Set the weather information here
* contruct html from the search city 
* @param json data from api response
*/
setWeatherInformation = (data) =>
{
	$(".weather-informations").html("");
	let html = "";
	let li = "";
	if( data ){
		for (var i = 0; i < data.cnt; i++) {
			console.log(data);
			let info = data.list[i];
			let dt_txt = info.dt_txt.split(" ");
			let date = convertDate(dt_txt[0])
			let time = convertTime(dt_txt[1]);
			let description = upperCaseWords(info.weather[0].description);
			html +=  `
			  	<div class="col-sm-3">
		         	<div class="report-container">
				        <h2>${time}</h2>
				        <div class="time">
				        	<p>${date}</p>
				            <div class='weather-description'>${description}</div>
				        </div>
				        <div class="weather-forecast">
				            <img src="http://openweathermap.org/img/w/${info.weather[0].icon}.png" class="weather-icon" /> 
				            	${info.main.temp}&deg;C
				        </div>
				        <div class="time">
				            <div>Humidity: ${info.main.humidity} %</div>
				            <div>Wind: ${info.wind.speed} km/h</div>
				        </div>
				    </div>
			    </div>
			`;

		}
		$(".main-weather .weather-informations").append(html);
		// $(".nav-sidebar").append(li)
	}
}

/**
* Convert the military time into 12hours format
* @param time formatted string 
* @return eg. 1:00 AM
*/
convertTime = (time) =>
{
	let timeString = time;
	let H = +timeString.substr(0, 2);
	let h = (H % 12) || 12;
	let ampm = H < 12 ? "AM" : "PM";
	return h + timeString.substr(2, 3) + ampm;
}

/**
* Convert the string into Upper Case Words
* @param string - string to convert
* @return eg. Hello World
*/
upperCaseWords = (str) => {
  return (str + '')
    .replace(/^(.)|\s+(.)/g, function ($1) {
      return $1.toUpperCase()
    });
}

/**
* Convert the string date into date formatted
* @param date to convert
* @return eg. Jan 01, 2020
*/
convertDate = (date) => 
{
	const months = ["Jan", "Feb", "Mar","Apr", "May", "Jun", "July", "Aug", "Sep", "Oct", "Nov", "Dec"];
	let current_datetime = new Date(date)
	let formatted_date =  months[current_datetime.getMonth()] + " " + current_datetime.getDate() + ", " + current_datetime.getFullYear()
	return formatted_date;
}



