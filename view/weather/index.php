<?php include 'view/template/header.php'; ?>

<div class="col-sm-9 col-md-9 main-weather" style="margin-top:80px;">
  <h2 class="sub-header">Weather Information</h2>
  <form name="form-weather" id="form-weather">
    <div class="form-group">
      <small id="locationHelp" class="form-text text-muted">Please enter a location to know the weather information and click search</small>
      <input type="text" class="form-control" id="location" placeholder="Location" name="location">
      <label class="lbl-error"></label>
    </div>
    <input type="hidden" name="form-submitted" value="1">
    <button type="button" id="btn-search" class="btn btn-primary">Search</button>
  </form>
    <div class="row weather-informations">
  </div>
</div>

      
<?php include 'view/template/footer.php'; ?>