function listTemplate(listNum) {
  let html = ``;

  for (i = 1; i <= listNum; i++) {
    html += `
      <h6>Title #${i}</h6>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" class="validate" name="list[${i}][title]">
          <label for="list[${i}][title]">List Title</label>
        </div>
      </div>
      <h6>Ingredients</h6>
      <blockquote>
      Insert each item on a new line.<br/>Omit any list formats (bullets or numbers).
      </blockquote>
      <div class="row">
        <div class="input-field col s6">
          <textarea id="textarea${i}" class="materialize-textarea" name="list[${i}][ingredients]"></textarea>
        </div>
      </div>
      <h6>Directions</h6>
      <blockquote>
      Insert a line (enter/return) between each step.<br/>Omit any list formats (bullets or numbers).
      </blockquote>
      <div class="row">
        <div class="input-field col s6">
          <textarea id="textarea${i}" class="materialize-textarea" name="list[${i}][directions]"></textarea>
        </div>
      </div>`;
  }

    return html;
}


$(function() {

  $("#list_number").on("change", function() {
    let listNum = $(this).val();

    let result = listTemplate(listNum);

    $("#list-container").html(result);
  });

  $("#copyRecipe").on("click", function() {
    $("#recipeCardHtml").select();
    document.execCommand('copy');
    Materialize.toast('Copied Code!', 5000);
  });

});