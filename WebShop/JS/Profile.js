let oldEmail = document.getElementById('email').value;
function fetchProfileInfo() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText.trim() !== "") {
                let response = JSON.parse(this.responseText);
                console.log(response);

                // Now you can use the response data to populate the form fields
                oldEmail = response[0].Email;
                document.getElementById('email').value = (response[0].Email !== "N/A") ? response[0].Email : '';
                document.getElementById('name').value = (response[0].Name !== "N/A") ? response[0].Name : '';
                document.getElementById('country').value = (response[0].country !== "N/A") ? response[0].country : '';
                document.getElementById('street').value = (response[0].street !== "N/A") ? response[0].street : '';
                document.getElementById('postal').value = (response[0].postalCode !== "N/A") ? response[0].postalCode : '';
                document.getElementById('city').value = (response[0].city !== "N/A") ? response[0].city : '';
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

var submitButton = document.getElementById('submit');
submitButton.addEventListener('click', function() {
    event.preventDefault();
    let email = document.getElementById('email').value;
    let name = document.getElementById('name').value;
    let country = document.getElementById('country').value;
    let street = document.getElementById('street').value;
    let postal = document.getElementById('postal').value;
    let city = document.getElementById('city').value;

    if(oldEmail !== email) {
        var confirmation = confirm("By changing the Email you will also change the Email used to login. Are you sure you want to proceed?");
        if (!confirmation) {
            // If the user clicks Cancel, do not submit the form
            return;
        }
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText.trim() !== "") {
                let response = JSON.parse(this.responseText);
                console.log(response);
            } else {
                console.log("Empty response received");
            }
        } else {
            console.log("Error: " + this.status);
            console.log("State: " + this.readyState);
        }
    };
    console.log("Sending request");
    xhttp.open("POST", "../php/updateProfile.php?LOAD=false", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(`email=${email}&name=${name}&country=${country}&street=${street}&postal=${postal}&city=${city}`);
});
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