<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Information</title>
    <link rel="stylesheet" href="../Design/Template.css">
    <link rel="stylesheet" href="../Design/Profile.css">
    <link rel="icon" href="../Images/LogoColour.png">
</head>
<body>
<div class="main">
    <?php include './standardised/header.php'; ?>
    <div class="content">
        <form id="profileInfo">
            <h2>Profile Information</h2>
            <label>
                <input type="text" id="email" name="email" placeholder="Email" />
            </label>
            <label>
                <input type="text" id="name" name="name" placeholder="Full Name"  />
            </label>
            <label>
                <input type="text" id="country" name="country" placeholder="Country" />
            </label>
            <label>
                <input type="text" id="street" name="street" placeholder="Street Name and Number" />
            </label>
            <label>
                <input type="text" id="postal" name="postal" placeholder="Postal Code" />
            </label>
            <label>
                <input type="text" id="city" name="city" placeholder="City" />
            </label>
            <button class="saveButton" type="submit">Save</button>
        </form>
    </div>
    <?php include './standardised/footer.php'; ?>
</div>
<script src="../JS/Template.js"></script>
<script src="../JS/Profile.js"></script>
</body>
</html>