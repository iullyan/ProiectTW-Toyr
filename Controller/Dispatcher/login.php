<?php
require_once('../../Config/config.php');
require_once('../Utils/CallWebService.php');
$loginWebService = new CallWebService();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $formPassword = $_POST['password'];
}
else
    die("Unspecified parameters");

$url = WEB_CONST_URL_PART_USERS . 'getUser.php?username='.$username;




//decode the data, and make sure it isn't an array of arrays
$data = $loginWebService->doGet($url);
$userData = $data[0];

//get the salt and make a hash from the input from form
$salt = $userData->salt;
$passHash = md5($formPassword.$salt);

if($passHash == $userData->password) {
    //create the session and add data to it
    session_start();
    $_SESSION['id'] = $userData->id;
    $_SESSION['username'] = $userData->id;
    $_SESSION['firstname'] = $userData->firstname;
    $_SESSION['user_type'] = $userData->user_type;
    header('Location:' . INDEX_URL);

}
//if  the password is wrong, the user will be sent back to login.php

else
{
    header('Location:' . LOGIN_PAGE);
    echo json_encode($userData);
}


