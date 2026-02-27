<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$book_id = (int)$_GET['id'];

// Get book details
$query = "SELECT b.*, c.category_name, sc.subcategory_name 
          FROM books b 
          LEFT JOIN categories c ON b.category_id = c.category_id 
          LEFT JOIN subcategories sc ON b.subcategory_id = sc.subcategory_id 
          WHERE b.book_id = $book_id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    header('Location: index.php');
    exit();
}

$book = mysqli_fetch_assoc($result);
$page_url = BASE_URL . 'book_details.php?id=' . $book_id;
$book_image = BASE_URL . 'uploads/' . $book['image'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Tags -->
    <title><?php echo htmlspecialchars($book['title']); ?> by <?php echo htmlspecialchars($book['author']); ?> - Ethiopia BookStore</title>
    <meta name="description" content="Buy <?php echo htmlspecialchars($book['title']); ?> by <?php echo htmlspecialchars($book['author']); ?>. <?php echo htmlspecialchars(substr($book['description'], 0, 150)); ?>... Price: $<?php echo number_format($book['price'], 2); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($book['title']); ?>, <?php echo htmlspecialchars($book['author']); ?>, <?php echo htmlspecialchars($book['category_name']); ?>, Ethiopian books, buy books online Ethiopia">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="product">
    <meta property="og:url" content="<?php echo $page_url; ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($book['title']); ?> - <?php echo htmlspecialchars($book['author']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(substr($book['description'], 0, 200)); ?>">
    <meta property="og:image" content="<?php echo $book_image; ?>">
    <meta property="og:price:amount" content="<?php echo $book['price']; ?>">
    <meta property="og:price:currency" content="USD">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo $page_url; ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($book['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars(substr($book['description'], 0, 200)); ?>">
    <meta name="twitter:image" content="<?php echo $book_image; ?>">
    
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Schema.org Product Markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "<?php echo htmlspecialchars($book['title']); ?>",
        "image": "<?php echo $book_image; ?>",
        "description": "<?php echo htmlspecialchars($book['description']); ?>",
        "isbn": "<?php echo htmlspecialchars($book['isbn']); ?>",
        "author": {
            "@type": "Person",
            "name": "<?php echo htmlspecialchars($book['author']); ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?php echo htmlspecialchars($book['publisher']); ?>"
        },
        "offers": {
            "@type": "Offer",
            "url": "<?php echo $page_url; ?>",
            "priceCurrency": "USD",
            "price": "<?php echo $book['price']; ?>",
            "availability": "<?php echo $book['stock_quantity'] > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock'; ?>",
            "seller": {
                "@type": "Organization",
                "name": "Ethiopia BookStore"
            }
        }
    }
    </script>
</head>
<body>
    <?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 2rem;">
    <!-- Social Share Buttons -->
    <div style="background: white; padding: 1rem; border-radius: 10px; margin-bottom: 1rem; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
        <strong style="margin-right: 1rem;">Share this book:</strong>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($page_url); ?>" 
           target="_blank" class="btn btn-primary" style="margin: 0 0.5rem;">
            <i class="fab fa-facebook"></i> Facebook
        </a>
        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($page_url); ?>&text=<?php echo urlencode($book['title'] . ' by ' . $book['author']); ?>" 
           target="_blank" class="btn btn-primary" style="margin: 0 0.5rem;">
            <i class="fab fa-twitter"></i> Twitter
        </a>
        <a href="https://wa.me/?text=<?php echo urlencode('Check out this book: ' . $book['title'] . ' - ' . $page_url); ?>" 
           target="_blank" class="btn btn-success" style="margin: 0 0.5rem;">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
        <a href="https://t.me/share/url?url=<?php echo urlencode($page_url); ?>&text=<?php echo urlencode($book['title']); ?>" 
           target="_blank" class="btn btn-primary" style="margin: 0 0.5rem;">
            <i class="fab fa-telegram"></i> Telegram
        </a>
        <button onclick="copyLink()" class="btn btn-secondary" style="margin: 0 0.5rem;">
            <i class="fas fa-link"></i> Copy Link
        </button>
    </div>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 3rem; background: white; border-radius: 10px; padding: 2rem; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
        <!-- Book Image -->
        <div>
            <img src="<?php echo $book_image; ?>" 
                 alt="<?php echo htmlspecialchars($book['title']); ?>"
                 style="width: 100%; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"
                 onerror="this.src='https://via.placeholder.com/400x600?text=<?php echo urlencode($book['title']); ?>'">
        </div>
        
        <!-- Book Details -->
        <div>
            <h1 style="color: var(--primary-color); margin-bottom: 0.5rem;">
                <?php echo htmlspecialchars($book['title']); ?>
            </h1>
            <p style="font-size: 1.2rem; color: #666; margin-bottom: 1rem;">
                by <strong><?php echo htmlspecialchars($book['author']); ?></strong>
            </p>
            
            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                <span class="status-badge status-delivered">
                    <i class="fas fa-tag"></i> <?php echo htmlspecialchars($book['category_name']); ?>
                </span>
                <?php if ($book['subcategory_name']): ?>
                    <span class="status-badge status-processing">
                        <?php echo htmlspecialchars($book['subcategory_name']); ?>
                    </span>
                <?php endif; ?>
            </div>
            
            <div style="font-size: 2rem; color: var(--success-color); font-weight: bold; margin-bottom: 1.5rem;">
                $<?php echo number_format($book['price'], 2); ?>
            </div>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin-bottom: 1.5rem;">
                <h3 style="margin-bottom: 1rem; color: var(--primary-color);">
                    <i class="fas fa-info-circle"></i> Book Information
                </h3>
                <table style="width: 100%;">
                    <tr>
                        <td style="padding: 0.5rem 0; color: #666;"><strong>ISBN:</strong></td>
                        <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                    </tr>
                    <?php if ($book['publisher']): ?>
                    <tr>
                        <td style="padding: 0.5rem 0; color: #666;"><strong>Publisher:</strong></td>
                        <td><?php echo htmlspecialchars($book['publisher']); ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($book['publication_year']): ?>
                    <tr>
                        <td style="padding: 0.5rem 0; color: #666;"><strong>Year:</strong></td>
                        <td><?php echo $book['publication_year']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if ($book['pages']): ?>
                    <tr>
                        <td style="padding: 0.5rem 0; color: #666;"><strong>Pages:</strong></td>
                        <td><?php echo $book['pages']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td style="padding: 0.5rem 0; color: #666;"><strong>Language:</strong></td>
                        <td><?php echo htmlspecialchars($book['language']); ?></td>
                    </tr>
                    <tr>
                        <td style="padding: 0.5rem 0; color: #666;"><strong>Availability:</strong></td>
                        <td>
                            <?php if ($book['stock_quantity'] > 0): ?>
                                <span style="color: var(--success-color);">
                                    <i class="fas fa-check-circle"></i> In Stock (<?php echo $book['stock_quantity']; ?> available)
                                </span>
                            <?php else: ?>
                                <span style="color: var(--accent-color);">
                                    <i class="fas fa-times-circle"></i> Out of Stock
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <?php if ($book['description']): ?>
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="margin-bottom: 1rem; color: var(--primary-color);">
                        <i class="fas fa-align-left"></i> Description
                    </h3>
                    <p style="line-height: 1.8; color: #666;">
                        <?php echo nl2br(htmlspecialchars($book['description'])); ?>
                    </p>
                </div>
            <?php endif; ?>
            
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <?php if ($book['stock_quantity'] > 0): ?>
                    <?php if (isset($_SESSION['student_id'])): ?>
                        <a href="add_to_cart.php?id=<?php echo $book['book_id']; ?>" class="btn btn-success" style="flex: 1; text-align: center;">
                            <i class="fas fa-cart-plus"></i> Add to Cart
                        </a>
                    <?php else: ?>
                        <a href="student/login.php" class="btn btn-success" style="flex: 1; text-align: center;">
                            <i class="fas fa-sign-in-alt"></i> Login to Buy
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <button class="btn btn-danger" style="flex: 1;" disabled>
                        <i class="fas fa-times-circle"></i> Out of Stock
                    </button>
                <?php endif; ?>
                <a href="index.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Books
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function copyLink() {
    const url = '<?php echo $page_url; ?>';
    navigator.clipboard.writeText(url).then(function() {
        alert('Link copied to clipboard!');
    }, function() {
        alert('Failed to copy link');
    });
}
</script>

<?php include 'includes/footer.php'; ?>
