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

    // Buy Now functionality (adds item to cart first, then redirects)
    buyNowButtons.forEach(button => {
        button.addEventListener("click", function () {
            const product = button.getAttribute("data-product");
            const price = button.getAttribute("data-price");

            // Add item to cart first
            addToCart(product, price);

            // Use a slight delay to ensure data is stored before redirecting
            setTimeout(() => {
                window.location.href = "cart.html"; // Redirect to cart page
            }, 200);
        });
    });

    // Function to add item to cart
    function addToCart(product, price) {
        let cart = JSON.parse(localStorage.getItem("cart")) || []; // Get existing cart or create a new one
        cart.push({ product, price }); // Add the new item
        localStorage.setItem("cart", JSON.stringify(cart)); // Save updated cart to localStorage
    }
});
