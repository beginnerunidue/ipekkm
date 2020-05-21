function init() {
  $.post(
    "core.php",
    {
      action: "init",
    },
    showGoods
  );
}

function showGoods(data) {
  console.info(data);
  data = JSON.parse(data);
  console.log(data);

  let out = "<select>";
  out += '<option data-id="0">Neuer Artikel</option>';
  for (let id in data) {
    out += `<option data-id="${id}">${data[id].name}</option>`;
  }
  out += "</select>";
  $(".goods-out").html(out);
}

$(document).ready(function () {
  //   console.log("init wird gestartet!");
  init();
});
