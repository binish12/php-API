<?php
 include 'DatabaseConfig.php';
 include 'helper_functions/authentication_functions.php';
    // Creating MySQL Connection.
    $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
    $isAdmin = checkIfAdmin($_POST['token'] ?? null);
    if($isAdmin){
        if (isset($_POST['product_id']) && isset($_POST['approved'])) {
            $product_id=$_POST['product_id'];
            $approved = $_POST['approved'];
            $insert_user = "UPDATE products SET approved = '$approved' WHERE id = $product_id";
            $result = mysqli_query($con, $insert_user);
            if ($result) {
                echo json_encode(
                    [
                        'success' => true,
                        'message' => 'Updated the status of product.'
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'success' => false,
                        'message' => 'Failed to update the status of the product.'
                    ]
                );
            }
           
    
        }else{
            $data=['success'=>false, 'message'=>'Product Id and product status is required.'];
            echo json_encode($data);
        }
    }else{
        $data=['success'=>false, 'message'=>'UnAuthorized.'];
        echo json_encode($data);
    }
   
 ?>