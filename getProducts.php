<?php

include 'DatabaseConfig.php';

//get categories from the database
 $categories = "SELECT products.id, products.image, products.description, products.price, products.approved, categories.name as category FROM products join categories on products.category_id = categories.category_id";
    $result = mysqli_query($con, $categories);
    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode(
            [
                'success' => true,
                'data' => $data,
                'message' => "Products fetched successfully"
            ]
        );
    } else {
        echo json_encode(
            [
                'success' => false,
                'message' => 'Error fetching categories'
            ]
        );
    }