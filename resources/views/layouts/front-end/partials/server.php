<?php
if (isset($_FILES['input-image'])) {
    // Define the path to the search.py script
    $search_script = "search.py";

    // Get the uploaded file path
    $input_img_path = $_FILES['input-image']['tmp_name'];

    // Execute the script and capture its output
    $output = shell_exec("python $search_script $input_img_path 2>&1");

    // MySQL database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "valley";

    // Create a connection to the database
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query the "products" table to get all data
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if (mysqli_num_rows($result) > 0) {
        $product_found = false;
        // Output data of each row
        while ($row = mysqli_fetch_array($result)) {
            $thumbnails = json_decode($row[13]); // Thumbnail
            $name = $row[3]; // Product Name
            $found_thumbnails = array();

            // Check if the thumbnail is found in the search output
            foreach ($thumbnails as $thumbnail) {
                if (strpos($output, $thumbnail) !== false) {
                    $found_product_name = $name; // assign found product name to variable
                    $found_thumbnails[] = $thumbnail;
                }
            }

            // Display the values in separate variables
            if (!empty($found_thumbnails)) {
                $product_found = true;
                break;
            }
        }

        if ($product_found) {
            $url = "http://localhost/ecommerce-den/products?name=" . urlencode($found_product_name) . "&upload-image=" . urlencode($_FILES['input-image']['name']) . "&data_from=search&page=1";
            header("Location: $url");
            exit();
            
        } else {
            echo "Product not found";
        }
    } else {
        echo "0 results";
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "No input image provided";
}
?>
    