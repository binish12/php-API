<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
// Creating MySQL Connection.


if (isset($_POST['full_name']) && isset($_POST['username']) && isset($_POST['address']) && isset($_POST['phone_number']) && isset($_POST['password']) ) {

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    //check if the username is already in the database
    $check_username = "SELECT * FROM members WHERE email = '$username'";
    $result = mysqli_query($con, $check_username);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        echo json_encode(
            [
                'success' => true,
                'message' => 'Username already exists'
            ]
        );
    } else {
        signUp($full_name, $username, $address, $phone_number, $password);
    }
} else {
    echo json_encode(
        [
            'message' => 'Please fill all the fields.',
            'success' => false
        ]
    );
}


