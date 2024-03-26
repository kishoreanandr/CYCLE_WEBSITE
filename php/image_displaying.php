<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password ="";
    $dbname = "cycle_details";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch images from the database
    $sql = "SELECT product_images FROM cycle_detail";
    $result = $conn->query($sql);

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Loop through each row of the result
        while ($row = $result->fetch_assoc()) {
            // Extract the file type from the binary data
            $imageData = $row["product_images"];
            $imageType = substr($imageData, 0, strpos($imageData, ',') - 1);
            $imageData = substr($imageData, strpos($imageData, ',') + 1);

            // Set the correct content type for displaying the image
            header('Content-Type: ' . $imageType);

            // Display the binary data as an image
            echo $imageData;

            // Add a space for separating images if you want to display multiple images on the same page
            echo " ";
        }
    } else {
        echo "0 results";
    }

    // Close the database connection
    $conn->close();
?>