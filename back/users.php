<?php

require_once __DIR__ . '/class.php';
use DB\UserADD\User;


if (!isset($_POST['name'])|| empty($_POST['name'])) {
    exit();
}

if (!isset($_POST['pass'])|| empty($_POST['pass'])) {
    exit();
}


//get data from client 
function get_data_from_client()
{
    $name_data = $_POST['name'];
    $pass_data = $_POST['pass'];

    //check name 
    if (strlen($name_data) < 3) {
        echo json_encode(['massage_err_name' => 'Your name must be over 3 words.']);
        return;
    }
    //check password
    if (strlen($pass_data) < 6) {
        echo json_encode(['massage_err_pass' => 'Your name must be over 3 words.']);
        return;
    }

   // add user to base 
    $new_user = new User();
    $new_user->setUser($name_data,$pass_data);
    $new_user->addUser();
    var_dump($new_user->getAllUsers());
    die();

    
}

get_data_from_client();



