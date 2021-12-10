<html>
<head>
  <!--
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  -->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='./assets/css/styles.css'>
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



//Getting the data from the previous page
//$student_id = $_POST["student_id"];
//$date = $_POST["date"];
//$date = "2021-12-03";
#$student_id = 0000;
$date = $_COOKIE['questionDate'];
$student_id = $_COOKIE['studentId'];


//The table
echo"
<div class='container' style='text-align:center'>
    <h1 style='color: #C0EEFA'><b>Questions</b></h1>
    <table>
      <thead>
        <tr>
          <th>Question Number</th>
          <th>Question</th>
          <th>Answered?</th>
        </tr>
      </thead>
      <tbody>
      ";
      //Loop through all the active questions from the professor and then stop
      $questions_query = "SELECT * FROM questions WHERE Q_date = '$date'";

      $questions_result = mysqli_query($conn, $questions_query);

      $i=0;
      while ($row = mysqli_fetch_array($questions_result)) {
          //Checking to see if the student has answered the question
          $answered = "SELECT COUNT(*) FROM Answers
              WHERE Q_id = $row[0] AND student_id = $student_id";
          $answered_result = mysqli_query($conn, $answered);
          while ($row2 = mysqli_fetch_array($answered_result)) {
              if($row2[0] == 0){
                $ans = "No";
              }
              else{
                $ans = "Yes";
              }
          };
          $i++;
          echo "
          <tr>";
          if($ans == 'No'){
            echo"<td><a href='questionPage.php?questionid=$row[0]&type=$row[2]&studentid=$student_id'>$i</a></td>";
          }
          else{
            echo"<td>$i</td>";
          };
          echo"
            <td>$row[1]</td>
            <td>$ans</td>
          </tr>
          ";
      };
echo "
      </tbody>
    </table>

    <a style='margin:5%; float:none; width: 30%; height: 40px; font-size: 20px; color: #1D323B' class='btn btn-primary back-button' href='login_page.php' role='button'>Return to Login Page</a>
    

  </div>";





/*
$count = mysqli_query($conn, $questions_total);
while ($row = mysqli_fetch_array($count)) {
  $countNum=$row[0];
}

*/


/*
MODAL STUFF
echo "
<div class='container'>
  <!-- Trigger the modal with a button -->
  <button type='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#modal1'>Resubmit</button>
";


//Creating a modal for each of the questions to display on the start of the screen or on the next button click
$i=0;
//echo"$questions_result";
while ($row = mysqli_fetch_array($questions_result)) {
    //INCREMENTING the question number
    $i++;
    $modal_id = 'modal' . $i;

    $next = $i+1;
    $nextModal = 'modal' . $next;

    echo "
    <!-- Modal -->
    <div id=$modal_id class='modal fade' role='dialog'>
      <div class='modal-dialog'>

      <!-- Modal content-->
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button' class='close' data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>$row[1]</h4>
        </div>
        <div class='modal-body'>
          <!-- Send data and go to next modal Send data to handler page then redirect back to this page showing the NEXT modal -->
          <form action='modalSubmitHandler.php' method='POST'>
      ";
      //Query for the answers of the specific questions
      $answers_query = "SELECT * FROM mcanswers WHERE Q_id = $row[0]";

      $answers_result = mysqli_query($conn, $answers_query);

      //Eventurally check to see what type of question it is
      $j = 'A';
      while ($row = mysqli_fetch_array($answers_result)) {
          echo "
                <label for='javascript'>$row[1]</label>
                <input type='radio' id=$j name='answer' value=$row[1]>
          ";
      }

      echo "
          </div>
          <div class='modal-footer'>
      ";
      //Check to see if it is the last question or not
      if($i != $countNum){
        $next = $i+1;
        $nextModal = 'modal' . $next;
        //echo "$nextModal";
        //Use the form submit button in the modal footer so that we can send data
        // data-dismiss='modal' data-toggle='modal' data-target='#$nextModal' extra attributes that keep from getting to handler
        echo "<input type='submit' name='submit' id='submit' value='Next' class='btn btn-default'>
        ";
      }
      else{
        echo "<input type='submit' name='submit' id='submit' class='btn btn-default' data-dismiss='modal'>";
      };

      echo "
          </div>
          </form>
        </div>

        </div>
      </div>";

}

echo "
</div>
";


?>

<script>
    //Displaying the first modal on page load
    $(document).ready(function() {
    $('#modal1').modal('show');
    });
</script>

*/

?>


</body>
</html>
