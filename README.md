# 🧾 Laravel API-Based Service Booking System

A simple RESTful API-based booking system built with Laravel.

## 🔧 Tech Stack

- Laravel 12
- Laravel Sanctum (API auth)
- MySQL
- L5-Swagger (API docs)

---

## 🔐 Authentication

- Register: `POST /api/register`
- Login: `POST /api/login`
- Token required for all authenticated routes (`Authorization: Bearer {token}`)

---

## 📦 Services

| Method | Endpoint                | Auth Required | Admin Only |
|--------|-------------------------|---------------|------------|
| GET    | `/api/services`         | ✅             | ❌          |
| POST   | `/api/services`         | ✅             | ✅          |
| PUT    | `/api/services/{id}`    | ✅             | ✅          |
| DELETE | `/api/services/{id}`    | ✅             | ✅          |

---

## 📅 Bookings

| Method | Endpoint                    | Auth Required | Admin Only |
|--------|-----------------------------|---------------|------------|
| GET    | `/api/bookings`            | ✅             | ❌          |
| POST   | `/api/bookings`            | ✅             | ❌          |
| GET    | `/api/admin/bookings`      | ✅             | ✅          |

---

## 🔗 Postman Collection

- You can create and test the endpoints manually in Postman.
- Export collection and import using the v2.1 format.

---

## 📘 Swagger Docs

- Visit: `http://localhost:8000/api/documentation`
- Auto-generated via `php artisan l5-swagger:generate`

---

## 🛠 Setup Instructions

```bash
git clone https://github.com/your-repo/service-booking-api.git
cd service-booking-api

composer install
cp .env.example .env
php artisan key:generate

# Configure DB in .env
php artisan migrate --seed

php artisan serve
