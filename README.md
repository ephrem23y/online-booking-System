# Ethiopia Online Book Store - E-Commerce Application

A complete, responsive e-commerce web application for selling books online in Ethiopia, built with PHP, MySQL, HTML, and CSS.

## Features

### Admin Module
- **Admin Login** - Secure authentication for administrators
- **Manage Products**
  - Add new books with details (title, author, ISBN, price, etc.)
  - Upload book cover images
  - Edit existing book information
  - Delete books
  - Manage stock quantities
- **Manage Orders**
  - View all customer orders
  - Update order status (Pending, Processing, Shipped, Delivered, Cancelled)
  - Add shipping tracking numbers
  - Update shipping location/status
- **Dashboard** - View statistics and recent activities
- **Logout** - Secure session termination

### Student/Customer Module
- **Register** - Create new customer account
- **Login** - Secure authentication
- **Search Books** - Find books by title, author, or keywords
- **Filter Books**
  - By Category
  - By Subcategory
  - By Price Range
- **View Book List** - Browse all available books
- **View Book Description** - Detailed book information
- **Add to Cart** - Add books to shopping cart
- **Place Order**
  - Add shipping address
  - Update shipping address
  - Select payment method (COD)
- **My Orders** - View order history
- **View Shipping Status** - Track order delivery status

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Web browser

### Setup Instructions

1. **Clone or Download** the project files to your web server directory
   ```
   C:\xampp\htdocs\online-bookstore\  (for XAMPP)
   ```

2. **Create Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `online_bookstore`
   - Import the `database.sql` file

3. **Configure Database Connection**
   - Open `config.php`
   - Update database credentials if needed:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'online_bookstore');
     ```

4. **Create Upload Directory**
   - Create a folder named `uploads` in the root directory
   - Set write permissions (chmod 777 on Linux)

5. **Access the Application**
   - Homepage: http://localhost/online-bookstore/
   - Admin Login: http://localhost/online-bookstore/admin/login.php
   - Student Login: http://localhost/online-bookstore/student/login.php

## Default Credentials

### Admin
- **Username:** admin
- **Password:** admin123

## Project Structure

```
online-bookstore/
├── admin/
│   ├── login.php
│   ├── dashboard.php
│   ├── manage_products.php
│   ├── manage_orders.php
│   └── logout.php
├── student/
│   ├── register.php
│   ├── login.php
│   ├── dashboard.php
│   ├── cart.php
│   ├── checkout.php
│   ├── my_orders.php
│   ├── manage_address.php
│   └── logout.php
├── includes/
│   ├── header.php
│   └── footer.php
├── uploads/          (create this folder)
├── config.php
├── index.php
├── book_details.php
├── add_to_cart.php
├── style.css
└── database.sql
```

## Database Schema

### Tables
- **admin** - Administrator accounts
- **students** - Customer accounts
- **categories** - Book categories
- **subcategories** - Book subcategories
- **books** - Book inventory
- **cart** - Shopping cart items
- **shipping_addresses** - Customer addresses
- **orders** - Order records
- **order_items** - Order line items
- **order_status_history** - Order tracking history
- **reviews** - Book reviews (optional)

## Technologies Used

- **Backend:** PHP 7.4+
- **Database:** MySQL
- **Frontend:** HTML5, CSS3
- **Icons:** Font Awesome 6.0
- **Design:** Responsive CSS Grid & Flexbox

## Features Highlights

### Responsive Design
- Mobile-friendly interface
- Adapts to all screen sizes
- Touch-friendly navigation

### Security
- Password hashing (bcrypt)
- SQL injection prevention
- Session management
- Input validation

### User Experience
- Intuitive navigation
- Real-time cart updates
- Order tracking
- Search and filter functionality

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Future Enhancements

- Payment gateway integration
- Email notifications
- Book reviews and ratings
- Wishlist functionality
- Advanced search filters
- Admin reports and analytics
- Multi-language support

## Support

For issues or questions, please contact: ephremyechale21@gmail.com
Phone: +251 987 112 092

## License

This project is for educational purposes.

---

**Developed with ❤️ for book lovers**
