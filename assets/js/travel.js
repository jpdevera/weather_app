/**
* When page is ready
*/
$(document).ready(function(){
	const base_path = $("#base_url").val();
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

	$(".main-travel #btn-search").on('click', function(e){
		$("#form-travel").submit();
	});

});


/**
* Set the weather information here
*/
setLocationInformation = (data) =>
{
	// icon image size (32, 44, 64, and 88)
	$(".travel-informations").html("");
	let html = "";
	if( data ){
		let venues = data.response.venues;
		for (var i = 0; i < venues.length; i++) {
			html +=  `
			  	<div class="col-sm-3">
		         	<div class="report-container">
				        <h4>${venues[i].name}</h4>
				        <div class="weather-forecast">
			            	<img style="background:red" src="${venues[i].categories[0].icon.prefix}32${venues[i].categories[0].icon.suffix}" class="weather-icon" /> 
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



