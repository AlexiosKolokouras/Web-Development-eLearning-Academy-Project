# 📌 Project Description

## Introduction

This project is a **Hotel Management System** developed using **PHP** and **MySQL**. It enables users to browse available rooms, view different room types, and manage their bookings efficiently. The application follows the **MVC (Model-View-Controller)** architecture for better code organization and maintainability.

## ✨ Features

- **Search & Filter**: Find available hotel rooms by city and type.
-  **User Authentication**: Secure login and session management.
-  **Booking System**: Reserve hotel rooms with real-time availability tracking.
-  **User Dashboard**: Manage bookings and view reservation history.
-  **Responsive UI**: Built with Bootstrap for a professional and user-friendly design.
-  **Database Schema**: Predefined `hotel.sql` file for easy database setup.

## 🏗️ Project Structure

The project is structured as follows:

```
Web-Development-eLearning-Academy-Project/
├── app/
│   ├── Controllers/   # Handles requests and business logic
│   ├── Models/        # Database interaction (User, Room, Booking)
│   ├── Services/      # Reusable functions for authentication & booking
├── boot/              # Initializes app settings and dependencies
├── config/            # Database configuration and environment settings
├── database/          # Contains hotel.sql for database setup
├── public/
│   ├── css/          # Stylesheets
│   ├── js/           # JavaScript & AJAX scripts
│   ├── images/       # Room images & icons
├── views/             # PHP templates for rendering UI
```

## 🛠️ Technologies Used

- **Backend**: PHP (OOP, MVC structure)
- **Database**: MySQL (User, Room, Booking data)
- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Session Management**: Secure authentication & tracking
- **AJAX & jQuery**: Dynamic updates & smooth UI interactions

## 📥 Installation Guide

### Prerequisites

Ensure you have the following installed:

- **XAMPP** (Apache, MySQL, PHP)

### Setup Instructions (Using XAMPP)

1. **Download and Install XAMPP**

   - Download from [Apache Friends](https://www.apachefriends.org/index.html) and install.
   - Start **Apache** and **MySQL** from the XAMPP Control Panel.

2. **Clone the Repository**

   ```sh
   git clone https://github.com/your-username/Web-Development-eLearning-Academy-Project.git
   ```

   Or download and extract the ZIP file.

3. **Move the Project to XAMPP's ****`htdocs`**** Directory**

   ```sh
   mv Web-Development-eLearning-Academy-Project C:\xampp\htdocs\
   ```

4. **Create the Database**

   - Open **phpMyAdmin** (`http://localhost/phpmyadmin/`)
   - Click **Databases**, enter `hotel` as the database name, and click **Create**.
   - Select `hotel` database → **Import** tab → Upload `hotel.sql` from `database/` folder → Click **Go**.

5. **Configure Database Connection**

   - Open `config/database.php` and update credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'hotel');
     ```

6. **Run the Project**

   - Open a browser and navigate to:
     ```
     http://localhost/Web-Development-eLearning-Academy-Project/public/
     ```

## 📌 Usage Guide

### 🔹 User Experience

- Register/Login securely.
- Browse rooms and view details.
- Book a room by selecting dates.
- Manage bookings via dashboard.

### 🔹 Admin Panel

- Navigate to `http://localhost/Web-Development-eLearning-Academy-Project/admin/`
- Login as admin (credentials stored in the database).
- Manage users, rooms, and bookings.

### 🔹 Database Management

- Use `phpMyAdmin` to modify records.
- Adjust room availability, prices, and user details.

---

💡 **Happy Coding!** 🚀

⚡ If you liked this project, don't forget to give a ⭐ on the repository!
