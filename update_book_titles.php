<?php
/**
 * Update Book Titles - Remove "Ethiopian" prefix
 * Run this to update existing book titles
 * Access: http://localhost/online_bookstore/update_book_titles.php
 */

require_once 'config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Update Book Titles</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 50px auto; padding: 20px; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 5px; margin: 10px 0; }
        h1 { color: #2c3e50; }
        .btn { display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 10px 5px; }
    </style>
</head>
<body>
    <h1>📚 Updating Book Titles</h1>
    <p>Removing 'Ethiopian' prefix from book titles...</p>";

try {
    // Array of title updates: [old_title => new_title]
    $title_updates = [
        // Academic Books
        'Ethiopian Mathematics Grade 9' => 'Mathematics Grade 9',
        'Ethiopian Mathematics Grade 10' => 'Mathematics Grade 10',
        'Ethiopian Mathematics Grade 11' => 'Mathematics Grade 11',
        'Ethiopian Mathematics Grade 12' => 'Mathematics Grade 12',
        'Ethiopian Biology Grade 9' => 'Biology Grade 9',
        'Ethiopian Chemistry Grade 10' => 'Chemistry Grade 10',
        'Ethiopian Physics Grade 11' => 'Physics Grade 11',
        'Ethiopian English Grade 9' => 'English Grade 9',
        'Ethiopian English Grade 10' => 'English Grade 10',
        'Ethiopian English Grade 11' => 'English Grade 11',
        'Ethiopian History and Civics Grade 9' => 'History and Civics Grade 9',
        'Ethiopian History Grade 10' => 'History Grade 10',
        
        // Other Books
        'Ethiopian Folktales' => 'Folktales Collection',
        'Ethiopian Business Guide' => 'Business Guide for Ethiopia',
        'Success in Ethiopia' => 'Success Principles',
        'ICT for Ethiopian Students' => 'ICT for Students',
        'Ethiopian Animal Stories' => 'Animal Stories',
        'Ethiopian Dreams' => 'Dreams and Aspirations'
    ];
    
    $updated_count = 0;
    $not_found_count = 0;
    
    foreach ($title_updates as $old_title => $new_title) {
        // Check if book exists
        $check_query = "SELECT book_id FROM books WHERE title = '" . mysqli_real_escape_string($conn, $old_title) . "'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            // Update the title
            $update_query = "UPDATE books SET title = '" . mysqli_real_escape_string($conn, $new_title) . "' 
                           WHERE title = '" . mysqli_real_escape_string($conn, $old_title) . "'";
            
            if (mysqli_query($conn, $update_query)) {
                echo "<div class='success'>✓ Updated: <strong>$old_title</strong> → <strong>$new_title</strong></div>";
                $updated_count++;
            } else {
                echo "<div class='error'>✗ Failed to update: $old_title</div>";
            }
        } else {
            echo "<div class='info'>⚠ Not found: $old_title (may not exist in database)</div>";
            $not_found_count++;
        }
    }
    
    echo "<div style='background: #d1ecf1; color: #0c5460; padding: 20px; border-radius: 10px; margin: 30px 0;'>
          <h2>📊 Summary</h2>
          <p><strong>Successfully Updated:</strong> $updated_count books</p>
          <p><strong>Not Found:</strong> $not_found_count books</p>
          <p><strong>Total Processed:</strong> " . count($title_updates) . " titles</p>
          </div>";
    
    // Show all current books
    echo "<div style='margin-top: 30px;'>
          <h2>📚 Current Books in Database</h2>";
    
    $all_books_query = "SELECT book_id, title, author, price FROM books ORDER BY title";
    $all_books_result = mysqli_query($conn, $all_books_query);
    
    if (mysqli_num_rows($all_books_result) > 0) {
        echo "<table style='width: 100%; border-collapse: collapse; background: white; box-shadow: 0 3px 10px rgba(0,0,0,0.1);'>
              <thead style='background: #667eea; color: white;'>
                <tr>
                  <th style='padding: 12px; text-align: left;'>ID</th>
                  <th style='padding: 12px; text-align: left;'>Title</th>
                  <th style='padding: 12px; text-align: left;'>Author</th>
                  <th style='padding: 12px; text-align: left;'>Price</th>
                </tr>
              </thead>
              <tbody>";
        
        while ($book = mysqli_fetch_assoc($all_books_result)) {
            echo "<tr style='border-bottom: 1px solid #ddd;'>
                    <td style='padding: 12px;'>" . $book['book_id'] . "</td>
                    <td style='padding: 12px;'><strong>" . htmlspecialchars($book['title']) . "</strong></td>
                    <td style='padding: 12px;'>" . htmlspecialchars($book['author']) . "</td>
                    <td style='padding: 12px;'>$" . number_format($book['price'], 2) . "</td>
                  </tr>";
        }
        
        echo "</tbody></table>";
    }
    echo "</div>";
    
    echo "<div style='text-align: center; margin: 30px 0;'>
          <a href='index.php' class='btn'>View Homepage</a>
          <a href='admin/manage_products.php' class='btn'>Manage Products</a>
          <a href='test_database.php' class='btn'>Test Database</a>
          </div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
}

echo "</body></html>";
?>
