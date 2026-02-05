# Task Management System

A robust, modern Task Management System built with **Laravel 10**, **Bootstrap 5**, and **jQuery**. This application features a clean UI, real-time validations, background processing for exports, and a comprehensive RESTful API.

## 🚀 Features

-   **Secure Authentication**: Integrated via Laravel Breeze with a custom redesigned split-screen UI.
-   **Project Management**: Full CRUD operations for projects with task count summaries and responsive card layouts.
-   **Task Tracking**: 
    -   Detailed task management with project associations.
    -   File attachments (Images/PDFs) with automatic cleanup on deletion.
    -   Real-time status updates via API.
-   **Advanced Filtering**: AJAX-powered task filtering by Project, Status, and Crew Member.
-   **Data Export**:
    -   **Excel Export**: Immediate download using `maatwebsite/excel`.
    -   **CSV Export**: Background job processing with a live-tracking download list.
-   **Modern UI/UX**:
    -   Split-screen Auth pages with professional illustrations.
    -   SweetAlert2 confirmation prompts for destructive actions.
    -   jQuery validation for immediate form feedback.
-   **RESTful API**: Clean API endpoints for external integrations.

---

## 🛠️ Setup Instructions

### 1. Prerequisites
-   PHP 8.1+
-   Composer
-   MySQL

### 2. Installation
```bash
# Clone the repository
git clone https://github.com/gitsi/Task-Assignment-ll-
cd Task-Assignment-ll-

# Install PHP dependencies
composer install

# Install JS dependencies
npm install && npm run build
```

### 3. Configuration
1.  Copy the environment file:
    ```bash
    cp .env.example .env
    ```
2.  Generate application key:
    ```bash
    php artisan key:generate
    ```
3.  Configure your database in `.env`:
    ```env
    DB_DATABASE=task_management_system
    DB_USERNAME=your_username
    DB_PASSWORD=your_password
    ```

### 4. Database Setup & Seeding
Run migrations and seed the database with sample data:
```bash
php artisan migrate --seed
```
> [!NOTE]
> **Default Test Credentials:**
> - **Email**: `test@example.com`
> - **Password**: `password`

### 5. Finalize Setup
```bash
# Link storage for attachments
php artisan storage:link

# Start the local server
php artisan serve
```

---

## 🏗️ Background Tasks (CSV Export)
To enable the background CSV export feature, you must run the queue worker:
```bash
php artisan queue:work
```

---

## 📖 API Documentation

The system provides a REST API for basic integrations. All responses are in JSON format.

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `GET` | `/api/projects` | List all projects with task counts. |
| `GET` | `/api/tasks` | List all tasks with related data. |
| `GET` | `/api/projects/{id}/tasks` | Get all tasks belonging to a specific project. |
| `PATCH` | `/api/tasks/{id}/status` | Update a task's status (`pending`, `in_progress`, `completed`). |

---

## 🧪 Tech Stack
-   **Backend**: Laravel 10 (Eloquent, API Resources, Service Layer)
-   **Frontend**: Bootstrap 5, jQuery, SweetAlert2
-   **Database**: MySQL
-   **Packages**: `maatwebsite/excel` for data exports.

