<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'make_payment') {
        // Process the payment
        // Code to process the payment goes here

        echo "Payment successful!";
    } elseif ($action == 'cancel_order') {
        // Cancel the order
        // Code to cancel the order goes here

        echo "Order cancelled!";
    }
} else {
    echo "Invalid request.";
}

?>