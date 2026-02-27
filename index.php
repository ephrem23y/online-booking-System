<?php
require_once 'config.php';
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Welcome to Ethiopia Online Book Store</h1>
        <p>Discover thousands of books across all genres. From classic literature to academic textbooks, we have something for every Ethiopian reader.</p>
        <a href="#featured-books" class="btn">Browse Books</a>
    </div>
</section>

<!-- Featured Books -->
<section id="featured-books" class="main-content">
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 30px; color: #333;">Featured Books</h2>
        
        <?php
        // Fetch featured books
        $sql = "SELECT b.*, c.category_name 
                FROM books b 
                LEFT JOIN categories c ON b.category_id = c.category_id 
                ORDER BY b.created_at DESC LIMIT 8";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            echo '<div class="books-grid">';
            while($row = $result->fetch_assoc()) {
                $book_id = $row['book_id'];
                $is_logged_in = isset($_SESSION['student_id']);
                
                echo '
                <div class="book-card">
                    <div class="book-image">
                        <i class="fas fa-book fa-3x"></i>
                    </div>
                    <div class="book-info">
                        <h3 class="book-title">' . htmlspecialchars($row['title']) . '</h3>
                        <p class="book-author">By ' . htmlspecialchars($row['author']) . '</p>
                        <p class="book-category">' . htmlspecialchars($row['category_name']) . '</p>
                        <p class="book-price">$' . number_format($row['price'], 2) . '</p>
                        <div style="display: flex; gap: 0.5rem; margin-top: 10px;">';
                
                if ($is_logged_in) {
                    echo '<a href="add_to_cart.php?id=' . $book_id . '" class="btn btn-success" style="flex: 1;">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                          </a>';
                } else {
                    echo '<a href="student/login.php" class="btn btn-success" style="flex: 1;">
                            <i class="fas fa-sign-in-alt"></i> Login to Buy
                          </a>';
                }
                
                echo '<a href="book_details.php?id=' . $book_id . '" class="btn btn-secondary">
                        <i class="fas fa-eye"></i>
                      </a>
                        </div>
                    </div>
                </div>';
            }
            echo '</div>';
        } else {
            echo '<p style="text-align: center;">No books available yet.</p>';
        }
        ?>
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="student/register.php" class="btn">Join Now to Explore More</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>