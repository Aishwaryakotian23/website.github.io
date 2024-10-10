<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_POST['index'];

    // Check if index exists in wishlist array
    if (isset($_SESSION['wishlist'][$index])) {
        // Remove item from wishlist using index
        unset($_SESSION['wishlist'][$index]);

        // Re-index wishlist array to prevent gaps
        $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);

        http_response_code(200); // Success response code
    } else {
        http_response_code(404); // Not found response code
    }
} else {
    http_response_code(400); // Bad request response code
}
?>
