var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.trim() !== "") {
            let products = JSON.parse(this.responseText);
            let productsContainer = document.querySelector('.onSale');

            products.forEach(product => {
                let productDiv = document.createElement('div');
                productDiv.className = 'product';

                let productLink = document.createElement('a');
                productLink.href = `../php/Product.php?id=${product.id}`;

                let productImage = document.createElement('img');
                productImage.src = `../Images/${product.image}`;
                productImage.alt = product.name;
                productImage.className = 'productImage';

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
    }
};
xhttp.open("GET", "./php/Main.php", true);
xhttp.send();