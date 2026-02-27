# 📦 How to Place an Order - Complete Guide

## Why "My Orders" is Empty?

**"My Orders"** only shows orders that have been **placed and confirmed**. If you haven't completed the checkout process, no orders will appear.

---

## 🛒 Complete Order Process (Step-by-Step):

### Step 1: Register/Login ✅
```
http://localhost/online_bookstore/student/register.php
```
- Create account with email and password
- Or login if you already have an account

### Step 2: Browse Books 📚
```
http://localhost/online_bookstore/index.php
```
- View available books
- Click on any book to see details

### Step 3: Add to Cart 🛒
- Click "Add to Cart" button on any book
- Book is added to your shopping cart
- Cart icon shows number of items

### Step 4: View Cart 👀
```
http://localhost/online_bookstore/student/cart.php
```
- See all items in cart
- Update quantities if needed
- See total price
- Click "Proceed to Checkout"

### Step 5: Add Shipping Address 📍
```
http://localhost/online_bookstore/student/manage_address.php
```
**IMPORTANT: You MUST add a shipping address first!**

Fill in:
- Full Name
- Phone Number
- Address Line 1
- City
- State
- ZIP Code
- Check "Set as default address"
- Click "Add Address"

### Step 6: Checkout 💳
```
http://localhost/online_bookstore/student/checkout.php
```
- Select your shipping address (radio button)
- Select payment method: Cash on Delivery (COD)
- Review order summary
- Click "Place Order"

### Step 7: Order Confirmation ✅
- You'll see "Order placed successfully!"
- Order number will be displayed
- Cart will be cleared
- Redirected to "My Orders"

### Step 8: View Orders 📦
```
http://localhost/online_bookstore/student/my_orders.php
```
Now you'll see:
- Order number
- Order date
- Order status (Pending)
- Total amount
- Books ordered
- Shipping address
- Order timeline

---

## 🎯 Quick Test Order:

### 1. Make sure database is set up:
```
http://localhost/online_bookstore/setup.php
```

### 2. Add Ethiopian books:
```
http://localhost/online_bookstore/add_ethiopian_books.php
```

### 3. Register new student:
```
http://localhost/online_bookstore/student/register.php

Example:
- Name: Test Student
- Email: test@example.com
- Password: test123
```

### 4. Login:
```
http://localhost/online_bookstore/student/login.php
```

### 5. Add book to cart:
- Go to homepage
- Click "Add to Cart" on any book
- Go to "My Shopping Cart"

### 6. Add shipping address:
```
http://localhost/online_bookstore/student/manage_address.php

Example:
- Full Name: Test Student
- Phone: +251 987 112 092
- Address: Bole Road
- City: Addis Ababa
- State: Addis Ababa
- ZIP: 1000
- Check "Set as default"
```

### 7. Complete checkout:
- Go to cart
- Click "Proceed to Checkout"
- Select address
- Select COD payment
- Click "Place Order"

### 8. View your order:
```
http://localhost/online_bookstore/student/my_orders.php
```

---

## 🔍 Troubleshooting:

### Problem: "My Orders" is empty
**Solution:** You haven't placed any orders yet. Follow steps above.

### Problem: Can't add to cart
**Solution:** Make sure you're logged in first.

### Problem: Can't checkout
**Solution:** Add a shipping address first at `manage_address.php`

### Problem: "No shipping address found"
**Solution:** Go to "Manage Addresses" and add at least one address.

### Problem: Order not showing after checkout
**Solution:** 
1. Check if you saw "Order placed successfully" message
2. Refresh "My Orders" page
3. Check database: `test_database.php`

---

## 📊 What Each Page Does:

### Shopping Cart (`cart.php`)
- Shows items you want to buy
- NOT yet ordered
- Can update or remove items
- Shows total price
- **Action:** Proceed to Checkout

### Checkout (`checkout.php`)
- Select shipping address
- Select payment method
- Review order
- **Action:** Place Order (confirms purchase)

### My Orders (`my_orders.php`)
- Shows COMPLETED orders
- Order tracking
- Shipping status
- Order history
- **Cannot modify** (already placed)

---

## 💡 Key Differences:

| Feature | Shopping Cart | My Orders |
|---------|--------------|-----------|
| Status | Not ordered yet | Order placed |
| Can modify | ✅ Yes | ❌ No |
| Payment | Not paid | Will pay on delivery |
| Tracking | No tracking | Has tracking |
| Admin sees | ❌ No | ✅ Yes |

---

## 🎓 For Testing:

### Create Test Order:
```bash
1. Register: test@example.com / test123
2. Add 2-3 books to cart
3. Add shipping address
4. Complete checkout
5. Check "My Orders" - order appears!
6. Login as admin to see the order
```

### Admin Can See Orders:
```
http://localhost/online_bookstore/admin/login.php
Username: admin
Password: admin123

Go to: Manage Orders
- See all student orders
- Update order status
- Add tracking number
```

---

## ✅ Summary:

**"My Orders" shows orders AFTER you:**
1. ✅ Add items to cart
2. ✅ Add shipping address
3. ✅ Complete checkout
4. ✅ Click "Place Order"

**Until you complete checkout, orders won't appear in "My Orders"!**

---

Need help? Contact: ephremyechale21@gmail.com | +251 987 112 092
