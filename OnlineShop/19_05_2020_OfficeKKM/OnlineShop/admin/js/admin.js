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
  $(".goods-out select").on("change", selectGoods);
}

function selectGoods() {
  //   console.log("function selectGoods works");
  let id = $(".goods-out select option:selected").attr("data-id");
  console.log(id);
  $.post(
    "core.php",
    {
      action: "selectOneOfGoods",
      gid: id,
    },
    function (data) {
      //   console.log(data);
      data = JSON.parse(data);
      // fill the fields in admin.html
      $("#gname").val(data.name);
      $("#gcost").val(data.cost);
      $("#gdescription").val(data.description);
      $("#gimage").val(data.img);
      $("#gorder").val(data.orderintb);
      $("#gid").val(data.id);
    }
  );
}

function saveToDb() {
  let id = $("#gid").val();
  if (id != 0) {
    $.post(
      "core.php",
      {
        action: "updateGoods",
        gid: id,
        gname: $("#gname").val(),
        gcost: $("#gcost").val(),
        gdescription: $("#gdescription").val(),
        gorder: $("#gorder").val(),
        gimage: $("#gimage").val(),
      },
      function (data) {
        // console.log(data);
        if (data == " Record updated successfully") {
          alert("record updated");
          init();
        } else {
          console.log(data);
        }
      }
    );
  } else {
    $.post(
      "core.php",
      {
        action: "newGoods",
        gid: id,
        gname: $("#gname").val(),
        gcost: $("#gcost").val(),
        gdescription: $("#gdescription").val(),
        gorder: $("#gorder").val(),
        gimage: $("#gimage").val(),
      },
      function (data) {
        // console.log(data);
        if (data == " Record inserted successfully") {
          alert("record inserted");
          init();
        } else {
          console.log(data);
        }
      }
    );
  }
}

$(document).ready(function () {
  //   console.log("init wird gestartet!");
  init();
  $(".add-to-db").on("click", saveToDb);
});
