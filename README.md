# SaaS Subscription API (Laravel)

A backend API for managing subscription-based SaaS applications with authentication, plan management, expiry handling, and access control.

---

## 🚀 Features

* User Authentication (Laravel Sanctum)
* Subscription Management
* Prevent duplicate active subscriptions
* Plan Upgrade / Downgrade
* Subscription Expiry Handling
* Cancel Subscription (with access until expiry)
* Premium Feature Access Control
* Invoice Generation

---

## 🛠 Tech Stack

* PHP (Laravel)
* MySQL
* Laravel Sanctum (API Auth)

---

## 📌 API Endpoints

### Auth

* POST /api/register
* POST /api/login

### Subscription

* POST /api/subscriptions
* GET /api/subscriptions
* PATCH /api/subscriptions/{id}
* POST /api/subscriptions/{id}/cancel

### Access

* GET /api/premium

---

## ⚙️ Setup Instructions

1. Clone the repository
2. Install dependencies:
   composer install
3. Create .env file and configure database
4. Run migrations:
   php artisan migrate --seed
5. Start server:
   php artisan serve

---

## 🔐 Authentication

Use Bearer Token in headers:

Authorization: Bearer YOUR_TOKEN

---

## 🧠 Key Concepts Implemented

* UUID-based primary keys
* Subscription lifecycle management
* Expiry-based access control
* RESTful API design

---

## 📈 Future Improvements

* Payment gateway integration
* Subscription renewal system
* Email notifications

---

## 👨‍💻 Author

Silpa P
