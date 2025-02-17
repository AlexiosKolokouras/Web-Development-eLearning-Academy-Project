# Web Development eLearning Academy Project

## Overview

This project is a hotel management system built using PHP and MySQL. It allows users to browse available rooms, view different room types, and manage their bookings. The application follows an MVC (Model-View-Controller) architecture for better code organization and maintainability.

## Features

- Retrieve and filter available hotel rooms by city and type.
- Secure user authentication with session management.
- Booking system for reserving hotel rooms with real-time availability.
- User dashboard for managing bookings and viewing reservation history.
- Responsive web interface with a modern and user-friendly design.
- Database schema (`hotel.sql`) for easy setup and deployment.
- Uses **Bootstrap** for a responsive and professional UI.

## Project Structure

The project is organized into the following directories:

- `app/` - Contains the main application logic, including:
  - `Models/` - Handles database interactions (e.g., `Room.php`, `User.php`, `Booking.php`).
  - `Controllers/` - Manages HTTP requests and responses, routing, and business logic.
  - `Services/` - Reusable functions for authentication, room filtering, and booking handling.
- `boot/` - Initializes application settings, loads dependencies, and sets up environment variables.
- `config/` - Configuration files for database connections and environment settings.
- `database/` - Contains the `hotel.sql` file, which includes table structures for users, rooms, bookings, and reviews.
- `public/` - Publicly accessible assets:
  - `css/` - Contains stylesheets for frontend design.
  - `js/` - JavaScript files for user interactivity and AJAX requests.
  - `images/` - Stores media files such as room images and icons.
- `views/` - PHP templates used for rendering the user interface.

## Technologies Used

- **Backend**: PHP (Object-Oriented Programming, MVC structure)
- **Database**: MySQL for storing user, room, and booking data.
- **Frontend**: HTML, CSS, JavaScript, and Bootstrap for a responsive user experience.
- **Session Management**: Secure user authentication and session tracking.
- **AJAX & jQuery**: For dynamic updates and smooth interactions.

## Installation

### Prerequisites

Ensure you have the following installed on your system:

- XAMPP (Apache, MySQL, PHP)

### Setup Instructions Using XAMPP

1. **Download and Install XAMPP:**
   - Download XAMPP from [Apache Friends](https://www.apachefriends.org/index.html) and install it on your system.
   - Start **Apache** and **MySQL** from the XAMPP Control Panel.

2. **Clone the repository:**
   ```sh
   git clone https://github.com/your-username/Web-Development-eLearning-Academy-Project.git
   ```
   Or download the project as a ZIP file and extract it.

3. **Move the project to XAMPP's `htdocs` directory:**
   ```sh
   mv Web-Development-eLearning-Academy-Project C:\xampp\htdocs\
   ```

4. **Create the database:**
   - Open **phpMyAdmin** by navigating to `http://localhost/phpmyadmin/` in your browser.
   - Click on **Databases**, enter `hotel` as the database name, and click **Create**.
   - Select the `hotel` database and go to the **Import** tab.
   - Click **Choose File**, select `hotel.sql` from the `database/` folder, and click **Go** to import the schema.

5. **Configure the database connection:**
   - Open `config/database.php` and update the database credentials:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'hotel');
     ```

6. **Run the project:**
   - Open a web browser and navigate to:
     ```
     http://localhost/Web-Development-eLearning-Academy-Project/public/
     ```

## Usage

- **User Registration & Login**: Create an account and log in securely.
- **Room Search & Booking**: Browse available rooms, filter results, and make reservations.
- **Booking Management**: View, cancel, or modify existing bookings from the dashboard.
- **User Profile**: Update personal details and track booking history.

## How to Use the Project

1. **Admin Panel:**
   - Access the admin panel by navigating to `http://localhost/Web-Development-eLearning-Academy-Project/admin/`
   - Log in with admin credentials (stored in the database).
   - Manage users, rooms, and bookings.

2. **User Experience:**
   - Register or log in as a guest.
   - Browse available rooms and view details.
   - Book a room by selecting dates and completing the reservation.
   - View your booking history and manage existing reservations.

3. **Database Management:**
   - Use `phpMyAdmin` to manage database records.
   - Modify room types, prices, and availability directly from the database if needed.

## License

This project is licensed under the MIT License. Feel free to use and modify it as needed.

