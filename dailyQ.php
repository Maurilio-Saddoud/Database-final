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

$date = $_COOKIE["date"];
$dbname = "ClassQuestions";
mysqli_select_db($conn, $dbname) or die("Could not open the '$dbname'");

$all_Questions = "SELECT * FROM Questions WHERE Q_date = '$date'";
$results = mysqli_query($conn, $all_Questions);

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

    <link rel=\"preconnect\" href=\"https://fonts.googleapis.com\">
    <link rel=\"preconnect\" href=\"https://fonts.gstatic.com\" crossorigin>
    <link href=\"https://fonts.googleapis.com/css2?family=Fira+Sans&display=swap\" rel=\"stylesheet\">
</head>

<body>
    <div class=\"qPopup\" id=\"qPopup\">
        <div class=\"qPopupBackground\"></div>
        <div class=\"inputContainer\">
            <button id=\"cancel\" >Cancel</button>
            <br>
            <br>
            <form autocomplete=\"off\" id=\"qInputForm\" method=\"post\" action=\"newQHandler.php?date=$date\">
                <label for=\"qInputForm\"> Question Type:</label>
                <select name=\"qType\" id=\"qType\">
                    <option value=\"fr\" selected>Free Response</option>
                    <option value=\"mc\">Multiple Choice</option>
                    <option value=\"tf\">True/False</option>
                </select>
                <br><br>
                <label for=\"qInputForm\">Please enter a question to ask:</label>
                <input type=\"text\" name=\"profPrompt\" id=\"profPrompt\" value=\"\" required>
                <br>
                <div id=\"variableInputOptions\"></div>
                <input type=\"submit\" value=\"Submit\" id=\"submit\">
            </form>
        </div>
    </div>
    <div class=\"container\">
    <button id=\"goBack\" >Back</button>
        <div class=\"row\">
            <div class=\"col-8\">
                <h1>Showing Questions for $date</h1>
            </div>
            <div class=\"col-4\">
                <button id=\"newQButton\" type=\"button\">Add Question</button>
            </div>
        </div>
        <div clas\"questionsContainer\">
            
        ";

        while ($row = mysqli_fetch_array($results)) {
            echo "
                <ul>
                    <a href=\"qResults.php?qId=$row[0]&qType=$row[2]\">
                        <div class=\"question\">
                            <h3 id=\"qPrompt\">$row[1]</h3>
                        </div>
                    </a>
                </ul>
            <br>
            ";
        }; 
        echo "
        
        </div>
    </div>

    <!-- visible content goes here -->
    <!-- <img src=\"assets/img/cdc background.png\" alt=\"\" width=\"100%\" height=\"auto\" > -->


    <!-- javascript -->
    <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js\"></script>
    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js\"
        integrity=\"sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj\"
        crossorigin=\"anonymous\"></script>
    <script>
        $(\"#newQButton\").click(() => {
            showQPopup()
        });

        $(\"#cancel\").click(() => {
            hideQPopup()
        });

        $('#goBack').click(() => {
            window.location.replace('profSelectDate.html');
       });

        let showQPopup = () => {
            document.getElementById(\"qPopup\").style.display = \"block\";
        }

        let hideQPopup = () => {
            document.getElementById(\"qPopup\").style.display = \"none\";
        }

        $(\"#qType\").change(() => {
            let container = document.getElementById(\"variableInputOptions\")
            container.innerHTML = \"\";
            let value = document.getElementById(\"qType\").value;

            if (value == \"mc\") {
                const br = document.createElement(\"br\");
                const prompt = document.createElement(\"p\");
                const node = document.createTextNode(\"Please create answer choices for students\");
                prompt.appendChild(node);
                container.appendChild(prompt);
                // A
                var a = document.createElement(\"INPUT\");
                a.setAttribute(\"type\", \"text\");
                a.setAttribute(\"name\", \"a\");
                a.setAttribute(\"required\", \"required\");

                // B
                var b = document.createElement(\"INPUT\");
                b.setAttribute(\"type\", \"text\");
                b.setAttribute(\"name\", \"b\");
                b.setAttribute(\"required\", \"required\");
                
                // C
                var c = document.createElement(\"INPUT\");
                c.setAttribute(\"type\", \"text\");
                c.setAttribute(\"name\", \"c\");
                c.setAttribute(\"required\", \"required\");

                // D
                var d = document.createElement(\"INPUT\");
                d.setAttribute(\"type\", \"text\");
                d.setAttribute(\"name\", \"d\");
                d.setAttribute(\"required\", \"required\");
                
                container.appendChild(a);
                container.appendChild(document.createElement(\"br\"));
                container.appendChild(b);
                container.appendChild(document.createElement(\"br\"));
                container.appendChild(c);
                container.appendChild(document.createElement(\"br\"));
                container.appendChild(d);
                container.appendChild(document.createElement(\"br\"));
            }
        })
    </script>
</body>
</html>
"
?>

</body>
</html>