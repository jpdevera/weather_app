/**
* When page is ready
* load all events here
*/
$(document).ready(function(){
	const base_path = $("#base_url").val();

	//Submit form
	$("#form-travel").off('submit.add').on('submit.add', function(e){
		e.preventDefault();
		var $url = `${base_path}controller/services.php`;
	 	$.ajax({
	        url: $url,
	        type: "post",
	        data: $(this).serialize()+'&travel=1',
	        success: function (data) {
	        	if( data == 'null'){
	        		$(".lbl-error").text('Please check your internet connection or either wrong configuration.');
          			$(".lbl-error").show();
          			return false;
	        	}
          		var result = JSON.parse(data);
          		if( result.meta.code==0 ){
          			$(".lbl-error").text(result.meta.error);
          			$(".lbl-error").show();
   					return false;
          		}else if(result.meta.code==200){
          			$(".lbl-error").hide();
          			setLocationInformation(result);
          		}
	        },
	        error: function(jqXHR, textStatus, errorThrown) {
	        }
	    });
	});

	//btn search click
	$(".main-travel #btn-search").on('click', function(e){
		$("#form-travel").submit();
	});

});

// loading indicator
var $body = $("body");
$(document).on({
    ajaxStart: function() { $body.addClass("loading please wait...");    },
     ajaxStop: function() { $body.removeClass("loading please wait..."); }    
});


/**
* Set the weather information here
* contruct html from the search city 
* @param json data from api response
*/
setLocationInformation = async (result) =>
{
	// icon image size (32, 44, 64, and 88)
	let promise = new Promise(function(resolved, rejected){
		if( result ){
			resolved(result)
		}else{
			rejected(result);
		}
	});

	// set the data
	let data = await promise;
	$(".travel-informations").html("");
	let html = "";
	if( data ){
		let venues = data.response.venues;
		for (var i = 0; i < venues.length; i++) {
			let icon = "";

			if( data.response.venues[i].categories[0] == undefined ){
				continue;
			}
			// check if icon already loaded
			if($.isEmptyObject(venues[i].categories[0].icon) != true){
				icon = `${venues[i].categories[0].icon.prefix}32${venues[i].categories[0].icon.suffix}`;
			}

			html +=  `
			  	<div class="col-sm-3">
		         	<div class="report-container">
				        <h4>${venues[i].name}</h4>
				        <div class="weather-forecast">
			            	<img style="background:red" src="${icon}" class="weather-icon" /> 
			            	<small>${venues[i].categories[0].name}</small>
				        </div>
				        <div class="time">
				            <div>Latitude: ${venues[i].location.lat}</div>
				            <div>Longtitude: ${venues[i].location.lng}</div>
				        </div>
				    </div>
			    </div>
			`;
		}
		$(".travel-informations").append(html);
	}
}



