# Ethiopia BookStore - Admin Guide

## 🔐 Admin Login

### Access Admin Panel
- **URL**: http://localhost/online_bookstore/admin/login.php
- **Username**: `admin` (lowercase - case sensitive!)
- **Password**: `admin123`

### Important Notes:
- Username is case-sensitive: use `admin` not `Admin`
- If login fails, run: http://localhost/online_bookstore/fix_admin_login.php

---

## 📊 Dashboard Features

### Main Statistics
The dashboard displays comprehensive statistics:

1. **Total Books** - Number of books in inventory
   - Shows low stock alert if any books have less than 10 units

2. **Total Customers** - Number of registered students/customers

3. **Total Orders** - All orders placed

4. **Total Revenue** - Sum of all completed orders (excluding cancelled)

5. **Pending Orders** - Orders waiting to be processed

6. **Categories** - Number of book categories

### Today's Performance
- Today's Orders
- Today's Revenue
- This Month's Orders
- This Month's Revenue

### Order Status Overview
Quick view of orders by status:
- **Pending** - New orders waiting to be processed
- **Processing** - Orders being prepared
- **Shipped** - Orders in transit
- **Delivered** - Completed orders

### Low Stock Alert
- Automatically shows books with less than 10 units in stock
- Red highlight for easy identification
- Quick link to update stock

### Top Selling Books
- Shows top 5 best-selling books
- Displays units sold and revenue generated
- Ranked by popularity

---

## 📚 Manage Products

### Add New Book
1. Click "Manage Products" from dashboard
2. Fill in the form on the left:
   - **Title** * (required)
   - **Author** * (required)
   - **ISBN** (optional)
   - **Category** * (required)
   - **Price** * (required)
   - **Stock Quantity** * (required)
   - **Publisher** (optional)
   - **Language** (default: English)
   - **Description** (optional)
   - **Book Cover Image** (optional)
3. Click "Add Book"

### Edit Existing Book
1. Find the book in the list
2. Click the blue **Edit** button (pencil icon)
3. Form will populate with current data
4. Make changes
5. Click "Update Book"
6. Or click "Cancel" to discard changes

### Delete Book
1. Find the book in the list
2. Click the red **Delete** button (trash icon)
3. Confirm deletion
4. Book will be permanently removed

### Stock Management
- Books with less than 10 units show red badge
- Update stock quantity by editing the book
- Low stock books appear in dashboard alert

---

## 📦 Manage Orders

### View All Orders
- Orders displayed in reverse chronological order (newest first)
- Each order shows:
  - Order number
  - Customer name and email
  - Order date
  - Delivery location
  - Order status
  - Total amount
  - List of items ordered

### Update Order Status
For each order, you can update:

1. **Order Status**:
   - Pending - Initial status
   - Processing - Order is being prepared
   - Shipped - Order has been dispatched
   - Delivered - Order received by customer
   - Cancelled - Order cancelled

2. **Tracking Number**:
   - Enter courier tracking number
   - Customer can use this to track shipment

3. **Shipping Status/Location**:
   - Current location of package
   - Examples: "Out for delivery", "At sorting facility", etc.

4. **Notes**:
   - Add internal notes about the order
   - Saved in order history

### Order Timeline
- System automatically records:
  - Order date
  - Shipped date (when status changed to "shipped")
  - Delivered date (when status changed to "delivered")

---

## 🏷️ Manage Categories

### Add Category
1. Click "Manage Categories" from dashboard
2. Fill in category form:
   - Category Name (required)
   - Description (optional)
3. Click "Add Category"

### Add Subcategory
1. Select parent category from dropdown
2. Enter subcategory name
3. Click "Add Subcategory"

### Delete Category
- Click red delete button next to category
- Warning: This will delete all subcategories too
- Books in this category will need to be reassigned

### Delete Subcategory
- Click X button next to subcategory name
- Books in this subcategory will need to be reassigned

### Current Categories
- Fiction (Novels and story books)
- Non-Fiction (Real life stories and biographies)
- Science (Scientific books and research)
- Technology (Computer science and technology books)
- Business (Business and management books)
- Self-Help (Personal development books)
- Academic (Educational and textbooks)
- Children (Books for children)

---

## 👥 View Customers

### Customer Information
View all registered customers with:
- Customer ID
- Full Name
- Email Address
- Phone Number
- Number of Orders
- Total Amount Spent
- Registration Date

### Delete Customer
- Click red delete button
- Warning: This will delete all customer data including orders
- Use with caution

---

## 🔧 Admin Management Tips

### Best Practices

1. **Order Processing**:
   - Check pending orders daily
   - Update order status promptly
   - Add tracking numbers when shipping
   - Keep customers informed via status updates

2. **Inventory Management**:
   - Monitor low stock alerts
   - Restock popular books
   - Remove out-of-stock books or mark as inactive
   - Update prices as needed

3. **Product Management**:
   - Use clear, descriptive titles
   - Add detailed descriptions
   - Upload high-quality book cover images
   - Keep ISBN numbers accurate
   - Categorize books correctly

4. **Customer Service**:
   - Review customer orders regularly
   - Handle cancellations promptly
   - Monitor customer spending patterns
   - Identify top customers

5. **Data Analysis**:
   - Check top-selling books
   - Monitor revenue trends
   - Track order status distribution
   - Analyze daily/monthly performance

---

## 🚨 Common Issues & Solutions

### Issue: Can't Login
**Solution**: 
- Verify username is lowercase: `admin`
- Run fix_admin_login.php to reset password
- Clear browser cache and cookies

### Issue: Can't Upload Images
**Solution**:
- Check uploads folder exists
- Verify folder permissions (should be writable)
- Check file size (max 2MB recommended)
- Use supported formats: JPG, PNG, GIF

### Issue: Orders Not Showing
**Solution**:
- Verify customers have placed orders
- Check database connection
- Run test_database.php to verify data

### Issue: Low Stock Not Showing
**Solution**:
- Update stock quantities in Manage Products
- Refresh dashboard
- Check if books exist in database

### Issue: Categories Not Loading
**Solution**:
- Run setup.php to recreate database
- Verify categories table has data
- Check database connection

---

## 📱 Mobile Access

The admin panel is fully responsive and works on:
- Desktop computers
- Tablets
- Mobile phones

Access from any device with a web browser.

---

## 🔒 Security Tips

1. **Change Default Password**:
   - Login to admin panel
   - Change password from default `admin123`
   - Use strong password with letters, numbers, symbols

2. **Logout When Done**:
   - Always click "Logout" when finished
   - Don't leave admin panel open on shared computers

3. **Regular Backups**:
   - Backup database regularly
   - Export important data
   - Keep backup copies safe

4. **Access Control**:
   - Don't share admin credentials
   - Use secure connection (HTTPS in production)
   - Monitor admin activity

---

## 📞 Support

### Quick Links
- **Test Admin Functionality**: http://localhost/online_bookstore/test_admin_functionality.php
- **Fix Admin Login**: http://localhost/online_bookstore/fix_admin_login.php
- **Test Database**: http://localhost/online_bookstore/test_database.php
- **Setup Database**: http://localhost/online_bookstore/setup.php

### Documentation
- `README.md` - Project overview
- `INSTALLATION.md` - Setup instructions
- `TROUBLESHOOTING.md` - Common issues
- `PROJECT_STATUS.md` - Current status

---

## ✅ Admin Checklist

### Daily Tasks
- [ ] Check pending orders
- [ ] Update order statuses
- [ ] Review low stock alerts
- [ ] Respond to customer issues

### Weekly Tasks
- [ ] Review sales performance
- [ ] Update inventory
- [ ] Check top-selling books
- [ ] Add new books if needed

### Monthly Tasks
- [ ] Analyze revenue trends
- [ ] Review customer data
- [ ] Update categories if needed
- [ ] Backup database
- [ ] Review and update prices

---

**Last Updated**: February 10, 2026
**Version**: 1.0
**Status**: ✅ All Features Working
