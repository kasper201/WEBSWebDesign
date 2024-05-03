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
                        this.src = '../Images/Basket.png';
                    };

                    let productName = document.createElement('h3');
                    productName.textContent = product.Name;

                    let productPrice = document.createElement('p');
                    productPrice.textContent = `Price: €${product.Price}`;

                    productLink.appendChild(productImage);
                    productLink.appendChild(productName);
                    productLink.appendChild(productPrice);

                    productDiv.appendChild(productLink);

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

    console.log("Sending request");
    xhttp.open("GET", "../php/convert4Overview.php?" + queryString, true);
    xhttp.send();
}
