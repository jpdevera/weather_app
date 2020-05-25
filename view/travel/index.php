<?php include 'view/template/header.php'; ?>

<div class="col-sm-9 col-md-9 main-travel" style="margin-top:80px;">
  <h2 class="sub-header">Travel Information</h2>
  <form name="form-travel" id="form-travel">
    <div class="form-group">
      <small id="locationHelp" class="form-text text-muted">Please enter a location to know the weather information and click search</small>
      <input type="text" class="form-control" id="location" placeholder="Location" name="location">
      <label class="lbl-error"></label>
    </div>
    <input type="hidden" name="form-submitted" value="1">
    <button type="button" id="btn-search" class="btn btn-primary">Search</button>
  </form>
  </br>
  <div class="form-group">

  </div>
  <div class="row travel-informations">

  </div>
</div>

      
<?php include 'view/template/footer.php'; ?>
<style type="text/css">
.weather_now {
    display: inline-block;
    background: #eee;
    border-top: solid 4px #09c;
    width: 100%;
    margin: 0 0 40px 0;
    padding: 5px;
}

#weather-description{
	text-transform: capitalize;
}

</style>
