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

* PHP (Native PHP)
* MySQL
* HTML
* CSS
* Bootstrap
* JavaScript
* SweetAlert2
* Apache / XAMPP

## Project Structure

```text
blog/
├── assets/
├── backimage/
├── database/
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

It also contains:

* Triggers for post auditing and counter updates
* Stored Procedures for post counter operations
* Scheduled Event for deleting expired tokens

The complete database dump is available in:

```text
database/blog_project.sql
```

## Local Setup

1. Install XAMPP.
2. Put the project inside the Apache `htdocs` directory.
3. Create/import the database using:

```text
database/blog_project.sql
```

4. Configure the local database connection in:

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
