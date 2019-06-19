<?php

//get the data from the form
$formData = array(
                    "username" => $_POST['username'],
                    "password" => $_POST['password'],
                    "user_type" => "customer",
                    "firstname" => $_POST['firstname'],
                    "lastname" => $_POST['lastname'],
                    "email" => $_POST['email']);

//create the json to be sent
$userCredentials = json_encode($formData);

$ch = curl_init('http://localhost/ProiectTW-Toyr/WebServices/UsersManagement/Controller/User/addUser.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $userCredentials);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
)//'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);

//echo $result;
header('Location: http://localhost/ProiectTW-Toyr/index.php');