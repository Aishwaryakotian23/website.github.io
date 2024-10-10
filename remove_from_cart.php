<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index']);

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array
        echo("<script language='javascript'>
        window.alert('removed From Cart')
        window.location.href='cart.php'
        </script>");
        exit();
    } else {
        echo("<script language='javascript'>
        window.alert('Item Not Found in Cart')
        window.location.href='cart.php'
        </script>");
        exit();
    }
}
?>
