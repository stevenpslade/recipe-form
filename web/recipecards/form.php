<?php
if (!empty($_POST)) {
  $title            = $_POST['title'];
  $image_url        = $_POST['image_url'];
  $list_number      = $_POST['list_number'];
  $list_array       = $_POST['list'];
  $action           = $_POST['action'];

  if (isset($_POST['display_servings'])) {
    $display_servings = $_POST['display_servings'];
    $serving_size     = $_POST['serving_size'];
    $serving_unit     = $_POST['serving_unit'];
  }

  // if (isset($_POST['display_time'])) {
  //   $display_time = $_POST['display_time'];
  //   $active_time  = $_POST['active_time'];
  //   $total_time   = $_POST['total_time'];
  // }

  if (isset($_POST['display_notes'])) {
    $display_notes = $_POST['display_notes'];
    $notes         = $_POST['notes'];
  }

  $errorValidations = array();

  if (empty($title)) {
    $errorValidations['title'] = "Title is required.";
  }

  if (empty($image_url)) {
    $errorValidations['image_url'] = "Image URL is required.";
  }

  if (empty($list_number) || !ctype_digit($list_number)) {
    $errorValidations['list_number'] = "Choose a valid number of lists.";
  }

  if (count($errorValidations) < 1) {

    // Build recipe card HTML
    $recipeCardHtml  = '';
    $recipeCardHtml .= '<div id="printArea">';
    $recipeCardHtml .= '<meta property="og:site_name" content="nikkidinkicooking.com"/><meta property="og:author" content="Nikki Dinki"/>';
    $recipeCardHtml .= '<div id="recipeCard" itemscope itemtype="http://schema.org/Recipe" style="width:100%;">';
    $recipeCardHtml .= '<h1 class="recipeTitle" itemprop="name">' . $title . '</h1>';

    if (isset($display_servings)) {
      $recipeCardHtml .= '<p class="recipeInfo"><em>servings:</em> ' . $serving_size . ' <span itemprop="recipeYield">' . $serving_unit . '</span></p>';
    }

    $recipeCardHtml .= '<div id="recipeContainer">';
    $recipeCardHtml .= '<img style="border: 2px solid #2c3852;" class="recipeImage" width="250" itemprop="image" src="' . $image_url . '">';
    $recipeCardHtml .= '<img id="printButton" class="recipeImage" width="255" src="/s/print_recipe_button1.png">';
    $recipeCardHtml .= '<div style="float:right;clear:both;margin-top:1rem;" class="rw-ui-container"></div>';

    foreach ($list_array as $list) {
      if ($list_number == 1) {
        $recipeCardHtml .= '<h3 class="ingredientsHeader">Ingredients:</h3>';
      } else {
        $recipeCardHtml .= '<h3 class="ingredientsHeader">' . $list["title"] .':</h3>';
      }

      $recipeCardHtml .= '<ul class="ingredientsList">';

      $ingredients_array = explode("\n", $list['ingredients']);

      foreach($ingredients_array as $ingredient) {
        if (strlen($ingredient) > 1) {
          $recipeCardHtml .= '<li itemprop="ingredients">' . $ingredient . '</li>';
        }
      }

      $recipeCardHtml .= '</ul>';
    }

    foreach ($list_array as $list) {
      if ($list_number == 1) {
        $recipeCardHtml .= '<h3 class="directionsHeader">Directions:</h3>';
      } else {
        $recipeCardHtml .= '<h3 class="directionsHeader">' . $list["title"] .':</h3>';
      }

      $recipeCardHtml .= '<ol class="directionsList">';

      $directions_array = explode("\n", $list['directions']);

      foreach($directions_array as $direction) {
        if (strlen($direction) > 1) {
          $recipeCardHtml .= '<li itemprop="recipeInstructions">' . $direction . '</li>';
        }
      }

      $recipeCardHtml .= '</ol>';
    }

    if (isset($display_notes)) {
      $recipeCardHtml .= '<h3 class="notesHeader">Notes:</h3>';
      $recipeCardHtml .= '<ul class="notesList">';

      $notes_array = explode("\n", $notes);

      foreach($notes_array as $note) {
        if (strlen($note) > 1) {
          $recipeCardHtml .= '<li>' . $note . '</li>';
        }
      }

      $recipeCardHtml .= '</ul>';
    }

    $recipeCardHtml .= '</div>';

    $recipeCardHtml .=
      '<div id="recipeFooter">
          <i class="fa fa-twitter" aria-hidden="true"></i>
          <i class="fa fa-snapchat-ghost" aria-hidden="true"></i> 
          <i class="fa fa-pinterest" aria-hidden="true"></i>
          : @NikkiDinki<br/><br/>
          <i class="fa fa-instagram" aria-hidden="true"></i>
          <i class="fa fa-facebook" aria-hidden="true"></i>
          : @NikkiDinkiCooking
        </div>
      </div>
      </div>';
  }

} else {
  $title         = "";
  $image_url     = "";
  $serving_size  = "";
  $serving_unit  = "";
  // $active_time   = "";
  $list_number   = "";
  $notes         = "";
}
?>

<?php if (isset($recipeCardHtml) && !empty($recipeCardHtml)) { ?>
  <div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">Recipe Card Created!</span>
          <p>Click the copy button below to copy the recipe card code and then paste it into a code block in Squarespace.</p>
        </div>
<!--         <div class="card-action">
          <a href="#">This is a link</a>
          <a href="#">This is a link</a>
        </div> -->
      </div>
<?php 
  echo '<textarea id="recipeCardHtml" class="z-depth-2">' , $recipeCardHtml , '</textarea>';
  echo '<a id="copyRecipe" class="waves-effect waves-light btn">Copy</a>';
  echo '</div></div>';
} ?>

<div class="section row">
  <div class="col s 12">
    <h2 class="header red-text text-lighten-2">Just a few questions...</h2>
  </div>

  <form id="recipe-form" class="col s12" action="form.php" method="post">
    <div class="row">
      <div class="input-field col s6">
        <input type="text" class="validate <?php echo (isset($errorValidations['title']) ? 'invalid' : '') ?>" name="title" value="<?php echo $title ?>">
        <label data-error="<?php echo (isset($errorValidations['title']) ? $errorValidations['title'] : '') ?>" for="title">Recipe Title</label>
      </div>
      <div class="input-field col s6">
        <input type="text" class="validate <?php echo (isset($errorValidations['image_url']) ? 'invalid' : '') ?>" name="image_url" value="<?php echo $image_url ?>">
        <label data-error="<?php echo (isset($errorValidations['image_url']) ? $errorValidations['image_url'] : '') ?>" for="image_url">Image URL</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s3">
        <input type="number" class="validate" name="serving_size" value="<?php echo $serving_size ?>">
        <label for="serving_size">Serving Size</label>
      </div>
      <div class="input-field col s5">
        <input placeholder="ex: bowls" type="text" class="validate" name="serving_unit" value="<?php echo $serving_unit ?>">
        <label for="serving_unit">Serving Unit</label>
      </div>
      <div class="input-field col s4">
        <input type="checkbox" class="filled-in" id="display_servings" <?php if (isset($display_servings)) echo "checked='checked'"; ?> name="display_servings" />
        <label for="display_servings">Display Servings</label>
      </div>
    </div>
    <!-- div class="row">
      <div class="input-field col s4">
        <input type="text" class="validate" name="active_time" value="<?php echo $active_time ?>">
        <label for="active_time">Active Time</label>
      </div>
      <div class="input-field col s4">
        <input  type="text" class="validate" name="total_time" value="<?php echo $total_time ?>">
        <label for="total_time">Total Time</label>
      </div>
      <div class="input-field col s4">
        <input type="checkbox" class="filled-in" id="display_time" <?php if (isset($display_time)) echo "checked='checked'"; ?> name="display_time" />
        <label for="display_time">Display Time</label>
      </div>
    </div -->
    <div class="row">
      <div class="col s12">
        How many ingredient/direction lists on the recipe card?
        <div class="input-field inline">
          <input id="list_number" type="number" class="validate <?php echo (isset($errorValidations['list_number']) ? 'invalid' : '') ?>" name="list_number" value="<?php echo $list_number ?>">
          <label data-error="<?php echo (isset($errorValidations['list_number']) ? $errorValidations['list_number'] : '') ?>" for="list_number">#</label>
        </div>
      </div>
    </div>
    <div id="list-container">
    <?php
    if (isset($list_array)) {
      $html = '';
      $cnt  = 1;
      foreach ($list_array as $list) {
        $html .= '<h6>Title #' . $cnt . '</h6>
              <div class="row">
                <div class="input-field col s6">
                  <input type="text" class="validate" name="list[' . $cnt . '][title]" value="' . $list["title"] . '">
                  <label for="list[' . $cnt . '][title]">List Title</label>
                </div>
              </div>
              <h6>Ingredients</h6>
              <blockquote>
              Insert each item on a new line.<br/>Omit any list formats (bullets or numbers).
              </blockquote>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="textarea$' . $cnt . '" class="materialize-textarea" name="list[' . $cnt . '][ingredients]">' . $list["ingredients"] . '</textarea>
                </div>
              </div>
              <h6>Directions</h6>
              <blockquote>
              Insert a line (enter/return) between each step.<br/>Omit any list formats (bullets or numbers).
              </blockquote>
              <div class="row">
                <div class="input-field col s6">
                  <textarea id="textarea' . $cnt . '" class="materialize-textarea" name="list[' . $cnt . '][directions]">' . $list["directions"] . '</textarea>
                </div>
              </div>';

        $cnt++;
      }
      echo $html;
    }
    ?>
    </div>
    <div class="row">
      <blockquote>
      Insert each item on a new line.<br/>Omit any list formats (bullets or numbers).
      </blockquote>
      <div class="input-field col s6">
        <textarea id="notes_textarea" class="materialize-textarea" name="notes"><?php echo $notes ?></textarea>
        <label for="notes_textarea">Notes</label>
      </div>
      <div class="input-field col s4">
        <input type="checkbox" class="filled-in" id="display_notes" <?php if (isset($display_notes)) echo "checked='checked'"; ?> name="display_notes" />
        <label for="display_notes">Display Notes</label>
      </div>
    </div>
    <button class="btn waves-effect waves-light" type="submit" name="action" value="create_recipe">Submit
      <i class="material-icons right">send</i>
    </button>
  </form>
</div>












