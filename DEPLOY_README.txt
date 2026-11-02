EASYBUY CAMPUSCART — DEPLOYMENT GUIDE
======================================

MAIN ENTRY POINTS
-----------------
Buyer:  /index.php
Seller: /sellerindex.php
Admin:  /adminindex.php
Admin login/setup: /admin-login.php

The buyer and seller pages contain their own inline CSS and JavaScript.
The admin dashboard also contains inline CSS and JavaScript.
The only image asset directory is /images (including seller-uploaded product
images at /images/uploads/products).

REQUIRED SUPPORT FILES
----------------------
Do not remove /api, /admin, /seller, /images, auth.php, database.sql or
.htaccess. These are backend endpoints, shared authentication/configuration,
admin login support, seller recovery/support pages, and persistent assets.
There is one MySQL connection configuration: api-config.php.

DEPLOYMENT
----------
1. Upload the complete contents of this folder to your hosting document root
   (usually public_html). Preserve the directory structure.
2. Create a MySQL database and database user in your hosting control panel.
3. Edit api-config.php and configure EASYBUY_DB_HOST, EASYBUY_DB_NAME,
   EASYBUY_DB_USER and EASYBUY_DB_PASS (or the corresponding PHP variables)
   for your hosting database. Never publish database passwords.
4. Import database.sql into that database using phpMyAdmin. The application
   also performs additive table setup for supported tables.
5. Ensure PHP with PDO MySQL is enabled and the images/ directory is writable
   by PHP if sellers will upload product photos.
6. Visit /index.php, register/login as a buyer, then visit /sellerindex.php
   to register/login as a seller. Visit /admin-login.php for first-time admin
   setup; then use /adminindex.php for the dashboard.

IMPORTANT
---------
- The original database.sql, product catalogue data, image assets, API
  endpoints, and application features are retained.
- Product uploads now live under images/uploads/products. Existing product
  image_path values already stored in MySQL that start with
  "uploads/products/" should be updated once with:
    UPDATE products
    SET image_path = CONCAT('images/', image_path)
    WHERE image_path LIKE 'uploads/products/%';
- Configure real production database credentials before deployment.
- Test buyer/seller authentication, product upload, ordering, admin login,
  and image URLs on the actual hosting account. Live deployment cannot be
  guaranteed until host-specific database credentials and permissions work.
