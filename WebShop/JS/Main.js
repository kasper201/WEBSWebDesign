var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.trim() !== "") {
            let response = JSON.parse(this.responseText);
            let products = Array.isArray(response) ? response : [response]; // make sure that it is actually an array
            let productsContainer = document.querySelector('.onSale');

            // log to console for debugging
            console.log(products);

            products.forEach(product => {
                let productDiv = document.createElement('div');
                productDiv.className = 'product';

                let productLink = document.createElement('a');
                productLink.href = `../php/Product.php?id=${product.id}`;

                let productImage = document.createElement('img');
                productImage.src = product.image; // Set the src to the image path fetched from the database
                productImage.alt = product.name;
                productImage.className = 'productImage';
                productImage.onerror = function() {
                    this.onerror = null; // To prevent infinite loop in case the placeholder image doesn't exist
                    this.src = '../Images/Basket.png'; // Replace with your placeholder image path
                };

                let productName = document.createElement('h3');
                productName.textContent = product.name;

                let productPrice = document.createElement('p');
                productPrice.textContent = `Price: €${product.price}`;

                productLink.appendChild(productImage);
                productLink.appendChild(productName);
                productLink.appendChild(productPrice);

                productDiv.appendChild(productLink);

                productsContainer.appendChild(productDiv);
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
xhttp.open("GET", "../php/Main.php", true);
xhttp.send();