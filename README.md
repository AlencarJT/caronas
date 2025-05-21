# Carona – Ride Sharing Management System

**Carona** is a ride sharing management system built with Laravel, Filament, and PostgreSQL. It includes an API for external integration and is based on a real-world routine.

---

## 🚗 Motivation

Every day I travel between Marau and Passo Fundo, a 35km route. To reduce costs and contribute to the environment, I started offering rides to others.

Until recently, all the ride management was done through an Excel spreadsheet. This caused multiple issues:

- Lack of organization and version control
- No guarantee that the number of available seats wouldn’t be exceeded
- Passengers had to manually contact me to check for availability

---

## 💡 Solution

This system was created to solve those problems. It allows users to register passengers and rides, and to link them in a traceable and organized way.

### Features:
- Each ride has a defined number of seats
- Once all seats are filled, the ride is no longer available
- CRUD operations via [Filament](https://filamentphp.com/) admin panel
- RESTful API for integration and external access (📄 Documentation is coming soon. Stay tuned!)

---

## 🔭 Next Steps

I’m currently planning a user-facing interface with authentication and other advanced features.

For now, the system is fully manageable via the admin panel and API.

---

## 🛠️ Tech Stack

- PHP (Laravel)
- PostgreSQL
- Filament Admin
- RESTful API (JSON)

---

## 📁 Project Structure

```bash
app/
├── Models/         # Eloquent models
├── Http/
│   ├── Controllers/    # API and panel controllers
│   └── Requests/       # Validation logic
routes/
├── api.php            # API routes
└── web.php            # Web/admin routes

📦 Installation
git clone git@github.com:AlencarJT/caronas.git
cd caronas
composer install
cp .env.example .env
php artisan key:generate
# Set up your .env database settings
php artisan migrate


📮 API (in progress)
You can interact with available endpoints for car rides and users.
More details soon...


Author
Alencar JT
Dev PHP/Laravel | PostgreSQL | JavaScript
