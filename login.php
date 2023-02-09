<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';
// Creating MySQL Connection.

if (isset($_POST['username']) && isset($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    //check if the username is already in the database
    $check_username = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $check_username);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      //check if the password is correct
      $data=mysqli_fetch_assoc($result);
      $databasePassword= $data['password'];
      $userId= $data['user_id'];
      $role= $data['role'];
      login($password, $databasePassword, $userId, $role);
     
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'User Not Found'
            ]
        );
    }
} else {
    echo json_encode(
        [
            'message' => 'Please fill all the fields.',
            'success' => false
        ]
    );
}


