# 📝 Task Management App – Laravel 12

---

## 🚀 Features

- ✅ User authentication (Laravel Breeze)
- ✅ Task CRUD (Create, Read, Update, Delete)
- ✅ Validation using Form Requests
- ✅ Soft deletes with audit logging
- ✅ Task status toggling (Pending ↔ Completed)
- ✅ AJAX for status toggle & delete
- ✅ Pagination with Laravel’s built-in styling
- ✅ Responsive UI with Tailwind CSS
- ✅ Clean, reusable Blade components
- ✅ CSRF protection for all actions

---

## 🛠 Tech Stack

- Laravel 12
- Laravel Breeze (Auth scaffolding)
- Tailwind CSS (Utility-first styling)
- MySQL
- Eloquent ORM
- Blade templating
- AJAX
- PHP 8.2.12

---

## ⚙️ Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/devkavin/task-manager.git
cd task-manager
```

### 2. Install Dependencies
```bash
composer install
npm install
npm run build
```

### 3. Create .env File
```bash
cp .env.example .env

Update your .env file with the database credentials:

DB_CONNECTION=mysql
DB_DATABASE=task-manager-db
```

### 4. Generate App Key
```bash
php artisan key:generate
```

### 5. Run Migrations & Seeders
```bash
php artisan migrate:fresh --seed
```

### 6. Start the Server
```bash
php artisan serve

Visit: http://localhost:8000
```

### 7. Logging in
```bash
For testing purposes, login using the test credentials on the Login Page
```

---

## 📂 Folder Structure Highlights

- app/Http/Controllers/TaskController.php – Task controller
- app/Http/Requests/TaskRequest.php –  Request validation
- resources/views/components/ – Reusable Blade components
- app/Policies/TaskPolicy.php – Authorizing access to tasks
- resources/views/tasks/ – Views

---

## 📋 Notes
- CSRF protection is handled via meta tag and fetch headers.
- Only the authenticated user can manage their own tasks.
- "Mark Complete"/"Mark Pending" toggle is via AJAX.
- All deletes are soft deletes.
