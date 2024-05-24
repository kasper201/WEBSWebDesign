function fetchProfileInfo() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.trim() !== "") {
                let response = JSON.parse(this.responseText);
                console.log(response);

                // Now you can use the response data to populate the form fields
                document.getElementById('email').value = response.email || '';
                document.getElementById('name').value = response.name || '';
                document.getElementById('country').value = response.country || '';
                document.getElementById('street').value = response.street || '';
                document.getElementById('postal').value = response.postal || '';
                document.getElementById('city').value = response.city || '';
            } else {
                console.log("Empty response received");
            }
        } else {
            console.log("Error: " + this.status);
            console.log("State: " + this.readyState);
        }
    };
    console.log("Sending request");
    xhttp.open("GET", "../php/updateProfile.php?LOAD=true", true);
    xhttp.send();
}

/*
function updateProduct(id, field, value) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "update.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // If the field is 'OnSale', convert the boolean value to 1 or 0
    if (field === 'OnSale' || field === 'inStock') {
        value = value ? 1 : 0;
    }
    xhttp.send(`column=${field}&id=${id}&newValue=${value}`);
}*/

// fetch profile
window.onload = fetchProfileInfo;