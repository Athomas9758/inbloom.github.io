document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const buyNowButtons = document.querySelectorAll(".buy-now");

    // Add to Cart functionality
    addToCartButtons.forEach(button => {
        button.addEventListener("click", function () {
            const product = button.getAttribute("data-product");
            const price = button.getAttribute("data-price");

            // Add item to cart
            addToCart(product, price);
            alert(`${product} has been added to the cart!`);
        });
    });

    // Buy Now functionality
    buyNowButtons.forEach(button => {
        button.addEventListener("click", function () {
            const product = button.getAttribute("data-product");
            const price = button.getAttribute("data-price");

            // Add item to cart and redirect to checkout
            addToCart(product, price);
            window.location.href = "/purchase/cart.html"; // Redirect to cart page
        });
    });

    // Function to add item to cart
    function addToCart(product, price) {
        let cart = JSON.parse(localStorage.getItem("cart")) || []; // Get existing cart or create a new one
        cart.push({ product, price }); // Add the new item
        localStorage.setItem("cart", JSON.stringify(cart)); // Save updated cart to localStorage
    }
});