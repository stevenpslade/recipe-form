<?php
if (isset($_POST)) {
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

  if (isset($_POST['display_time'])) {
    $display_time = $_POST['display_time'];
    $active_time  = $_POST['active_time'];
    $total_time   = $_POST['total_time'];
  }

  if (isset($_POST['display_notes'])) {
    $display_notes = $_POST['display_notes'];
    $notes         = $_POST['notes'];
  }
} else {
  $title         = "";
  $image_url     = "";
  $serving_size = "";
  $serving_unit  = "";
  $active_time   = "";
  $list_number   = "";
  $notes         = "";
}
?>

<div class="section row">
  <div class="col s 12">
    <h3 class="red-text text-lighten-2">Just a few questions...</h3>
  </div>

  <form id="recipe-form" class="col s12" action="form.php" method="post">
    <div class="row">
      <div class="input-field col s6">
        <input type="text" class="validate" name="title" value="<?php echo $title ?>">
        <label for="title">Recipe Title</label>
      </div>
      <div class="input-field col s6">
        <input type="text" class="validate" name="image_url" value="<?php echo $image_url ?>">
        <label for="image_url">Image URL</label>
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
    <div class="row">
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
    </div>
    <div class="row">
      <div class="col s12">
        How many ingredient/direction lists on the recipe card?
        <div class="input-field inline">
          <input id="list_number" type="number" class="validate" name="list_number" value="<?php echo $list_number ?>">
          <label for="list_number">#</label>
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












