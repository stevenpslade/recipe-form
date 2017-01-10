<?php

require('../vendor/autoload.php');
require('header.php');


$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// // Our web handlers!

// $app->run();
?>

<div class="section row">
  <div class="col s 12">
    <h3 class="red-text text-lighten-2">Just a few questions...</h3>
  </div>

  <form class="col s12">
    <div class="row">
      <div class="input-field col s6">
        <input type="text" class="validate" name="title">
        <label for="title">Recipe Title</label>
      </div>
      <div class="input-field col s6">
        <input type="text" class="validate" name="image_url">
        <label for="image_url">Image URL</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s3">
        <input type="number" class="validate" name="serving_size">
        <label for="serving_size">Serving Size</label>
      </div>
      <div class="input-field col s5">
        <input placeholder="ex: bowls" type="text" class="validate" name="serving_unit">
        <label for="serving_unit">Serving Unit</label>
      </div>
      <div class="input-field col s4">
        <input type="checkbox" class="filled-in" id="display_servings" checked="checked" name="show_servings" />
        <label for="display_servings">Display Servings</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <input type="text" class="validate" name="active_time">
        <label for="active_time">Active Time</label>
      </div>
      <div class="input-field col s4">
        <input  type="text" class="validate" name="total_time">
        <label for="total_time">Total Time</label>
      </div>
      <div class="input-field col s4">
        <input type="checkbox" class="filled-in" id="display_time" checked="checked" name="display_time" />
        <label for="display_time">Display Time</label>
      </div>
    </div>
    <button class="btn waves-effect waves-light" type="submit" name="action" value="create_recipe">Submit
      <i class="material-icons right">send</i>
    </button>
  </form>
</div>

<?php
require('footer.php');
