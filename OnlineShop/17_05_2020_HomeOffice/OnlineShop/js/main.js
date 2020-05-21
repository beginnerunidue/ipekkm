let cart = {}; // Warenkorb

function init() {
  // Ausgabe der Ware auf der Hauptseite
  $.getJSON("goods.json", goodsOut);
}

function goodsOut(data) {
  // let goods = data;
  console.log(data);
  let out = "";
  for (let key in data) {
    //--------ES5
    // out += '<div class="cart">';
    // out += '<p class="name">' + data[key].name + '</p>';
    // out += '<img src="images/' + data[key].img + '" height="100" width="100" alt="">';
    // out += '<div class="cost">' + data[key].cost + '</div>';
    // out += '<button class="add-to-cart">Add to cart</button>';
    // out += '</div>'

    //--------ES6
    out += '<div class="cart">';
    out += `<p class="name">${data[key].name}</p>`;
    out += `<img src="images/${data[key].img}" height="100" width="100" alt="">`;
    out += `<div class="cost">${data[key].cost}</div>`;
    out += `<button class="add-to-cart" data-id="${key}">Add to cart</button>`;
    out += "</div>";
  }
  $(".goods-out").html(out);
  $(".add-to-cart").on("click", addToCart);
}

function addToCart() {
  // add goods to the cart
  let id = $(this).attr("data-id");
  console.info("you added articel: " + id);
  if (cart[id] == undefined) {
    cart[id] = 1; // hier wird zu dem array cart
    // neues element mit id z.B. 1234 hinzugefügt
    // diese id is identisch mit key in array data,
    // id wird über Parameter data-id übergeben (hängt an dem Button)
    // und gleichzeitig dem element 1234 wird Wert 1 zugewiesen 1234: 1
  } else {
    cart[id]++; //bzw. Wert für element mit id 1234 wird um ein erhöht.
  }
  console.log(cart);
  showMiniCart();
  saveCart();
}

function showMiniCart() {
  // show MiniCart
  let out = "";
  for (let key in cart) {
    out += key + "---" + cart[key] + "<br>";
  }
  $(".mini-cart").html(out);
}

function saveCart() {
  // save cart in localStorage
  localStorage.setItem("cart", JSON.stringify(cart)); // convert cart to string
}

function loadCart() {
  if (localStorage.getItem("cart")) {
    cart = JSON.parse(localStorage.getItem("cart"));
    showMiniCart();
  }
}

$(document).ready(function () {
  init();
  loadCart();
});

// init();
