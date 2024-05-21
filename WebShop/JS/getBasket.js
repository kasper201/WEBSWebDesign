let totalPrice = 0; // Total price for all items in the cart

// create order
function createOrder() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let productIds = cart.map(item => item.ID);
    // insert the products into the order
    "CALL AddOrder(orderID, userID, productID, quantity);"
}

var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.trim() !== "") {
            let response = JSON.parse(this.responseText);
            let products = Array.isArray(response) ? response : [response]; // make sure that it is actually an array
            let basket = document.querySelector('.basket');

            // create bottom container for the total price and go to checkout button
            let bottomContainer = document.createElement('div');
            bottomContainer.className = 'bottomContainer';

            // Total price of the products
            let totalProductPrice = document.createElement('div');
            totalProductPrice.className = 'productPrice';

            let goToCheckout = document.createElement('button');
            goToCheckout.className = 'goToCheckout';
            goToCheckout.textContent = 'TO CHECKOUT';

            goToCheckout.onclick = function () { // add to cart
                if(localStorage.getItem('user') === null) {
                    alert('Please log in to continue');
                    return;
                } else if(cart.length === 0) {
                    alert('Cart is empty');
                    return;
                }
                createOrder();
            }

            // log to console for debugging
            console.log(products);

            products.forEach(product => {
                // define cart
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let productIndex = cart.findIndex(p => p.ID == product.ID);

                // create the product div
                let productDiv = document.createElement('div');
                productDiv.className = 'product';

                let imageContainer = document.createElement('div');
                imageContainer.className = 'productImage';

                let productImage = document.createElement('img');
                productImage.src = product.thumbnail; // set the image
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
                productDescription.textContent = product.Description.split('. ')[0] + '.'; // only show the first sentence

                let productPrice = document.createElement('div');
                productPrice.className = 'price';
                productPrice.textContent = `€${parseFloat((product.Price * cart[productIndex].Quantity).toFixed(2))}`;

                // Add the price to the total price
                totalPrice += product.Price * cart[productIndex].Quantity;

                // Quantity selection and Add to Cart button container
                let actionContainer = document.createElement('div');
                actionContainer.className = 'actionContainer';

                // Quantity selection
                let quantitySelection = document.createElement('div');
                quantitySelection.className = 'quantitySelection';

                // make sure that the quantity is a number already selected before
                let quantityInput = document.createElement('input');
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
                            ID: product.ID,
                            Quantity: parseInt(quantityInput.value)
                        });
                    }
                    localStorage.setItem('cart', JSON.stringify(cart));
                    // update the total price of the product and the total price of the cart
                    productPrice.textContent = `€${parseFloat((product.Price * cart[productIndex].Quantity).toFixed(2))}`;

                    // recalculate the total price of the cart
                    totalPrice = 0;
                    for (let i = 0; i < cart.length; i++) {
                        let productInCart = products.find(p => p.ID == cart[i].ID);
                        if (productInCart) {
                            totalPrice += productInCart.Price * cart[i].Quantity;
                        }
                    }

                    totalProductPrice.textContent = `Total: €${parseFloat((totalPrice).toFixed(2))}`;
                }

                quantitySelection.appendChild(quantityInput);

                let deleteButton = document.createElement('button');
                deleteButton.className = 'deleteFromCart';

                deleteButton.onclick = function () { // remove from cart
                    if (productIndex >= 0) {
                        cart.splice(productIndex, 1);
                        localStorage.setItem('cart', JSON.stringify(cart));
                        alert('Removed from cart');
                        // Refresh the page or update the cart display
                        location.reload();
                    }
                }

                let deleteButtonImage = document.createElement('img');
                deleteButtonImage.src = '../Images/bin.png';
                deleteButtonImage.alt = 'Delete from cart';

                deleteButton.appendChild(deleteButtonImage);

                actionContainer.appendChild(deleteButton);
                actionContainer.appendChild(quantitySelection);
                actionContainer.appendChild(productPrice);

                // make the entire tmp div a link to the product page
                let productLink = document.createElement('a');
                productLink.href = `../php/Product.php?id=${cart[productIndex].ID}`;

                let tempDiv = document.createElement('div');
                tempDiv.className = 'tmp';

                // Append the image, name, and description to the temp div
                let imageLink = imageContainer.cloneNode(true); // clone the imageContainer
                tempDiv.appendChild(imageLink);

                let nameLink = productName.cloneNode(true); // clone the productName
                tempDiv.appendChild(nameLink);

                let descriptionLink = productDescription.cloneNode(true); // clone the productDescription
                tempDiv.appendChild(descriptionLink);

                // Append the temp div to the product link
                productLink.appendChild(tempDiv);

                productDiv.appendChild(productLink);
                productDiv.appendChild(actionContainer);

                basket.appendChild(productDiv);

            });

            // Set the total price after all products have been processed
            totalProductPrice.textContent = `Total: €${parseFloat((totalPrice).toFixed(2))}`;

            bottomContainer.appendChild(goToCheckout);
            bottomContainer.appendChild(totalProductPrice);
            basket.appendChild(bottomContainer);

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
let productIdsString = productIds.join(',') + "&onSale=null";

let productAmount = cart.map(item => item.Quantity);

console.log(productIds);

console.log("Sending request");
xhttp.open("GET", "../php/convert4Overview.php?productNr=" + productIdsString, true);
xhttp.send();