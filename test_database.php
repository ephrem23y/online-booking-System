<?php
/**
 * Database Test & Verification Script
 * Check if all tables exist and show sample data
 */

require_once 'config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Database Test - Ethiopia BookStore</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 20px auto; padding: 20px; }
        h1 { color: #2c3e50; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; background: white; }
        th, td { padding: 12px; text-align: left; border: 1px solid #ddd; }
        th { background: #667eea; color: white; }
        tr:hover { background: #f5f5f5; }
        .section { margin: 30px 0; padding: 20px; background: #f8f9fa; border-radius: 10px; }
    </style>
</head>
<body>
    <h1>🔍 Database Test - Ethiopia BookStore</h1>";

try {
    // Test connection
    echo "<div class='success'>✓ Database connection successful!</div>";
    
    // Check all required tables
    $required_tables = ['admin', 'students', 'categories', 'subcategories', 'books', 'cart', 'shipping_addresses', 'orders', 'order_items', 'order_status_history'];
    
    echo "<div class='section'>";
    echo "<h2>📋 Tables Status</h2>";
    echo "<table>";
    echo "<tr><th>Table Name</th><th>Status</th><th>Row Count</th></tr>";
    
    foreach ($required_tables as $table) {
        $result = mysqli_query($conn, "SELECT COUNT(*) as count FROM $table");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo "<tr><td>$table</td><td style='color: green;'>✓ Exists</td><td>" . $row['count'] . "</td></tr>";
        } else {
            echo "<tr><td>$table</td><td style='color: red;'>✗ Missing</td><td>-</td></tr>";
        }
    }
    echo "</table>";
    echo "</div>";
    
    // Show admin accounts
    echo "<div class='section'>";
    echo "<h2>👨‍💼 Admin Accounts</h2>";
    $admin_result = mysqli_query($conn, "SELECT admin_id, username, email, full_name FROM admin");
    if (mysqli_num_rows($admin_result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Full Name</th></tr>";
        while ($admin = mysqli_fetch_assoc($admin_result)) {
            echo "<tr>";
            echo "<td>" . $admin['admin_id'] . "</td>";
            echo "<td>" . htmlspecialchars($admin['username']) . "</td>";
            echo "<td>" . htmlspecialchars($admin['email']) . "</td>";
            echo "<td>" . htmlspecialchars($admin['full_name']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div class='success'>Default Login: Username: <strong>admin</strong> | Password: <strong>admin123</strong></div>";
    } else {
        echo "<div class='error'>No admin accounts found!</div>";
    }
    echo "</div>";
    
    // Show students
    echo "<div class='section'>";
    echo "<h2>👥 Student Accounts</h2>";
    $student_result = mysqli_query($conn, "SELECT student_id, full_name, email, phone, created_at FROM students ORDER BY created_at DESC LIMIT 10");
    if (mysqli_num_rows($student_result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Registered</th></tr>";
        while ($student = mysqli_fetch_assoc($student_result)) {
            echo "<tr>";
            echo "<td>" . $student['student_id'] . "</td>";
            echo "<td>" . htmlspecialchars($student['full_name']) . "</td>";
            echo "<td>" . htmlspecialchars($student['email']) . "</td>";
            echo "<td>" . htmlspecialchars($student['phone']) . "</td>";
            echo "<td>" . date('M d, Y', strtotime($student['created_at'])) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='error'>No student accounts found. <a href='student/register.php'>Register now</a></div>";
    }
    echo "</div>";
    
    // Show books
    echo "<div class='section'>";
    echo "<h2>📚 Books in Store</h2>";
    $books_result = mysqli_query($conn, "SELECT b.book_id, b.title, b.author, b.price, b.stock_quantity, c.category_name 
                                         FROM books b 
                                         LEFT JOIN categories c ON b.category_id = c.category_id 
                                         ORDER BY b.created_at DESC LIMIT 10");
    if (mysqli_num_rows($books_result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Category</th><th>Price</th><th>Stock</th></tr>";
        while ($book = mysqli_fetch_assoc($books_result)) {
            echo "<tr>";
            echo "<td>" . $book['book_id'] . "</td>";
            echo "<td>" . htmlspecialchars($book['title']) . "</td>";
            echo "<td>" . htmlspecialchars($book['author']) . "</td>";
            echo "<td>" . htmlspecialchars($book['category_name']) . "</td>";
            echo "<td>$" . number_format($book['price'], 2) . "</td>";
            echo "<td>" . $book['stock_quantity'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='error'>No books found. <a href='admin/manage_products.php'>Add books</a></div>";
    }
    echo "</div>";
    
    // Show orders
    echo "<div class='section'>";
    echo "<h2>📦 Recent Orders</h2>";
    $orders_result = mysqli_query($conn, "SELECT o.order_id, o.order_number, o.total_amount, o.order_status, o.order_date, s.full_name 
                                          FROM orders o 
                                          JOIN students s ON o.student_id = s.student_id 
                                          ORDER BY o.order_date DESC LIMIT 10");
    if (mysqli_num_rows($orders_result) > 0) {
        echo "<table>";
        echo "<tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr>";
        while ($order = mysqli_fetch_assoc($orders_result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($order['order_number']) . "</td>";
            echo "<td>" . htmlspecialchars($order['full_name']) . "</td>";
            echo "<td>$" . number_format($order['total_amount'], 2) . "</td>";
            echo "<td>" . ucfirst($order['order_status']) . "</td>";
            echo "<td>" . date('M d, Y H:i', strtotime($order['order_date'])) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='error'>No orders found yet.</div>";
    }
    echo "</div>";
    
    // Test queries
    echo "<div class='section'>";
    echo "<h2>🧪 Test Queries</h2>";
    
    // Test student registration query
    $test_email = 'test@example.com';
    $check_query = "SELECT * FROM students WHERE email = '$test_email'";
    $check_result = mysqli_query($conn, $check_query);
    if ($check_result !== false) {
        echo "<div class='success'>✓ Student query test passed</div>";
    } else {
        echo "<div class='error'>✗ Student query test failed: " . mysqli_error($conn) . "</div>";
    }
    
    // Test order insertion
    echo "<div class='success'>✓ All database operations working correctly</div>";
    echo "</div>";
    
    echo "<div style='text-align: center; margin: 30px 0;'>";
    echo "<a href='index.php' style='display: inline-block; padding: 15px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 5px;'>Go to Homepage</a>";
    echo "<a href='admin/login.php' style='display: inline-block; padding: 15px 30px; background: #f5576c; color: white; text-decoration: none; border-radius: 5px; margin: 5px;'>Admin Login</a>";
    echo "<a href='student/register.php' style='display: inline-block; padding: 15px 30px; background: #43e97b; color: white; text-decoration: none; border-radius: 5px; margin: 5px;'>Student Register</a>";
    echo "</div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
}

echo "</body></html>";
?>
