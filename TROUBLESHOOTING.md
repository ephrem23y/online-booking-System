# Troubleshooting Guide - Ethiopia BookStore

## Common Issues and Solutions

### Issue 1: "My Orders" Page Shows No Orders

**Possible Causes:**
1. Database not set up properly
2. Orders table is empty
3. Student not logged in
4. Order placement failed

**Solutions:**

#### Step 1: Verify Database Setup
1. Open: `http://localhost/online_bookstore/test_database.php`
2. Check if all tables exist
3. Verify student account exists
4. Check if books are available

#### Step 2: Test Order Placement
1. **Login as Student**
   - Go to: `http://localhost/online_bookstore/student/login.php`
   - If no account, register first

2. **Add Books to Cart**
   - Browse books on homepage
   - Click "Add to Cart" on any book
   - Verify cart shows items

3. **Add Shipping Address**
   - Go to: `http://localhost/online_bookstore/student/manage_address.php`
   - Add at least one shipping address
   - Set it as default

4. **Place Order**
   - Go to cart: `http://localhost/online_bookstore/student/cart.php`
   - Click "Proceed to Checkout"
   - Select shipping address
   - Select payment method (COD)
   - Click "Place Order"

5. **View Orders**
   - Go to: `http://localhost/online_bookstore/student/my_orders.php`
   - Orders should appear here

---

### Issue 2: Registration Not Working

**Error Messages:**
- "Email already registered"
- "Registration failed"
- "All fields are required"

**Solutions:**

1. **Check Database Connection**
   ```
   Open: http://localhost/online_bookstore/test_database.php
   ```

2. **Verify Email is Unique**
   - Use a different email address
   - Check if email already exists in database

3. **Password Requirements**
   - Minimum 6 characters
   - Both password fields must match

4. **Required Fields**
   - Full Name (required)
   - Email (required)
   - Password (required)
   - Phone (optional)

---

### Issue 3: Cannot Add Books to Cart

**Possible Causes:**
- Not logged in
- Book out of stock
- Database error

**Solutions:**

1. **Login First**
   - You must be logged in to add books to cart
   - Go to: `http://localhost/online_bookstore/student/login.php`

2. **Check Book Stock**
   - Admin can check stock in: `admin/manage_products.php`
   - Books with 0 stock cannot be added

3. **Clear Browser Cache**
   - Press Ctrl+Shift+Delete
   - Clear cookies and cache
   - Refresh page

---

### Issue 4: Admin Cannot Login

**Default Credentials:**
- **Username:** admin
- **Password:** admin123

**Solutions:**

1. **Verify Admin Account Exists**
   ```
   Open: http://localhost/online_bookstore/test_database.php
   Check "Admin Accounts" section
   ```

2. **Reset Admin Password (via phpMyAdmin)**
   - Open: http://localhost/phpmyadmin
   - Select database: `online_bookstore`
   - Click table: `admin`
   - Find admin user
   - Edit password field
   - Use this hash for "admin123":
     ```
     $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
     ```

3. **Create New Admin (via phpMyAdmin)**
   ```sql
   INSERT INTO admin (username, password, email, full_name) 
   VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
           'admin@ethiopiabookstore.com', 'Admin User');
   ```

---

### Issue 5: Books Not Showing on Homepage

**Solutions:**

1. **Add Books via Admin Panel**
   - Login to admin: `http://localhost/online_bookstore/admin/login.php`
   - Go to "Manage Products"
   - Add new books with details

2. **Check Book Status**
   - Books must have status = 'active'
   - Check in phpMyAdmin: `books` table

3. **Verify Categories Exist**
   - Categories must be created first
   - Check in phpMyAdmin: `categories` table

---

### Issue 6: Images Not Displaying

**Solutions:**

1. **Create Uploads Folder**
   ```
   Create folder: C:\xampp\htdocs\online_bookstore\uploads\
   ```

2. **Set Folder Permissions**
   - Right-click folder → Properties → Security
   - Give "Full Control" to Users

3. **Upload Images via Admin**
   - Go to: `admin/manage_products.php`
   - When adding book, select image file
   - Supported formats: JPG, PNG, GIF

---

### Issue 7: "404 Not Found" Error

**Solutions:**

1. **Check Project Location**
   - Must be in: `C:\xampp\htdocs\online_bookstore\`
   - Not in subfolder

2. **Verify Apache is Running**
   - Open XAMPP Control Panel
   - Start Apache
   - Start MySQL

3. **Check BASE_URL in config.php**
   ```php
   define('BASE_URL', 'http://localhost/online_bookstore/');
   ```

4. **Access Correct URL**
   ```
   Correct: http://localhost/online_bookstore/
   Wrong: http://localhost/online_bookstore
   Wrong: http://localhost/
   ```

---

### Issue 8: Database Connection Error

**Error:** "Unknown database 'online_bookstore'"

**Solutions:**

1. **Run Setup Script**
   ```
   http://localhost/online_bookstore/setup.php
   ```

2. **Manual Database Creation**
   - Open: http://localhost/phpmyadmin
   - Click "New"
   - Database name: `online_bookstore`
   - Click "Create"
   - Import `database.sql` file

3. **Check MySQL is Running**
   - Open XAMPP Control Panel
   - MySQL should show "Running"
   - If not, click "Start"

---

### Issue 9: Session Errors

**Error:** "Session could not be started"

**Solutions:**

1. **Check PHP Session Directory**
   - Usually: `C:\xampp\tmp\`
   - Must have write permissions

2. **Clear Session Files**
   - Delete all files in: `C:\xampp\tmp\`
   - Restart Apache

3. **Check config.php**
   - Verify `session_start()` is called
   - Should be at top of file

---

### Issue 10: Order Status Not Updating

**Solutions:**

1. **Admin Must Update Status**
   - Login to admin panel
   - Go to "Manage Orders"
   - Select order
   - Update status and tracking info
   - Click "Update Order"

2. **Check Order Status History**
   - View in phpMyAdmin
   - Table: `order_status_history`
   - Should show status changes

---

## Quick Diagnostic Steps

### 1. Test Database Connection
```
http://localhost/online_bookstore/test_database.php
```

### 2. Verify All Tables Exist
- admin
- students
- categories
- subcategories
- books
- cart
- shipping_addresses
- orders
- order_items
- order_status_history

### 3. Check Sample Data
- At least 1 admin account
- At least 8 categories
- At least 8 books
- Test student account

### 4. Test User Flow
1. Register student account
2. Login
3. Browse books
4. Add to cart
5. Add shipping address
6. Place order
7. View in "My Orders"

---

## Still Having Issues?

### Enable Error Display
Add to top of `config.php`:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### Check Apache Error Log
```
C:\xampp\apache\logs\error.log
```

### Check MySQL Error Log
```
C:\xampp\mysql\data\mysql_error.log
```

### Contact Support
- Email: ephremyechale21@gmail.com
- Phone: +251 987 112 092

---

## Useful Links

- **Homepage:** http://localhost/online_bookstore/
- **Setup:** http://localhost/online_bookstore/setup.php
- **Test Database:** http://localhost/online_bookstore/test_database.php
- **Quick Access:** http://localhost/online_bookstore/START_HERE.html
- **Admin Login:** http://localhost/online_bookstore/admin/login.php
- **Student Register:** http://localhost/online_bookstore/student/register.php
- **phpMyAdmin:** http://localhost/phpmyadmin

---

**Last Updated:** 2024
**Version:** 1.0
