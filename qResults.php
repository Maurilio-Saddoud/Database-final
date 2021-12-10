<html>
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

// Check connectionf
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$qId = htmlspecialchars($_GET["qId"]);
$qType = htmlspecialchars($_GET["qType"]);
$date = $_COOKIE["date"];
$dbname = "ClassQuestions";

mysqli_select_db($conn, $dbname) or die("Could not open the '$dbname'");

$question_query = "SELECT * FROM Questions WHERE Q_id = '$qId'";
$question_results = mysqli_query($conn, $question_query);
$qRow = mysqli_fetch_array($question_results);

$q_answers = "SELECT * FROM Answers WHERE Q_id = '$qId'";
$results = mysqli_query($conn, $q_answers);


echo "
<!DOCTYPE html>
<html lang=\"en\">

<head>
    <!-- meta tags -->
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap\" rel=\"stylesheet\">

    <title>DailyQ Screen</title>

    <!-- CSS -->
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\"
        integrity=\"sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We\" crossorigin=\"anonymous\">
    <link rel=\"stylesheet\" href=\"../assets/css/styles.css\">

    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Nunito&display=swap\" rel=\"stylesheet\">
</head>

<body>
<button id=\"goBack\" >Back</button>
<h1>$qRow[1] </h1>
";

if ($qType == "fr") {
    $fr_query = "SELECT * FROM FreeResponse WHERE Q_id = '$qId'";
    $fr_result = mysqli_query($conn, $fr_query);

    echo"
        <div class='answersContainer'>
    ";
    $i = 0;
    while ($row = mysqli_fetch_array($fr_result)) {
        $i++; 
        echo "
            <div class=\"answer\">
                <h3 id=\"answer\">$row[0]</h3>
            </div>
        ";
    }; 
    if ($i == 0) { // If there are no answers yet
        echo "<h3>No answers yet</h3>";
    }
    echo"</div >";

} else {
    $mc_query = "SELECT * FROM (SELECT answer_code, COUNT(*) FROM Answers WHERE Q_id = $qId GROUP BY answer_code) AS ONE NATURAL JOIN MCAnswers WHERE Q_id = $qId";
    $mc_result = mysqli_query($conn, $mc_query);

    echo "
    <div id='graphContainer'></div>

    <script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>
    <script type=\"text/javascript\">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Asnwers', 'Question'],
        ";

        while ($row = mysqli_fetch_array($mc_result)) {
            echo "
            ['$row[2]', $row[1]],
            ";
        };
        echo "
        ]);

        var options = {
          title: '$qRow[1]'
        };

        var chart = new google.visualization.PieChart(document.getElementById('graphContainer'));

        chart.draw(data, options);
      }
    </script>
    ";
    
}


echo " 
    <!-- javascript -->
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js\"
        integrity=\"sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj\"
        crossorigin=\"anonymous\"></script>
    <script>
       $('#goBack').click(() => {
            window.location.replace('dailyQ.php');
       });
    </script>
</body>
</html>
"
?>

</body>
</html>