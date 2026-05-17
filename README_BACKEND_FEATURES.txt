Car Rental Backend Features Added
=================================

This version preserves the existing HTML/CSS/Bootstrap design and adds backend functionality only.

Main files added:
- shop.php: Dynamic cars page with search/filter and Rent Now buttons.
- book.php: Booking form with pickup/return dates and automatic price calculation.
- my_bookings.php: User booking history.
- contact_submit.php: Saves contact form messages to the database.
- admin/cars.php: Admin car CRUD listing with search/filter.
- admin/car_form.php: Add/edit cars and upload car images.
- admin/delete_car.php: Delete cars.
- admin/bookings.php: View/search/filter bookings and update booking status.
- admin/update_booking.php: Booking status update handler.
- admin/users.php: Manage registered users.
- admin/messages.php: View contact form messages.
- admin/_admin_nav.php: Shared admin navigation using existing Bootstrap styling.
- uploads/cars/: Uploaded car images folder.

Files safely modified:
- database.sql: Added cars, bookings, admins, and contact_messages tables plus sample cars.
- includes/auth.php: Added reusable escaping/redirect/login helpers.
- contact.html: Only the form action/method/input names were added so messages can be saved.
- Existing nav links to Shop now point to shop.php so the functional cars page is used.

Database setup:
1. Create/import database.sql in phpMyAdmin or MySQL.
2. Check config/db.php and update database username/password if needed.
3. Open the site through a PHP server, for example XAMPP Apache.

Default admin:
- Username: admin
- Email: admin@example.com
- Password: Admin@123

Notes:
- No payment gateway was added.
- Passwords use password_hash/password_verify.
- Database queries use PDO prepared statements.
- Admin pages are protected by session role authorization.
