# Native PHP Blog

A full-stack blog project built with Native PHP and MySQL, developed as a portfolio project to practice backend development, database design, authentication, CRUD operations, and user authorization.

## Features

* User registration and login
* Admin and user authentication
* Session and cookie-based authentication
* Token-based login system with expiration
* Create, view, update, and delete posts
* User ownership authorization
* Admin post management
* Image upload and replacement
* Pagination
* Arabic / English language switching
* Custom 404 handling with `.htaccess`
* MySQL Triggers
* MySQL Stored Procedures
* MySQL Event Scheduler
* Posts audit table
* Responsive UI

## Technologies

* Native PHP
* MySQL
* HTML
* CSS
* Bootstrap
* JavaScript
* SweetAlert2
* Apache / XAMPP

## Project Structure

```text
native-php-blog/
├── assets/
├── backimage/
├── db/
│   └── blog.sql
├── errors/
├── handle/
├── inc/
├── uploads/
├── vendor/
├── addPost.php
├── editPost.php
├── Home.php
├── homeadmin.php
├── index.php
├── myposts.php
├── register.php
├── viewPost.php
├── viewadmin.php
└── .htaccess
```

## Database

The project uses MySQL and includes:

* `users`
* `admins`
* `posts`
* `posts_audit`
* `tokens`
* `counter`

It also includes:

* Triggers for post auditing and counter updates
* Stored Procedures for post counter operations
* Scheduled Event for deleting expired tokens

The complete database dump is available in:

```text
db/blog.sql
```

## Demo Admin Accounts

Use the following demo accounts to test the admin features:

### Admin 1

Email:

```text
admin1@gmail.com
```

Password:

```text
6549852374
```

### Admin 2

Email:

```text
admin2@gmail.com
```

Password:

```text
3652125487
```

## Local Setup

1. Install XAMPP.
2. Put the project inside the Apache `htdocs` directory.
3. Create/import the database using:

```text
db/blog.sql
```

4. Configure the database connection in:

```text
inc/conn.php
```

5. Make sure Apache and MySQL are running.
6. Open the project through localhost.

## Authentication

The project uses:

* PHP Sessions
* Cookies
* Database tokens
* Password hashing with `password_hash()`
* Password verification with `password_verify()`

Users and admins have separate access permissions.

## Notes

This project was built as a learning and portfolio project using Native PHP and MySQL, with the goal of practicing backend development and database concepts.

## Author

Omar Mousad
