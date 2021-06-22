// //setting default attribute to disabled of minus button
// document.querySelector(".minus-btn").setAttribute("disabled", "disabled");

// //taking value to increment decrement input value
// var valueCount

// //taking price value in variable
// var price =parseInt( document.getElementById("price").innerText);
// //taking total-price value in variable
// var totalamount = parseInt(document.getElementById("total-amount").innerText);

// //price calculation function
// function priceTotal() {
//     var total = valueCount * price;
//     document.getElementById("price").innerText = total;
// }

// function update(){
//     totalamount = totalamount + price;
//     document.getElementById("total-amount").innerText = totalamount;


// }

// //plus button
// document.querySelector(".plus-btn").addEventListener("click", function() {
//     //getting value of input
//     valueCount = document.getElementById("quantity").value;

//     //input value increment by 1
//     valueCount++;

//      //setting increment input value
//      document.getElementById("quantity").value = valueCount;

//     if (valueCount > 1) {
//         document.querySelector(".minus-btn").removeAttribute("disabled");
//         document.querySelector(".minus-btn").classList.remove("disabled");
//     }

//         //calling price function
//         priceTotal();
    
//         update();
    
// })

// //plus button
// document.querySelector(".minus-btn").addEventListener("click", function() {
//      //getting value of input
//      valueCount = document.getElementById("quantity").value;

//     //input value increment by 1
//     valueCount--

//     //setting increment input value
//     document.getElementById("quantity").value = valueCount

//     if (valueCount == 1) {
//         document.querySelector(".minus-btn").setAttribute("disabled", "disabled")
//     }

//     //calling price function
//     priceTotal()
// })

// //removing items from the cart

window.onload = (event) =>{
    $('.product-quantity input').change();
};
var shippingRate = 100.00; 
var fadeTime = 0;


/* Assign actions */
$('.product-quantity input').change(function() {
    updateQuantity(this);
});

$('.product-quantity .minus-btn').click(function() {
    decQuantity(this);
});

$('.product-quantity .plus-btn').click(function() {
    incQuantity(this);
});

$('.product-removal .btn').click( function() {
    removeItem(this);
});


/* Recalculate cart */
function recalculateCart()
{
  var subtotal = 0;
  
  /* Sum up row totals */
  $('.product').each(function () {
    subtotal += parseFloat($(this).children('.product-line-price').text());
  });
  
  /* Calculate totals */
  //var tax = subtotal * taxRate;
  var shipping = (subtotal > 0 ? shippingRate : 0);
  var total = subtotal + /*tax +*/ shipping;
  
  /* Update totals display */
  $('.totals-value').fadeOut(fadeTime, function() {
    $('#cart-subtotal').html(subtotal.toFixed(2));
    //$('#cart-tax').html(tax.toFixed(2));
    $('#cart-shipping').html(shipping.toFixed(2));
    $('#cart-total').html(total.toFixed(2));
    /*if(total == 0){
      $('.checkout').fadeOut(fadeTime);
    }else{
      $('.checkout').fadeIn(fadeTime);
    }*/
    $('.totals-value').fadeIn(fadeTime);
  });
}


/* Update quantity */
function updateQuantity(quantityInput)
{
  /* Calculate line price */
  var productRow = $(quantityInput).parent().parent();
  var price = parseFloat(productRow.children('.product-price').text());
  var quantity = $(quantityInput).val();
  var linePrice = price * quantity;
  
  /* Update line price display and recalc cart totals */
  productRow.children('.product-line-price').each(function () {
    $(this).fadeOut(fadeTime, function() {
      $(this).text(linePrice.toFixed(2));
      recalculateCart();
      $(this).fadeIn(fadeTime);
    });
  });  
}
function decQuantity(quantityBtn)
{
    var quantityInput = $(quantityBtn).parent().children('input');
    var quantity = parseInt(quantityInput.val());
    if (quantity != 1) {
        quantity--;
        quantityInput.val(quantity);
    }
    else{
      return;
    }
    quantityInput.change();
}
function incQuantity(quantityBtn)
{
    var quantityInput = $(quantityBtn).parent().children('input');
    var quantity = parseInt(quantityInput.val());
    quantity++;
    quantityInput.val(quantity);
    quantityInput.change();
}
/* Remove item from cart */
function removeItem(removeButton)
{
  /* Remove row from DOM and recalc cart total */
  var productRow = $(removeButton).parent().parent();
  productRow.slideUp(fadeTime, function() {
    productRow.remove();
    recalculateCart();
  });
}