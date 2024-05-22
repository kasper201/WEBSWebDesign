fetch('./getProducts.php?query=CALL getProducts()')
    .then(response => response.json())
    .then(products => {
        let table = document.getElementById('productTable');
        products.forEach(product => {
            // Convert OnSale from integer to boolean
            let row = table.insertRow(-1);
            let checked = Number(product.OnSale) ? 'checked' : '';
            console.log(product.OnSale);
            console.log(checked);
            row.innerHTML = `
                <td>${product.ID}</td>
                <td contenteditable="true" onblur="updateProduct(${product.ID}, 'Name', this.textContent)">${product.Name}</td>
                <td contenteditable="true" onblur="updateProduct(${product.ID}, 'Price', this.textContent)">${product.Price}</td>
                <td contenteditable="true" onblur="updateProduct(${product.ID}, 'Description', this.textContent)">${product.Description}</td>
                <td><input type="checkbox" ${checked} onchange="updateProduct(${product.ID}, 'OnSale', this.checked)"></td>
            `;
        });
    });

function updateProduct(id, field, value) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "update.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // If the field is 'OnSale', convert the boolean value to 1 or 0
    if (field === 'OnSale') {
        value = value ? 1 : 0;
    }
    xhttp.send(`column=${field}&id=${id}&newValue=${value}`);
}