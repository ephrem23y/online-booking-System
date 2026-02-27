<?php
require_once 'config.php';

if (!isset($_SESSION['student_id'])) {
    $_SESSION['redirect_message'] = 'Please login to add items to cart';
    header('Location: student/login.php');
    exit();
}

if (isset($_GET['id'])) {
    $book_id = (int)$_GET['id'];
    $student_id = $_SESSION['student_id'];
    
    // Check if book exists and is in stock
    $book_query = "SELECT * FROM books WHERE book_id = $book_id AND status = 'active' AND stock_quantity > 0";
    $book_result = mysqli_query($conn, $book_query);
    
    if (mysqli_num_rows($book_result) > 0) {
        // Check if already in cart
        $check_query = "SELECT * FROM cart WHERE student_id = $student_id AND book_id = $book_id";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // Update quantity
            $cart_item = mysqli_fetch_assoc($check_result);
            $new_quantity = $cart_item['quantity'] + 1;
            mysqli_query($conn, "UPDATE cart SET quantity = $new_quantity WHERE student_id = $student_id AND book_id = $book_id");
            $_SESSION['success_message'] = 'Book quantity updated in cart!';
        } else {
            // Add to cart
            mysqli_query($conn, "INSERT INTO cart (student_id, book_id, quantity) VALUES ($student_id, $book_id, 1)");
            $_SESSION['success_message'] = 'Book added to cart successfully!';
        }
    } else {
        $_SESSION['error_message'] = 'Book not available or out of stock!';
    }
} else {
    $_SESSION['error_message'] = 'Invalid book selection!';
}

// Redirect back to previous page or homepage
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: index.php');
}
exit();
?>
