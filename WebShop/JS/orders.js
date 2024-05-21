fetch('./Orders.php?query=CALL%20getOrders()')
    .then(response => response.json())
    .then(data => {
        let table = document.createElement('table');
        // Create table headers
        let headers = ['userID', 'productID', 'Name', 'Quantity', 'state'];
        let thead = document.createElement('thead');
        let headerRow = document.createElement('tr');
        headers.forEach(header => {
            let th = document.createElement('th');
            th.textContent = header;
            headerRow.appendChild(th);
        });
        thead.appendChild(headerRow);
        table.appendChild(thead);

        // Create table body
        let tbody = document.createElement('tbody');
        data.forEach((row) => {
            let tr = document.createElement('tr');
            headers.forEach(header => {
                let td = document.createElement('td');
                td.textContent = row[header];
                td.contentEditable = 'true';
                td.addEventListener('blur', function() {
                    console.log(`Updated ${header} of row with userID ${row['userID']} and productID ${row['productID']} to ${td.textContent}`);
                });
                tr.appendChild(td);
            });
            tbody.appendChild(tr);
        });
        table.appendChild(tbody);
        document.body.appendChild(table);
    });

function updateDatabase(column, id, newValue) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "update.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`column=${column}&id=${id}&newValue=${newValue}`);
}