let cart = {};

function loadCart() {
  if (localStorage.getItem("cart")) {
    cart = JSON.parse(localStorage.getItem("cart")); // decode item and put in cart
    console.log(cart);
    if (isEmpty(cart)) {
      $(".main-cart").html("Cart is empty!");
    } else {
      showCart();
    }
  }
}

function showCart() {
  if (isEmpty(cart)) {
    $(".main-cart").html("Cart is empty!");
  } else {
    $.getJSON("goods.json", function (data) {
      console.log(data);
      let out = "";
      for (let id in cart) {
        // key is id of data
        out += `<button data-id="${id}" class="del-goods">X</button>`;
        out += ` <img src="images/${data[id].img}" height="100" width="100">`;
        out += ` ${data[id].name} - `;
        out += `<button data-id="${id}" class="minus-goods">-</button>`;
        out += ` ${cart[id]} `;
        out += ` <button data-id="${id}" class="plus-goods">+</button>  `;
        $kosten = cart[id] * data[id].cost;

        $kosten = parseFloat($kosten).toFixed(2);
        // out += "€ " + cart[id] * data[id].cost;
        out += "€ " + $kosten;
        out += "<br>";
      }
      $(".main-cart").html(out);
      $(".del-goods").on("click", delGoods);
      $(".plus-goods").on("click", plusGoods);
      $(".minus-goods").on("click", minusGoods);
    });
  }
}

function isEmpty(object) {
  //test the cart if it is empty
  let empty = true;
  for (let key in object) {
    if (object.hasOwnProperty(key)) {
      empty = false;
    } else {
      empty = true;
    }
  }
  return empty;
}

function delGoods() {
  // delete goods from cart
  let id = $(this).attr("data-id");
  delete cart[id];
  saveCart();
  showCart();
}

function plusGoods() {
  // add goods to the cart
  let id = $(this).attr("data-id");
  cart[id]++;
  saveCart();
  showCart();
}

function minusGoods() {
  // take goods away from the cart
  let id = $(this).attr("data-id");
  if (cart[id] == 1) {
    delete cart[id];
  } else {
    cart[id]--;
    console.info(
      "id für diese Ware ist: " + id + " Wert => cart[id]=  " + cart[id]
    );
  }
  saveCart();
  showCart();
}

function saveCart() {
  // save cart in localStorage
  localStorage.setItem("cart", JSON.stringify(cart)); // convert cart to string
}

function sendEMail() {
  let ename = $("#ename").val();
  let email = $("#email").val();
  let ephone = $("#ephone").val();
  if (ename != "" && email != "" && ephone != "") {
    if (!isEmpty(cart)) {
      // verschicken Bestätigung
      $.post(
        "core/mail.php",
        {
          ename: ename,
          email: email,
          ephone: ephone,
          cart: cart,
        },
        function (mail_answer) {
          console.info("info zu deiner Bestellung" + mail_answer);
          if (mail_answer == 1) {
            alert("Bestellung ist abgeschickt");
          } else {
            alert("Wiederholen Sie bitte Ihre Bestellung");
          }

          // console.log(mail_answer);
        }
      );
    }
  } else {
    alert("Füllen Sie alle Input-Felder aus");
  }
}

$(document).ready(function () {
  loadCart();
  $(".send-email").on("click", sendEMail); // send email mit der Bestellung
});
