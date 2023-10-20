<?php
require_once '../config.php';

$error = array();
$res = array();
//var_dump('$_POST REQUEST CHECKING .....');
//var_dump($_POST);
//exit();
if (empty($_POST['username'])) {
    $error[] = "Username field is required";
}

if (empty($_POST['password'])) {
    $error[] = "Password field is required";
}
/*
if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $error[] = "Enter Valid Email address";
}
*/
if (count($error) > 0) {
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp);
    exit;
}

$bool_login_limit_count = checkLoginLimitUserCount($conn);
if (!$bool_login_limit_count) {
    $error[] = "Login limit exceeds, please contact administrator";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp);
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];
$sql = "select * from users where username = '$username'";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {

    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    // var_dump($result);

    $id = $result[0]['id'];
    $username = $result[0]['username'];
    $dbSavedPassword = $result[0]['password'];

    if ($password  !=  $dbSavedPassword) {
        $error[] = "Password is not valid";
        $resp['msg'] = $error;
        $resp['status'] = false;
        echo json_encode($resp);
        exit;
    } else {

        // Assuming $user_id is the user's ID and $session_id is the session ID
        // Store session data in the database
        $sql = "INSERT INTO user_sessions (user_id, last_activity) VALUES ( $id, NOW())";
        $res = mysqli_query($conn, $sql);

        session_start();
        $_SESSION['loggedin'] = array("id" => $id, "username" => $username);
        $resp['redirect'] = '../dashboard';
        $resp['status'] = true;
        echo json_encode($resp);
        exit;
    }
} else {
    $error[] = "Username does not match";
    $resp['msg'] = $error;
    $resp['status'] = false;
    echo json_encode($resp);
    exit;
}

function checkLoginLimitUserCount($conn)
{
    $sql = "select * from dashboard where meta_key = 'login_limit_count'";
    $query = mysqli_query($conn, $sql);
    $login_limit_count = 1;
    if (mysqli_num_rows($query) > 0) {
        $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
        $login_limit_count = $result[0]['value'];
    }

    $sql = "SELECT COUNT(*) as user_log_count FROM user_sessions WHERE user_id IS NOT NULL AND last_activity >= NOW() - INTERVAL 30 MINUTE";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
    // print_r($result);exit;
    $login_count = $result[0]['user_log_count'];
    if ($login_limit_count < $login_count)
        return false;
    else
        return true;
}

// CREATE TABLE user_sessions (
//     session_id VARCHAR(255) PRIMARY KEY,
//     user_id INT,
//     last_activity TIMESTAMP
// );