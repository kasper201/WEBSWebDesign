var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.trim() !== "") {
            let response = JSON.parse(this.responseText);
            let products = Array.isArray(response) ? response : [response]; // make sure that it is actually an array
            let productsContainer = document.querySelector('.product');

            // log to console for debugging
            console.log(products);

            products.forEach(product => {
                let productDiv = document.createElement('div');
                productDiv.className = 'product';

                let imageContainer = document.createElement('div');
                imageContainer.className = 'productImage';

                let productImage = document.createElement('img');
                productImage.src = 'data:image/jpeg;base64,' + product.thumbnail; // set the image
                productImage.alt = product.Name;
                productImage.onerror = function () {
                    this.onerror = null; // To prevent infinite loop in case the placeholder image doesn't exist
                    this.src = '../Images/Basket.png'; // Replace with your placeholder image path
                };

                imageContainer.appendChild(productImage);

                let productName = document.createElement('div');
                productName.className = 'name';
                productName.textContent = product.Name;

                let productDescription = document.createElement('div');
                productDescription.className = 'description';
                productDescription.textContent = product.Description;

                // price container (static)
                let priceContainer = document.createElement('div');
                priceContainer.className = 'priceContainer';

                let productPrice = document.createElement('div');
                productPrice.className = 'price';
                productPrice.textContent = `€${product.Price}`;

                // Quantity selection and Add to Cart button container
                let actionContainer = document.createElement('div');
                actionContainer.className = 'actionContainer';

                // Quantity selection
                let quantitySelection = document.createElement('div');
                quantitySelection.className = 'quantitySelection';

                let quantityInput = document.createElement('input');
                quantityInput.type = 'number';
                quantityInput.value = 1;
                quantityInput.min = 1;
                quantityInput.max = 9999;
                quantityInput.className = 'quantityInput';

                quantityInput.oninput = function() {
                    if (this.value > 9999) {
                        this.value = 9999;
                    } else if (this.value < 1) {
                        this.value = 1;
                    }
                }

                quantitySelection.appendChild(quantityInput);

                let addToCartButton = document.createElement('button');
                addToCartButton.className = 'addToCart';
                addToCartButton.textContent = 'Add to cart';

                addToCartButton.onclick = function () { // add to cart
                    let cart = JSON.parse(localStorage.getItem('cart')) || [];
                    let productIndex = cart.findIndex(p => p.ID == product.ID);
                    if (productIndex >= 0) {
                        cart[productIndex].Quantity += parseInt(quantityInput.value);
                    } else {
                        cart.push({
                            ProductNr: product.ProductNr,
                            ID: parseInt(id),
                            Quantity: parseInt(quantityInput.value)
                        });
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    alert('Added to cart');
                }

                actionContainer.appendChild(quantitySelection);
                actionContainer.appendChild(addToCartButton);

                priceContainer.appendChild(productPrice);
                priceContainer.appendChild(actionContainer);

                productDiv.appendChild(imageContainer);
                productDiv.appendChild(productName);
                productDiv.appendChild(productDescription);
                productDiv.appendChild(priceContainer);

                productsContainer.appendChild(productDiv);
            });

            console.log(productsContainer.outerHTML);
        } else {
            console.log("Empty response received");
        }
    } else if (this.status == 500) {
        console.log("Error: " + this.status);
        console.log("response: " + this.responseText);
        console.log("State: " + this.readyState);
    } else {
        console.log("Error: " + this.status);
        console.log("State: " + this.readyState);
    }
};
// Get the URL parameters
var urlParams = new URLSearchParams(window.location.search);

// Get the value of id
var id = urlParams.get('id');

console.log("Sending request");
xhttp.open("GET", "../php/getProduct.php?productNr=" + id, true);
xhttp.send();