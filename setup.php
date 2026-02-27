<?php
/**
 * Database Setup Script
 * Run this file once to create the database and tables
 * Access: http://localhost/online_bookstore/setup.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'online_bookstore');

echo "<!DOCTYPE html>
<html>
<head>
    <title>Database Setup</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 5px; margin: 10px 0; }
        h1 { color: #333; }
        .btn { display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>📚 Online Book Store - Database Setup</h1>";

try {
    // Connect without database first
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<div class='success'>✓ Connected to MySQL server successfully!</div>";
    
    // Create database
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
    if ($conn->query($sql) === TRUE) {
        echo "<div class='success'>✓ Database '" . DB_NAME . "' created successfully!</div>";
    } else {
        throw new Exception("Error creating database: " . $conn->error);
    }
    
    // Select database
    $conn->select_db(DB_NAME);
    echo "<div class='success'>✓ Database selected!</div>";
    
    // Read and execute SQL file
    $sql_file = 'database.sql';
    if (file_exists($sql_file)) {
        $sql_content = file_get_contents($sql_file);
        
        // Split by semicolon and execute each statement
        $statements = array_filter(array_map('trim', explode(';', $sql_content)));
        
        $success_count = 0;
        foreach ($statements as $statement) {
            if (!empty($statement) && !preg_match('/^(--|\/\*)/', $statement)) {
                if ($conn->query($statement) === TRUE) {
                    $success_count++;
                } else {
                    // Ignore "table already exists" errors
                    if (strpos($conn->error, 'already exists') === false) {
                        echo "<div class='error'>⚠ Error: " . $conn->error . "</div>";
                    }
                }
            }
        }
        
        echo "<div class='success'>✓ Executed $success_count SQL statements successfully!</div>";
    } else {
        echo "<div class='error'>⚠ database.sql file not found!</div>";
    }
    
    // Verify tables
    $result = $conn->query("SHOW TABLES");
    $tables = [];
    while ($row = $result->fetch_array()) {
        $tables[] = $row[0];
    }
    
    echo "<div class='info'><strong>Tables created:</strong><br>";
    echo implode(', ', $tables);
    echo "</div>";
    
    // Check admin account
    $admin_check = $conn->query("SELECT * FROM admin LIMIT 1");
    if ($admin_check && $admin_check->num_rows > 0) {
        echo "<div class='success'>✓ Admin account created!</div>";
        echo "<div class='info'><strong>Admin Login Credentials:</strong><br>
              Username: <strong>admin</strong><br>
              Password: <strong>admin123</strong></div>";
    }
    
    // Check sample books
    $books_check = $conn->query("SELECT COUNT(*) as count FROM books");
    if ($books_check) {
        $count = $books_check->fetch_assoc()['count'];
        echo "<div class='success'>✓ Sample books loaded: $count books</div>";
    }
    
    echo "<div class='success' style='margin-top: 30px;'>
          <h2>🎉 Setup Complete!</h2>
          <p>Your database has been set up successfully. You can now use the application.</p>
          </div>";
    
    echo "<a href='index.php' class='btn'>Go to Homepage</a> ";
    echo "<a href='admin/login.php' class='btn'>Admin Login</a> ";
    echo "<a href='student/register.php' class='btn'>Student Register</a>";
    
    echo "<div class='info' style='margin-top: 30px;'>
          <strong>⚠ Important:</strong> For security, delete or rename this setup.php file after setup is complete.
          </div>";
    
    $conn->close();
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
    echo "<div class='info'>
          <strong>Troubleshooting:</strong><br>
          1. Make sure XAMPP MySQL is running<br>
          2. Check database credentials in config.php<br>
          3. Ensure you have permission to create databases<br>
          4. Try accessing phpMyAdmin: <a href='http://localhost/phpmyadmin' target='_blank'>http://localhost/phpmyadmin</a>
          </div>";
}

echo "</body></html>";
?>
