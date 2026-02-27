# Installation Guide - Ethiopia Online Book Store

## Step-by-Step Installation Instructions

### 1. Prerequisites
Before you begin, ensure you have:
- **XAMPP** (or WAMP/LAMP) installed
- **PHP 7.4+** 
- **MySQL 5.7+**
- A web browser (Chrome, Firefox, Edge, Safari)

### 2. Download and Extract
1. Download the project files
2. Extract to your web server directory:
   - **XAMPP**: `C:\xampp\htdocs\online-bookstore\`
   - **WAMP**: `C:\wamp64\www\online-bookstore\`
   - **Linux**: `/var/www/html/online-bookstore/`

### 3. Create Database
1. Start Apache and MySQL from XAMPP Control Panel
2. Open your browser and go to: `http://localhost/phpmyadmin`
3. Click "New" to create a new database
4. Name it: `online_bookstore`
5. Click "Create"
6. Select the `online_bookstore` database
7. Click "Import" tab
8. Click "Choose File" and select `database.sql` from the project folder
9. Click "Go" to import

### 4. Configure Database Connection
1. Open `config.php` in a text editor
2. Verify these settings match your setup:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');          // Change if different
define('DB_PASS', '');              // Add password if you set one
define('DB_NAME', 'online_bookstore');
```
3. Update `BASE_URL` if needed:
```php
define('BASE_URL', 'http://localhost/online-bookstore/');
```

### 5. Create Upload Directory
1. Create a folder named `uploads` in the project root directory
2. On Windows: Right-click folder → Properties → Security → Edit → Add write permissions
3. On Linux: Run `chmod 777 uploads`

### 6. Access the Application
Open your browser and navigate to:
- **Homepage**: `http://localhost/online-bookstore/`
- **Admin Panel**: `http://localhost/online-bookstore/admin/login.php`
- **Student Login**: `http://localhost/online-bookstore/student/login.php`

### 7. Default Login Credentials

#### Admin Access
- **URL**: http://localhost/online-bookstore/admin/login.php
- **Username**: `admin`
- **Password**: `admin123`

#### Student/Customer
- Register a new account at: http://localhost/online-bookstore/student/register.php

### 8. Test the Application

#### As Admin:
1. Login to admin panel
2. Go to "Manage Products"
3. Add a new book with details and image
4. Go to "Manage Orders" to see order management

#### As Student:
1. Register a new account
2. Browse books on homepage
3. Add books to cart
4. Add shipping address
5. Place an order
6. View order status in "My Orders"

### 9. Troubleshooting

#### Database Connection Error
- Check if MySQL is running in XAMPP
- Verify database credentials in `config.php`
- Ensure database `online_bookstore` exists

#### Images Not Showing
- Check if `uploads` folder exists
- Verify folder has write permissions
- Check image paths in database

#### Page Not Found (404)
- Verify BASE_URL in `config.php` matches your setup
- Check if .htaccess file exists (if using Apache)
- Ensure all files are in correct directory

#### Session Errors
- Check if `session_start()` is called in `config.php`
- Verify PHP session directory has write permissions

### 10. Sample Data
The database includes:
- 1 Admin account
- 8 Sample categories
- 24 Sample subcategories
- 8 Sample books

You can add more books through the admin panel.

### 11. Security Recommendations

For Production Use:
1. Change admin password immediately
2. Update database credentials
3. Enable HTTPS
4. Set proper file permissions
5. Update `BASE_URL` to your domain
6. Enable error logging (disable display_errors)

### 12. File Structure Verification

Ensure you have these files:
```
online-bookstore/
├── admin/
│   ├── dashboard.php
│   ├── login.php
│   ├── logout.php
│   ├── manage_orders.php
│   └── manage_products.php
├── includes/
│   ├── footer.php
│   └── header.php
├── student/
│   ├── cart.php
│   ├── checkout.php
│   ├── dashboard.php
│   ├── login.php
│   ├── logout.php
│   ├── manage_address.php
│   ├── my_orders.php
│   └── register.php
├── uploads/          (create this)
├── add_to_cart.php
├── book_details.php
├── config.php
├── database.sql
├── index.php
├── README.md
└── style.css
```

### 13. Next Steps
1. Customize the design in `style.css`
2. Add more books through admin panel
3. Test all features thoroughly
4. Configure email notifications (optional)
5. Set up payment gateway (optional)

### Need Help?
- Check README.md for feature documentation
- Review database.sql for schema details
- Contact: ephremyechale21@gmail.com
- Phone: +251 987 112 092

---

**Installation Complete! Happy Selling! 📚**
