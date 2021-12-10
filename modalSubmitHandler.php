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
    require("./inc/db_connection.php");
    
    // Gets the user's answer
    $answer = $_POST["answer"];

    //WHERE ARE THE STUDENTS' ANSWERS BEING STORED?????
    //Need to update the db so that there is an autoincrement
    $insert_answer = "INSERT INTO mcanswers VALUES (7, 'HELLLLOWasdfsafd', 2)";

    $result = mysqli_query($conn, $insert_answer);


    header('Location: student_questions.php');
      die();



    //action='#$nextModal'


  ?>


</body>
</html>
