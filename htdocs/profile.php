<?php

if ($_POST['submit'] == 'Change') {

    $error = "";

    // update login details
    $dbhost = '127.0.0.1';
    $dbuser = 'root';
    $dbpass = 'password';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }

    // change dataname name
    mysqli_select_db($conn, 'hello');


    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    // may need to variables
    // $query = "UPDATE `hello`.`users` SET `email`='". mysqli_real_escape_string($conn, $_POST['email']) ."', `username`='". mysqli_real_escape_string($conn, $_POST['username']) . "', `password`='". md5($_POST['password']) . "' WHERE `email`='hello@gmail.com';";
    $query = "UPDATE `hello`.`users` SET `idusers`='". $email."', `password`='". $password . "' WHERE `idusers`='". $email ."';";
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

?>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

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

    .form .message a {
        color: #4CAF50;
        text-decoration: none;
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
<form class="form" method="post">
    <input type="email" name="email" id="email" placeholder="new email"/>
    <input type="password" name="password" id="password" placeholder="new password"/>
    <input type="submit" name="submit" value="Change">
</form>
