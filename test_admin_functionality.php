<?php
/**
 * Test Admin Functionality
 * This script tests all admin features and reports any issues
 * Access: http://localhost/online_bookstore/test_admin_functionality.php
 */

require_once 'config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Test Admin Functionality</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 50px auto; padding: 20px; background: #f5f5f5; }
        .container { background: white; border-radius: 10px; padding: 30px; box-shadow: 0 3px 10px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; text-align: center; }
        .test-section { margin: 20px 0; padding: 20px; border-radius: 8px; background: #f8f9fa; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 5px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 5px 0; }
        .warning { background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; margin: 5px 0; }
        .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 5px; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin: 10px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #667eea; color: white; }
        .btn { display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 5px; }
        .btn:hover { background: #5568d3; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🔍 Admin Functionality Test</h1>";

$all_tests_passed = true;

// Test 1: Check Admin Table
echo "<div class='test-section'>
      <h2>1. Admin Table Test</h2>";
try {
    $admin_query = "SELECT * FROM admin";
    $admin_result = mysqli_query($conn, $admin_query);
    
    if ($admin_result && mysqli_num_rows($admin_result) > 0) {
        echo "<div class='success'>✓ Admin table exists and has data</div>";
        echo "<table><tr><th>ID</th><th>Username</th><th>Email</th><th>Full Name</th></tr>";
        while ($admin = mysqli_fetch_assoc($admin_result)) {
            echo "<tr>
                    <td>{$admin['admin_id']}</td>
                    <td><strong>{$admin['username']}</strong></td>
                    <td>{$admin['email']}</td>
                    <td>{$admin['full_name']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='error'>✗ Admin table is empty or doesn't exist</div>";
        $all_tests_passed = false;
    }
} catch (Exception $e) {
    echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
    $all_tests_passed = false;
}
echo "</div>";

// Test 2: Check Books Table
echo "<div class='test-section'>
      <h2>2. Books Table Test</h2>";
try {
    $books_query = "SELECT COUNT(*) as count FROM books";
    $books_result = mysqli_query($conn, $books_query);
    $books_count = mysqli_fetch_assoc($books_result)['count'];
    
    if ($books_count > 0) {
        echo "<div class='success'>✓ Books table has {$books_count} books</div>";
        
        // Show sample books
        $sample_books = mysqli_query($conn, "SELECT * FROM books LIMIT 5");
        echo "<table><tr><th>ID</th><th>Title</th><th>Author</th><th>Price</th><th>Stock</th></tr>";
        while ($book = mysqli_fetch_assoc($sample_books)) {
            echo "<tr>
                    <td>{$book['book_id']}</td>
                    <td>{$book['title']}</td>
                    <td>{$book['author']}</td>
                    <td>\${$book['price']}</td>
                    <td>{$book['stock_quantity']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='warning'>⚠ Books table is empty. Run add_ethiopian_books.php to add books</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
    $all_tests_passed = false;
}
echo "</div>";

// Test 3: Check Categories Table
echo "<div class='test-section'>
      <h2>3. Categories Table Test</h2>";
try {
    $categories_query = "SELECT * FROM categories";
    $categories_result = mysqli_query($conn, $categories_query);
    
    if ($categories_result && mysqli_num_rows($categories_result) > 0) {
        $cat_count = mysqli_num_rows($categories_result);
        echo "<div class='success'>✓ Categories table has {$cat_count} categories</div>";
        echo "<table><tr><th>ID</th><th>Category Name</th><th>Description</th></tr>";
        while ($cat = mysqli_fetch_assoc($categories_result)) {
            echo "<tr>
                    <td>{$cat['category_id']}</td>
                    <td><strong>{$cat['category_name']}</strong></td>
                    <td>{$cat['description']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<div class='error'>✗ Categories table is empty</div>";
        $all_tests_passed = false;
    }
} catch (Exception $e) {
    echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
    $all_tests_passed = false;
}
echo "</div>";

// Test 4: Check Students Table
echo "<div class='test-section'>
      <h2>4. Students Table Test</h2>";
try {
    $students_query = "SELECT COUNT(*) as count FROM students";
    $students_result = mysqli_query($conn, $students_query);
    $students_count = mysqli_fetch_assoc($students_result)['count'];
    
    echo "<div class='info'>ℹ Students table has {$students_count} registered students</div>";
    
    if ($students_count > 0) {
        $sample_students = mysqli_query($conn, "SELECT * FROM students LIMIT 5");
        echo "<table><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th></tr>";
        while ($student = mysqli_fetch_assoc($sample_students)) {
            echo "<tr>
                    <td>{$student['student_id']}</td>
                    <td>{$student['full_name']}</td>
                    <td>{$student['email']}</td>
                    <td>" . ($student['phone'] ?? 'N/A') . "</td>
                  </tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
    $all_tests_passed = false;
}
echo "</div>";

// Test 5: Check Orders Table
echo "<div class='test-section'>
      <h2>5. Orders Table Test</h2>";
try {
    $orders_query = "SELECT COUNT(*) as count, SUM(total_amount) as revenue FROM orders";
    $orders_result = mysqli_query($conn, $orders_query);
    $orders_data = mysqli_fetch_assoc($orders_result);
    $orders_count = $orders_data['count'];
    $revenue = $orders_data['revenue'] ?? 0;
    
    echo "<div class='info'>ℹ Orders table has {$orders_count} orders with total revenue: \$" . number_format($revenue, 2) . "</div>";
    
    if ($orders_count > 0) {
        $sample_orders = mysqli_query($conn, "SELECT o.*, s.full_name FROM orders o JOIN students s ON o.student_id = s.student_id LIMIT 5");
        echo "<table><tr><th>Order #</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th></tr>";
        while ($order = mysqli_fetch_assoc($sample_orders)) {
            echo "<tr>
                    <td>{$order['order_number']}</td>
                    <td>{$order['full_name']}</td>
                    <td>\$" . number_format($order['total_amount'], 2) . "</td>
                    <td>{$order['order_status']}</td>
                    <td>" . date('M d, Y', strtotime($order['order_date'])) . "</td>
                  </tr>";
        }
        echo "</table>";
    }
} catch (Exception $e) {
    echo "<div class='error'>✗ Error: " . $e->getMessage() . "</div>";
    $all_tests_passed = false;
}
echo "</div>";

// Test 6: Check Required Tables
echo "<div class='test-section'>
      <h2>6. Database Tables Check</h2>";
$required_tables = [
    'admin', 'students', 'books', 'categories', 'subcategories', 
    'cart', 'orders', 'order_items', 'shipping_addresses', 'order_status_history'
];

foreach ($required_tables as $table) {
    $check_query = "SHOW TABLES LIKE '$table'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        echo "<div class='success'>✓ Table '{$table}' exists</div>";
    } else {
        echo "<div class='error'>✗ Table '{$table}' is missing</div>";
        $all_tests_passed = false;
    }
}
echo "</div>";

// Test 7: Check Admin Pages
echo "<div class='test-section'>
      <h2>7. Admin Pages Check</h2>";
$admin_pages = [
    'admin/login.php' => 'Admin Login',
    'admin/dashboard.php' => 'Admin Dashboard',
    'admin/manage_products.php' => 'Manage Products',
    'admin/manage_orders.php' => 'Manage Orders',
    'admin/manage_categories.php' => 'Manage Categories',
    'admin/view_students.php' => 'View Students',
    'admin/logout.php' => 'Logout'
];

foreach ($admin_pages as $file => $name) {
    if (file_exists($file)) {
        echo "<div class='success'>✓ {$name} ({$file}) exists</div>";
    } else {
        echo "<div class='error'>✗ {$name} ({$file}) is missing</div>";
        $all_tests_passed = false;
    }
}
echo "</div>";

// Test 8: Check Uploads Directory
echo "<div class='test-section'>
      <h2>8. Uploads Directory Check</h2>";
if (file_exists('uploads')) {
    if (is_writable('uploads')) {
        echo "<div class='success'>✓ Uploads directory exists and is writable</div>";
    } else {
        echo "<div class='warning'>⚠ Uploads directory exists but is not writable</div>";
    }
} else {
    echo "<div class='warning'>⚠ Uploads directory doesn't exist. It will be created when you upload a book image</div>";
}
echo "</div>";

// Final Summary
echo "<div class='test-section' style='background: " . ($all_tests_passed ? "#d4edda" : "#fff3cd") . ";'>
      <h2>📊 Test Summary</h2>";
if ($all_tests_passed) {
    echo "<div class='success' style='font-size: 1.2rem;'>
          <strong>✓ All critical tests passed!</strong><br>
          Your admin panel is ready to use.
          </div>";
} else {
    echo "<div class='warning' style='font-size: 1.2rem;'>
          <strong>⚠ Some tests failed</strong><br>
          Please review the errors above and fix them.
          </div>";
}
echo "</div>";

// Quick Links
echo "<div style='text-align: center; margin-top: 30px;'>
      <h3>Quick Links</h3>
      <a href='admin/login.php' class='btn'>🔐 Admin Login</a>
      <a href='fix_admin_login.php' class='btn'>🔧 Fix Admin Login</a>
      <a href='setup.php' class='btn'>⚙️ Setup Database</a>
      <a href='add_ethiopian_books.php' class='btn'>📚 Add Books</a>
      <a href='index.php' class='btn'>🏠 Homepage</a>
      </div>";

echo "</div></body></html>";
?>
