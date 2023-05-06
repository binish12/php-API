<?php

include 'DatabaseConfig.php';
include 'helper_functions/authentication_functions.php';

if (isset($_POST['username']) && isset($_POST['old_password']) && isset($_POST['new_password'])) {

    $username = $_POST['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    //check if the username and old password match
    $check_user = "SELECT * FROM members WHERE email = '$username'";
    $result = mysqli_query($con, $check_user);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $user = mysqli_fetch_assoc($result);
        $stored_password = $user['password'];
        if (password_verify($old_password, $stored_password)) {
            //update the password in the database
            $encrypted_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password = "UPDATE members SET password='$encrypted_password' WHERE email='$username'";
            $result = mysqli_query($con, $update_password);
            if ($result) {
                echo json_encode(
                    [
                        'success' => true,
                        'message' => 'Password changed successfully'
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'success' => false,
                        'message' => 'Password change failed'
                    ]
                );
            }
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Incorrect old password'
                ]
            );
        }
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'User not found'
            ]
        );
    }
} else {
    echo json_encode(
        [
            'message' => 'Please provide all the required information',
            'success' => false
        ]
    );
}
