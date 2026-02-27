<?php
/**
 * Fix Admin Login - Reset Admin Credentials
 * Run this to fix admin login issues
 * Access: http://localhost/online_bookstore/fix_admin_login.php
 */

require_once 'config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Fix Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .container { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px; margin: 10px 0; border: 2px solid #ffc107; }
        h1 { color: #2c3e50; text-align: center; }
        .credentials { background: #f8f9fa; padding: 20px; border-radius: 10px; margin: 20px 0; border: 3px solid #667eea; }
        .credentials h2 { color: #667eea; margin-top: 0; }
        .cred-item { margin: 15px 0; font-size: 1.2rem; }
        .cred-value { background: #667eea; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; display: inline-block; margin-left: 10px; }
        .btn { display: inline-block; padding: 15px 30px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 10px 5px; font-weight: bold; }
        .btn:hover { background: #5568d3; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #667eea; color: white; }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🔐 Fix Admin Login</h1>";

try {
    // Check if admin exists
    $check_query = "SELECT * FROM admin";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<h2>Current Admin Accounts:</h2>";
        echo "<table>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full Name</th>
              </tr>";
        
        while ($admin = mysqli_fetch_assoc($check_result)) {
            echo "<tr>
                    <td>" . $admin['admin_id'] . "</td>
                    <td><strong>" . htmlspecialchars($admin['username']) . "</strong></td>
                    <td>" . htmlspecialchars($admin['email']) . "</td>
                    <td>" . htmlspecialchars($admin['full_name']) . "</td>
                  </tr>";
        }
        echo "</table>";
        
        // Update/Reset admin password
        $new_password = 'admin123';
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update all admin accounts to have correct password
        $update_query = "UPDATE admin SET password = '$hashed_password' WHERE username = 'admin'";
        
        if (mysqli_query($conn, $update_query)) {
            echo "<div class='success'>✓ Admin password has been reset successfully!</div>";
        } else {
            echo "<div class='error'>✗ Failed to update password: " . mysqli_error($conn) . "</div>";
        }
        
    } else {
        // No admin exists, create one
        echo "<div class='info'>⚠ No admin account found. Creating new admin account...</div>";
        
        $username = 'admin';
        $password = 'admin123';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $email = 'admin@ethiopiabookstore.com';
        $full_name = 'Admin User';
        
        $insert_query = "INSERT INTO admin (username, password, email, full_name) 
                        VALUES ('$username', '$hashed_password', '$email', '$full_name')";
        
        if (mysqli_query($conn, $insert_query)) {
            echo "<div class='success'>✓ New admin account created successfully!</div>";
        } else {
            echo "<div class='error'>✗ Failed to create admin: " . mysqli_error($conn) . "</div>";
        }
    }
    
    // Show credentials
    echo "<div class='credentials'>
          <h2>🔑 Admin Login Credentials</h2>
          <div class='cred-item'>
            <strong>Username:</strong>
            <span class='cred-value'>admin</span>
            <span style='color: red; margin-left: 10px;'>(lowercase 'a')</span>
          </div>
          <div class='cred-item'>
            <strong>Password:</strong>
            <span class='cred-value'>admin123</span>
          </div>
          </div>";
    
    echo "<div class='info'>
          <h3>⚠️ Important Notes:</h3>
          <ul>
            <li><strong>Username is case-sensitive!</strong> Use <code>admin</code> not <code>Admin</code></li>
            <li>Password is: <code>admin123</code></li>
            <li>Make sure there are no extra spaces</li>
            <li>Copy and paste if needed</li>
          </ul>
          </div>";
    
    echo "<div style='text-align: center; margin: 30px 0;'>
          <a href='admin/login.php' class='btn'>🔐 Go to Admin Login</a>
          <a href='index.php' class='btn'>🏠 Go to Homepage</a>
          </div>";
    
    // Test login
    echo "<div style='background: #e8f5e9; padding: 20px; border-radius: 10px; margin: 20px 0;'>
          <h3 style='color: #2e7d32;'>✅ Test Login:</h3>
          <p>Try logging in with these exact credentials:</p>
          <ol>
            <li>Go to: <a href='admin/login.php' target='_blank'>admin/login.php</a></li>
            <li>Username: <strong>admin</strong> (all lowercase)</li>
            <li>Password: <strong>admin123</strong></li>
            <li>Click Login</li>
          </ol>
          </div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
}

echo "</div></body></html>";
?>
