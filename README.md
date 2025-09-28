# Moon Style 👗🛒

Moon Style is a **university project** built with **Laravel** and **Blade**.  
It is a clothing store platform where different fashion shops can register, manage their products, and sell to customers.  

---

## 🚀 Features

- **Landing Page** with:
  - Categories: Men, Women, Kids
  - Featured Products section
  - Stores showcase (each store has its own product page)
- **Multi-store Platform**:
  - Shops can register and get a panel to manage their products
  - Customers can browse and purchase items from different stores
- **Admin Panel**:
  - Manage users, shops, and products
- **Seller Panel**:
  - Add and update products
  - Manage store details
- **Authentication system** for users, sellers, and admins

---

## 🖼️ Screenshots

Here are some screenshots of the landing page:

### Hero Section
![Hero Section](public/image/hero-section.png)

### Featured Products
![Products](public/image/products.png)

### Stores Showcase
![Stores](public/image/stores.png)

---

## ⚙️ Installation & Setup

Follow these steps to run the project locally:

## ⚙️ Installation & Setup

Follow these steps to run the project locally:

### 1. Clone the repository
```bash
git clone https://github.com/mmk4-81/My_Shop.git
cd My_Shop

2. Install PHP dependencies
composer install

3. Create environment file
cp .env.example .env

4. Generate application key
php artisan key:generate

5. Configure database
Edit the .env file with your database credentials (MySQL or any supported DB).

6. Run migrations
php artisan migrate

7. Start the development server
php artisan serve
