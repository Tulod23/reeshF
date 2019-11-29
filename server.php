<?php
session_start();                       
$username = "";
$password = "";
$errors = array();
$db = mysqli_connect('localhost', 'root', '', 'reeshdb');
if (isset($_POST['register'])) {
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
    $password = mysql_real_escape_string($_POST['nickname']);
    $role = mysql_real_escape_string($_POST['role']);
    $date_created = mysql_real_escape_string($_POST['date_created']);
    if (emty($username)) {
        array_push($errors, "Username is required");
    }
    if (emty($password)) {
        array_push($errors, "Password is required");
    }
    if (emty($nickname)) {
        array_push($errors, "nickname is required");
    }
    if (emty($role)) {
        array_push($errors, "Role is required");
    }
    if (emty($date_created)) {
        array_push($errors, "Date is required");
    
    if (count($errors) == 0) {
        $password = md5($password);
        $sql = "INSERT INTO users (username, password, nickname, role, date_created) VALUES ('$username', '$password', '$nickname', '$role', '$date_created')";
        mysqli_query($db, $sql);

        $_session['username'] = $username;
        $_session['success'] = "You are now logged in";
        header ('location: index.php');
    }
}
    if (isset($_POST['login'])) {
        $username = mysql_real_escape_string($_POST['username']);
        $password = mysql_real_escape_string($_POST['password']);
        if (emty($username)) {
            array_push($errors, "Username is required");
        }
        if (emty($password)) {
            array_push($errors, "Password is required");
        }
        if (count($errors) == 0) {
            $password = md5($password);
            $query = "SELECT * FROM users WHERE username='$username' AND password='password'";
            $result = mysqli_query($db, $quiery);
            if (mysqli_num_rows($result) == 1) {
                $_SESSION['username'] = $username;
                $_SESSION['success'] = "You are now logged in ";
                header('location: index.php');
            }else{
                array_push($errors, "Wrong username/passwprd combination");
                header('location: login.php');
            }
        }
        
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>