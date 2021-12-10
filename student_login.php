<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>

<?php
$servername = "127.0.0.1"; // Do not use "localhost"

// In the Real World (TM), you should not connect using the root account.
// Create a privileged account instead.
$username = "root";

// In the Real World (TM), this password would be cracked in miliseconds.
$password = "02042001";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dbname = "ClassQuestions";

mysqli_select_db($conn, $dbname) or die("Could not open the '$dbname'");

echo "<body>
<div class='container-fluid'>
    <div class='calendarContainer'>
        <form action='student_loginHandler.php' method='POST'>
            <label class='form-label' for='date'>Class Date</label>
            <input type='date' name='date' id='date'>
            <br> <br>

            <label class='form-label' for='student_id'>Student ID (last 4)</label>
            <input type='text' name='student_id' id='student_id' />
            <br>
            <input type='submit' name='submit' id='submit'>
        </form>
    </div>
</div>
<!-- visible content goes here -->
<!-- <img src='assets/img/cdc background.png' alt='' width='100%' height='auto' > -->
<!-- javascript -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js'
    integrity='sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj'
    crossorigin='anonymous'></script>
</body>
";


?>

</body>
</html>
