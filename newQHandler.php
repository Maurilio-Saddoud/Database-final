<html>
<>

<?php
$servername = "127.0.0.1"; // Do not use "localhost"
$username = "root";

// In the Real World (TM), this password would be cracked in miliseconds.
$password = "02042001";

// Create connection
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST["date"];
$question = $_POST["question"];
$dbname = "ClassQuestions";
mysqli_select_db($conn, $dbname) or die("Could not open the '$dbname'");

echo "
<h1>$date</h1>
<h1>$question</h1>
";
$qType = $_POST["qType"];
$question = $_POST["profPrompt"];
$date = htmlspecialchars($_GET["date"]);

$dbname = "ClassQuestions";

if ($qType == "fr") {
    $question_query = "INSERT INTO Questions (Q_prompt, Q_type, Q_date, class_id) VALUES ('$question', '$qType', '$date', 1)";
    mysqli_query($conn, $question_query);

mysqli_select_db($conn, $dbname) or die("Could not open the '$dbname'");
} else if ($qType == "mc"){
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];
    $d = $_POST["d"];

    $question_query = "INSERT INTO Questions (Q_prompt, Q_type, Q_date, class_id) VALUES ('$question', '$qType', '$date', 1)";
    mysqli_query($conn, $question_query);

    $find_id = "SELECT Q_id FROM Questions WHERE Q_prompt = '$question' AND Q_date = '$date'";
    $result = mysqli_query($conn, $find_id);
    $row = mysqli_fetch_array($result);

    $a_query = "INSERT INTO MCAnswers VALUES ('$a', $row[0], 1)";
    mysqli_query($conn, $a_query);

    $b_query = "INSERT INTO MCAnswers VALUES ('$b', $row[0], 2)";
    mysqli_query($conn, $b_query);

    $c_query = "INSERT INTO MCAnswers VALUES ('$c', $row[0], 3)";
    mysqli_query($conn, $c_query);

    $d_query = "INSERT INTO MCAnswers VALUES ('$d', $row[0], 4)";
    mysqli_query($conn, $d_query);

} else {
    $question_query = "INSERT INTO Questions (Q_prompt, Q_type, Q_date, class_id) VALUES ('$question', '$qType', '$date', 1)";
    mysqli_query($conn, $question_query);

    $find_id = "SELECT Q_id FROM Questions WHERE Q_prompt = '$question' AND Q_date = '$date'";
    $result = mysqli_query($conn, $find_id);
    $row = mysqli_fetch_array($result);

    $t_query = "INSERT INTO MCAnswers VALUES ('True', $row[0], 1)";
    mysqli_query($conn, $t_query);

    $f_query = "INSERT INTO MCAnswers VALUES ('False', $row[0], 2)";
    mysqli_query($conn, $f_query);
}
header("Location: /dailyQ.php");
die();

?>
</body>
</html>
