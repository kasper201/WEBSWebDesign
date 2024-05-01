var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.trim() !== "") {
            let response = JSON.parse(this.responseText);
            let products = Array.isArray(response) ? response : [response]; // make sure that it is actually an array
            let basket = document.querySelector('.basket');

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

                // Quantity selection and Add to Cart button container
                let actionContainer = document.createElement('div');
                actionContainer.className = 'actionContainer';

                // Quantity selection
                let quantitySelection = document.createElement('div');
                quantitySelection.className = 'quantitySelection';

                // make sure that the quantity is a number already selected before
                let quantityInput = document.createElement('input');
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let productIndex = cart.findIndex(p => p.ProductNr == product.ProductNr);
                quantityInput.type = 'number';
                quantityInput.value = cart[productIndex].Quantity;
                quantityInput.min = 1;
                quantityInput.max = 9999;
                quantityInput.className = 'quantityInput';

                quantityInput.oninput = function() {
                    if (this.value > 9999) {
                        this.value = 9999;
                    } else if (this.value < 1) {
                        this.value = 1;
                    }
                    // update the cart in local storage
                    if (productIndex >= 0) {
                        cart[productIndex].Quantity = parseInt(quantityInput.value);
                    } else {
                        cart.push({
                            ProductNr: product.ProductNr,
                            Quantity: parseInt(quantityInput.value)
                        });
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                }

                quantitySelection.appendChild(quantityInput);

                let deleteButton = document.createElement('button');
                deleteButton.className = 'deleteFromCart';
                deleteButton.textContent = 'Delete from cart';

                deleteButton.onclick = function () { // remove from cart
                    if (productIndex >= 0) {
                        cart.splice(productIndex, 1);
                        localStorage.setItem('cart', JSON.stringify(cart));
                        alert('Removed from cart');
                        // Refresh the page or update the cart display
                        location.reload();
                    }
                }

                actionContainer.appendChild(deleteButton);
                actionContainer.appendChild(quantitySelection);

                productDiv.appendChild(imageContainer);
                productDiv.appendChild(productName);
                productDiv.appendChild(productDescription);
                productDiv.appendChild(actionContainer);

                basket.appendChild(productDiv);
            });

            console.log(basket.outerHTML);
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

let cart = JSON.parse(localStorage.getItem('cart')) || [];

let productIds = cart.map(item => item.ID);
let productIdsString = productIds.join(',');

let productAmount = cart.map(item => item.Quantity);

console.log(productIds);

console.log("Sending request");
xhttp.open("GET", "../php/convert4Overview.php?productNr=" + productIdsString, true);
xhttp.send();