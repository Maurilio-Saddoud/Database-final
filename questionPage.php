<!doctype html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link rel='stylesheet' href='./assets/css/styles.css'>

    <title>Question</title>

    <style>
      html,
body {
  height: 100%;
  padding: 0;
  margin: 0;
}

div {
  width: 50%;
  height: 50%;
  float: left;
}
</style>

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

    $dbname = 'classQuestions';

    mysqli_select_db($conn, $dbname) or die('Could not open the $dbname');

    // CHeck to make sure user is present, alert them to create an account first



    // Program to display current page URL.

    $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?
                    "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .
                    $_SERVER['REQUEST_URI'];

    //echo $link;

    // Use parse_url() function to parse the URL
    // and return an associative array which
    // contains its various components
    //https://www.geeksforgeeks.org/how-to-get-parameters-from-a-url-string-in-php/#:~:text=The%20parameters%20from%20a%20URL%20string%20can%20be,the%20parameters%20are%20separated%20by%20the%20%3F%20character.
    $url_components = parse_url($link);

    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);

    $questionId = $params['questionid'];
    $studentId = $params['studentid'];
    $type = $params['type'];
    // Display result
    //Get the question
    $questions_query = "SELECT Q_prompt FROM questions WHERE Q_id = $questionId";

    $questions_result = mysqli_query($conn, $questions_query);
    while ($row = mysqli_fetch_array($questions_result)) {
      $question = $row[0];
    }


    if($type == "mc"){
    echo"<div style='background-color: white; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%); height: 150px; width: 30%; border-radius: 50%; text-align: center; display: flex; align-items: center; justify-content: center; border: 7px solid black'><h2>$question</h2></div>";
    //echo"
    //<form action='answerHandler.php?questionid=$questionId&studentid=$studentId&type=$type' method='POST'>";
        //Query for the answers of the specific questions
        $answers_query = "SELECT * FROM mcanswers WHERE Q_id = $questionId";

        $answers_result = mysqli_query($conn, $answers_query);

        //Eventurally check to see what type of question it is
        $i=0;
        $colors = ['#C0EEFA', '#2E86AB', '#2E86AB', '#C0EEFA'];
        while ($row = mysqli_fetch_array($answers_result)) {
          /*
            echo "
                <
                  <label>$row[1]</label>
                  <input type='radio' name='answer' value=$row[1]>
            ";*/
            $color = $colors[$i];
         
            echo"
              <a style='float:none' href='answerHandler.php?questionid=$questionId&studentid=$studentId&type=$type&answer=$row[0]'><div style='background-color: $color; text-align: center; color:black; display: flex; align-items: center; justify-content: center; border: 2px solid black'><h1>$row[0]</h1></div></a>
              ";
            $i++;
        };
        //echo"<input type='submit'>
    //</form>";

  };

  if($type == "fr"){
    echo"
      <form action='answerHandler.php?questionid=$questionId&studentid=$studentId&type=$type' method='POST' style = 'position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%); height: 500px; width:40%; border-radius: 50%; align-items: center; justify-content: center;'>
        <label><h3 style='color:#C0EEFA'>$question</h3></label>
        <br>
        <textarea class='form-control' rows='5' id='comment' name='answer'></textarea>
        <br>
        <input type='submit' class='btn btn-primary back-button' style='width: 80px'>
      </form>
      ";
  }

  if($type == "tf"){
    echo"<div style='background-color: white; position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%); height: 150px; width: 30%; border-radius: 50%; text-align: center; display: flex; align-items: center; justify-content: center; border: 7px solid black'><h2>$question</h2></div>";
        $answers_query = "SELECT * FROM mcanswers WHERE Q_id = $questionId";

        $answers_result = mysqli_query($conn, $answers_query);

        //Eventurally check to see what type of question it is
        $i=0;
        $colors = ['#C0EEFA', '#2E86AB'];
        while ($row = mysqli_fetch_array($answers_result)) {
          
            $color = $colors[$i];
         
            echo"
              <a style='float:none' href='answerHandler.php?questionid=$questionId&studentid=$studentId&type=$type&answer=$row[0]'><div style='width:100%; height: 50%; background-color: $color; text-align: center; color:black; display: flex; align-items: center; justify-content: center; border: 2px solid black'><h1>$row[0]</h1></div></a>
              ";
            $i++;
        };

  };

  ?>


</body>
</html>
