<?php
$username = $_POST['username'];
$formPassword = $_POST['password'];

$url = "http://localhost/ProiectTW-Toyr/WebServices/UsersManagement/Controller/User/getUser.php?username=".$username;

//bget user's credentials from db via the service
$request = curl_init();
curl_setopt ($request, CURLOPT_URL, $url);
curl_setopt ($request, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec ($request);
curl_close ($request);

//decode the data, and make sure it isn't an array of arrays
$data = json_decode($response,true);
$userData = $data[0];

//get the salt and make a hash from the input from form
$salt = $userData['salt'];
$passHash = md5($formPassword.$salt);

if($passHash == $userData['password']) {
    //create the session and add data to it
    session_start();
    $_SESSION['id'] = $userData['id'];
    $_SESSION['username'] = $userData['id'];
    $_SESSION['firstname'] = $userData['firstname'];
    $_SESSION['user_type'] = $userData['user_type'];
    header('Location: http://localhost/ProiectTW-Toyr/index.php');
}
//if  the password is wrong, the user will be sent back to login.html
else header('Location: http://localhost/ProiectTW-Toyr/View/pages/login.html');
