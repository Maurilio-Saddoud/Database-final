<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel='stylesheet' href='./assets/css/styles.css'>
</head>
<body>

<?php
require("./inc/db_connection.php");

mysqli_select_db($conn, $dbname) or die("Could not open the '$dbname'");

echo
"<div class='container'>
  <div class='row'>
    <div style='width: 400px; margin: auto' >
      <ul class='nav nav-tabs' style = 'border:none; margin-top: 20%; margin-bottom: 8%'>
        <li class='active'><a data-toggle='tab' href='#student'>Student</a></li>
        <li><a data-toggle='tab' href='#professor'>Professor</a></li>
      </ul>
      ";

        echo
            "<div class='tab-content'>
                <div id='student' class='tab-pane fade in active'>
                      <form autocomplete='off' style='margin:0px' action='student_loginHandler.php' method='POST'>
                        <div class='form-outline mb-4'>
                            <label class='form-label loginLabelStyle' for='date'>Class Date</label>
                            <input required class='form-control form-control-lg' type='date' name='date' id='date'>
                        </div>
                            <br>

                        <div class='form-outline mb-4'>
                            <label class='form-label loginLabelStyle' for='student_id'>Student ID (last 4)</label>
                            <input required class='form-control form-control-lg' type='text' name='student_id' id='student_id' />
                        </div>
                            <br>
                        <div class='pt-1 mb-4'>
                          <input class='btn btn-info btn-lg btn-block' type='submit' value='Submit'>
                        </div>
                      </form>
                    </div>


                <div id='professor' class='tab-pane fade'>
                      <form autocomplete='off' action='profSelectDate.html' method='POST'>
                          <div class='form-outline mb-4'>
                              <label class='form-label loginLabelStyle' for='professor_code'>Professor Code</label>
                              <input required type='text' class='form-control form-control-lg' name='professor_code' id='professor_code' />
                          </div>
                          <br>
                          <div class='pt-1 mb-4'>
                            <input class='btn btn-info btn-lg btn-block' type='submit' value='Submit'>
                          </div>
                      </form>
                </div>
          </div>
        </div>
      </div>";

?>

<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p' crossorigin='anonymous'></script>

</body>
</html>
