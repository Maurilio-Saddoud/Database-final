<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>

    <title>Handler</title>

</head>

<body>
  <?php
    $servername = '127.0.0.1'; // Do not use 'localhost'

    // In the Real World (TM), you should not connect using the root account.
    // Create a privileged account instead.
    $username = 'root';

    // In the Real World (TM), this password would be cracked in miliseconds.
    $password = '02042001';

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    $dbname = 'ClassQuestions';

    mysqli_select_db($conn, $dbname) or die('Could not open the $dbname');

    // Gets the user's answer
    //$answer = $_POST["answer"];

    //Getting url params
    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                    "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
                    $_SERVER['REQUEST_URI'];

    $url_components = parse_url($link);

    parse_str($url_components['query'], $params);

    $questionId = $params['questionid'];
    $studentId = $params['studentid'];
    $questionType = $params['type'];
    

    if($questionType == "mc" || $questionType == "tf"){
      $answer = $params['answer'];
    }

    if($questionType == "fr"){
      $answer = $_POST["answer"];
    }
    

    echo"$answer $questionId";

    if($questionType == "mc" || $questionType == "tf"){
        //Getting the answer code based off the answer and the questionid
        //I think we need to include the actual answer in mcanswers so we can identify the answer key
        $get_code = "SELECT answer_code FROM mcanswers WHERE answerchoice = '$answer' AND Q_id = $questionId";
        $result = mysqli_query($conn, $get_code);
        while ($row = mysqli_fetch_array($result)) {
          $code = $row[0];
        };

        //CHECK TO SEE IF THEY ALREADY HAVE ANSWERED THE QUESTION AND IF THEY HAVE THEN DELETE THEIR PREVIOUS ANSWER BEFORE INSERTING
        $insert_answer = "INSERT INTO answers VALUES ($questionId, $studentId, $code)";
        echo"$insert_answer";
        $result = mysqli_query($conn, $insert_answer);

    };
    
    if($questionType == "fr"){
      $insert_answer = "INSERT INTO answers VALUES ($questionId, $studentId, 5)";
      $result = mysqli_query($conn, $insert_answer);

      $insert_fr = "INSERT INTO FreeResponse VALUES ('$answer', $questionId)";
  
      $result = mysqli_query($conn, $insert_fr);
    }

    header('Location: student_questions.php?studentid=$studentId');
      die();

  ?>


</body>
</html>
