<?php include 'view/template/header.php'; ?>

<!-- For improvement home page, but for now -->
<div class="col-sm-9 col-md-9 main-travel" style="margin-top:80px;">
  <h2 class="sub-header">Nearby Locations and Weather Information</h2>
    <div class="form-group">
      <p>
      Weather Application has local and international weather forecasts from the most accurate weather forecasting technology.</br>
      This page aims to provide travel information of Japan for foreign tourists visiting Japan for the first time.</br>
      The traveler has the possibility of going to the following cities.</br>
      Tokyo, Yokohama, Kyoto, Osaka, Sapporo, Nagoya </br>
      <i>There's no home information here, intended for examination purposes only.</i>
    </p>
    </div>
    <div class="form-group">
       <p>To know more the travel information click the <b>Travel Page</b> or click <i><a href="<?php echo $base_url_index ?>&module=travel">here</a>.<i></p>
    </div>
    <div class="form-group">
       <p>To know more the weather information click the <b>Weather Page</b> or click <i><a href="<?php echo $base_url_index ?>&module=weather">here</a>.<i></p>
    </div>
</div>

      
<?php include 'view/template/footer.php'; ?>