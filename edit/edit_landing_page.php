<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <link rel='stylesheet' media='screen' href='..\css\edit\edit_landing_page.css'>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STB-Edit</title>
    <link rel="shortcut icon" href="/Sneaker_Red.png">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
</head>

<body>
    <div class="main-block">
        <h1>Edit Sneaker</h1>
        <form action="fetch_data.php" method="POST">

            <label id="icon" for="sneakerID"></label>
            <input type="text" name="sneakerID" id="sneakerID" placeholder="Sneaker ID" required />

            <div><br>
                <button id="button" type="submit" value="Submit">Edit</button>
            </div>
        </form>
        <form>
            <input onclick="window.location.href='../index.html'" id="button_reset" type="button" value="Back" />
        </form>
    </div>
</body>

</html>