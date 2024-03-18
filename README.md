<div style="text-align: center; background-color: white">
    <img src="./assets/images/logo.png" alt="Magic Print Logo" width="400">
</div>

## Magic Print E-Commerce Application

Welcome to Magic Print, your one-stop destination for all your sublimation, vinyl, and printing-related needs. This README provides an overview of the application structure, features, and how to set it up.

### Table of Contents
1. [Introduction](#introduction)
2. [Features](#features)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Customization](#customization)
6. [Developer](#developer)

### Introduction
Magic Print is an e-commerce application built using Laravel framework. It provides a seamless platform for users to explore and purchase various printing-related products. The application consists of both a backend control panel and a frontend interface.

You can check out live demos here:
- **Backend Control Panel:** [Live Demo](#) (username: admin, password: admin123)
- **Frontend Interface:** [Live Demo](#)

### Features
- **Backend Control Panel:**
  - User Management
  - Category and Subcategory Management
  - Brand Management
  - Color and Size Management
  - Product Management
  - Discount Code Management
  - Store Information Management
  - Shipping Information Management

- **Frontend Interface:**
  - Homepage Display
  - Product Category Menu
  - Product Listing with Search Filters
  - Shopping Cart

### Installation
To install Magic Print on your local machine using XAMPP, follow these steps:

1. Clone this repository into your XAMPP's `htdocs` directory. Open a terminal and navigate to your XAMPP installation directory.
   ```bash
   cd /path/to/xampp/htdocs
   git clone https://github.com/printshop.git

2. Start your XAMPP control panel and ensure that Apache and MySQL services are running.

3. Navigate to the project directory.
    ```bash
    cd printshop

4. Install dependencies via Composer.
    ```bash
    composer install

5. Create a copy of the .env.example file and rename it to .env.
    ```bash
    cp .env.example .env

6. Generate an application key.
    ```bash
    php artisan key:generate

7. Configure your database settings in the `.env` file. Replace the following placeholders with your actual database credentials:

   ```plaintext
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password

8. Run database migrations and seed the database.
    ```bash
    php artisan migrate --seed

### Usage
  - **Backend Control Panel:**

    - Access the backend control panel by visiting http://localhost/printshop/admin.
    - Login using your credentials.
    - Manage users, categories, brands, products, discounts, and store/shipping information.

  - **Frontend Interface:**

    - Explore product categories and listings.
    - Utilize search filters to find specific products.
    - Add products to the shopping cart and proceed to checkout.

### Customization
This ecommerce app is designed to be easily configurable for other businesses. You can adapt and customize it according to your specific requirements and branding needs.

### Developer
Ecommerce was developed by Roberto Gauna.