document.addEventListener("DOMContentLoaded", function() {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    addToCartButtons.forEach(button => {
        button.addEventListener("click", function() {
            const product = button.getAttribute('data-product');
            const price = button.getAttribute('data-price');
            alert(`${product} has been added to the cart for $${price}`);
        });
    });

    const buyNowButtons = document.querySelectorAll(".buy-now");

    buyNowButtons.forEach(button => {
        button.addEventListener("click", function() {
            const product = button.getAttribute('data-product');
            const price = button.getAttribute('data-price');
            alert(`Proceeding to checkout for ${product} at $${price}`);
        });
    });
});
