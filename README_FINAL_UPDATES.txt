Final backend updates added without redesigning the website.

Added / Improved:
1. User account page: profile.php
   - View account information
   - Edit username/email
   - See recent booking history

2. User password features:
   - change_password.php for logged-in users
   - forgot_password.php
   - reset_password.php with secure token hash stored in database

3. User booking management:
   - my_bookings.php now supports cancel booking
   - edit_booking.php supports editing dates and user note
   - Unauthorized edits are blocked by user_id checks
   - Booking conflicts are checked before updates

4. Dynamic logged-in state:
   - includes/site_nav.php added
   - index.php and contact.php created from the existing HTML pages with the same design
   - Navbar shows Login/Register when logged out and Account/Logout when logged in

5. Admin messages management:
   - Mark messages as read
   - Delete messages
   - Save admin reply notes
   - Search/filter messages

6. Admin booking improvements:
   - Admin notes
   - Status change reason
   - Link to customer details
   - admin/user_details.php added

7. Security improvements:
   - CSRF tokens added to important POST forms
   - POST-only delete/update actions
   - Session cookie protection in includes/auth.php
   - PDO prepared statements kept throughout the project
   - password_hash/password_verify kept for authentication

Database:
Import database.sql for a fresh database.
For an existing database, run the ALTER TABLE statements at the bottom of database.sql if your MySQL/MariaDB version supports ADD COLUMN IF NOT EXISTS.

Default admin remains:
Email/Username: admin@example.com / admin
Password: Admin@123

Important:
The original .html pages are kept. Use index.php and contact.php for dynamic login-aware navbar behavior.
