function fetchGeneral(params)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.trim() !== "") {
                let response = JSON.parse(this.responseText);
                let products = Array.isArray(response) ? response : [response]; // make sure that it is actually an array
                let productsContainer = document.querySelector('.items');

                // log to console for debugging
                console.log(products);

                products.forEach(product => {
                    let productDiv = document.createElement('div');
                    productDiv.className = 'product';

                    let productLink = document.createElement('a');
                    productLink.href = `../php/Product.php?id=${product.ID}`;

                    let productImage = document.createElement('img');
                    productImage.src = product.thumbnail; // set the image
                    productImage.alt = product.Name;
                    productImage.className = 'productImage';
                    productImage.onerror = function (event) {
                        console.log("Error loading image: ", event);
                        console.log("Failed to load image with src: ", this.src);
                        this.onerror = null; // To prevent infinite loop in case the placeholder image doesn't exist
                        this.src = '../Images/ohno.png';
                    };

                    let productName = document.createElement('h3');
                    productName.textContent = product.Name;

                    let productPrice = document.createElement('p');
                    productPrice.textContent = `Price: €${product.Price}`;

                    let addToCartDiv = document.createElement('div');
                    addToCartDiv.className = 'addToCartDiv';

                    let quantityInput = document.createElement('input');
                    quantityInput.type = 'number';
                    quantityInput.value = 1;
                    quantityInput.min = 1;
                    quantityInput.max = 999;
                    quantityInput.className = 'quantityInput';

                    quantityInput.oninput = function() {
                        if (this.value > 999) {
                            this.value = 999;
                        } else if (this.value < 1) {
                            this.value = 1;
                        }
                    }

                    let addToCartButton = document.createElement('button');
                    addToCartButton.className = 'addToCart';

                    addToCartButton.onclick = function () { // add to cart
                        let cart = JSON.parse(localStorage.getItem('cart')) || [];
                        let productIndex = cart.findIndex(p => p.ID == product.ID);
                        if (productIndex >= 0) {
                            cart[productIndex].Quantity += parseInt(quantityInput.value);
                        } else {
                            cart.push({
                                ProductNr: product.ProductNr,
                                ID: parseInt(product.ID),
                                Quantity: parseInt(quantityInput.value)
                            });
                        }
                        localStorage.setItem('cart', JSON.stringify(cart));
                        alert('Added to cart');
                    }

                    let productButtomImage = document.createElement('img');
                    productButtomImage.src = '../Images/Basket.png';

                    addToCartButton.appendChild(productButtomImage);

                    productLink.appendChild(productImage);
                    productLink.appendChild(productName);
                    productLink.appendChild(productPrice);
                    addToCartDiv.appendChild(quantityInput);
                    addToCartDiv.appendChild(addToCartButton);

                    productDiv.appendChild(productLink);
                    productDiv.appendChild(addToCartDiv);

                    productsContainer.appendChild(productDiv);
                    console.log(productsContainer.outerHTML);
                });
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
    console.log("Sending request");
    var queryString = Object.keys(params).map(key => key + '=' + params[key]).join('&');

    console.log("Sending request: " + queryString);
    xhttp.open("GET", "../php/convert4Overview.php?" + queryString, true);
    xhttp.send();
}

// TODO: Make sort by price