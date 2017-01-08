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

<div class="row">
  <form class="col s12">
    <div class="row">
      <div class="input-field col s6">
        <input placeholder="Placeholder" id="first_name" type="text" class="validate">
        <label for="first_name">First Name</label>
      </div>
    </div>
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit
      <i class="material-icons right">send</i>
    </button>
  </form>
</div>

<?php
require('footer.php');
