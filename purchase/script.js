// let cart = [];
// let totalPrice = 0;

// // Function to add items to the cart
// function addToCart(itemName, price) {
//   cart.push({ itemName, price });
//   totalPrice += price;

//   // Update cart items and total price on the page
//   updateCartDisplay();
// }

// // Function to update the cart UI
// function updateCartDisplay() {
//   const cartItemsList = document.getElementById('cart-items');
//   const totalPriceElement = document.getElementById('total-price');
//   const checkoutButton = document.getElementById('checkout-btn');

//   // Clear the existing cart items
//   cartItemsList.innerHTML = '';

//   // Add updated items to the cart list
//   cart.forEach(item => {
//     const listItem = document.createElement('li');
//     listItem.textContent = `${item.itemName} - $${item.price}`;
//     cartItemsList.appendChild(listItem);
//   });

//   // Update the total price
//   totalPriceElement.textContent = totalPrice;

//   // ✅ Ensure the checkout button is always visible
//   checkoutButton.style.display = 'inline-block';
// }

// // Function to handle checkout and redirect to confirmation page
// function checkout() {
//   // Store cart information in localStorage to persist it
//   localStorage.setItem('cart', JSON.stringify(cart));
//   localStorage.setItem('totalPrice', totalPrice);

//   // Redirect to the confirmation page
//   window.location.href = 'confirmation.html'; 
// }

// // ✅ Ensure the checkout button is visible even on page load
// document.addEventListener('DOMContentLoaded', () => {
//   updateCartDisplay(); // This ensures the button is displayed when the page loads
// });


// // Hamburger Menu
// function toggleMenu() {
//   var menu = document.getElementById('menu');
//   menu.classList.toggle('active');
// }

// // Hide the menu when clicking outside of it
// document.addEventListener('click', function(event) {
//   var menu = document.getElementById('menu');
//   var menuIcon = document.querySelector('.menu-icon');
  
//   // Check if the click is outside the menu and menu icon
//   if (!menu.contains(event.target) && !menuIcon.contains(event.target)) {
//     menu.classList.remove('active');
//   }
// });


// Load cart items from localStorage
let cart = JSON.parse(localStorage.getItem("cart")) || [];
let totalPrice = 0;

// Function to update the cart UI
function updateCartDisplay() {
  const cartItemsList = document.getElementById("cart-items");
  const totalPriceElement = document.getElementById("total-price");

  // Clear the existing cart items
  cartItemsList.innerHTML = "";

  // Reset total price
  totalPrice = 0;

  // Add updated items to the cart list
  cart.forEach((item, index) => {
    const listItem = document.createElement("li");

    // Display item name and price
    listItem.textContent = `${item.product} - $${item.price}`;

    // Add a remove button for each item
    const removeButton = document.createElement("button");
    removeButton.textContent = "Remove";
    removeButton.classList.add("remove-btn");
    removeButton.addEventListener("click", () => removeItem(index));

    listItem.appendChild(removeButton);
    cartItemsList.appendChild(listItem);

    // Calculate total price
    totalPrice += parseFloat(item.price);
  });

  // Update the total price
  totalPriceElement.textContent = totalPrice.toFixed(2);
}

// Function to remove an item from the cart
function removeItem(index) {
  cart.splice(index, 1); // Remove the item from the cart array
  localStorage.setItem("cart", JSON.stringify(cart)); // Update localStorage
  updateCartDisplay(); // Refresh the cart display
}

// Function to handle checkout
function checkout() {
  if (cart.length === 0) {
    alert("Your cart is empty. Please add items before checking out.");
    return;
  }

  // Store the total price in localStorage for the confirmation page
  localStorage.setItem("totalPrice", totalPrice);

  // Redirect to the confirmation page
  window.location.href = "confirmation.html";
}

// Load cart items when the page loads
document.addEventListener("DOMContentLoaded", function () {
  updateCartDisplay();
});

// Hamburger Menu
function toggleMenu() {
  const menu = document.getElementById("menu");
  menu.classList.toggle("active");
}

// Hide the menu when clicking outside of it
document.addEventListener("click", function (event) {
  const menu = document.getElementById("menu");
  const menuIcon = document.querySelector(".menu-icon");

  // Check if the click is outside the menu and menu icon
  if (!menu.contains(event.target) && !menuIcon.contains(event.target)) {
    menu.classList.remove("active");
  }
});