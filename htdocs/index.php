<?php

if ($_POST['submit'] == 'Sign up') {

    session_start();

    $error = "";

    // Check if email is valid
    if (!$_POST['email']) {
        $error .= "<br />Please enter your email";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error .= "<br />Please enter a valid email address";
    }

    // Check if password is valid
    if (!$_POST['password']) {
        $error .= "Please enter your password";
    } else {
        if (strlen($_POST['password']) < 8) {
            $error .= "<br />Please enter a password";
        }

        if (!preg_match('`[A-Z]`', $_POST['password'])) {
            $error .= "<br />Please include at least one capital letter in your password";
        }
    }

    if (!(strcmp($error, "")) == 0) {
        echo "There errors in the signup details" . $error;
    } else {

        // Set info for connecting to the database
        $dbhost = '127.0.0.1';
        $dbuser = 'root';
        $dbpass = '0x38be';

        $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

        if (!$conn) {
            die('Could not connect: ' . mysqli_error());
        }

        // Connect to the database
        mysqli_select_db($conn, 'hello');
        $query = "SELECT * FROM hello.users WHERE users.idusers='" . mysqli_real_escape_string($conn, $_POST['email']) . "'"; #escape string stops sql injections
        $retval = mysqli_query($conn, $query);

        if (!$retval) {
            die('Could not get data: ' . mysqli_error());
        }

        if ($retval->num_rows == 0) {

            // Hash password, etc.
            $query = "INSERT INTO `users` (`idusers`, `password`) values ('" . mysqli_real_escape_string($conn, $_POST['email']) . "', '" . md5($_POST['password']) . "')";
            mysqli_query($conn, $query);
            echo "Sign up success <br> Redirecting to home page";

            // Create session ID for user
            $_SESSION['id'] = mysqli_insert_id($conn);

            // Send user to landing page
            header("Location: /home.php");
            exit;

        } else {
            echo "Email already taken";
        }

        mysqli_close($conn);

    }
}

if ($_POST['loginSubmit'] == 'Log in') {
    $error = "";

    $dbhost = '127.0.0.1';
    $dbuser = 'root';
    $dbpass = '0x38be';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }

    mysqli_select_db($conn, 'hello');
    $query = "SELECT * FROM hello.users WHERE users.idusers='" . mysqli_real_escape_string($conn, $_POST['loginEmail']) . "' AND users.password = '" . md5($_POST['loginPassword']) . "';"; #escape string stops sql injections
    $retval = mysqli_query($conn, $query);

    if (!$retval) {
        die('Could not get data: ' . mysqli_error());
    }

    if ($retval->num_rows > 0) {
        echo "successful login <br> redirecting to home page";
        $_SESSION['id'] = mysqli_insert_id($conn);

        // Send user to landing page
        header("Location: /home.php");
        exit;

    } else {
        echo "unsuccessful login";
    }

    mysqli_close($conn);

}

# function to parse XSS attacks
function checkScript($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

?>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }

    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }

    .form input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }

    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #4CAF50;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }

    .form button:hover, .form button:active, .form button:focus {
        background: #43A047;
    }

    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }

    .form .register-form {
        display: none;
    }

    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }

    .container:before, .container:after {
        content: "";
        display: block;
        clear: both;
    }

    .container .info {
        margin: 50px auto;
        text-align: center;
    }

    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }

    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }

    .container .info span a {
        color: #000000;
        text-decoration: none;
    }

    .container .info span .fa {
        color: #EF3B3A;
    }

    body {
        background: #76b852; /* fallback for old browsers */
        background: -webkit-linear-gradient(right, #76b852, #8DC26F);
        background: -moz-linear-gradient(right, #76b852, #8DC26F);
        background: -o-linear-gradient(right, #76b852, #8DC26F);
        background: linear-gradient(to left, #76b852, #8DC26F);
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
</style>

<div class="login - page">
    <form class="login - form" method="post">

        <input type="login" name="loginEmail" id="loginEmail" placeholder="email"/>
        <input type="password" name="loginPassword" placeholder="password"/>
        <input type="submit" name="loginSubmit" value="Log in">
        <br>
        <hr>
        <br>
        <input type="email" name="email" id="email" placeholder="email"/>
        <input type="password" name="password" placeholder="password"/>
        <input type="submit" name="submit" value="Sign up">

    </form>
</div>
