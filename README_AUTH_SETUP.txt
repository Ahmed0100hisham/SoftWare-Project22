Authentication/Admin Setup
==========================

1) Create the database by importing database.sql in phpMyAdmin or MySQL.

2) Update database settings in:
   config/db.php

Default values:
   Database: car_rental_auth
   User: root
   Password: empty

3) Run the project using a PHP server, for example XAMPP/WAMP/MAMP.

4) Default admin account:
   Username: admin
   Email: admin@example.com
   Password: Admin@123

Files added:
   config/db.php
   includes/auth.php
   register.php
   login.php
   logout.php
   admin/dashboard.php
   admin/delete_user.php
   database.sql

Existing frontend pages were not redesigned. Only Login/Register navbar links were added.
