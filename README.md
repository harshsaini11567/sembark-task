# 🚀 URL Shortener SaaS (Laravel)

## 📌 Project Overview
This is a multi-tenant URL Shortener SaaS built using Laravel.  
It supports multiple companies with role-based access control.

---

## ⚙️ Features
- Multi-company architecture
- Role-based system:
  - SuperAdmin
  - Admin
  - Member
- URL shortening system
- Public URL redirection
- Company-level data isolation

---

## 🛠 Tech Stack
- Laravel 12
- MySQL
- Spatie Laravel Permission
- Blade Templates

---

## 👤 Roles & Permissions

### SuperAdmin
- Cannot create URLs
- Can view all URLs

### Admin
- Can create URLs
- Can view only their company URLs

### Member
- Can create URLs
- Can view only their own URLs

---

## ⚙️ Installation Steps

```bash
git clone https://github.com/YOUR_USERNAME/url-shortener.git
cd url-shortener
composer install
npm install
cp .env.example .env
php artisan key:generate
