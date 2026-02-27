<?php
/**
 * Add Ethiopian Academic and Fiction Books
 * Run this once to populate database with Ethiopian books
 * Access: http://localhost/online_bookstore/add_ethiopian_books.php
 */

require_once 'config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Add Ethiopian Books</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1000px; margin: 50px auto; padding: 20px; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; }
        h1 { color: #2c3e50; }
        .btn { display: inline-block; padding: 10px 20px; background: #667eea; color: white; text-decoration: none; border-radius: 5px; margin: 10px 5px; }
    </style>
</head>
<body>
    <h1>📚 Adding Ethiopian Books to Database</h1>";

try {
    // Ethiopian Academic Books
    $ethiopian_books = [
        // Academic - Mathematics
        ['Mathematics Grade 9', 'Ministry of Education', '9789994450091', 7, 19, 'Comprehensive mathematics textbook for Grade 9 students', 15.99, 100, 'MOE Ethiopia', 2023, 320, 'English'],
        ['Mathematics Grade 10', 'Ministry of Education', '9789994450092', 7, 19, 'Advanced mathematics for Grade 10 curriculum', 16.99, 100, 'MOE Ethiopia', 2023, 340, 'English'],
        ['Mathematics Grade 11', 'Ministry of Education', '9789994450093', 7, 19, 'Mathematics textbook for Grade 11 students', 17.99, 100, 'MOE Ethiopia', 2023, 360, 'English'],
        ['Mathematics Grade 12', 'Ministry of Education', '9789994450094', 7, 19, 'Final year mathematics preparation', 18.99, 100, 'MOE Ethiopia', 2023, 380, 'English'],
        
        // Academic - Science
        ['Biology Grade 9', 'Ministry of Education', '9789994450101', 7, 20, 'Biology textbook for students', 14.99, 100, 'MOE Ethiopia', 2023, 280, 'English'],
        ['Chemistry Grade 10', 'Ministry of Education', '9789994450102', 7, 20, 'Chemistry fundamentals for curriculum', 15.99, 100, 'MOE Ethiopia', 2023, 300, 'English'],
        ['Physics Grade 11', 'Ministry of Education', '9789994450103', 7, 20, 'Physics textbook for Grade 11', 16.99, 100, 'MOE Ethiopia', 2023, 320, 'English'],
        
        // Academic - English
        ['English Grade 9', 'Ministry of Education', '9789994450111', 7, 19, 'English language textbook for Grade 9', 12.99, 100, 'MOE Ethiopia', 2023, 250, 'English'],
        ['English Grade 10', 'Ministry of Education', '9789994450112', 7, 19, 'English language and literature Grade 10', 13.99, 100, 'MOE Ethiopia', 2023, 270, 'English'],
        ['English Grade 11', 'Ministry of Education', '9789994450113', 7, 19, 'Advanced English for Grade 11', 14.99, 100, 'MOE Ethiopia', 2023, 290, 'English'],
        
        // Academic - History
        ['History and Civics Grade 9', 'Ministry of Education', '9789994450121', 7, 19, 'History and civic education', 13.99, 100, 'MOE Ethiopia', 2023, 260, 'English'],
        ['History Grade 10', 'Ministry of Education', '9789994450122', 7, 19, 'World and Ethiopian history Grade 10', 14.99, 100, 'MOE Ethiopia', 2023, 280, 'English'],
        
        // Fiction - Ethiopian Authors
        ['Oromay', 'Baalu Girma', '9789994450201', 1, 1, 'Classic Ethiopian novel about love and politics', 19.99, 80, 'Addis Ababa Publishers', 1983, 420, 'Amharic'],
        ['Fikir Eske Mekabir', 'Hadis Alemayehu', '9789994450202', 1, 1, 'Love unto the grave - Ethiopian classic romance', 18.99, 75, 'Artistic Printing Press', 1968, 380, 'Amharic'],
        ['Aliteb Yemikerew', 'Bealu Girma', '9789994450203', 1, 1, 'Ethiopian political fiction', 17.99, 70, 'Addis Ababa Publishers', 1979, 350, 'Amharic'],
        ['Yalanchinet Kokeb', 'Daniachew Worku', '9789994450204', 1, 1, 'Star of dawn - Ethiopian literary masterpiece', 16.99, 65, 'Kuraz Publishing', 1970, 320, 'Amharic'],
        
        // Fiction - Contemporary Ethiopian
        ['Beneath the Lions Gaze', 'Maaza Mengiste', '9780393338607', 1, 1, 'Historical fiction set during Ethiopian Red Terror', 24.99, 60, 'W. W. Norton', 2010, 304, 'English'],
        ['The Shadow King', 'Maaza Mengiste', '9780393083507', 1, 1, 'Ethiopian women in war - Booker Prize finalist', 26.99, 55, 'W. W. Norton', 2019, 432, 'English'],
        ['Cutting for Stone', 'Abraham Verghese', '9780375714368', 1, 1, 'Epic story set in Ethiopia', 27.99, 50, 'Vintage', 2009, 541, 'English'],
        ['Notes from the Hyenas Belly', 'Nega Mezlekia', '9780312203467', 2, 4, 'Memoir of Ethiopian childhood', 22.99, 45, 'Picador', 2000, 368, 'English'],
        
        // Fiction - Ethiopian Folktales
        ['Folktales Collection', 'Various Authors', '9789994450301', 8, 24, 'Collection of traditional Ethiopian stories', 14.99, 90, 'Ethiopian Heritage', 2020, 200, 'English'],
        ['Tales from Ethiopia', 'Ashenafi Kebede', '9789994450302', 8, 24, 'Traditional stories for children', 12.99, 95, 'Addis Books', 2021, 180, 'English'],
        
        // Self-Help & Business
        ['Business Guide for Ethiopia', 'Tadesse Kuma', '9789994450401', 5, 13, 'Starting business in Ethiopia', 29.99, 40, 'Ethiopian Business Press', 2022, 280, 'English'],
        ['Success Principles', 'Mekdes Alemayehu', '9789994450402', 6, 16, 'Personal development guide', 19.99, 50, 'Inspire Ethiopia', 2023, 240, 'English'],
        
        // Technology
        ['ICT for Students', 'Yohannes Haile', '9789994450501', 4, 10, 'Information technology basics', 21.99, 70, 'Tech Ethiopia', 2023, 300, 'English'],
        ['Computer Science Grade 11', 'Ministry of Education', '9789994450502', 4, 10, 'Computer science curriculum', 18.99, 80, 'MOE Ethiopia', 2023, 280, 'English'],
        
        // Children Books
        ['Abugida - Learn Amharic', 'Sara Tesfaye', '9789994450601', 8, 24, 'Learn Amharic alphabet for kids', 9.99, 120, 'Kids Ethiopia', 2023, 60, 'Amharic/English'],
        ['Animal Stories', 'Bekele Molla', '9789994450602', 8, 24, 'Animal stories for children', 11.99, 100, 'Kids Books ET', 2022, 80, 'English'],
        
        // Additional Fiction
        ['Love in Addis', 'Hanna Getachew', '9789994450701', 1, 2, 'Modern romance novel', 15.99, 60, 'Romance Ethiopia', 2023, 280, 'English'],
        ['The Mystery of Lalibela', 'Dawit Kebede', '9789994450702', 1, 3, 'Thriller set in ancient churches', 17.99, 55, 'Mystery House', 2022, 320, 'English'],
        ['Dreams and Aspirations', 'Tigist Assefa', '9789994450703', 1, 1, 'Contemporary fiction', 16.99, 65, 'Modern Ethiopia Press', 2023, 300, 'English']
    ];
    
    $success_count = 0;
    $error_count = 0;
    
    foreach ($ethiopian_books as $book) {
        $title = mysqli_real_escape_string($conn, $book[0]);
        $author = mysqli_real_escape_string($conn, $book[1]);
        $isbn = $book[2];
        $category_id = $book[3];
        $subcategory_id = $book[4];
        $description = mysqli_real_escape_string($conn, $book[5]);
        $price = $book[6];
        $stock = $book[7];
        $publisher = mysqli_real_escape_string($conn, $book[8]);
        $year = $book[9];
        $pages = $book[10];
        $language = $book[11];
        
        $query = "INSERT INTO books (title, author, isbn, category_id, subcategory_id, description, price, stock_quantity, publisher, publication_year, pages, language, image) 
                 VALUES ('$title', '$author', '$isbn', $category_id, $subcategory_id, '$description', $price, $stock, '$publisher', $year, $pages, '$language', 'default-book.jpg')";
        
        if (mysqli_query($conn, $query)) {
            echo "<div class='success'>✓ Added: $title by $author</div>";
            $success_count++;
        } else {
            // Check if book already exists
            if (strpos(mysqli_error($conn), 'Duplicate') !== false) {
                echo "<div style='background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; margin: 10px 0;'>⚠ Already exists: $title</div>";
            } else {
                echo "<div class='error'>✗ Failed to add: $title - " . mysqli_error($conn) . "</div>";
                $error_count++;
            }
        }
    }
    
    echo "<div style='background: #d1ecf1; color: #0c5460; padding: 20px; border-radius: 10px; margin: 30px 0;'>
          <h2>📊 Summary</h2>
          <p><strong>Successfully Added:</strong> $success_count books</p>
          <p><strong>Errors:</strong> $error_count</p>
          <p><strong>Total Ethiopian Books:</strong> " . count($ethiopian_books) . "</p>
          </div>";
    
    echo "<div style='text-align: center; margin: 30px 0;'>
          <a href='index.php' class='btn'>View Books on Homepage</a>
          <a href='admin/manage_products.php' class='btn'>Manage Products</a>
          <a href='test_database.php' class='btn'>Test Database</a>
          </div>";
    
} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
}

echo "</body></html>";
?>
